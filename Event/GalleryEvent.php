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

use Symfony\Component\EventDispatcher\Event;
use Fightmaster\Bundle\GalleryBundle\Model\GalleryInterface;

/**
 * @author Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 */
class GalleryEvent extends Event
{
    /**
     * @var GalleryInterface
     */
    private $gallery;

    public function __construct(GalleryInterface $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @return GalleryInterface
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
