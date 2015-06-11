<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 04-06-2015
 * Time: 0:40
 */

namespace cellar\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PurchaseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);
        $builder->add('id_provider', 'text', array(
            'label' => 'Nro  proveedor',
            'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
            'attr' => array('required' => false, 'novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Nro  proveedor')
        ))
            ->add('id_product', 'text', array(
                'label' => 'Nro producto',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('required' => false, 'novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Nro producto')
            ))
            ->add('purchase_detail_unit_value', 'text', array(
                'label' => 'Valor unitario',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('required' => false, 'value' => '0', 'novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Valor unitario')
            ))
            ->add('purchase_detail_price', 'text', array(
                'label' => 'Precio',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('required' => false, 'value' => '0', 'novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Precio')
            ))
            ->add('purchase_detail_quantity', 'text', array(
                'label' => 'Cantidad de producto',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('required' => false, 'value' => '0', 'novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Cantidad de producto')
            ))
            ->add('purchase_detail_iva', 'text', array(
                'label' => 'Iva %',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('required' => false, 'value' => '19', 'novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Iva')
            ))
            ->add('purchase_detail_discount', 'text', array(
                'label' => 'Descuento %',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('required' => false, 'value' => '0', 'novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Descuento')
            ))
            ->add('purchase_detail_value_total', 'text', array(
                'label' => 'Valor total',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('required' => false, 'value' => '0', 'novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'total')
            ))
            ->add('save', 'submit', array('label' => 'Registrar compra', 'attr' => array('class' => 'btn btn-default btn-sm', 'style' => '  float: right;')));
    }

    public function getName()
    {
        return 'PurchaseType';
    }
}