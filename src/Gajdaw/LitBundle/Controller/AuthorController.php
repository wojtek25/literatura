<?php

namespace Gajdaw\LitBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\LitBundle\Entity\Author;

/**
 * Author controller.
 *
 * @Route("/author")
 */
class AuthorController extends Controller
{
    /**
     * Lists all Author entities.
     *
     * @Route("/", name="author")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawLitBundle:Author')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Author entity.
     *
     * @Route("/{id}", name="author_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawLitBundle:Author')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Author entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

}
