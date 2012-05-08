<?php

/**
 * This file is part of the FightmasterGalleryBundle package.
 *
 * (c) Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Fightmaster\Bundle\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fightmaster\Bundle\GalleryBundle\Service\GalleryService;
use Fightmaster\Bundle\GalleryBundle\Form\GalleryType;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Gallery controller.
 *
 */
class GalleryController extends Controller
{
    /**
     * Finds and displays all galleries
     *
     * @param $competition
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($competition)
    {
        $entities = $this->getGalleryService()->findAllGalleries();

        return $this->render('FightmasterGalleryBundle:Gallery:index.html.twig', array(
            'entities' => $entities,
            'competition' => $competition
        ));
    }

    /**
     * Finds and displays a Gallery entity.
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function showAction($id)
    {
        $entity = $this->getGalleryService()->findGalleryById($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->getTranslationsUnableToFind($id));
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FightmasterGalleryBundle:Gallery:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Gallery entity.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $entity = $this->getGalleryService()->create();
        $form   = $this->createForm(new GalleryType(), $entity);

        return $this->render('FightmasterGalleryBundle:Gallery:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Gallery entity.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        $entity = $this->getGalleryService()->create();
        $request = $this->getRequest();
        $form    = $this->createForm(new GalleryType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $this->getGalleryService()->save($entity);

            return $this->redirect($this->generateUrl('FightmasterGalleryBundle_Gallery_show', array('id' => $entity->getId())));
            
        }

        return $this->render('FightmasterGalleryBundle:Gallery:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Gallery entity.
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function editAction($id)
    {
        $entity = $this->getGalleryService()->findGalleryById($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->getTranslationsUnableToFind($id));
        }

        $editForm = $this->createForm(new GalleryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FightmasterGalleryBundle:Gallery:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     *  Edits an existing Gallery entity.
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function updateAction($id)
    {
        $entity = $this->getGalleryService()->findGalleryById($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->getTranslationsUnableToFind($id));
        }

        $editForm   = $this->createForm(new GalleryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $this->getGalleryService()->save($entity);

            return $this->redirect($this->generateUrl('FightmasterGalleryBundle_Gallery_edit', array('id' => $id)));
        }

        return $this->render('FightmasterGalleryBundle:Gallery:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Gallery entity.
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $gallery = $this->getGalleryService()->findGalleryById($id);

            if (!$gallery) {
                throw $this->createNotFoundException($this->getTranslationsUnableToFind($id));
            }
            $this->getGalleryService()->remove($gallery);
        }

        return $this->redirect($this->generateUrl('FightmasterGalleryBundle_Gallery'));
    }

    /**
     * @param $id
     * @return \Symfony\Component\Form\Form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * @return GalleryService
     */
    private function getGalleryService()
    {
        return $this->container->get('fightmaster_gallery.service.gallery');
    }

    /**
     * @return TranslatorInterface
     */
    private function getTranslator()
    {
        return $this->get('translator');
    }

    /**
     * @param int $id
     * @return string
     */
    private function getTranslationsUnableToFind($id)
    {
        return $this->getTranslator()->trans('gallery.errors.unable_to_find', array('%id%' => $id), 'FightmasterGalleryBundle');
    }
}
