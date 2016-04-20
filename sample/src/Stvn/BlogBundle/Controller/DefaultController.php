<?php

namespace Stvn\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Stvn\BlogBundle\Entity\Category;
use Stvn\BlogBundle\Form\Type\CategoryType;
use Stvn\BlogBundle\Entity\Article;
use Stvn\BlogBundle\Form\Type\ArticleType;

/**
 * @author Steven
 * controller to handle blog category and blog article
 */
class DefaultController extends Controller
{
    /**
     * store userId
     * @var Integer
     */
    protected static $userId = null;

    /**
     * blog index listing all categories and articles
     * @param Integer $categoryId
     * @param Request $request
     * @return Response
     */
    public function indexAction($categoryId, Request $request)
    {
        $this->setUserId($request);//fetch userId from session

        //get all categories
        $categories = $this->getDoctrine()
                ->getRepository('StvnBlogBundle:Category')
                ->findByUserId(self::$userId);

        //get articles
        $articles = array();
        if($categoryId > 0){//fetch articles under specific category
            $articles = $this->getDoctrine()
                    ->getRepository('StvnBlogBundle:Article')
                    ->findBy(array(
                        'userId' => self::$userId,
                        'categoryId' => $categoryId
                    ));
        }else{//fetch all articles if specific category not indicated
            $articles = $this->getDoctrine()
                    ->getRepository('StvnBlogBundle:Article')
                    ->findByUserId(self::$userId);
        }
        return $this->render('StvnBlogBundle:Default:index.html.twig', array(
            "categories" => $categories,
            "articles" => $articles
        ));
    }
    /**
     * display details of articles
     * @param Integer $id
     * @param Request $request
     * @return Response
     */
    public function detailAction($id, Request $request){
        $this->setUserId($request);
        if(\is_numeric($id) && $id > 0){// check id validation
            $article = $this->getDoctrine()
                    ->getRepository('StvnBlogBundle:Article')
                    ->find($id);
            //make sure article with specific id exists and the owner is current user
            if(!empty($article) && $article->getUserId() == self::$userId){
                return $this->render('StvnBlogBundle:Default:detail.html.twig', array(
                    "article" => $article
                ));
            }
        }
        throw $this->createNotFoundException("You don't have access to this page, article doesn't exist");
    }
    /**
     * add new category
     * @param Request $request
     * @return Response
     */
    public function addCategoryAction(Request $request){
        $this->setUserId($request);

        //create category form
        $category = new Category();
        $form = $this->createForm(new CategoryType(), $category);

        //reflect form to entity
        $form->handleRequest($request);
        if( $form->isValid() ){
            try{
                //persist category
                $em = $this->getDoctrine()->getManager();
                $currentTime = new \DateTime();
                $category->setUserId(self::$userId);
                $category->setCreateTime($currentTime);
                $category->setUpdateTime($currentTime);
                $em->persist($category);
                $em->flush();
                return $this->render('StvnBlogBundle:Default:add_category_success.html.twig');
            }catch(\Exception $e){
                return $this->render('StvnBlogBundle:Default:add_category_failure.html.twig');
            }
        }
        return $this->render('StvnBlogBundle:Default:add_category.html.twig', array(
            'form' => $form->createView()
        ));
    }
    /**
     * edit and save category
     * @param Integer $id
     * @param Request $request
     * @return Response
     */
    public function editCategoryAction($id, Request $request){
        $this->setUserId($request);
        if( \is_numeric($id) && $id > 0 ){// check category id valication
            $category = $this->getDoctrine()
                    ->getRepository('StvnBlogBundle:Category')
                    ->find($id);
            if( !empty($category) && $category->getUserId() == self::$userId){//check the owner of the category
                $form = $this->createForm(new CategoryType(), $category);
                //save modification of the category
                if($request->getMethod() == "POST"){
                    $form->handleRequest($request);
                    if( $form->isValid() ){
                        $currentTime = new \DateTime();
                        $category->setUpdateTime($currentTime);
                        try{
                            $em = $this->getDoctrine()->getManager();
                            $em->flush();
                            return $this->render('StvnBlogBundle:Default:edit_category_success.html.twig');
                        }catch(\Exception $e){
                            return $this->render('StvnBlogBundle:Default:edit_category_failure.html.twig');
                        }
                    }
                }
                return $this->render('StvnBlogBundle:Default:edit_category.html.twig', array(
                    'form' => $form->createView()
                ));
            }
        }
        throw $this->createNotFoundException("You don't have access to this page, category doesn't exist");
    }
    /**
     * add new article
     * @param Request $request
     * @return Response
     */
    public function addArticleAction(Request $request){
        $this->setUserId($request);
        //create article form
        $categories = $this->getDoctrine()
                ->getRepository('StvnBlogBundle:Category')
                ->findByUserId(self::$userId);
        $article = new Article();
        $form = $this->createForm(new ArticleType($categories), $article);

        //reflect form to entity
        $form->handleRequest($request);
        if($form->isValid()){
            try{
                //persist article
                $category = $this->getDoctrine()
                    ->getRepository('StvnBlogBundle:Category')
                    ->find($article->getCategoryId());
                $em = $this->getDoctrine()->getManager();
                $currentTime = new \DateTime();
                $article->setUserId(self::$userId);
                $article->setCreateTime($currentTime);
                $article->setUpdateTime($currentTime);
                $article->setCategory($category);
                $em->persist($article);
                $em->flush();
                return $this->render('StvnBlogBundle:Default:add_article_success.html.twig');
            }catch(\Exception $e){
                return $this->render('StvnBlogBundle:Default:add_article_failure.html.twig');
            }
        }
        return $this->render('StvnBlogBundle:Default:add_article.html.twig', array(
            'form' => $form->createView()
        ));
    }
    /**
     * edit and save article
     * @param Integer $id
     * @param Request $request
     * @return Response
     */
    public function editArticleAction($id, Request $request){
        $this->setUserId($request);
        if( \is_numeric($id) && $id > 0 ){//check article id validation
            $article = $this->getDoctrine()
                    ->getRepository('StvnBlogBundle:Article')
                    ->find($id);
            //check the owner of the article
            if( !empty($article) && $article->getUserId() == self::$userId ){
                //create article form
                $categories = $this->getDoctrine()
                    ->getRepository('StvnBlogBundle:Category')
                    ->findByUserId(self::$userId);
                $form = $this->createForm(new ArticleType($categories, $article->getCategoryId()), $article);
                //reflect form to entity
                if($request->getMethod() == "POST"){
                    $form->handleRequest($request);
                    if( $form->isValid() ){
                        //persist modified article
                        $category = $this->getDoctrine()
                            ->getRepository('StvnBlogBundle:Category')
                            ->find($article->getCategoryId());
                        $article->setCategory($category);
                        $currentTime = new \DateTime();
                        $article->setUpdateTime($currentTime);
                        try{
                            $em = $this->getDoctrine()->getManager();
                            $em->flush();
                            return $this->render('StvnBlogBundle:Default:edit_article_success.html.twig');
                        }catch(\Exception $e){
                            return $this->render('StvnBlogBundle:Default:edit_article_failure.html.twig');
                        }
                    }
                }
                return $this->render('StvnBlogBundle:Default:edit_article.html.twig', array(
                    'form' => $form->createView()
                ));
            }
        }
        throw $this->createNotFoundException("You don't have access to this page, article doesn't exist");
    }
    /**
     * fetch userId from session to static userid property
     * @param Request $request 
     */
    protected function setUserId(Request $request){
        if(self::$userId === null){
            $session = $request->getSession();
            $userId = $session->get('uid');
            if( ! \is_numeric($userId) || $userId <=0 ){
                throw $this->createNotFoundException("You don't have access to this page, please login first");
            }
        }
        self::$userId = $userId;
    }
}