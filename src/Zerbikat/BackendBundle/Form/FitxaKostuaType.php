<?php

namespace Zerbikat\BackendBundle\Form;

use JMS\SerializerBundle\JMSSerializerBundle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use GuzzleHttp;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class FitxaKostuaType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $udala = $options['udala'];
        $api = $options[ 'api_url' ];
        // DEBUG
//        $api = "http://zzoo.dev/app_dev.php/api";

        $client = new GuzzleHttp\Client();
        $url = $api.'/udalzergak/'.$udala.'.json';
        $proba = $client->request( 'GET', $url );
        $valftp = (string)$proba->getBody();
        $array = json_decode($valftp, true);

        $resp=array("Aukeratu bat" => "-1");
        foreach ($array as $a)
        {
            $txt ="";
            if ( (array_key_exists("kodea_prod", $a))  ) {
                $txt = $a[ 'kodea_prod' ]." - ";
            }


            if ( array_key_exists("izenburuaeu_prod", $a) ) {
                $txt = $txt . $a[ 'izenburuaeu_prod' ];
                $resp[$txt] = $a['id'];
            }
        }

        $builder
            ->add('udala')
            ->add('fitxa')
            ->add('kostua', ChoiceType::class, array(
                'choices' => $resp
                )

            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zerbikat\BackendBundle\Entity\FitxaKostua',
            'udala' => null,
            'api_url' => null
        ));
    }
}
