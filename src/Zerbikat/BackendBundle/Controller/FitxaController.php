<?php

namespace Zerbikat\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Zerbikat\BackendBundle\Entity\Fitxa;
use Zerbikat\BackendBundle\Form\FitxaType;
use Symfony\Component\HttpFoundation\Response;

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
//        $erab=$this->getUser();
        $auth_checker = $this->get('security.authorization_checker');
        if ($auth_checker->isGranted('ROLE_USER'))
        {
            $em = $this->getDoctrine()->getManager();

            $fitxas = $em->getRepository('BackendBundle:Fitxa')->findAll();

            return $this->render('fitxa/index.html.twig', array(
                'fitxas' => $fitxas,
            ));
        }
    }

    /**
     * Creates a new Fitxa entity.
     *
     * @Route("/new", name="fitxa_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $auth_checker = $this->get('security.authorization_checker');
        if ($auth_checker->isGranted('ROLE_USER')) {
            $fitxa = new Fitxa();
//            $fitxa->setUdala($this->getUser()->getUdala());

            $form = $this->createForm('Zerbikat\BackendBundle\Form\FitxaType', $fitxa);
            $form->handleRequest($request);

//            $form->getData()->setUdala($this->getUser()->getUdala());
//            $form->setData($form->getData());

            $em = $this->getDoctrine()->getManager();

            if ($form->isSubmitted() && $form->isValid()) {
                $fitxa->setCreatedAt(new \DateTime());
//                $em = $this->getDoctrine()->getManager();
                $em->persist($fitxa);
                $em->flush();

                return $this->redirectToRoute('fitxa_show', array('id' => $fitxa->getId()));
            } else
            {
                $form->getData()->setUdala($this->getUser()->getUdala());
                $form->setData($form->getData());
            }


            $query = $em->createQuery('
            SELECT f.oharraktext,f.helburuatext,f.ebazpensinpli,f.arduraaitorpena,f.aurreikusi,f.arrunta,f.isiltasunadmin,f.norkeskatutext,f.norkeskatutable,f.dokumentazioatext,f.dokumentazioatable,f.kostuatext,f.kostuatable,f.araudiatext,f.araudiatable,f.prozeduratext,f.prozeduratable,f.doklaguntext,f.doklaguntable,f.datuenbabesatext,f.datuenbabesatable,f.norkebatzitext,f.norkebatzitable,f.besteak1text,f.besteak1table,f.besteak2text,f.besteak2table,f.besteak3text,f.besteak3table,f.kanalatext,f.kanalatable,f.azpisailatable
              FROM BackendBundle:Eremuak f
          ');
            //$eremuak = $query->getResult();
            $eremuak = $query->getSingleResult();

            $query = $em->createQuery('
            SELECT f.oharraklabeleu,f.oharraklabeles,f.helburualabeleu,f.helburualabeles,f.ebazpensinplilabeleu,f.ebazpensinplilabeles,f.arduraaitorpenalabeleu,f.arduraaitorpenalabeles,f.aurreikusilabeleu,f.aurreikusilabeles,f.arruntalabeleu,f.arruntalabeles,f.isiltasunadminlabeleu,f.isiltasunadminlabeles,f.norkeskatulabeleu,f.norkeskatulabeles,f.dokumentazioalabeleu,f.dokumentazioalabeles,f.kostualabeleu,f.kostualabeles,f.araudialabeleu,f.araudialabeles,f.prozeduralabeleu,f.prozeduralabeles,f.doklagunlabeleu,f.doklagunlabeles,f.datuenbabesalabeleu,f.datuenbabesalabeles,f.norkebatzilabeleu,f.norkebatzilabeles,f.besteak1labeleu,f.besteak1labeles,f.besteak2labeleu,f.besteak2labeles,f.besteak3labeleu,f.besteak3labeles,f.kanalalabeleu,f.kanalalabeles,f.epealabeleu,f.epealabeles,f.doanlabeleu,f.doanlabeles,f.azpisailalabeleu,f.azpisailalabeles
              FROM BackendBundle:Eremuak f
          ');
            $labelak = $query->getSingleResult();

            return $this->render('fitxa/new.html.twig', array(
                'fitxa' => $fitxa,
                'form' => $form->createView(),
                'eremuak' => $eremuak,
                'labelak' => $labelak
            ));
        }
    }
    /**
     * Finds and displays a Fitxa entity.
     *
     * @Route("/{id}", name="fitxa_show")
     * @Method("GET")
     */
    public function showAction(Fitxa $fitxa)
    {
        $deleteForm = $this->createDeleteForm($fitxa);

        $em = $this->getDoctrine()->getManager();
        $kanalmotak=$em->getRepository('BackendBundle:Kanalmota')->findAll();

        $query = $em->createQuery('
          SELECT f.oharraktext,f.helburuatext,f.ebazpensinpli,f.arduraaitorpena,f.aurreikusi,f.arrunta,f.isiltasunadmin,f.norkeskatutext,f.norkeskatutable,f.dokumentazioatext,f.dokumentazioatable,f.kostuatext,f.kostuatable,f.araudiatext,f.araudiatable,f.prozeduratext,f.prozeduratable,f.doklaguntext,f.doklaguntable,f.datuenbabesatext,f.datuenbabesatable,f.norkebatzitext,f.norkebatzitable,f.besteak1text,f.besteak1table,f.besteak2text,f.besteak2table,f.besteak3text,f.besteak3table,f.kanalatext,f.kanalatable,f.azpisailatable
            FROM BackendBundle:Eremuak f
        ');
        $eremuak = $query->getSingleResult();

        $query = $em->createQuery('
          SELECT f.oharraklabeleu,f.oharraklabeles,f.helburualabeleu,f.helburualabeles,f.ebazpensinplilabeleu,f.ebazpensinplilabeles,f.arduraaitorpenalabeleu,f.arduraaitorpenalabeles,f.aurreikusilabeleu,f.aurreikusilabeles,f.arruntalabeleu,f.arruntalabeles,f.isiltasunadminlabeleu,f.isiltasunadminlabeles,f.norkeskatulabeleu,f.norkeskatulabeles,f.dokumentazioalabeleu,f.dokumentazioalabeles,f.kostualabeleu,f.kostualabeles,f.araudialabeleu,f.araudialabeles,f.prozeduralabeleu,f.prozeduralabeles,f.doklagunlabeleu,f.doklagunlabeles,f.datuenbabesalabeleu,f.datuenbabesalabeles,f.norkebatzilabeleu,f.norkebatzilabeles,f.besteak1labeleu,f.besteak1labeles,f.besteak2labeleu,f.besteak2labeles,f.besteak3labeleu,f.besteak3labeles,f.kanalalabeleu,f.kanalalabeles,f.epealabeleu,f.epealabeles,f.doanlabeleu,f.doanlabeles,f.azpisailalabeleu,f.azpisailalabeles
            FROM BackendBundle:Eremuak f
        ');
        $labelak = $query->getSingleResult();

        return $this->render('fitxa/show.html.twig', array(
            'fitxa' => $fitxa,
            'kanalmotak'=>$kanalmotak,
            'delete_form' => $deleteForm->createView(),
            'eremuak'=> $eremuak,
            'labelak'=> $labelak
        ));
    }

    /**
     * Finds and displays a Fitxa entity.
     *
     * @Route("/pdf/{id}", name="fitxa_pdf")
     * @Method("GET")
     */
    public function pdfAction(Fitxa $fitxa)
    {
        $deleteForm = $this->createDeleteForm($fitxa);

        $em = $this->getDoctrine()->getManager();
        $kanalmotak=$em->getRepository('BackendBundle:Kanalmota')->findAll();

        $query = $em->createQuery('
          SELECT f.oharraktext,f.helburuatext,f.ebazpensinpli,f.arduraaitorpena,f.aurreikusi,f.arrunta,f.isiltasunadmin,f.norkeskatutext,f.norkeskatutable,f.dokumentazioatext,f.dokumentazioatable,f.kostuatext,f.kostuatable,f.araudiatext,f.araudiatable,f.prozeduratext,f.prozeduratable,f.doklaguntext,f.doklaguntable,f.datuenbabesatext,f.datuenbabesatable,f.norkebatzitext,f.norkebatzitable,f.besteak1text,f.besteak1table,f.besteak2text,f.besteak2table,f.besteak3text,f.besteak3table,f.kanalatext,f.kanalatable,f.azpisailatable
            FROM BackendBundle:Eremuak f
        ');
        $eremuak = $query->getSingleResult();

        $query = $em->createQuery('
          SELECT f.oharraklabeleu,f.oharraklabeles,f.helburualabeleu,f.helburualabeles,f.ebazpensinplilabeleu,f.ebazpensinplilabeles,f.arduraaitorpenalabeleu,f.arduraaitorpenalabeles,f.aurreikusilabeleu,f.aurreikusilabeles,f.arruntalabeleu,f.arruntalabeles,f.isiltasunadminlabeleu,f.isiltasunadminlabeles,f.norkeskatulabeleu,f.norkeskatulabeles,f.dokumentazioalabeleu,f.dokumentazioalabeles,f.kostualabeleu,f.kostualabeles,f.araudialabeleu,f.araudialabeles,f.prozeduralabeleu,f.prozeduralabeles,f.doklagunlabeleu,f.doklagunlabeles,f.datuenbabesalabeleu,f.datuenbabesalabeles,f.norkebatzilabeleu,f.norkebatzilabeles,f.besteak1labeleu,f.besteak1labeles,f.besteak2labeleu,f.besteak2labeles,f.besteak3labeleu,f.besteak3labeles,f.kanalalabeleu,f.kanalalabeles,f.epealabeleu,f.epealabeles,f.doanlabeleu,f.doanlabeles,f.azpisailalabeleu,f.azpisailalabeles
            FROM BackendBundle:Eremuak f
        ');
        $labelak = $query->getSingleResult();

//        return $this->render('fitxa/show.html.twig', array(
//            'fitxa' => $fitxa,
//            'kanalmotak'=>$kanalmotak,
//            'delete_form' => $deleteForm->createView(),
//            'eremuak'=> $eremuak,
//            'labelak'=> $labelak
//        ));
        $html="<table border=1><tr><td>aaaaaaa</td><td>hola</td></tr>";

        $html="<table border=\"1\"  cellpadding=\"4\">
        <tr>
            <td colspan=\"12\" align=\"right\">
               <span style=\"font-size: xx-small;\">Azken eguneraketa:</span> 
            </td>
        </tr>
        <tr>
            <th colspan=\"2\">
                        <img src='".$fitxa->getUdala()->getLogoa()."' />
           
                        <img src=\"".$fitxa->getUdala()->getLogoa()."\" alt=\"test alt attribute\" width=\"140\" height=\"100\" border=\"0\" />
            </th>
            <th colspan=\"2\" >
                    <h2 style=\"text-align:center\">".$fitxa->getEspedientekodea()."</h2>
            </th>
            <th colspan=\"8\">
                <h4>".$fitxa->getDeskribapenaeu()."</h4>
                <h5>".$fitxa->getDeskribapenaes()."</h5>
            </th>
        </tr>
    </table>
        ";

    $html=$html."<br /><br /><table cellspacing=\"3\" cellpadding=\"3\"><tr>
                    <th style=\"text-align:center\">ZER DA? ZERTARAKO DA?</th>
                    <th style=\"text-align:center\">¿QUÉ ES? ¿PARA QUÉ?</th>
                </tr>
                <tr>
                <td><span style=\"font-size: small;\">".$fitxa->getHelburuaeu()."</span></td>
                <td><span style=\"font-size: small;\">".$fitxa->getHelburuaes()."</span></td>
                </tr>
                
                </table>
    ";








        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor($this->getUser()->getUdala());
//        $pdf->SetTitle(('Our Code World Title'));
        $pdf->SetTitle(($fitxa->getDeskribapenaeu()));
        $pdf->SetSubject($fitxa->getDeskribapenaes());
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();

        $filename = 'ourcodeworld_pdf_demo';

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($filename.".pdf",'I'); // This will output the PDF as a response directly

    }




    /**
     * Displays a form to edit an existing Fitxa entity.
     *
     * @Route("/{id}/edit", name="fitxa_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Fitxa $fitxa)
    {
        $auth_checker = $this->get('security.authorization_checker');
        if((($auth_checker->isGranted('ROLE_USER')) && ($fitxa->getUdala()==$this->getUser()->getUdala()))
            ||($auth_checker->isGranted('ROLE_SUPER_ADMIN')))
        {
            $deleteForm = $this->createDeleteForm($fitxa);
            $editForm = $this->createForm('Zerbikat\BackendBundle\Form\FitxaType', $fitxa);
            $editForm->handleRequest($request);
    
            $em = $this->getDoctrine()->getManager();
    
            if ($editForm->isSubmitted() && $editForm->isValid())
            {
                $fitxa->setUpdatedAt(new \DateTime());
                $em->persist($fitxa);
                $em->flush();
                return $this->redirectToRoute('fitxa_edit', array('id' => $fitxa->getId()));
            }
            $query = $em->createQuery('
              SELECT f.oharraktext,f.helburuatext,f.ebazpensinpli,f.arduraaitorpena,f.aurreikusi,f.arrunta,f.isiltasunadmin,f.norkeskatutext,f.norkeskatutable,f.dokumentazioatext,f.dokumentazioatable,f.kostuatext,f.kostuatable,f.araudiatext,f.araudiatable,f.prozeduratext,f.prozeduratable,f.doklaguntext,f.doklaguntable,f.datuenbabesatext,f.datuenbabesatable,f.norkebatzitext,f.norkebatzitable,f.besteak1text,f.besteak1table,f.besteak2text,f.besteak2table,f.besteak3text,f.besteak3table,f.kanalatext,f.kanalatable,f.azpisailatable
                FROM BackendBundle:Eremuak f
            ');
            $eremuak = $query->getSingleResult();
    
            $query = $em->createQuery('
              SELECT f.oharraklabeleu,f.oharraklabeles,f.helburualabeleu,f.helburualabeles,f.ebazpensinplilabeleu,f.ebazpensinplilabeles,f.arduraaitorpenalabeleu,f.arduraaitorpenalabeles,f.aurreikusilabeleu,f.aurreikusilabeles,f.arruntalabeleu,f.arruntalabeles,f.isiltasunadminlabeleu,f.isiltasunadminlabeles,f.norkeskatulabeleu,f.norkeskatulabeles,f.dokumentazioalabeleu,f.dokumentazioalabeles,f.kostualabeleu,f.kostualabeles,f.araudialabeleu,f.araudialabeles,f.prozeduralabeleu,f.prozeduralabeles,f.doklagunlabeleu,f.doklagunlabeles,f.datuenbabesalabeleu,f.datuenbabesalabeles,f.norkebatzilabeleu,f.norkebatzilabeles,f.besteak1labeleu,f.besteak1labeles,f.besteak2labeleu,f.besteak2labeles,f.besteak3labeleu,f.besteak3labeles,f.kanalalabeleu,f.kanalalabeles,f.epealabeleu,f.epealabeles,f.doanlabeleu,f.doanlabeles,f.azpisailalabeleu,f.azpisailalabeles
                FROM BackendBundle:Eremuak f
            ');
            $labelak = $query->getSingleResult();
    
    //        }
//            if ($fitxa->getUdala()==$this->getUser()->getUdala()) {
                return $this->render('fitxa/edit.html.twig', array(
                    'fitxa' => $fitxa,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'eremuak' => $eremuak,
                    'labelak' => $labelak
                ));
//            } else
//            {
//                return $this->redirectToRoute('fitxa_index');
//            }
        }else
        {
            return $this->redirectToRoute('backend_errorea');
        }            
    }

    /**
     * Deletes a Fitxa entity.
     *
     * @Route("/{id}", name="fitxa_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Fitxa $fitxa)
    {
        $auth_checker = $this->get('security.authorization_checker');
        if((($auth_checker->isGranted('ROLE_ADMIN')) && ($fitxa->getUdala()==$this->getUser()->getUdala()))
            ||($auth_checker->isGranted('ROLE_SUPER_ADMIN')))
        {
            //udala egokia den eta admin baimena duen egiaztatu
            $auth_checker = $this->get('security.authorization_checker');
            if (($auth_checker->isGranted('ROLE_ADMIN'))&&($fitxa->getUdala()==$this->getUser()->getUdala())) {
                $form = $this->createDeleteForm($fitxa);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($fitxa);
                    $em->flush();
                }
            }
            return $this->redirectToRoute('fitxa_index');
        }else
        {
            //baimenik ez
            return $this->redirectToRoute('backend_errorea');
        }
    }

    /**
     * Creates a form to delete a Fitxa entity.
     *
     * @param Fitxa $fitxa The Fitxa entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fitxa $fitxa)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fitxa_delete', array('id' => $fitxa->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }



    
}
