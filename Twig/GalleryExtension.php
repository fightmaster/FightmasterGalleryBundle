<?php

/**
 * This file is part of the FightmasterGalleryBundle package.
 *
 * (c) Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Fightmaster\Bundle\GalleryBundle\Twig;

use Twig_Extension;
use Twig_Function_Method;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Fightmaster\Bundle\GalleryBundle\Model\GalleryInterface;
use Fightmaster\Bundle\GalleryBundle\Model\SignedGalleryInterface;
use SarSport\Bundle\UserBundle\Entity\User;

/**
 * @author Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 */
class GalleryExtension extends Twig_Extension
{
    /**
     * @var SecurityContext
     */
    protected $securityContext;

    /**
     * Constructor.
     *
     * @param SecurityContextInterface $securityContext
     */
    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * Checks owner of the entity
     *
     * @param GalleryInterface $gallery
     * @return bool
     */
    public function isOwner(GalleryInterface $gallery)
    {
        if ($this->securityContext->getToken()->getUser() instanceof User) {
            if ($this->securityContext->isGranted(array('ROLE_ADMIN'))) {
                return true;
            } elseif ($gallery instanceof SignedGalleryInterface) {
                if ($this->securityContext->getToken()->getUser()->getId() == $gallery->getUser()->getId()) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'fightmaster_gallery_is_owner' => new Twig_Function_Method($this, 'isOwner'),
        );
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'fightmaster_gallery';
    }
}
