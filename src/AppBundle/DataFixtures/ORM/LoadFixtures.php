<?php

namespace AppBundle\DataFixtures\ORM;

// use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements ORMFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $objects = Fixtures::load(
            __DIR__.'/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }

    public function userName()
    {
      $names = [
        'Juan',
        'Adolfo',
        'Daniel',
        'Pedro',
        'Ramiro',
        'Eduardo',
        'Samuel',
        'David',
        'Eufemio',
        'Sofia',
        'Sarahi',
        'Susana',
        'Erika',
        'Anastasia',
        'Alma',
        'Isabel',
        'Eugenia',
        'Marisol'
      ];
      $key = array_rand($names);

      return $names[$key];
    }

    public function userLastName()
    {
      $lastNames = [
        'Nutriales',
        'Rayado',
        'Cornado',
        'Colmillo',
        'Madrigal',
        'Blanco',
        'León',
        'Martin',
        'Mordáz',
        'Rojo',
        'Bernal',
        'Delcampo',
        'Delrio',
        'Musgo',
      ];
      $key = array_rand($lastNames);

      return $lastNames[$key];
    }
}