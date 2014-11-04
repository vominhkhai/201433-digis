<?php

namespace MK\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MK\UserBundle\Entity\User;
/**
 * Load User data
 */
class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * Set container
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPassword('admin');
        $userAdmin->setEmail('admin@admin.com');
        $factory = $this->container->get('security.encoder_factory');
        $encoder = $factory->getEncoder($userAdmin);
        $password = $encoder->encodePassword($userAdmin->getPassword(), $userAdmin->getSalt());
        $userAdmin->setPassword($password);
        $userAdmin->setIsActive(1);
        $userAdmin->setIsSuperadmin(1);

        $manager->persist($userAdmin);
        $manager->flush();
    }
}