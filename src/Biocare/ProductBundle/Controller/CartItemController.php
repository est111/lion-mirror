<?php

namespace Biocare\ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Biocare\ProductBundle\Entity\CartItem;
use Biocare\ProductBundle\Form\CartItemType;

/**
 * CartItem controller.
 *
 * @Route("/admin/cartitem")
 */
class CartItemController extends Controller
{

    /**
     * Lists all CartItem entities.
     *
     * @Route("/", name="admin_cartitem")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BiocareProductBundle:CartItem')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CartItem entity.
     *
     * @Route("/", name="admin_cartitem_create")
     * @Method("POST")
     * @Template("BiocareProductBundle:CartItem:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CartItem();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cartitem_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CartItem entity.
     *
     * @param CartItem $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CartItem $entity)
    {
        $form = $this->createForm(new CartItemType(), $entity, array(
            'action' => $this->generateUrl('admin_cartitem_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CartItem entity.
     *
     * @Route("/new", name="admin_cartitem_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CartItem();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CartItem entity.
     *
     * @Route("/{id}", name="admin_cartitem_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareProductBundle:CartItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CartItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CartItem entity.
     *
     * @Route("/{id}/edit", name="admin_cartitem_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareProductBundle:CartItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CartItem entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a CartItem entity.
    *
    * @param CartItem $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CartItem $entity)
    {
        $form = $this->createForm(new CartItemType(), $entity, array(
            'action' => $this->generateUrl('admin_cartitem_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CartItem entity.
     *
     * @Route("/{id}", name="admin_cartitem_update")
     * @Method("PUT")
     * @Template("BiocareProductBundle:CartItem:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareProductBundle:CartItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CartItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cartitem_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CartItem entity.
     *
     * @Route("/{id}", name="admin_cartitem_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BiocareProductBundle:CartItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CartItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_cartitem'));
    }

    /**
     * Creates a form to delete a CartItem entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_cartitem_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
