<?php

namespace Zerbikat\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Zerbikat\BackendBundle\Entity\Kalea;
use Zerbikat\BackendBundle\Form\KaleaType;

/**
 * Kalea controller.
 *
 * @Route("/kalea")
 */
class KaleaController extends Controller
{
    /**
     * Lists all Kalea entities.
     *
     * @Route("/", name="kalea_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kaleas = $em->getRepository('BackendBundle:Kalea')->findAll();

        return $this->render('kalea/index.html.twig', array(
            'kaleas' => $kaleas,
        ));
    }

    /**
     * Creates a new Kalea entity.
     *
     * @Route("/new", name="kalea_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $kalea = new Kalea();
        $form = $this->createForm('Zerbikat\BackendBundle\Form\KaleaType', $kalea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kalea);
            $em->flush();

            return $this->redirectToRoute('kalea_show', array('id' => $kalea->getId()));
        }

        return $this->render('kalea/new.html.twig', array(
            'kalea' => $kalea,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Kalea entity.
     *
     * @Route("/{id}", name="kalea_show")
     * @Method("GET")
     */
    public function showAction(Kalea $kalea)
    {
        $deleteForm = $this->createDeleteForm($kalea);

        return $this->render('kalea/show.html.twig', array(
            'kalea' => $kalea,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Kalea entity.
     *
     * @Route("/{id}/edit", name="kalea_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Kalea $kalea)
    {
        $deleteForm = $this->createDeleteForm($kalea);
        $editForm = $this->createForm('Zerbikat\BackendBundle\Form\KaleaType', $kalea);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kalea);
            $em->flush();

            return $this->redirectToRoute('kalea_edit', array('id' => $kalea->getId()));
        }

        return $this->render('kalea/edit.html.twig', array(
            'kalea' => $kalea,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Kalea entity.
     *
     * @Route("/{id}", name="kalea_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Kalea $kalea)
    {
        $form = $this->createDeleteForm($kalea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($kalea);
            $em->flush();
        }

        return $this->redirectToRoute('kalea_index');
    }

    /**
     * Creates a form to delete a Kalea entity.
     *
     * @param Kalea $kalea The Kalea entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Kalea $kalea)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kalea_delete', array('id' => $kalea->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}