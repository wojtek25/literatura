<?php

namespace Gajdaw\AngazeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\LitBundle\Entity\Reviewer;
use Symfony\Component\Yaml\Yaml;

class LoadReviewer implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'Data/reviewer.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
            $reviewer = new Reviewer();
            $reviewer->setFirstname($item['firstname']);
            $reviewer->setLastname($item['lastname']);
            $manager->persist($reviewer);
        }
        $manager->flush();

    }
}
