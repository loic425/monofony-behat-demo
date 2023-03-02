<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Story\DefaultAdministratorsStory;
use App\Story\DefaultAppUsersStory;
use App\Story\DefaultBooksStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class DefaultFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        DefaultAdministratorsStory::load();
        DefaultAppUsersStory::load();
        DefaultBooksStory::load();
    }

    public static function getGroups(): array
    {
        return ['default'];
    }
}
