<?php

/**
 * This file is part of the FightmasterGalleryBundle package.
 *
 * (c) Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */


namespace Fightmaster\Bundle\GalleryBundle\Service;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Fightmaster\Model\Manager\ManagerInterface;
use Fightmaster\Bundle\GalleryBundle\Model\GalleryInterface;
use Fightmaster\Bundle\GalleryBundle\Exception\GalleryException;
use Fightmaster\Bundle\GalleryBundle\Events;
use Fightmaster\Bundle\GalleryBundle\Event\GalleryPersistEvent;
use Fightmaster\Bundle\GalleryBundle\Event\GalleryRemoveEvent;
use Fightmaster\Bundle\GalleryBundle\Event\GalleryEvent;

/**
 * @author Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 */
class GalleryService
{
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @param ManagerInterface $manager
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, ManagerInterface $manager)
    {
        $this->dispatcher = $eventDispatcher;
        $this->manager = $manager;
    }

    /**
     * Saves gallery entities
     *
     * @param GalleryInterface $gallery
     * @throws GalleryException
     */
    public function save(GalleryInterface $gallery)
    {
        $event = new GalleryPersistEvent($gallery);
        $this->getDispatcher()->dispatch(Events::GALLERY_PRE_PERSIST, $event);

        if ($event->isPersistenceAborted()) {
            throw GalleryException::savingAbortedByPrePersistEvent();
        }

        $this->manager->save($gallery, true);

        $event = new GalleryEvent($gallery);
        $this->getDispatcher()->dispatch(Events::GALLERY_POST_PERSIST, $event);
    }

    /**
     * Removes gallery entities
     *
     * @param GalleryInterface $gallery
     * @throws GalleryException
     */
    public function remove(GalleryInterface $gallery)
    {
        $event = new GalleryRemoveEvent($gallery);
        $this->getDispatcher()->dispatch(Events::GALLERY_PRE_REMOVE, $event);

        if ($event->isRemovingAborted()) {
            throw GalleryException::removingAbortedByPreRemovingEvent();
        }

        $this->manager->remove($gallery, true);

        $event = new GalleryEvent($gallery);
        $this->getDispatcher()->dispatch(Events::GALLERY_POST_REMOVE, $event);
    }

    /**
     * Saves gallery entities
     *
     * @return GalleryInterface
     */
    public function create()
    {
        $gallery = $this->manager->create();
        $event = new GalleryEvent($gallery);
        $this->getDispatcher()->dispatch(Events::GALLERY_CREATE, $event);

        return $gallery;
    }

    /**
     * Returns gallery
     *
     * @param int $id
     * @return GalleryInterface
     */
    public function findGalleryById($id)
    {
        return $this->manager->find($id);
    }

    /**
     * Returns galleries
     *
     * @param null|int $limit
     * @param null|int $offset
     * @return GalleryInterface[]
     */
    public function findAllGalleries($limit = null, $offset = null)
    {
        return $this->manager->findBy(array(), array('id' => 'DESC'), $limit, $offset);
    }

    /**
     * Returns EventDispatcher
     *
     * @return \Symfony\Component\EventDispatcher\EventDispatcherInterface
     */
    protected function getDispatcher()
    {
        return $this->dispatcher;
    }
}
