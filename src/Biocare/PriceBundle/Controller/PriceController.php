<?php

namespace Biocare\PriceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Biocare\PriceBundle\Entity\Price;
use Biocare\PriceBundle\Form\PriceType;

/**
 * Price controller.
 *
 * @Route("/admin/price")
 */
class PriceController extends Controller
{

    /**
     * Lists all Price entities.
     *
     * @Route("/", name="admin_price")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BiocarePriceBundle:Price')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Price entity.
     *
     * @Route("/", name="admin_price_create")
     * @Method("POST")
     * @Template("BiocarePriceBundle:Price:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Price();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_price_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Price entity.
     *
     * @param Price $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Price $entity)
    {
        $form = $this->createForm(new PriceType(), $entity, array(
            'action' => $this->generateUrl('admin_price_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Price entity.
     *
     * @Route("/new", name="admin_price_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Price();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Price entity.
     *
     * @Route("/{id}", name="admin_price_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocarePriceBundle:Price')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Price entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Price entity.
     *
     * @Route("/{id}/edit", name="admin_price_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocarePriceBundle:Price')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Price entity.');
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
    * Creates a form to edit a Price entity.
    *
    * @param Price $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Price $entity)
    {
        $form = $this->createForm(new PriceType(), $entity, array(
            'action' => $this->generateUrl('admin_price_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Price entity.
     *
     * @Route("/{id}", name="admin_price_update")
     * @Method("PUT")
     * @Template("BiocarePriceBundle:Price:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocarePriceBundle:Price')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Price entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_price_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Price entity.
     *
     * @Route("/{id}", name="admin_price_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BiocarePriceBundle:Price')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Price entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_price'));
    }

    /**
     * Creates a form to delete a Price entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_price_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
