<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of studentType
 *
 * @author Hatem_tito
 */

namespace AppBundle\Entity\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface As Builder;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class StudentType extends AbstractType{

    public function buildForm(Builder $builder , array $options) {
        $builder
            ->add('Student_ID',TextType::class)
            ->add('password',PasswordType::class)
            ->add('signin' , SubmitType::class , array('label'=>'Sign In'));
    }
}
