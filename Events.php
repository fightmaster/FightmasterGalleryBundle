<?php

/**
 * This file is part of the FightmasterGalleryBundle package.
 *
 * (c) Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Fightmaster\Bundle\GalleryBundle;

/**
 * @author Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 */
final class Events
{
    /**
     * The PRE_PERSIST event occurs prior to the persistence backend
     * persisting the gallery.
     *
     * This event allows you to modify the data in the gallery prior
     * to persisting occuring. The listener receives a
     * Fightmaster\Bundle\GalleryBundle\Event\GalleryPersistEvent instance.
     *
     * Persisting of the gallery can be aborted by calling
     * $event->abortPersist()
     *
     * @var string
     */
    const GALLERY_PRE_PERSIST = 'fightmaster_gallery.gallery.pre_persist';

    /**
     * The POST_PERSIST event occurs after the persistence backend
     * persisted the gallery.
     *
     * This event allows you to notify users or perform other actions
     * that might require the gallery to be persisted before performing
     * those actions. The listener receives a
     * Fightmaster\Bundle\GalleryBundle\Event\GalleryEvent instance.
     *
     * @var string
     */
    const GALLERY_POST_PERSIST = 'fightmaster_gallery.gallery.post_persist';
    /**
     * The PRE_REMOVE event occurs prior to the removing the gallery.
     *
     * This event allows you to modify the data in the gallery prior
     * to removing occuring. The listener receives a
     * Fightmaster\Bundle\GalleryBundle\Event\GalleryRemoveEvent instance.
     *
     * Removing of the gallery can be aborted by calling
     * $event->abortRemove()
     *
     * @var string
     */
    const GALLERY_PRE_REMOVE = 'fightmaster_gallery.gallery.pre_remove';

    /**
     * The POST_REOVE event occurs after the remove backend
     * persisted the gallery.
     *
     * This event allows you to notify users or perform other actions
     * that might require the gallery to be removed before performing
     * those actions. The listener receives a
     * Fightmaster\Bundle\GalleryBundle\Event\GalleryEvent instance.
     *
     * @var string
     */
    const GALLERY_POST_REMOVE = 'fightmaster_gallery.gallery.post_remove';

    /**
     * The CREATE event occurs when the manager is asked to create
     * a new instance of a gallery.
     *
     * The listener receives a Fightmaster\Bundle\GalleryBundle\Event\GalleryEvent
     * instance.
     *
     * @var string
     */
    const GALLERY_CREATE = 'fightmaster_gallery.gallery.create';
}
