<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class DataFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $objects = Fixtures::load(__DIR__ . '/pesquisador.yml', $manager);
//        $objects = Fixtures::load(__DIR__ . '/grauDeFormacao.yml', $manager);
    }
}