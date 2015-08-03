<?php

namespace Biocare\StorageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Biocare\StorageBundle\Entity\Storage;
use Biocare\StorageBundle\Form\StorageType;

/**
 * Storage controller.
 *
 * @Route("/admin/storage")
 */
class StorageController extends Controller
{
    /**
     * Lists all Storage entities.
     *
     * @Route("/{id}/expo", name="storage_expo")
     * @Method("GET")
     * @Template("BiocareStorageBundle:Storage:storage_expo.html.twig")
     */
    public function expoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT distinct(i.product) as product, COUNT(i.id) as qty FROM BiocareProductBundle:Item i WHERE i.storage = :storage GROUP BY i.product');
        $query->setParameter('storage', $id);
        $count = $query->getResult();
        dump($count);
        return array(
            'count' => $count,
        );
    }
    
    
    /**
     * Lists all Storage entities.
     *
     * @Route("/{id}/count", name="storage_count")
     * @Method("GET")
     * @Template("BiocareStorageBundle:Storage:storage_count.html.twig")
     */
    public function countAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT distinct(i.product) as product, COUNT(i.id) as qty FROM BiocareProductBundle:Item i WHERE i.storage = :storage GROUP BY i.product');
        $query->setParameter('storage', $id);
        $count = $query->getResult();
        return array(
            'count' => $count,
        );
    }
    
    
    /**
     * Lists all Storage entities.
     *
     * @Route("/", name="admin_storage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BiocareStorageBundle:Storage')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Storage entity.
     *
     * @Route("/", name="admin_storage_create")
     * @Method("POST")
     * @Template("BiocareStorageBundle:Storage:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Storage();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_storage_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Storage entity.
     *
     * @param Storage $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Storage $entity)
    {
        $form = $this->createForm(new StorageType(), $entity, array(
            'action' => $this->generateUrl('admin_storage_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Storage entity.
     *
     * @Route("/new", name="admin_storage_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Storage();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Storage entity.
     *
     * @Route("/{id}", name="admin_storage_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareStorageBundle:Storage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Storage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Storage entity.
     *
     * @Route("/{id}/edit", name="admin_storage_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareStorageBundle:Storage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Storage entity.');
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
    * Creates a form to edit a Storage entity.
    *
    * @param Storage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Storage $entity)
    {
        $form = $this->createForm(new StorageType(), $entity, array(
            'action' => $this->generateUrl('admin_storage_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Storage entity.
     *
     * @Route("/{id}", name="admin_storage_update")
     * @Method("PUT")
     * @Template("BiocareStorageBundle:Storage:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareStorageBundle:Storage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Storage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_storage_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Storage entity.
     *
     * @Route("/{id}", name="admin_storage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BiocareStorageBundle:Storage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Storage entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_storage'));
    }

    /**
     * Creates a form to delete a Storage entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_storage_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
