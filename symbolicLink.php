<?php 

/**
 * create a symbolic link
 */
class symbolicLink
{
	/**
	 * the directory or the file that you want to create a shortcut for
	 *
	 * @var string
	 */
	private $target;

	/**
	 * the directory where you can put the shortcut directory or file
	 *
	 * @var string
	 */
	private $link;

    /**
     * creates a symbolic link from the given input
     *
     * @return void
     */
    public function __construct($target, $link)
    {
		$this->target = $target;  
		$this->link   = $link;
		symlink($this->target, $this->link);
    }
}

// example:
new symbolicLink('/home/users/100/project/storage/app/public','/home/users/100/project/public/storage');
