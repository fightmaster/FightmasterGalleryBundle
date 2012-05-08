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
interface RemoveEventInterface
{
    /**
     * Indicates that the removing operation should not proceed.
     *
     * @abstract
     */
    public function abortRemoving();

    /**
     * Checks if a listener has set the event to abort the removing operation.
     *
     * @abstract
     *
     * @return bool
     */
    public function isRemovingAborted();
}
