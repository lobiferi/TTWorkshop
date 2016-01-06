<?php

namespace AppBundle\Form;

use AppBundle\Entity\Battery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class BatteryType extends AbstractType
{
    public $name;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $batteryType;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(min=1, max=999)
     */
    public $count;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new CallbackTransformer(function($data){return $data;}, function($data){return $data;});
        $builder
            ->add('name')
            ->add('batteryType')
			->add('count', NumberType::class)
            ->add('save', SubmitType::class)
        ;
        //$builder->addModelTransformer($transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BatteryType::class,
        ));
    }

}
