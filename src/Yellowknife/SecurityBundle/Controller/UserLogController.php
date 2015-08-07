<?php

namespace Yellowknife\SecurityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Yellowknife\SecurityBundle\Entity\UserLog;
use Yellowknife\SecurityBundle\Form\UserLogType;

/**
 * UserLog controller.
 *
 * @Route("/admin/user/userlog")
 */
class UserLogController extends Controller
{

    /**
     * Lists all UserLog entities.
     *
     * @Route("/", name="admin_user_userlog")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('YellowknifeSecurityBundle:UserLog')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new UserLog entity.
     *
     * @Route("/", name="admin_user_userlog_create")
     * @Method("POST")
     * @Template("YellowknifeSecurityBundle:UserLog:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new UserLog();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_user_userlog_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a UserLog entity.
     *
     * @param UserLog $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserLog $entity)
    {
        $form = $this->createForm(new UserLogType(), $entity, array(
            'action' => $this->generateUrl('admin_user_userlog_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserLog entity.
     *
     * @Route("/new", name="admin_user_userlog_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new UserLog();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a UserLog entity.
     *
     * @Route("/{id}", name="admin_user_userlog_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('YellowknifeSecurityBundle:UserLog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserLog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing UserLog entity.
     *
     * @Route("/{id}/edit", name="admin_user_userlog_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('YellowknifeSecurityBundle:UserLog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserLog entity.');
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
    * Creates a form to edit a UserLog entity.
    *
    * @param UserLog $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserLog $entity)
    {
        $form = $this->createForm(new UserLogType(), $entity, array(
            'action' => $this->generateUrl('admin_user_userlog_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserLog entity.
     *
     * @Route("/{id}", name="admin_user_userlog_update")
     * @Method("PUT")
     * @Template("YellowknifeSecurityBundle:UserLog:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('YellowknifeSecurityBundle:UserLog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserLog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_user_userlog_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a UserLog entity.
     *
     * @Route("/{id}", name="admin_user_userlog_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('YellowknifeSecurityBundle:UserLog')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserLog entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_user_userlog'));
    }

    /**
     * Creates a form to delete a UserLog entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_user_userlog_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
