<?php

/**
 * This file is part of the FightmasterGalleryBundle package.
 *
 * (c) Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Fightmaster\Bundle\GalleryBundle\Exception;

/**
 * @author Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 */
class GalleryException extends \Exception implements Exception
{
    /**
     * @static
     * @return GalleryException
     */
    public static function savingAbortedByPrePersistEvent()
    {
        return new self('Saving of the gallery was aborted by the pre-persist event');
    }

    /**
     * @static
     * @return GalleryException
     */
    public static function removingAbortedByPreRemovingEvent()
{
    return new self('Removing of the gallery was aborted by the pre-remove event');
}
}
