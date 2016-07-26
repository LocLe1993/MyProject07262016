<?php

namespace MyProject\Core;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
 
/**
 * UserProviderInterface retrieves users for WsseUserToken tokens.
 *
 * @author Mai Han
 */
class WsseProvider implements AuthenticationProviderInterface
{
    private $userProvider;
    private $providerKey;
    private $encoderFactory;
 
    /**
     * @param UserProviderInterface $userProvider
     * @param unknown $providerKey
     * @param EncoderFactoryInterface $encoderFactor
     */
    public function __construct(
        UserProviderInterface $userProvider,
        $providerKey,
        EncoderFactoryInterface $encoderFactory
    ) {
        $this->userProvider = $userProvider;
        $this->providerKey = $providerKey;
        $this->encoderFactory = $encoderFactory;
    }
 
    /**
     * {@inheritdoc}
     */
    protected function retrieveUser($username, WsseUserToken $token)
    {
        $user = $token->getUser();
        if ($user instanceof UserInterface) {
            return $user;
        }
 
        try {
            $user = $this->userProvider->loadUserByUsername(
                $username
            );
 
            if (!$user instanceof UserInterface) {
                return;
            }
 
            return $user;
        } catch (UsernameNotFoundException $notFound) {
            throw new BadCredentialsException('ユーザ名またはパスワードが正しくありません。	');
        }
    }
 
    /* (non-PHPdoc)
     * @see \Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface::supports()
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof WsseUserToken;
    }
 
    /* (non-PHPdoc)
     * @see \Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface::authenticate()
     */
    public function authenticate(TokenInterface $token)
    {
        if (!$this->supports($token)) {
            return null;
        }
       
        $username = $token->getUsername();
        $password = $token->getCredentials();

        if (empty($username)) {
            throw new BadCredentialsException('ユーザ名を入力してください。');
        }
        if (empty($password)) {
            throw new BadCredentialsException('パスワードを入力してください。');
        }
         
        try {
            $user = $this->retrieveUser($username, $token);
        } catch (UsernameNotFoundException $notFound) {
            throw new BadCredentialsException('ユーザ名またはパスワードが正しくありません。');
        }
 
        if (!$user instanceof UserInterface) {
            return;
        }
 
        try {
            $this->checkAuthentication($user, $token);
        } catch (BadCredentialsException $e) {
            throw new BadCredentialsException('ユーザ名またはパスワードが正しくありません。');
        }
 
        $authenticatedToken = new WsseUserToken(
            $user,
            $token->getCredentials(),
            $user->getRoles()
        );
 
        return $authenticatedToken;
    }
    
    /**
     * @param unknown $user
     * @param WsseUserToken $token
     * @throws BadCredentialsException
     */
    protected function checkAuthentication($user, WsseUserToken $token)
    {
        $currentUser = $token->getUser();
        if ($currentUser instanceof UserInterface) {
            if ($currentUser->getPassword() !== $user->getPassword()) {
                throw new BadCredentialsException('The credentials were changed from another session.');
            }
        } else {
            if ('' === ($presentedPassword = $token->getCredentials())) {
                throw new BadCredentialsException('The presented password cannot be empty.');
            }

            if (!$this->encoderFactory->getEncoder($user)->isPasswordValid(
                $user->getPassword(),
                $presentedPassword,
                $user->getSalt()
            )) {
                throw new BadCredentialsException('The presented password is invalid.');
            }
        }
    }
}
