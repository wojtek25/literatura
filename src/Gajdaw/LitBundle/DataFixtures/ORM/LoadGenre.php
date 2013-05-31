<?php

namespace Gajdaw\LitBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\LitBundle\Entity\Genre;
use Symfony\Component\Yaml\Yaml;

class LoadGenre implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'Data/genre.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
            $genre = new Genre();
            $genre->setName($item['name']);
            $genre->setShortcut($item['shortcut']);
            $manager->persist($genre);
        }
        $manager->flush();

    }
}
