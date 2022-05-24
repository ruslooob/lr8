<?php

namespace App\DataFixtures;

use App\Entity\Screenshot;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Ramsey\Uuid\Nonstandard\Uuid;

class AppFixtures extends Fixture
{
    public const USERS_COUNT = 10;
    public const SCREENSHOTS_COUNT = 10;

    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < self::USERS_COUNT; $i++) {
            $user = $this->createRandomUser();
            // set screenshots
            for ($j = 0; $j < self::SCREENSHOTS_COUNT; $j++) {
                $screenshot = $this->createRandomScreenshot();
                $manager->persist($screenshot);
                $user->addScreenshot($screenshot);
            }
            $manager->persist($user);
        }

        $manager->flush();
    }

    private function createRandomUser(): User {
        $generator = Factory::create("ru_RU");

        $user = new User();
        $user->setEmail($generator->unique()->email);
        $user->setLogin($generator->unique()->userName);
        $user->setPassword(password_hash($generator->password, PASSWORD_DEFAULT));
        $user->setIsModerator(false);
        $user->setPhone($generator->phoneNumber);
        return $user;
    }

    private function createRandomScreenshot(): Screenshot {
        $generator = Factory::create("ru_RU");

        $screenshot = new Screenshot();
        $screenshot->setDescription($generator->unique()->text(100));
        $screenshot->setExtension($generator->text(8));
        $screenshot->setPathToSource($generator->unique()->url);
        $screenshot->setUuid(str_replace("\\", "", Uuid::uuid4()));
        $screenshot->setUploadDate($generator->dateTime);
        return $screenshot;
    }
}
