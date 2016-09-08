<?php

namespace Cz\ManagerBundle\DataFixtures\ORM;

use Cz\AdminBundle\Entity\Carrousel;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Cz\ManagerBundle\Entity\Group;
use Symfony\Component\Validator\Constraints\Null;

/**
 * Fixture for creating the basic groups
 */
class CarrouselFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
            $this->createCarrousel($manager,Null);
            $manager->flush();
    }

    /**
     * Create a group
     *
     * @param ObjectManager $manager The object manager
     * @param string        $name    The name of the group
     * @param array         $roles   The roles connected to this group
     *
     * @return Group
     */
    private function createCarrousel(ObjectManager $manager, $name)
    {
        $carrousel = new Carrousel($name);
        $manager->persist($carrousel);

        return $carrousel;
    }

    /**
     * Get the order of this fixture
     *
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }

}
