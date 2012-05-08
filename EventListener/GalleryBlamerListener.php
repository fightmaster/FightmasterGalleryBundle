<?php

/**
 * This file is part of the FightmasterGalleryBundle package.
 *
 * (c) Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Fightmaster\Bundle\GalleryBundle\EventListener;

use Fightmaster\Bundle\GalleryBundle\Events;
use Fightmaster\Bundle\GalleryBundle\Event\GalleryEvent;
use Fightmaster\Bundle\GalleryBundle\Model\SignedGalleryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Blames a application using Symfony2 security component
 *
 * @author Dmitry Petrov aka fightmaster <old.fightmaster@gmail.com>
 */
class GalleryBlamerListener implements EventSubscriberInterface
{
    /**
     * @var SecurityContext
     */
    protected $securityContext;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Constructor.
     *
     * @param SecurityContextInterface $securityContext
     * @param LoggerInterface $logger
     */
    public function __construct(SecurityContextInterface $securityContext, LoggerInterface $logger = null)
    {
        $this->securityContext = $securityContext;
        $this->logger = $logger;
    }

    /**
     * Assigns the currently logged in user to a Gallery.
     *
     * @param GalleryEvent $event
     * @return mixed
     */
    public function blame(GalleryEvent $event)
    {
        $gallery = $event->getGallery();

        if (!$gallery instanceof SignedGalleryInterface) {
            if ($this->logger) {
                $this->logger->debug("Gallery does not implement SignedGalleryInterface, skipping");
            }

            return;
        }

        if (null === $this->securityContext->getToken()) {
            if ($this->logger) {
                $this->logger->debug("There is no firewall configured. We cant get a user.");
            }

            return;
        }

        if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY') && $gallery->getUser() == null) {
            $gallery->setUser($this->securityContext->getToken()->getUser());
        }
    }

    /**
     * {@inheritDoc}
     *
     * @static
     * @return array
     */
    static public function getSubscribedEvents()
    {
        return array(Events::GALLERY_PRE_PERSIST => 'blame');
    }
}
