<?php

namespace Gajdaw\LitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\LitBundle\Entity\Genre;
use Gajdaw\LitBundle\Form\GenreType;

/**
 * Genre controller.
 *
 * @Route("/genre")
 */
class GenreController extends Controller
{
    /**
     * Lists all Genre entities.
     *
     * @Route("/", name="genre")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawLitBundle:Genre')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Genre entity.
     *
     * @Route("/", name="genre_create")
     * @Method("POST")
     * @Template("GajdawLitBundle:Genre:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Genre();
        $form = $this->createForm(new GenreType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('genre_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Genre entity.
     *
     * @Route("/new", name="genre_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Genre();
        $form   = $this->createForm(new GenreType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Genre entity.
     *
     * @Route("/{id}", name="genre_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawLitBundle:Genre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Genre entity.
     *
     * @Route("/{id}/edit", name="genre_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawLitBundle:Genre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genre entity.');
        }

        $editForm = $this->createForm(new GenreType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Genre entity.
     *
     * @Route("/{id}", name="genre_update")
     * @Method("PUT")
     * @Template("GajdawLitBundle:Genre:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawLitBundle:Genre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new GenreType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('genre_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Genre entity.
     *
     * @Route("/{id}", name="genre_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawLitBundle:Genre')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Genre entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('genre'));
    }

    /**
     * Creates a form to delete a Genre entity by id.
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
