<?php

namespace MyProject\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use MyProject\Entity\BlogType;
use MyProject\Entity\Field;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

class BlogTypes extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
		->add('name', TextType::class, array(
			'label' => 'Tên blog',
			'required' => false
		))
		->add('blog_type_id', EntityType::class, array(
			'label' => 'Loại blog',
			'class' => BlogType::class,
			'choice_label' => 'name',
			'choice_value' => 'id',
			'choices' => null,
			'query_builder' => function ($em) {
				return $em->createQueryBuilder('em')
    				->where('em.del_flg = 0')
    				->orderBy('em.name', 'ASC');
			},
			'required' => false
		))
		->add('field_id', EntityType::class, array(
			'label' => 'Loại field',
			'class' => Field::class,
			'choice_label' => 'name',
			'choice_value' => 'id',
			'choices' => null,
			'query_builder' => function ($em) {
				return $em->createQueryBuilder('em')
					->where('em.del_flg = 0')
					->orderBy('em.name', 'ASC');
			},
			'required' => false
		))
		->add('del_flg', HiddenType::class, array(
			'label' => false,
			'required' => false
		))
		->add('created_by', HiddenType::class, array(
			'label' => false,
			'required' => false
		))
		->add('updated_by', HiddenType::class, array(
			'label' => false,
			'required' => false
		))
		->addEventListener(FormEvents::POST_SUBMIT, function ($event) {
			$form = $event->getForm();
			$data = $form->getData();
			if($data->getname() === null) {
				$form['name']->addError(new FormError('Chưa nhập giá trị'));
			}
			if($data->getBlogTypeId() === null) {
				$form['blog_type_id']->addError(new FormError('Chưa chọn giá trị'));
			}
			if($data->getFieldId() === null) {
				$form['field_id']->addError(new FormError('Chưa chọn giá trị'));
			}
		});
	}
	
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array(
		));
	}
	
	public function getBlockPrefix() {
		return 'blog';
	}
}