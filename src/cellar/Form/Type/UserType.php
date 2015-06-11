<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 02-06-2015
 * Time: 10:36
 */

namespace cellar\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);
        $builder->add('username', 'text', array(
            'label' => 'Usuario',
            'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
            'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Usuario'),
        ))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'options' => array('required' => false, 'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'style' => '', 'placeholder' => 'Contraseña')),
                'first_options' => array('label' => 'Contraseña'),
                'required' => false,
                'second_options' => array('label' => 'Repita la contraseña'),
                'first_name' => 'pass_1',
                'second_name' => 'pass_2',
                'invalid_message' => 'Los campos de contraseña deben coincidir.',
            ))
            ->add('mail', 'text', array(
                'label' => 'E-mail',
                'label_attr' => array('class' => '', 'style' => 'color:rgba(52, 52, 52, 0.85);'),
                'attr' => array('required' => false, 'novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'E-mail')
            ))
            ->add('status_user', 'choice', array(
                'label' => 'Estado de usuario',
                'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s'),
                'required' => true,
                'choices' => array(
                    '' => 'Seleccione item',
                    1 => 'Activar',
                    2 => 'Desactivar'
                ),
                'constraints' => new Assert\Choice(array(1, 2)),
            ))
            ->add('role', 'choice', array(
                'label' => 'Nivel de permiso módulos',
                'attr' => array('novalidate' => 'novalidate', 'class' => 'form-control box-s', 'placeholder' => 'Rol'),
                'choices' => array(
                    '' => 'Seleccione item',
                    'ROLE_SUPER_ADMIN' => 'Administrador General',
                    'ROLE_GERENTE' => 'Gerente',
                    'ROLE_OPERADOR' => 'Operador',
                    'ROLE_USER' => 'Usuario estándar'
                )
            ))
            ->add('save', 'submit', array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-default btn-sm', 'style' => 'float: inherit;')));
    }

    public function getName()
    {
        return 'User';
    }
}