<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 05-06-2015
 * Time: 7:22
 */

namespace cellar\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CustomerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);
        $builder->add('customer_rut', 'text', array(
            'label' => 'RUT',
            'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
            'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'RUT'),
        ))
            ->add('customer_name', 'text', array(
                'label' => 'Nombres',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Nombres')
            ))
            ->add('customer_lastname', 'text', array(
                'label' => 'Apellido paterno',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Apellido paterno')
            ))
            ->add('customer_motherslastname', 'text', array(
                'label' => 'Apellido materno',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Apellido materno')
            ))
            ->add('customer_address', 'text', array(
                'label' => 'Dirección',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array( 'novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Dirección')
            ))
            ->add('save', 'submit', array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-default btn-sm', 'style' => '  float: right;')));
    }

    public function getName()
    {
        return 'Customer';
    }
}