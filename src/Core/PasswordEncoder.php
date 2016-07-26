<?php

namespace MyProject\Core;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class PasswordEncoder implements PasswordEncoderInterface
{
    
    public function __construct()
    {
    }

    public function encodePassword($raw, $salt)
    {
        if ($salt == '') {
            $res = password_hash($raw, PASSWORD_BCRYPT);
        } else {
            $res = password_hash($raw, PASSWORD_BCRYPT, ['salt' => $salt]);
        }
        return $res;
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        if ($encoded == '') {
            return false;
        }
        
        return password_verify($raw, $encoded);
    }
}
