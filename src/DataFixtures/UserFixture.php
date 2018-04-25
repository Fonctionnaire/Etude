<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 28/02/2018
 * Time: 14:08
 */

namespace App\DataFixtures;


use App\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
    }

    private function loadUsers(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [$username, $password, $email, $roles]) {
            $user = new User();
            $user->setUsername($username);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $user->setEmail($email);
            $user->setRoles($roles);
            $manager->persist($user);
        }
        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            // $userData = [$fullname, $username, $password, $email, $roles];
            ['Fonctionnaire', 'cromwell33', 'thibaut.gruffy@gmail.com', ['ROLE_ADMIN']],
            ['Utilisateur1', 'cromwell33', 'thibaut.gruffy+userun@gmail.com', ['ROLE_USER']],
            ['Utilisateur2', 'cromwell33', 'thibaut.gruffy+userdeux@gmail.com', ['ROLE_USER']]
        ];
    }
}