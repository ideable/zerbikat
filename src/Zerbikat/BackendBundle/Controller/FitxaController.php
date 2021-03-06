<?php

namespace Zerbikat\BackendBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query;
use GuzzleHttp;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Zerbikat\BackendBundle\Entity\Familia;
use Zerbikat\BackendBundle\Entity\Fitxa;
use Zerbikat\BackendBundle\Entity\Fitxafamilia;


/**
 * Fitxa controller.
 *
 * @Route("/fitxa")
 */
class FitxaController extends Controller
{

    /**
     * Lists all Fitxa entities.
     *
     * @Route("/", name="fitxa_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $auth_checker = $this->get( 'security.authorization_checker' );
        if ( $auth_checker->isGranted( 'ROLE_USER' ) ) {
            $em = $this->getDoctrine()->getManager();
            /** @var Query $query */
            $query = $em->createQuery(
                'SELECT f 
                      FROM BackendBundle:Fitxa f
                      LEFT JOIN f.azpisaila a
                      ORDER BY a.saila ASC, f.azpisaila ASC        '
            );
            $fitxas = $query->getResult();

            $deleteForms = array();
            /** @var Fitxa $fitxa */
            foreach ( $fitxas as $fitxa ) {
                $deleteForms[ $fitxa->getId() ] = $this->createDeleteForm( $fitxa )->createView();
            }

            return $this->render(
                'fitxa/index.html.twig',
                array(
                    'deleteforms' => $deleteForms,
                    'fitxas'      => $fitxas,
                )
            );
        } else {
            return $this->redirectToRoute( 'fos_user_security_login' );
        }
    }

    /**
     * Creates a new Fitxa entity.
     *
     * @Route("/new", name="fitxa_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction( Request $request )
    {
        $auth_checker = $this->get( 'security.authorization_checker' );
        if ( $auth_checker->isGranted( 'ROLE_USER' ) ) {
            /** @var \Zerbikat\BackendBundle\Entity\Fitxa $fitxa */
            $fitxa = new Fitxa();
            $fitxa->setUdala( $this->getUser()->getUdala() );
            $form = $this->createForm( 'Zerbikat\BackendBundle\Form\FitxanewType', $fitxa );
            $form->handleRequest( $request );

            $em = $this->getDoctrine()->getManager();

            if ( $form->isSubmitted() && $form->isValid() ) {
                $fitxa->setCreatedAt( new \DateTime() );

                $em->persist( $fitxa );
                $em->flush();

                return $this->redirectToRoute( 'fitxa_edit', array( 'id' => $fitxa->getId() ) );
            } else {
                $form->getData()->setUdala( $this->getUser()->getUdala() );
                $form->setData( $form->getData() );
            }


            return $this->render(
                'fitxa/new.html.twig',
                array(
                    'fitxa' => $fitxa,
                    'form'  => $form->createView(),
                )
            );
        } else {
            return $this->redirectToRoute( 'fos_user_security_login' );
        }
    }

    /**
     * Finds and displays a Fitxa entity.
     *
     * @Route("/{id}", name="fitxa_show")
     * @Method("GET")
     * @param Fitxa $fitxa
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction( Fitxa $fitxa )
    {
        $deleteForm = $this->createDeleteForm( $fitxa );

        $em = $this->getDoctrine()->getManager();
        $kanalmotak = $em->getRepository( 'BackendBundle:Kanalmota' )->findAll();

        $kostuZerrenda = array();
        foreach ( $fitxa->getKostuak() as $kostu ) {
            $client = new GuzzleHttp\Client();
            $api = $this->container->getParameter( 'zzoo_aplikazioaren_API_url' );
            $proba = $client->request( 'GET', $api . '/zerga/' . $kostu->getKostua() . '.json' );
            $fitxaKostua = (string)$proba->getBody();
            $array = json_decode( $fitxaKostua, true );
            $kostuZerrenda[] = $array;
        }

        /** @var Query $query */
        $query = $em->createQuery(
        /** @lang text */
            '
          SELECT f.oharraktext,f.helburuatext,f.ebazpensinpli,f.arduraaitorpena,f.aurreikusi,f.arrunta,f.isiltasunadmin,f.norkeskatutext,f.norkeskatutable,f.dokumentazioatext,f.dokumentazioatable,f.kostuatext,f.kostuatable,f.araudiatext,f.araudiatable,f.prozeduratext,f.prozeduratable,f.doklaguntext,f.doklaguntable,f.datuenbabesatext,f.datuenbabesatable,f.norkebatzitext,f.norkebatzitable,f.besteak1text,f.besteak1table,f.besteak2text,f.besteak2table,f.besteak3text,f.besteak3table,f.kanalatext,f.kanalatable,f.azpisailatable
            FROM BackendBundle:Eremuak f
            WHERE f.udala = :udala
        '
        );
        $query->setParameter( 'udala', $fitxa->getUdala() );
        $eremuak = $query->getSingleResult();

        $query = $em->createQuery(
        /** @lang text */
            '
          SELECT f.oharraklabeleu,f.oharraklabeles,f.helburualabeleu,f.helburualabeles,f.ebazpensinplilabeleu,f.ebazpensinplilabeles,f.arduraaitorpenalabeleu,f.arduraaitorpenalabeles,f.aurreikusilabeleu,f.aurreikusilabeles,f.arruntalabeleu,f.arruntalabeles,f.isiltasunadminlabeleu,f.isiltasunadminlabeles,f.norkeskatulabeleu,f.norkeskatulabeles,f.dokumentazioalabeleu,f.dokumentazioalabeles,f.kostualabeleu,f.kostualabeles,f.araudialabeleu,f.araudialabeles,f.prozeduralabeleu,f.prozeduralabeles,f.doklagunlabeleu,f.doklagunlabeles,f.datuenbabesalabeleu,f.datuenbabesalabeles,f.norkebatzilabeleu,f.norkebatzilabeles,f.besteak1labeleu,f.besteak1labeles,f.besteak2labeleu,f.besteak2labeles,f.besteak3labeleu,f.besteak3labeles,f.kanalalabeleu,f.kanalalabeles,f.epealabeleu,f.epealabeles,f.doanlabeleu,f.doanlabeles,f.azpisailalabeleu,f.azpisailalabeles
            FROM BackendBundle:Eremuak f
            WHERE f.udala = :udala
        '
        );
        $query->setParameter( 'udala', $fitxa->getUdala() );
        $labelak = $query->getSingleResult();

        return $this->render(
            'fitxa/show.html.twig',
            array(
                'fitxa'         => $fitxa,
                'kanalmotak'    => $kanalmotak,
                'delete_form'   => $deleteForm->createView(),
                'eremuak'       => $eremuak,
                'labelak'       => $labelak,
                'kostuZerrenda' => $kostuZerrenda,
            )
        );
    }

    /**
     * Finds and displays a Fitxa entity.
     *
     * @Route("/pdf/{id}", name="fitxa_pdf")
     * @Method("GET")
     * @param Fitxa $fitxa
     */
    public function pdfAction( Fitxa $fitxa )
    {
        $deleteForm = $this->createDeleteForm( $fitxa );

        $em = $this->getDoctrine()->getManager();
        $kanalmotak = $em->getRepository( 'BackendBundle:Kanalmota' )->findAll();

        /** @var Query $query */
        $query = $em->createQuery(
            /** @lang text */
            '
          SELECT f.oharraktext,f.helburuatext,f.ebazpensinpli,f.arduraaitorpena,f.aurreikusi,f.arrunta,f.isiltasunadmin,f.norkeskatutext,f.norkeskatutable,f.dokumentazioatext,f.dokumentazioatable,f.kostuatext,f.kostuatable,f.araudiatext,f.araudiatable,f.prozeduratext,f.prozeduratable,f.doklaguntext,f.doklaguntable,f.datuenbabesatext,f.datuenbabesatable,f.norkebatzitext,f.norkebatzitable,f.besteak1text,f.besteak1table,f.besteak2text,f.besteak2table,f.besteak3text,f.besteak3table,f.kanalatext,f.kanalatable,f.azpisailatable
            FROM BackendBundle:Eremuak f
            WHERE f.udala = :udala            
        '
        );
        $query->setParameter( 'udala', $fitxa->getUdala() );
        $eremuak = $query->getSingleResult();

        $query = $em->createQuery(
            /** @lang text */
            '
          SELECT f.oharraklabeleu,f.oharraklabeles,f.helburualabeleu,f.helburualabeles,f.ebazpensinplilabeleu,f.ebazpensinplilabeles,f.arduraaitorpenalabeleu,f.arduraaitorpenalabeles,f.aurreikusilabeleu,f.aurreikusilabeles,f.arruntalabeleu,f.arruntalabeles,f.isiltasunadminlabeleu,f.isiltasunadminlabeles,f.norkeskatulabeleu,f.norkeskatulabeles,f.dokumentazioalabeleu,f.dokumentazioalabeles,f.kostualabeleu,f.kostualabeles,f.araudialabeleu,f.araudialabeles,f.prozeduralabeleu,f.prozeduralabeles,f.doklagunlabeleu,f.doklagunlabeles,f.datuenbabesalabeleu,f.datuenbabesalabeles,f.norkebatzilabeleu,f.norkebatzilabeles,f.besteak1labeleu,f.besteak1labeles,f.besteak2labeleu,f.besteak2labeles,f.besteak3labeleu,f.besteak3labeles,f.kanalalabeleu,f.kanalalabeles,f.epealabeleu,f.epealabeles,f.doanlabeleu,f.doanlabeles,f.azpisailalabeleu,f.azpisailalabeles
            FROM BackendBundle:Eremuak f
            WHERE f.udala = :udala
        '
        );
        $query->setParameter( 'udala', $fitxa->getUdala() );
        $labelak = $query->getSingleResult();

        $kostuZerrenda = array();
        foreach ( $fitxa->getKostuak() as $kostu ) {
            $client = new GuzzleHttp\Client();

            $api = $this->container->getParameter( 'zzoo_aplikazioaren_API_url' );
//            $proba = $client->request( 'GET', 'http://zergaordenantzak.dev/app_dev.php/api/azpiatalas/'.$kostu->getKostua().'.json' );
            $proba = $client->request( 'GET', $api . '/zerga/' . $kostu->getKostua() . '.json' );

            $fitxaKostua = (string)$proba->getBody();
            $array = json_decode( $fitxaKostua, true );
            $kostuZerrenda[] = $array;
        }

        // Debug only:
        //return $this->render(
        $html = $this->render(
            'fitxa/pdf.html.twig',
            array(
                'fitxa'         => $fitxa,
                'kanalmotak'    => $kanalmotak,
                'delete_form'   => $deleteForm->createView(),
                'eremuak'       => $eremuak,
                'labelak'       => $labelak,
                'kostuZerrenda' => $kostuZerrenda,
            )
        );

        $pdf = $this->get( "white_october.tcpdf" )->create(
            'vertical',
            PDF_UNIT,
            PDF_PAGE_FORMAT,
            true,
            'UTF-8',
            false
        );
        $pdf->SetAuthor( $this->getUser()->getUdala() );
//        $pdf->SetTitle(('Our Code World Title'));
        $pdf->SetTitle( ( $fitxa->getDeskribapenaeu() ) );
        $pdf->SetSubject( $fitxa->getDeskribapenaes() );
        $pdf->setFontSubsetting( true );
        $pdf->SetFont( 'helvetica', '', 11, '', true );
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();

        $filename = $fitxa->getEspedientekodea() . "." . $fitxa->getDeskribapenaeu();

        $pdf->writeHTMLCell(
            $w = 0,
            $h = 0,
            $x = '',
            $y = '',
            $html->getContent(),
            $border = 0,
            $ln = 1,
            $fill = 0,
            $reseth = true,
            $align = '',
            $autopadding = true
        );
        $pdf->Output( $filename . ".pdf", 'I' ); // This will output the PDF as a response directly
    }

    /**
     * Displays a form to edit an existing Fitxa entity.
     *
     * @Route("/{id}/edit", name="fitxa_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Fitxa   $fitxa
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function editAction( Request $request, Fitxa $fitxa )
    {
        $auth_checker = $this->get( 'security.authorization_checker' );
        if ( ( ( $auth_checker->isGranted( 'ROLE_USER' ) ) && ( $fitxa->getUdala() == $this->getUser()->getUdala() ) )
            || ( $auth_checker->isGranted( 'ROLE_SUPER_ADMIN' ) )
        ) {
            $deleteForm = $this->createDeleteForm( $fitxa );

            $api_url = $this->getParameter( 'zzoo_aplikazioaren_API_url' );

            $editForm = $this->createForm(
                'Zerbikat\BackendBundle\Form\FitxaType',
                $fitxa,
                array( 'user' => $this->getUser(), 'api_url' => $api_url )
            );

            // Create an ArrayCollection of the current Kostuak objects in the database
            $originalKostuak = new ArrayCollection();
            foreach ( $fitxa->getKostuak() as $kostu ) {
                $originalKostuak->add( $kostu );
            }
            // Create an ArrayCollection of the current Araudiak objects in the database
            $originalAraudiak = new ArrayCollection();
            foreach ( $fitxa->getAraudiak() as $araudi ) {
                $originalAraudiak->add( $araudi );
            }
            // Create an ArrayCollection of the current Prozedurak objects in the database
            $originalProzedurak = new ArrayCollection();
            foreach ( $fitxa->getProzedurak() as $prozedura ) {
                $originalProzedurak->add( $prozedura );
            }

            $editForm->handleRequest( $request );
            $em = $this->getDoctrine()->getManager();

            if ( $editForm->isSubmitted() ) {
                if ( $editForm->isValid() ) {

                    foreach ( $originalKostuak as $kostu ) {
                        if ( false === $fitxa->getKostuak()->contains( $kostu ) ) {
                            $kostu->setFitxa( null );
                            $em->remove( $kostu );
                            $em->persist( $fitxa );
                        }
                    }
                    foreach ( $originalAraudiak as $araudi ) {
                        if ( false === $fitxa->getAraudiak()->contains( $araudi ) ) {
                            $araudi->setFitxa( null );
                            $em->remove( $araudi );
                            $em->persist( $fitxa );
                        }
                    }
                    foreach ( $originalProzedurak as $prozedura ) {
                        if ( false === $fitxa->getProzedurak()->contains( $prozedura ) ) {
                            $prozedura->setFitxa( null );
                            $em->remove( $prozedura );
                            $em->persist( $fitxa );
                        }
                    }

                    $fitxa->setUpdatedAt( new \DateTime() );
                    $em->persist( $fitxa );
                    $em->flush();

                    return $this->redirectToRoute( 'fitxa_edit', array( 'id' => $fitxa->getId() ) );
                }
            }

            /** @var Query $query */
            $query = $em->createQuery(
            /** @lang text */
                '
              SELECT f.oharraktext,f.helburuatext,f.ebazpensinpli,f.arduraaitorpena,f.aurreikusi,f.arrunta,f.isiltasunadmin,f.norkeskatutext,f.norkeskatutable,f.dokumentazioatext,f.dokumentazioatable,f.kostuatext,f.kostuatable,f.araudiatext,f.araudiatable,f.prozeduratext,f.prozeduratable,f.doklaguntext,f.doklaguntable,f.datuenbabesatext,f.datuenbabesatable,f.norkebatzitext,f.norkebatzitable,f.besteak1text,f.besteak1table,f.besteak2text,f.besteak2table,f.besteak3text,f.besteak3table,f.kanalatext,f.kanalatable,f.azpisailatable
                FROM BackendBundle:Eremuak f
                WHERE f.udala = :udala                
            '
            );
            $query->setParameter( 'udala', $fitxa->getUdala() );
            $eremuak = $query->getSingleResult();

            $query = $em->createQuery(
            /** @lang text */
                '
              SELECT f.oharraklabeleu,f.oharraklabeles,f.helburualabeleu,f.helburualabeles,f.ebazpensinplilabeleu,f.ebazpensinplilabeles,f.arduraaitorpenalabeleu,f.arduraaitorpenalabeles,f.aurreikusilabeleu,f.aurreikusilabeles,f.arruntalabeleu,f.arruntalabeles,f.isiltasunadminlabeleu,f.isiltasunadminlabeles,f.norkeskatulabeleu,f.norkeskatulabeles,f.dokumentazioalabeleu,f.dokumentazioalabeles,f.kostualabeleu,f.kostualabeles,f.araudialabeleu,f.araudialabeles,f.prozeduralabeleu,f.prozeduralabeles,f.doklagunlabeleu,f.doklagunlabeles,f.datuenbabesalabeleu,f.datuenbabesalabeles,f.norkebatzilabeleu,f.norkebatzilabeles,f.besteak1labeleu,f.besteak1labeles,f.besteak2labeleu,f.besteak2labeles,f.besteak3labeleu,f.besteak3labeles,f.kanalalabeleu,f.kanalalabeles,f.epealabeleu,f.epealabeles,f.doanlabeleu,f.doanlabeles,f.azpisailalabeleu,f.azpisailalabeles
                FROM BackendBundle:Eremuak f
                WHERE f.udala = :udala                
            '
            );
            $query->setParameter( 'udala', $fitxa->getUdala() );
            $labelak = $query->getSingleResult();

            $fitxafamilium = new Fitxafamilia();
            $fitxafamilium->setFitxa( $fitxa );
            $fitxafamilium->setUdala( $this->getUser()->getUdala() );
            $form = $this->createForm(
                'Zerbikat\BackendBundle\Form\FitxafamiliaType',
                $fitxafamilium,
                [
                    'action' => $this->generateUrl( 'fitxafamilia_newfromfitxa' ),
                ]
            );

            $familiak = $em->getRepository( 'BackendBundle:Familia' )->findBy(
                array(
                    'udala'  => $fitxa->getUdala(),
                    'parent' => null,
                ),
                array( 'ordena' => 'ASC' )
            );

            return $this->render(
                'fitxa/edit.html.twig',
                array(
                    'fitxa'            => $fitxa,
                    'udala'            => $this->getUser()->getUdala()->getId(),
                    'udal'             => $this->getUser()->getUdala(),
                    'edit_form'        => $editForm->createView(),
                    'delete_form'      => $deleteForm->createView(),
                    'formfitxafamilia' => $form->createView(),
                    'eremuak'          => $eremuak,
                    'labelak'          => $labelak,
                    'familiak'         => $familiak,
                )
            );
        } else {
            return $this->redirectToRoute( 'backend_errorea' );
        }
    }

    /**
     * Deletes a Fitxa entity.
     *
     * @Route("/{id}/del", name="fitxa_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Fitxa   $fitxa
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction( Request $request, Fitxa $fitxa )
    {

        //udala egokia den eta admin baimena duen egiaztatu
        $auth_checker = $this->get( 'security.authorization_checker' );
        if ( ( ( $auth_checker->isGranted( 'ROLE_ADMIN' ) ) && ( $fitxa->getUdala() == $this->getUser()->getUdala() ) )
            || ( $auth_checker->isGranted( 'ROLE_SUPER_ADMIN' ) )
        ) {
            $form = $this->createDeleteForm( $fitxa );
            $form->handleRequest( $request );
            if ( $form->isSubmitted() ) {
                $em = $this->getDoctrine()->getManager();
                $em->remove( $fitxa );
                $em->flush();
            }

            return $this->redirectToRoute( 'fitxa_index' );

        } else {
            //baimenik ez
            return $this->redirectToRoute( 'backend_errorea' );
        }
    }

    /**
     * Creates a form to delete a Fitxa entity.
     *
     * @param Fitxa $fitxa The Fitxa entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm( Fitxa $fitxa )
    {
        return $this->createFormBuilder()
                    ->setAction( $this->generateUrl( 'fitxa_delete', array( 'id' => $fitxa->getId() ) ) )
                    ->setMethod( 'DELETE' )
                    ->getForm();
    }

    private function createfamiliaDeleteForm( Familia $familia )
    {
        return $this->createFormBuilder()
                    ->setAction( $this->generateUrl( 'familia_delete', array( 'id' => $familia->getId() ) ) )
                    ->setMethod( 'DELETE' )
                    ->getForm();
    }

}
