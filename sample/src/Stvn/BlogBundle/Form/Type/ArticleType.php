<?php
namespace Stvn\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @author Steven
 * help creating article form
 */
class ArticleType extends AbstractType
{
    /**
     * all categories
     * @var Array
     */
    protected $categories;
    /**
     * current category id
     * @var Integer
     */
    protected $categoryId;
    
    /**
     * input parameters used for creating category choices
     * @param Array $categories
     * @param Integer $categoryId
     */
    public function __construct($categories, $categoryId = 0){
        $this->categories = $categories;
        $this->categoryId = $categoryId;
    }
    public function buildForm(FormBuilderInterface $builder, array $options){
        $choices = array();
        $firstCategoryId = 0;
        foreach( $this->categories as $category ){
            if( $firstCategoryId <= 0 ){
                $firstCategoryId = $category->getId();
            }
            $choices[$category->getId()] = $category->getName();
        }
        $data = $this->categoryId > 0 ? $this->categoryId :  $firstCategoryId;
        $builder->add('title',  'text')
                ->add('content', 'textarea')
                ->add('categoryId', 'choice', array('choices' => $choices, 'data' => $data))
                ->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'Stvn\BlogBundle\Entity\Article'
        ));
    }

    public function getName(){
        return 'Article';
    }
}
?>