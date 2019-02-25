<?php

namespace App\Repoes;

use App\Models\Product as Model;

class CartRepo
{
    /**
     * the model.
     *
     * @var object
     */
    private $model;

    /**
     * the cart.
     *
     * @var array
     */
    private $cart;

    /**
     * Init.
     *
     * @param  object  $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $has_cart    = session()->has('cart-'.auth()->user()->id);
        if($has_cart)
            $this->cart = session()->get('cart-'.auth()->user()->id);
        else{
            session()->put('cart-'.auth()->user()->id, []);
            $this->cart = session()->get('cart-'.auth()->user()->id);
        }
    }

    /**
     * Change the content of the cart.
     *
     * @return \Illuminate\Http\Response
     */
    private function change(array $cart)
    {
        session()->put('cart-'.auth()->user()->id, $cart);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($request)
    {
        return response()->json($this->cart);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $model = $this->model->find($request['id']);

        // if item exists in the cart then update the quantity of the item 
        if(isset($this->cart[$request['id']])) {
            $this->cart[$request['id']]['quantity']++;
            $this->change($this->cart);
            return response()->json($this->cart);
        }

        // otherwise add the item to the cart
        $this->cart[$request['id']] = [
            'id'       => $request['id'],
            'name'     => $model->name,
            'quantity' => $request['quantity'],
            'price'    => $model->price,
            'image'    => $model->image
        ];
        $this->change($this->cart);
        return response()->json($this->cart);
    }

    /**
     * update a resource in storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, $request)
    {
        $this->cart[$request['id']]['quantity'] = $request['quantity'];
        $this->change($this->cart);
        return response()->json($this->cart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(isset($this->cart[$request['id']])) {
            unset($this->cart[$request['id']]);
            $this->change($this->cart);
        }
        return response()->json($this->cart);
    }
}

