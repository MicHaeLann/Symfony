<?php
namespace BlogBundle\Extension;

use BlogBundle\Entity\Category;

/**
* Class Used to Generate Category List
*/
class CategoryList extends Category
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    public $navEdit;

    /**
     * @var string
     */
    public $navDel;
    
    /**
     * @var string
     */
    public $navView;

    /**
    * Extend Parent Parameters
    */
    public function __construct()
    {
        $this->name = parent::getName();
    }
}