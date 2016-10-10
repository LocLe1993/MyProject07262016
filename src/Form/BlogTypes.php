<?php

namespace MyProject\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

class BlogTypes extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
		->add('name', TextType::class, array(
			'label' => 'Tên blog'
		))
		->add('blog_type_id', TextType::class, array(
			'label' => 'Loại blog'
		))
		->add('field_id', TextType::class, array(
			'label' => 'Loại field'
		));
	}
	
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array(
		));
	}
	
	public function getBlockPrefix() {
		return 'blog';
	}
}