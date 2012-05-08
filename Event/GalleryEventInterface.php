<?php

/**
 * This file is part of the FightmasterGalleryBundle package.
 *
 * (c) Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Fightmaster\Bundle\GalleryBundle\Event;

/**
 * @author Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 */
interface GalleryEventInterface
{
    /**
     * Indicates that the persisting operation should not proceed.
     *
     * @abstract
     */
    public function abortPersistence();

    /**
     * Checks if a listener has set the event to abort the persisting operation.
     *
     * @abstract
     *
     * @return bool
     */
    public function isPersistenceAborted();
}
