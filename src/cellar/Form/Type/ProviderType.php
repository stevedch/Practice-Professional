<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 05-06-2015
 * Time: 21:23
 */

namespace cellar\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ProviderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);
        $builder->add('provider_name', 'text', array(
            'label' => 'Nombre de proveedor',
            'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
            'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Nombre de proveedor'),
        ))
            ->add('provider_telephone', 'text', array(
                'label' => 'Télefono',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'ejm: 022 2484494')
            ))
            ->add('provider_address', 'text', array(
                'label' => 'Dirección',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Dirección')
            ))
            ->add('save', 'submit', array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-default btn-sm', 'style' => '  float: right;')));
    }

    public function getName()
    {
        return 'Provider';
    }
}