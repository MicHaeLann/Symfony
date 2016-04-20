<?php

namespace Stvn\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\FormError;

use Stvn\UserBundle\Entity\User;
use Stvn\UserBundle\Form\Type\UserType;

/**
 * @author Steven
 * controller used to handle user log in and sign up
 */
class DefaultController extends Controller
{
    /**
     * user login
     * @param Request $request
     * @return Response
     */
    public function loginAction(Request $request)
    {
        //create login form
        $defaultData = array();
        $form = $this->createFormBuilder($defaultData)
                ->add('userName', 'email',
                        array('constraints' => new Email())
                        )
                ->add('userPassword', 'password', 
                        array('constraints' => new Length(array('min'=>6,'max'=>15)))
                        )
                ->add('login', 'submit')
                ->getForm();

        //reflect form to entity
        $form->handleRequest($request);
        if( $form->isValid() ){//user request to log in
            $loginData = $form->getData();
            $email = $loginData['userName'];
            $user = $this->getDoctrine()
                    ->getRepository("StvnUserBundle:User")
                    ->findOneByEmail($email);
            if(empty($user)){//user not found
                $form->addError(new FormError('email hasn\'t been registered'));
            }elseif($user->getPassword() != md5($loginData['userPassword'])){//password error
                $form->addError(new FormError('email or password was wrongly input'));
            }else{//login successful, write session and forward to blog index page
                $session = $request->getSession();
                $session->set('uid', $user->getId());
                $session->set('email', $user->getEmail());
                $response = $this->forward('StvnBlogBundle:Default:index', array('categoryId' => 0));
                return $response;
            }
        }
        return $this->render('StvnUserBundle:Default:login.html.twig', array(
            'form' => $form->createView()
        ));
    }
    /**
     * user sign up
     * @param Request $request
     * @return Response
     */
    public function signAction(Request $request)
    {
        //create sign-up form
        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        //reflect form to entity
        $form->handleRequest($request);
        if( $form->isValid() ){
            $confirmed_password = $form->get('confirmed_password')->getData();
            if( $confirmed_password != $user->getPassword() ){//wrongly re-entered password
                $form->addError(new FormError('password confirmation doesn\'t conform password'));
            }else{
                //persist user information
                try{
                    $em = $this->getDoctrine()->getManager();
                    $currentTime = new \DateTime();
                    $user->setPassword(md5($user->getPassword()));
                    $user->setCreateTime($currentTime);
                    $user->setUpdateTime($currentTime);
                    $em->persist($user);
                    $em->flush();
                    return $this->render('StvnUserBundle:Default:sign_success.html.twig');
                }catch(\Exception $e){
                    return $this->render('StvnUserBundle:Default:sign_failure.html.twig');
                }
            }
        }

        return $this->render('StvnUserBundle:Default:sign.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
