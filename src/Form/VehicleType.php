<?php

namespace App\Form;

use App\Entity\Vehicle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class VehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', TextType::class)
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Check to delete image',
                'download_label' => 'Click here to download',
                'download_uri' => true,
                'image_uri' => true,
                /*'imagine_pattern' => '...',*/
                'label' => 'Image (JPG or PNG file)'
            ])
            ->add('stock', IntegerType::class)
            ->add('locationStatus', ChoiceType::class, [
                'choices'  => [
                    'Available' => 'available',
                    'Unavailable' => 'unavailable',
                ], 
                'label'=> 'Status'
            ])
            ->add('characsJSON', TextareaType::class, [
                'label'=> 'Characteristics (JSON)',
                'empty_data' => '{\n\t\n}',
                'attr'=> [
                    'class'=> 'text-edit-json',
                    'onkeydown'=> "if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
        ]);
    }
}
