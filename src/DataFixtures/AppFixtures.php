<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
        {
        }

    public function load(ObjectManager $manager): void
    {
        $categories_names = ['Fruits', 'Légumes', 'Frais', 'Hygiène', 'Sanitaire', 'Animaux', 'Laitier', 'Viande', 'Poisson', 'Epicerie salée', 'Epicerie sucrée', 'Boissons', 'Surgelé'];

        foreach ($categories_names as $name) {

            $category = new Category();
            $category->setName($name);
            

            $manager->persist($category);
        }

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN']);

        $hashed = $this->hasher->hashPassword($admin, 'qwerty');
        $admin->setPassword($hashed);

        $manager->persist($admin);
        $manager->flush();
        
    }


}
