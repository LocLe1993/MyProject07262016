<?php

namespace MyProject\Form;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogTypes extends FormType
{
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		parent::buildForm($builder, $options);
		$builder
		->add('name', TextType::class, array(
			'label' => 'Tên blog'
		))
		->add('blog_type_id', TextType::class, array(
			'label' => 'Loại blog'
		));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		parent::configureOptions($resolver);
	    $defaults = array(
	        'compound' => true,
	        'inherit_data' => false,
    		'method' => 'GET',
	    );
	    $resolver->setDefaults($defaults);
	}
}