<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 08-06-2015
 * Time: 6:06
 */

namespace cellar\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;


class ProductsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);
        $builder->add('category_name', 'text', array(
            'label' => 'Nombre de categoria',
            'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
            'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Nombre de categoria'),
        ))
            ->add('product_name', 'text', array(
                'label' => 'Nombre del producto',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Nombre del producto')
            ))
            ->add('product_price', 'text', array(
                'label' => 'Precio del producto',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('value' => '0','novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Precio del producto')
            ))
            ->add('product_max_discount', 'text', array(
                'label' => 'Máximo de descuento',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('value' => '0','novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Máximo de descuento')
            ))
            ->add('product_stock_quantity', 'text', array(
                'label' => 'Cantidad de stock',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('value' => '0','novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Cantidad de stock')
            ))
            ->add('save', 'submit', array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-default btn-sm', 'style' => '  float: right;')));
    }


    public function getName()
    {
        return 'Products';
    }
}