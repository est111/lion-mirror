<?php

namespace Biocare\OrderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Biocare\OrderBundle\Entity\Orders;
use Biocare\OrderBundle\Form\OrdersType;

/**
 * Orders controller.
 *
 * @Route("/admin/orders")
 */
class OrdersController extends Controller
{

    /**
     * Lists all Orders entities.
     *
     * @Route("/", name="admin_orders")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BiocareOrderBundle:Orders')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    
//    /**
//     * Lists all Orders entities.
//     *
//     * @Route("/", name="admin_orders")
//     * @Method("GET")
//     * @Template()
//     */
//    public function indexAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entities = $em->getRepository('BiocareOrderBundle:Orders')->findAll();
//
//        return array(
//            'entities' => $entities,
//        );
//    }
    
    
    /**
     * Creates a new Orders entity.
     *
     * @Route("/", name="admin_orders_create")
     * @Method("POST")
     * @Template("BiocareOrderBundle:Orders:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Orders();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_orders_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Orders entity.
     *
     * @param Orders $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Orders $entity)
    {
        $form = $this->createForm(new OrdersType(), $entity, array(
            'action' => $this->generateUrl('admin_orders_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Orders entity.
     *
     * @Route("/new", name="admin_orders_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Orders();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    
    
    /**
     * Finds and displays a Orders entity.
     *
     * @Route("/{id}", name="admin_orders_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareOrderBundle:Orders')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Orders entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Orders entity.
     *
     * @Route("/{id}/edit", name="admin_orders_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareOrderBundle:Orders')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Orders entity.');
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
    * Creates a form to edit a Orders entity.
    *
    * @param Orders $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Orders $entity)
    {
        $form = $this->createForm(new OrdersType(), $entity, array(
            'action' => $this->generateUrl('admin_orders_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Orders entity.
     *
     * @Route("/{id}", name="admin_orders_update")
     * @Method("PUT")
     * @Template("BiocareOrderBundle:Orders:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareOrderBundle:Orders')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Orders entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_orders_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Orders entity.
     *
     * @Route("/{id}", name="admin_orders_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BiocareOrderBundle:Orders')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Orders entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_orders'));
    }

    /**
     * Creates a form to delete a Orders entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_orders_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
