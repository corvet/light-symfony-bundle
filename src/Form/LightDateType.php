<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LightDateType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder->addViewTransformer(
            new DateTimeToStringTransformer(
                inputTimezone: 'UTC',
                outputTimezone: 'UTC',
                format: 'd.m.Y'
            )
        );
    }

    public function buildView(
        FormView $view,
        FormInterface $form,
        array $options
    ): void {
        $view->vars['legend'] =
            $options['legend'] ?? ucfirst($form->getName());
    }

    public function configureOptions(
        OptionsResolver $resolver
    ): void {
        $resolver->setDefaults([
            'legend' => null,
            'attr' => [
                'placeholder' => '__.__.____',
                'autocomplete' => 'off',
            ],
        ]);
    }

    public function getParent(): string
    {
        return TextType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'corvet__light_symfony_bundle__light_date';
    }
}
