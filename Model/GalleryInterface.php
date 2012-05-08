<?php

/**
 * This file is part of the FightmasterGalleryBundle package.
 *
 * (c) Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Fightmaster\Bundle\GalleryBundle\Model;

/**
 * @author Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 */
interface GalleryInterface
{
    /**
     * Returns ID
     *
     * @abstract
     * @return int
     */
    public function getId();

    /**
     * Returns name of the gallery
     *
     * @abstract
     * @return string
     */
    public function getName();

    /**
     * Sets value of the name of the gallery
     *
     * @abstract
     * @param string $name
     * @return GalleryInterface
     */
    public function setName($name);
}
