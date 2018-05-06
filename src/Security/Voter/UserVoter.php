<?php

namespace App\Security\Voter;

use App\Entity\User\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{

    const VIEW = 'view';
    const EDIT = 'edit';

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, [self::VIEW, self::EDIT]) &&
            $subject instanceof User;
    }


    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::EDIT:
                return $this->isSameUser($user, $subject);
                break;
            case self::VIEW:
                return $this->isSameUser($user, $subject);
                break;
        }

        return false;
    }

    /**
     * Check if two users are identicals
     * */
    private function isSameUser(UserInterFace $user1, UserInterface $user2){
    return $user1 === $user2;
    }
}
