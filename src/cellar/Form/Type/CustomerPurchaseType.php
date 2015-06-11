<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 05-06-2015
 * Time: 15:33
 */

namespace cellar\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CustomerPurchaseType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);
        $builder->add('id_customer', 'text', array(
            'label' => 'Nro Cliente',
            'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
            'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Nro Cliente'),
        ))
            ->add('invoice_detail_price', 'text', array(
                'label' => 'Precio de producto',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('value' => '0','novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Precio de producto')
            ))
            ->add('invoice_detail_quantity', 'text', array(
                'label' => 'Cantidad de producto',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('value' => '0','novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Cantidad de producto')
            ))
            ->add('invoice_detail_discount', 'text', array(
                'label' => 'Descuento',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('value' => '0','novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Descuento')
            ))
            ->add('invoice_detail_total', 'text', array(
                'label' => 'Total',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('required' => false, 'value' => '0','novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Total')
            ))
            ->add('id_product', 'text', array(
                'label' => 'Nro producto',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Nro producto')
            ))
            ->add('save', 'submit', array('label' => 'Registrar venta', 'attr' => array('class' => 'btn btn-default btn-sm', 'style' => '  float: right;')));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "customerPurchase";
    }
}