<?php

namespace MyProject\Core;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * WsseUserToken implements a username and password token.
 *
 * @author Pro_64
 *
 */
class WsseUserToken extends AbstractToken
{
    public $username;
    public $password;

    /**
     * @param unknown $username
     * @param unknown $password
     * @param unknown $role
     */
    public function __construct($username, $password, $role)
    {
        parent::__construct();
        $this->username = $username;
        $this->password = $password;
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\Security\Core\Authentication\Token\TokenInterface::getCredentials()
     */
    public function getCredentials()
    {
        return $this->password;
    }
    
    /* (non-PHPdoc)
     * @see \Symfony\Component\Security\Core\Authentication\Token\AbstractToken::getUsername()
     */
    public function getUsername()
    {
        return $this->username;
    }
}
