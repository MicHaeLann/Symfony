<?php
namespace BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use \stdClass;
use BlogBundle\Entity\User;
use BlogBundle\Entity\Category;
use BlogBundle\Entity\Article;

use BlogBundle\Extension\UserRegister;
use BlogBundle\Extension\CategoryList;
use BlogBundle\Extension\ArticleList;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\FormError;

/**
* Blog Controller Class
*/
class DefaultController extends Controller
{
	/**
	* Homepage
	* @return Response
	*/
	public function homeAction()
	{
		$navs = $this->generateNav(array('home'));

		return $this->render('BlogBundle:home.html.twig', array(
			'navs' => $navs,
            'navJoin' => $this->get('router')->generate('blog_user_register'),
            'navLogin' => $this->get('router')->generate('blog_user_login')
		));
	}

    /**
    * User Register
    * @param Request $request
    * @return Response
    */
    public function registerAction(Request $request)
    {
    	$navs = $this->generateNav(array('home'));
    	
    	$user = new UserRegister;

    	$form = $this->createFormBuilder($user)
    		->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'width: 200px;margin-bottom: 15px')))
    		->add('password', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'width: 200px;margin-bottom: 15px')))
    		->add('confirm_password', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'width: 200px;margin-bottom: 15px')))
    		->add('submit', SubmitType::class, array('attr' => array('class' => 'btn btn-success')))
    		->getForm();

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
    		$name = $form['name']->getData();
    		$password = $form['password']->getData();
    		$confirm_password = $form['confirm_password']->getData();

    		if ($password != $confirm_password) {
    			$form->addError(new FormError('password not match.'));
    		} else {
    			$user = $this->getDoctrine()
                    ->getRepository("BlogBundle:User")
                    ->findOneByName($name);
                if (!empty($user)) {
                	$form->addError(new FormError('user already exists.'));
                } else {
                	$user = new User;
                	$current_time = new \DateTime('now');

                	$user->setName($name);
		    		$user->setPassword(md5($password));
		    		$user->setCreateDate($currentTime);
		    		$user->setUpdateDate($currentTime);

		    		$em = $this->getDoctrine()->getManager();
		    		$em->persist($user);
		    		$em->flush();

		    		$this->addFlash(
		    			'notice',
		    			'user register'
		    		);
		    		return $this->redirectToRoute('blog_category_list');	
                }
    		}
    	}

    	return $this->render('BlogBundle:user.html.twig', array(
    		'navs' => $navs,
    		'title' => 'User Register',
    		'form' => $form->createView()
    	));
    }

    /**
    * User Login
    * @param Request $request
    * @return Response
    */
    public function loginAction(Request $request)
    {
    	$navs = $this->generateNav(array('home'));

    	$user = new User;

    	$form = $this->createFormBuilder($user)
    		->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'width: 200px;margin-bottom: 15px')))
    		->add('password', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'width: 200px;margin-bottom: 15px')))
    		->add('login', SubmitType::class, array('attr' => array('class' => 'btn btn-success')))
    		->getForm();

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
    		$name = $form['name']->getData();
    		$password = $form['password']->getData();

    		$user = $this->getDoctrine()
                    ->getRepository("BlogBundle:User")
                    ->findOneByName($name);

            if (empty($user)) {
            	$form->addError(new FormError('name does not exist.'));
            } elseif ($user->getPassword() != md5($password)) {
            	$form->addError(new FormError('password not match.'));
            } else {
            	$current_time = new \DateTime('now');
            	
            	$user->setUpdateDate($current_time);

            	$em = $this->getDoctrine()->getManager();
                $em->flush();

                $this->addFlash(
                	'notice',
                	'user login'
                );
            	
            	$session = $request->getSession();
                $session->set('uid', $user->getId());
                $session->set('name', $user->getName());
                return $this->redirectToRoute('blog_category_list');
            }
    	}

    	return $this->render('BlogBundle:user.html.twig', array(
    		'navs' => $navs,
    		'title' => 'User Login',
    		'form' => $form->createView()
    	));
    }

    /**
    * Category List
    * @param Request $request
    * @return Response
    */
    public function listCategoryAction(Request $request)
    {
    	$navs = $this->generateNav(array('home', 'category', 'article'));

		$nav_create = new stdClass;
    	$nav_create->title = 'Create';
    	$nav_create->url = $this->get('router')->generate('blog_category_create');

		$session = $request->getSession();
        $uid = $session->get('uid');
        if (!\is_numeric($uid) || $uid <= 0) {
            throw $this->createNotFoundException("You don't have access to this page, please login first");
        }

        $list = $this->generateSidebar($uid);

        return $this->render('BlogBundle:category_list.html.twig', array(
        	'navs' => $navs,
        	'nav_create' => $nav_create,
        	'title' => 'Category',
        	'categories' => $list
        ));
    }

    /**
	* Create Category
	* @param Request $request
	* @return Response
    */
    public function createCategoryAction(Request $request)
    {
    	$navs = $this->generateNav(array('home', 'category', 'article'));

		$session = $request->getSession();
        $uid = $session->get('uid');
        if (!\is_numeric($uid) || $uid <= 0) {
            throw $this->createNotFoundException("You don't have access to this page, please login first");
        }

        $list = $this->generateSidebar(intval($uid));

    	$category = new Category;

    	$form = $this->createFormBuilder($category)
    		->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'width: 200px;margin-bottom: 15px')))
    		->add('create', SubmitType::class, array('attr' => array('class' => 'btn btn-success')))
    		->getForm();

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
    		$name = $form['name']->getData();
    		$category = $this->getDoctrine()
    			->getRepository('BlogBundle:Category')
    			->findBy(array(
    				'userId' => $uid,
    				'name' => $name
    			));

			if (!empty($category)) {
				$form->addError(new FormError('Category already exists.'));
    		} else {
    			$current_time = new \DateTime('now');

    			$category = new Category;
    			$category->setName($name);
    			$category->setUserId($uid);
    			$category->setCreateDate($current_time);
    			$category->setUpdateDate($current_time);

    			$em = $this->getDoctrine()->getManager();
    			$em->persist($category);
    			$em->flush();

    			$this->addFlash(
    				'notice',
    				'category create'
    			);

    			return $this->redirectToRoute('blog_category_list');
    		}
    	}

    	return $this->render('BlogBundle:category.html.twig', array(
    		'navs' => $navs,
    		'title' => 'Create Category',
    		'form' => $form->createView(),
    		'categories' => $list
    	));
    }

    /**
    * Edit Category
    * @param Integer $id
    * @param Request $request
    * @return Response
    */
    public function editCategoryAction($id, Request $request)
    {
    	$navs = $this->generateNav(array('home', 'category', 'article'));

		$session = $request->getSession();
        $uid = $session->get('uid');
        if (!\is_numeric($uid) || $uid <= 0) {
            throw $this->createNotFoundException("You don't have access to this page, please login first");
        }
        
        $list = $this->generateSidebar($uid);

    	$category = $this->getDoctrine()
    				->getRepository('BlogBundle:Category')
    				->find($id);

    	$form = $this->createFormBuilder($category)
    		->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'width: 200px;margin-bottom: 15px')))
    		->add('save', SubmitType::class, array('attr' => array('class' => 'btn btn-success')))
    		->getForm();

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
    		$name = $form['name']->getData();
    		$updated_category = $this->getDoctrine()
    			->getRepository('BlogBundle:Category')
    			->findBy(array(
    				'userId' => $uid,
    				'name' => $name
    			));

			if (!empty($updated_category)) {
				$form->addError(new FormError('Category already exists.'));
    		} else {
    			$current_time = new \DateTime('now');

    			$category->setName($name);
    			$category->setUpdateDate($current_time);

    			$em = $this->getDoctrine()->getManager();
    			$em->flush();

    			$this->addFlash(
    				'notice',
    				'category edit'
    			);

    			return $this->redirectToRoute('blog_category_list');
    		}
    	}

    	return $this->render('BlogBundle:category.html.twig', array(
    		'navs' => $navs,
    		'title' => 'Edit Category',
    		'form' => $form->createView(),
    		'categories' => $list
    	));
    }

    /**
    * Delete Category
    * @param Integer $id
    * @param Request $request
    * @return Response
    */
    public function deleteCategoryAction($id, Request $request)
    {
    	$navs = $this->generateNav(array('home', 'category', 'article'));

		$session = $request->getSession();
        $uid = $session->get('uid');
        if (!\is_numeric($uid) || $uid <= 0) {
            throw $this->createNotFoundException("You don't have access to this page, please login first");
        }

        $category = $this->getDoctrine()
    			->getRepository('BlogBundle:Category')
    			->find($id);

    	$em = $this->getDoctrine()->getManager();
    	$em->remove($category);
    	$em->flush();

    	$this->addFlash(
			'notice',
			'category remove'
		);

		return $this->redirectToRoute('blog_category_list');
    }

    /**
    * Article List
    * @param Integer $id
    * @param Request $request
    * @return Response
    */
    public function listArticleAction($id, Request $request)
    {
    	$navs = $this->generateNav(array('home', 'category', 'article'));

    	$nav_create = new stdClass;
    	$nav_create->title = 'Create';
    	$nav_create->url = $this->get('router')->generate('blog_article_create');

		$session = $request->getSession();
        $uid = $session->get('uid');
        if (!\is_numeric($uid) || $uid <= 0) {
            throw $this->createNotFoundException("You don't have access to this page, please login first");
        }

        $categories = $this->generateSidebar($uid);

        $current_category = $this->getDoctrine()
                                ->getRepository('BlogBundle:Category')
                                ->find($id);

        if ($id == 0) {
        	$articles = $this->getDoctrine()
        			->getRepository('BlogBundle:Article')
        			->findByUserId($uid);
        } else {
        	$articles = $this->getDoctrine()
        			->getRepository('BlogBundle:Article')
        			->findBy(array(
        				'userId' => $uid,
        				'categoryId' => $id
        			));
    	}

    	$list = array();

    	foreach ($articles as $article) {
    		$article_list = new ArticleList;

    		$article_list->setTitle($article->getTitle());
    		$article_list->setContent($article->getContent());
    		$article_list->setCreateDate($article->getCreateDate());
    		$article_list->navView = $this->get('router')->generate('blog_article_view', array('id' => $article->getId()));

    		$list[] = $article_list;
    	}

    	return $this->render('BlogBundle:article_list.html.twig', array(
    		'navs' => $navs,
    		'nav_create' => $nav_create,
    		'title' => $id > 0 ? $current_category->getName() : 'All Articles',
    		'categories' => $categories,
    		'articles' => $list
    	));
    }
        
    /**
    * Create Article
    * @param Request $request
    * @return Response
    */
    public function createArticleAction(Request $request)
    {
    	$navs = $this->generateNav(array('home', 'category', 'article'));

		$session = $request->getSession();
        $uid = $session->get('uid');
        if (!\is_numeric($uid) || $uid <= 0) {
            throw $this->createNotFoundException("You don't have access to this page, please login first");
        }

        $list = $this->generateSidebar(intval($uid));

    	$choices = array();

    	$categories = $this->getDoctrine()
                    ->getRepository("BlogBundle:Category")
                    ->findByUserId($uid);
        
        foreach ($categories as $category) {
        	$id = $category->getId();
        	$name = $category->getName();
        	$choices[$name] = $id;
        }

        $article = new Article;

    	$form = $this->createFormBuilder($article)
    		->add('title', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'width: 200px;margin-bottom: 15px')))
    		->add('content', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'width: 600px;height: 400px;margin-bottom: 15px')))
    		->add('categoryId', ChoiceType::class, array('label'=> 'Category', 'choices' => $choices, 'attr' => array('style' => 'margin-bottom: 15px')))
    		->add('publish', SubmitType::class, array('attr' => array('class' => 'btn btn-success')))
    		->getForm();

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
    		$title = $form['title']->getData();
    		$content = $form['content']->getData();
    		$categoryId = $form['categoryId']->getData();
            $article = $this->getDoctrine()
    			->getRepository('BlogBundle:Article')
    			->findBy(array(
    				'userId' => $uid,
                    'categoryId' => $categoryId,
    				'title' => $title
    			));

			if (!empty($article)) {
				$form->addError(new FormError('Article already exists.'));
    		} else {
    			$current_time = new \DateTime('now');

    			$article = new Article;

    			$article->setUserId($uid);
    			$article->setCategoryId($categoryId);
    			$article->setTitle($title);
    			$article->setContent($content);
    			$article->setCreateDate($current_time);
    			$article->setUpdateDate($current_time);

    			$em = $this->getDoctrine()->getManager();
    			$em->persist($article);
    			$em->flush();

    			$this->addFlash(
    				'notice',
    				'article publish'
    			);

    			return $this->redirectToRoute('blog_article_list', array('id' => $categoryId));
    		}
    	}

    	return $this->render('BlogBundle:article.html.twig', array(
    		'navs' => $navs,
    		'title' => 'Publish Article',
    		'form' => $form->createView(),
    		'categories' => $list
    	));
    }

    /**
    * Edit Article
    * @param Integer $id
    * @param Request $request
    * @return Response
    */
    public function editArticleAction($id, Request $request)
    {
        $navs = $this->generateNav(array('home', 'category', 'article'));

        $session = $request->getSession();
        $uid = $session->get('uid');
        if (!\is_numeric($uid) || $uid <= 0) {
            throw $this->createNotFoundException("You don't have access to this page, please login first");
        }

        $list = $this->generateSidebar(intval($uid));

        $choices = array();

        $categories = $this->getDoctrine()
                    ->getRepository("BlogBundle:Category")
                    ->findByUserId($uid);
        
        foreach ($categories as $category) {
            $cid = $category->getId();
            $name = $category->getName();
            $choices[$name] = $cid;
        }

        $article = $this->getDoctrine()
                    ->getRepository('BlogBundle:Article')
                    ->find($id);

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'width: 200px;margin-bottom: 15px')))
            ->add('content', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'width: 600px;height: 400px;margin-bottom: 15px')))
            ->add('categoryId', ChoiceType::class, array('label'=> 'Category', 'choices' => $choices, 'data' => $article->getCategoryId(), 'attr' => array('style' => 'margin-bottom: 15px')))
            ->add('save', SubmitType::class, array('attr' => array('class' => 'btn btn-success')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $title = $form['title']->getData();
            $content = $form['content']->getData();
            $categoryId = $form['categoryId']->getData();
            $updated_article = $this->getDoctrine()
                ->getRepository('BlogBundle:Article')
                ->findBy(array(
                    'userId' => $uid,
                    'categoryId' =>$categoryId,
                    'title' => $title
                ));

            if (!empty($updated_article)) {
                $form->addError(new FormError('Article already exists.'));
            } else {
                $current_time = new \DateTime('now');

                $article->setCategoryId($categoryId);
                $article->setTitle($title);
                $article->setContent($content);
                $article->setUpdateDate($current_time);

                $em = $this->getDoctrine()->getManager();
                $em->flush();

                $this->addFlash(
                    'notice',
                    'article edit'
                );

                return $this->redirectToRoute('blog_article_list', array('id' => $categoryId));
            }
        }

        return $this->render('BlogBundle:article.html.twig', array(
            'navs' => $navs,
            'title' => 'Update Article',
            'form' => $form->createView(),
            'categories' => $list
        ));
    }

    /**
    * View Article
    * @param $id
    * @param Request $request
    * @return Response
    */
    public function viewArticleAction($id, Request $request)
    {
        $navs = $this->generateNav(array('home', 'category', 'article'));

        $session = $request->getSession();
        $uid = $session->get('uid');
        if (!\is_numeric($uid) || $uid <= 0) {
            throw $this->createNotFoundException("You don't have access to this page, please login first");
        }

        $list = $this->generateSidebar(intval($uid));

        $article = $this->getDoctrine()
                        ->getRepository('BlogBundle:Article')
                        ->find($id);

        $article_list = new ArticleList;
        $article_list->setTitle($article->getTitle());
        $article_list->setCreateDate($article->getCreateDate());
        $article_list->setContent($article->getContent());
        $article_list->navEdit = $this->get('router')->generate('blog_article_edit', array('id' => $article->getId()));

        return $this->render('BlogBundle:article_view.html.twig', array(
            'navs' => $navs,
            'title' => 'Article',
            'article' => $article_list,
            'categories' => $list
        ));
    }

    /**
    * Function Used to Generate Header Navigation
    * @param Array $arr
    * @return Array
    */
    private function generateNav(Array $arr)
    {
    	$navs = array();

    	foreach ($arr as $item) {
    		$nav = new stdClass;
    		switch ($item) {
    			case 'home':
    				$nav->title = 'Home';
    				$nav->url = $this->get('router')->generate('blog_homepage');
    				break;
    			case 'category':
    				$nav->title = 'Category';
    				$nav->url = $this->get('router')->generate('blog_category_list');
    				break;
    			case 'article':
    				$nav->title = 'Article';
    				$nav->url = $this->get('router')->generate('blog_article_list', array('id' => 0));
    				break;

    		}
    		$navs[] = $nav;
    	}

    	return $navs;
    }

    /**
    * Function Used to Generate Sidebar
    * @param Integer $uid
    * @return Array
    */
    private function generateSidebar($uid)
    {
    	$list = array();

    	$categories = $this->getDoctrine()
                    ->getRepository("BlogBundle:Category")
                    ->findByUserId($uid);

    	foreach ($categories as $category) {
        	$category_list = new CategoryList;

        	$category_list->setName($category->getName());
        	$category_list->navEdit = $this->get('router')->generate('blog_category_edit', array('id' => $category->getId()));
        	$category_list->navDel = $this->get('router')->generate('blog_category_delete', array('id' => $category->getId()));
        	$category_list->navView = $this->get('router')->generate('blog_article_list', array('id' => $category->getId()));

        	$list[] = $category_list;
        }

        return $list;
    }
}
