<?php

namespace DavidTeruel\UtilsBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;

abstract class GenericManager
{
    /** @var ObjectManager $manager */
    private $manager;

    /**
     * GenericManager constructor.
     *
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param $object
     */
    public function persistAndFlush($object)
    {
        $this->manager->persist($object);
        $this->manager->flush();
    }

    /**
     * @param $object
     */
    public function removeAndFlush($object)
    {
        $this->manager->remove($object);
        $this->manager->flush();
    }
}