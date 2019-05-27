<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AddTask extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task', TextType::class, [
                'label' => false,
                'attr' => ['class' => 'form__input']
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'form__submit']
            ]);
    }
}