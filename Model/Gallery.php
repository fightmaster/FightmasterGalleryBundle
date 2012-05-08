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
abstract class Gallery implements GalleryInterface
{
    /**
     * The unique ID of the gallery
     *
     * @var int
     */
    protected $id;

    /**
     * The name of the gallery
     * @var string
     */
    protected $name;

    /**
     * {@inheritDoc}
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $name
     * @return GalleryInterface
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
