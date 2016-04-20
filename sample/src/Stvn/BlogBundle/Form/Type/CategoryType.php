<?php
namespace Stvn\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
/**
 * @author Steven
 * help creating category form
 */
class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('name', 'text')
                ->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'Stvn\BlogBundle\Entity\Category'
        ));
    }

    public function getName(){
        return 'Category';
    }
}
?>