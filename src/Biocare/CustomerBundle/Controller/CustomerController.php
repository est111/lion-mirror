<?php

namespace Biocare\CustomerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Biocare\CustomerBundle\Entity\Customer;
use Biocare\CustomerBundle\Form\CustomerType;
use Symfony\Component\HttpFoundation\Session;

/**
 * Customer controller.
 *
 * @Route("/admin/customer")
 */
class CustomerController extends Controller {

    /**
     * Lists all Customer entities.
     *
     * @Route("/", name="admin_customer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BiocareCustomerBundle:Customer')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Customer entities.
     *
     * @Route("/customer/", name="customer")
     * @Method("GET")
     * @Template()
     */
    public function customerAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BiocareCustomerBundle:Customer')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Customer entity.
     *
     * @Route("/", name="admin_customer_create")
     * @Method("POST")
     * @Template("BiocareCustomerBundle:Customer:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Customer();
        $callregister = $this->get('session')->get('callregister');
        dump($callregister);
        $em->persist($callregister);
        if ($callregister) {
            $entity->setCallregister($callregister);
        }
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_customer_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Customer entity.
     *
     * @param Customer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Customer $entity) {
        $form = $this->createForm(new CustomerType(), $entity, array(
            'action' => $this->generateUrl('admin_customer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Customer entity.
     *
     * @Route("/new", name="admin_customer_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Customer();
        $callregister = $this->get('session')->get('callregister');
        dump($callregister);
        $em->persist($callregister);
        if ($callregister) {
            $entity->setCallregister($callregister);
        }
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Customer entity.
     *
     * @Route("/{id}", name="admin_customer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareCustomerBundle:Customer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Customer entity.
     *
     * @Route("/{id}/edit", name="admin_customer_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareCustomerBundle:Customer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Customer entity.
     *
     * @param Customer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Customer $entity) {
        $form = $this->createForm(new CustomerType(), $entity, array(
            'action' => $this->generateUrl('admin_customer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Customer entity.
     *
     * @Route("/{id}", name="admin_customer_update")
     * @Method("PUT")
     * @Template("BiocareCustomerBundle:Customer:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareCustomerBundle:Customer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_customer_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Customer entity.
     *
     * @Route("/{id}", name="admin_customer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BiocareCustomerBundle:Customer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Customer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_customer'));
    }

    /**
     * Creates a form to delete a Customer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_customer_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
