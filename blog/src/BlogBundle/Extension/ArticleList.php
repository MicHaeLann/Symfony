<?php
namespace BlogBundle\Extension;

use BlogBundle\Entity\Article;

/**
* Class Used to Generate Article List
*/
class ArticleList extends Article
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var datetime
     */
    private $createDate;

    /**
     * @var string
     */
    public $navEdit;
    
    /**
     * @var string
     */
    public $navView;

    /**
    * Extend Parent Parameters
    */
    public function __construct()
    {
        $this->title = parent::getTitle();
        $this->content = parent::getContent();
        $this->createDate = parent::getCreateDate();
    }
}