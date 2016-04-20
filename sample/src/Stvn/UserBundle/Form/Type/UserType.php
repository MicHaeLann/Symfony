<?php
namespace Stvn\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @author Steven
 * helper to create user sign-up form
 */
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('email', 'email')
                ->add('password', 'password')
                ->add('confirmed_password', 'password', array(
                    'mapped' => false,
                    'constraints' => new Length(array('min' => 6, 'max' => 15))
                ))
                ->add('signUp', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'Stvn\UserBundle\Entity\User'
        ));
    }

    public function getName(){
        return 'SignUp';
    }
}
?>