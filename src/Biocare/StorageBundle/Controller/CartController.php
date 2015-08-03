<?php

namespace Biocare\StorageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Biocare\StorageBundle\Entity\Cart;
use Biocare\StorageBundle\Form\CartType;

/**
 * Cart controller.
 *
 * @Route("/admin/cart")
 */
class CartController extends Controller
{
    /**
     * Lists all Storage entities.
     *
     * @Route("/{id}/count", name="cart_count")
     * @Method("GET")
     * @Template("BiocareStorageBundle:Cart:cart_count.html.twig")
     */
    public function countAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p as product, COUNT(i.id),(COUNT(i.id)*p.weight) as weight  as qty FROM BiocareProductBundle:CartItem i JOIN BiocareProductBundle:Product p WHERE i.cart = :cart GROUP BY p.id');
        $query->setParameter('cart', $id);
        $count = $query->getResult();
        return array(
            'count' => $count,
        );
    }
    /**
     * Lists all Cart entities.
     *
     * @Route("/", name="admin_cart")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BiocareStorageBundle:Cart')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Cart entity.
     *
     * @Route("/", name="admin_cart_create")
     * @Method("POST")
     * @Template("BiocareStorageBundle:Cart:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Cart();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cart_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Cart entity.
     *
     * @param Cart $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cart $entity)
    {
        $form = $this->createForm(new CartType(), $entity, array(
            'action' => $this->generateUrl('admin_cart_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cart entity.
     *
     * @Route("/new", name="admin_cart_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Cart();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Cart entity.
     *
     * @Route("/{id}", name="admin_cart_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareStorageBundle:Cart')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cart entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Cart entity.
     *
     * @Route("/{id}/edit", name="admin_cart_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareStorageBundle:Cart')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cart entity.');
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
    * Creates a form to edit a Cart entity.
    *
    * @param Cart $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cart $entity)
    {
        $form = $this->createForm(new CartType(), $entity, array(
            'action' => $this->generateUrl('admin_cart_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cart entity.
     *
     * @Route("/{id}", name="admin_cart_update")
     * @Method("PUT")
     * @Template("BiocareStorageBundle:Cart:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareStorageBundle:Cart')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cart entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cart_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Cart entity.
     *
     * @Route("/{id}", name="admin_cart_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BiocareStorageBundle:Cart')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cart entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_cart'));
    }

    /**
     * Creates a form to delete a Cart entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_cart_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
