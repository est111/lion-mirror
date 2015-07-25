<?php

namespace Biocare\ConnectionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Biocare\ConnectionBundle\Entity\Connexion;
use Biocare\ConnectionBundle\Form\ConnexionType;

/**
 * Connexion controller.
 *
 * @Route("/admin/connexion")
 */
class ConnexionController extends Controller
{

    /**
     * Lists all Connexion entities.
     *
     * @Route("/", name="admin_connexion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BiocareConnectionBundle:Connexion')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Connexion entity.
     *
     * @Route("/", name="admin_connexion_create")
     * @Method("POST")
     * @Template("BiocareConnectionBundle:Connexion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Connexion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_connexion_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Connexion entity.
     *
     * @param Connexion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Connexion $entity)
    {
        $form = $this->createForm(new ConnexionType(), $entity, array(
            'action' => $this->generateUrl('admin_connexion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Connexion entity.
     *
     * @Route("/new", name="admin_connexion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Connexion();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Connexion entity.
     *
     * @Route("/{id}", name="admin_connexion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareConnectionBundle:Connexion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Connexion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Connexion entity.
     *
     * @Route("/{id}/edit", name="admin_connexion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareConnectionBundle:Connexion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Connexion entity.');
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
    * Creates a form to edit a Connexion entity.
    *
    * @param Connexion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Connexion $entity)
    {
        $form = $this->createForm(new ConnexionType(), $entity, array(
            'action' => $this->generateUrl('admin_connexion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Connexion entity.
     *
     * @Route("/{id}", name="admin_connexion_update")
     * @Method("PUT")
     * @Template("BiocareConnectionBundle:Connexion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BiocareConnectionBundle:Connexion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Connexion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_connexion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Connexion entity.
     *
     * @Route("/{id}", name="admin_connexion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BiocareConnectionBundle:Connexion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Connexion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_connexion'));
    }

    /**
     * Creates a form to delete a Connexion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_connexion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
