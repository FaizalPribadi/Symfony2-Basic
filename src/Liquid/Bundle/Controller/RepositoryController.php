<?php

namespace Liquid\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Liquid\Bundle\Entity\Repository;
use Liquid\Bundle\Form\RepositoryType;

/**
 * Repository controller.
 *
 * @Route("/repository")
 */
class RepositoryController extends Controller
{
    /**
     * Lists all Repository entities.
     *
     * @Route("/", name="repository")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LiquidBundle:Repository')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Repository entity.
     *
     * @Route("/{id}/show", name="repository_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LiquidBundle:Repository')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Repository entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Repository entity.
     *
     * @Route("/new", name="repository_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Repository();
        $form   = $this->createForm(new RepositoryType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Repository entity.
     *
     * @Route("/create", name="repository_create")
     * @Method("POST")
     * @Template("LiquidBundle:Repository:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Repository();
        $form = $this->createForm(new RepositoryType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('repository_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Repository entity.
     *
     * @Route("/{id}/edit", name="repository_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LiquidBundle:Repository')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Repository entity.');
        }

        $editForm = $this->createForm(new RepositoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Repository entity.
     *
     * @Route("/{id}/update", name="repository_update")
     * @Method("POST")
     * @Template("LiquidBundle:Repository:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LiquidBundle:Repository')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Repository entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RepositoryType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('repository_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Repository entity.
     *
     * @Route("/{id}/delete", name="repository_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LiquidBundle:Repository')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Repository entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('repository'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
