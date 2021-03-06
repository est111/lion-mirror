<?php

namespace Biocare\CallBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Biocare\CallBundle\Entity\CallRegister;
use Biocare\CallBundle\Form\CallRegisterType;

/**
 * CallRegister controller.
 *
 * @Route("/admin/callregister")
 */
class CallRegisterController extends Controller
{

    /**
     * Lists all CallRegister entities.
     *
     * @Route("/", name="admin_callregister")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BiocareCallBundle:CallRegister')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CallRegister entity.
     *
     * @Route("/", name="admin_callregister_create")
     * @Method("POST")
     * @Template("BiocareCallBundle:CallRegister:new.html.twig")
     */
    public function createAction(Request $request)
    {
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $ip = $this->container->get('request')->getClientIp();
                
        
        $entity = new CallRegister();
        $entity->setCreatedBy($user);
        $entity->setCreatedFromIp($ip);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_callregister_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CallRegister entity.
     *
     * @param CallRegister $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CallRegister $entity)
    {
        $form = $this->createForm(new CallRegisterType(), $entity, array(
            'action' => $this->generateUrl('admin_callregister_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CallRegister entity.
     *
     * @Route("/new", name="admin_callregister_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $ip = $this->container->get('request')->getClientIp();
                
        
        $entity = new CallRegister();
        
        $entity->setCreatedBy($user);
        $entity->setCreatedFromIp($ip);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CallRegister entity.
     *
     * @Route("/{id}", name="admin_callregister_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareCallBundle:CallRegister')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CallRegister entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CallRegister entity.
     *
     * @Route("/{id}/edit", name="admin_callregister_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareCallBundle:CallRegister')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CallRegister entity.');
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
    * Creates a form to edit a CallRegister entity.
    *
    * @param CallRegister $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CallRegister $entity)
    {
        $form = $this->createForm(new CallRegisterType(), $entity, array(
            'action' => $this->generateUrl('admin_callregister_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CallRegister entity.
     *
     * @Route("/{id}", name="admin_callregister_update")
     * @Method("PUT")
     * @Template("BiocareCallBundle:CallRegister:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareCallBundle:CallRegister')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CallRegister entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_callregister_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CallRegister entity.
     *
     * @Route("/{id}", name="admin_callregister_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BiocareCallBundle:CallRegister')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CallRegister entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_callregister'));
    }

    /**
     * Creates a form to delete a CallRegister entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_callregister_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
