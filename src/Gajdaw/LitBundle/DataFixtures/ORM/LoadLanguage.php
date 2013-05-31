<?php

namespace Gajdaw\LitBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\LitBundle\Entity\Language;
use Symfony\Component\Yaml\Yaml;

class LoadLanguage implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'Data/language.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
            $language = new Language();
            $language->setName($item['name']);
            $language->setShortcut($item['shortcut']);
            $manager->persist($language);
        }
        $manager->flush();

    }
}