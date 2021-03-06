<?php

namespace Zerbikat\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Zerbikat\BackendBundle\Entity\Norkeskatu;
use Zerbikat\BackendBundle\Form\NorkeskatuType;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

/**
 * Norkeskatu controller.
 *
 * @Route("/norkeskatu")
 */
class NorkeskatuController extends Controller
{
    /**
     * Lists all Norkeskatu entities.
     *
     * @Route("/", defaults={"page" = 1}, name="norkeskatu_index")
     * @Route("/page{page}", name="norkeskatu_index_paginated")
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $auth_checker = $this->get('security.authorization_checker');
        if ($auth_checker->isGranted('ROLE_KUDEAKETA')) {
            $em = $this->getDoctrine()->getManager();
            $norkeskatus = $em->getRepository('BackendBundle:Norkeskatu')->findAll();

            $deleteForms = array();
            foreach ($norkeskatus as $norkeskatu) {
                $deleteForms[$norkeskatu->getId()] = $this->createDeleteForm($norkeskatu)->createView();
            }

            return $this->render('norkeskatu/index.html.twig', array(
                'norkeskatus' => $norkeskatus,
                'deleteforms' => $deleteForms
            ));
        }else
        {
            return $this->redirectToRoute('backend_errorea');
        }
    }

    /**
     * Creates a new Norkeskatu entity.
     *
     * @Route("/new", name="norkeskatu_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $auth_checker = $this->get('security.authorization_checker');
        if ($auth_checker->isGranted('ROLE_ADMIN'))
        {
            $norkeskatu = new Norkeskatu();
            $form = $this->createForm('Zerbikat\BackendBundle\Form\NorkeskatuType', $norkeskatu);
            $form->handleRequest($request);

//            $form->getData()->setUdala($this->getUser()->getUdala());
//            $form->setData($form->getData());

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($norkeskatu);
                $em->flush();

//                return $this->redirectToRoute('norkeskatu_show', array('id' => $norkeskatu->getId()));
                return $this->redirectToRoute('norkeskatu_index');
            } else
            {
                $form->getData()->setUdala($this->getUser()->getUdala());
                $form->setData($form->getData());
            }

            return $this->render('norkeskatu/new.html.twig', array(
                'norkeskatu' => $norkeskatu,
                'form' => $form->createView(),
            ));
        }else
        {
            return $this->redirectToRoute('backend_errorea');
        }
    }

    /**
     * Finds and displays a Norkeskatu entity.
     *
     * @Route("/{id}", name="norkeskatu_show")
     * @Method("GET")
     */
    public function showAction(Norkeskatu $norkeskatu)
    {
        $deleteForm = $this->createDeleteForm($norkeskatu);

        return $this->render('norkeskatu/show.html.twig', array(
            'norkeskatu' => $norkeskatu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Norkeskatu entity.
     *
     * @Route("/{id}/edit", name="norkeskatu_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Norkeskatu $norkeskatu)
    {
        $auth_checker = $this->get('security.authorization_checker');
        if((($auth_checker->isGranted('ROLE_ADMIN')) && ($norkeskatu->getUdala()==$this->getUser()->getUdala()))
            ||($auth_checker->isGranted('ROLE_SUPER_ADMIN')))
        {
            $deleteForm = $this->createDeleteForm($norkeskatu);
            $editForm = $this->createForm('Zerbikat\BackendBundle\Form\NorkeskatuType', $norkeskatu);
            $editForm->handleRequest($request);
    
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($norkeskatu);
                $em->flush();
    
                return $this->redirectToRoute('norkeskatu_edit', array('id' => $norkeskatu->getId()));
            }
    
            return $this->render('norkeskatu/edit.html.twig', array(
                'norkeskatu' => $norkeskatu,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }else
        {
            return $this->redirectToRoute('backend_errorea');
        }            
    }

    /**
     * Deletes a Norkeskatu entity.
     *
     * @Route("/{id}", name="norkeskatu_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Norkeskatu $norkeskatu)
    {
        $auth_checker = $this->get('security.authorization_checker');
        if((($auth_checker->isGranted('ROLE_ADMIN')) && ($norkeskatu->getUdala()==$this->getUser()->getUdala()))
            ||($auth_checker->isGranted('ROLE_SUPER_ADMIN')))
        {
            $form = $this->createDeleteForm($norkeskatu);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($norkeskatu);
                $em->flush();
            }
            return $this->redirectToRoute('norkeskatu_index');
        }else
        {
            //baimenik ez
            return $this->redirectToRoute('backend_errorea');
        }            
    }

    /**
     * Creates a form to delete a Norkeskatu entity.
     *
     * @param Norkeskatu $norkeskatu The Norkeskatu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Norkeskatu $norkeskatu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('norkeskatu_delete', array('id' => $norkeskatu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
