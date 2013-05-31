<?php

namespace Gajdaw\LitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\LitBundle\Entity\Reviewer;
use Gajdaw\LitBundle\Form\ReviewerType;

/**
 * Reviewer controller.
 *
 * @Route("/reviewer")
 */
class ReviewerController extends Controller
{
    /**
     * Lists all Reviewer entities.
     *
     * @Route("/", name="reviewer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawLitBundle:Reviewer')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Reviewer entity.
     *
     * @Route("/", name="reviewer_create")
     * @Method("POST")
     * @Template("GajdawLitBundle:Reviewer:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Reviewer();
        $form = $this->createForm(new ReviewerType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('reviewer_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Reviewer entity.
     *
     * @Route("/new", name="reviewer_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Reviewer();
        $form   = $this->createForm(new ReviewerType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Reviewer entity.
     *
     * @Route("/{id}", name="reviewer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawLitBundle:Reviewer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reviewer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Reviewer entity.
     *
     * @Route("/{id}/edit", name="reviewer_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawLitBundle:Reviewer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reviewer entity.');
        }

        $editForm = $this->createForm(new ReviewerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Reviewer entity.
     *
     * @Route("/{id}", name="reviewer_update")
     * @Method("PUT")
     * @Template("GajdawLitBundle:Reviewer:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawLitBundle:Reviewer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reviewer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ReviewerType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('reviewer_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Reviewer entity.
     *
     * @Route("/{id}", name="reviewer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawLitBundle:Reviewer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Reviewer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('reviewer'));
    }

    /**
     * Creates a form to delete a Reviewer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
