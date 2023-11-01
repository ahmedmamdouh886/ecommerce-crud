<?php

namespace App\Services\Auth;

use App\Repository\Interface\RepoInterface;

class UserAuth
{
    /**
     * User repository instance.
     * 
     * @var \App\Repository\Interface\RepoInterface
     */
    protected RepoInterface $userRepoInstance;

    /**
     * Class initialization.
     * 
     * @param \App\Repository\Interface\RepoInterface $userRepoInstance
     * 
     * @return void
     */
    public function __construct(RepoInterface $userRepoInstance) {
        $this->userRepoInstance = $userRepoInstance;
    }
    /**
     * Apply discount.
     * 
     * @param string $username
     * 
     * @return string
     */
    public function createTokenFor(string $username): string {
        return $this->userRepoInstance->findByUsername($username)->createToken('Personal Access Token')->plainTextToken;
    }

    /**
     * Register a user and fetch token.
     * 
     * @param [string] name
     * @param [string] username
     * @param [string] password
     * 
     * @return string
     */
    public function register(array $payload): string {
        $this->userRepoInstance->create($payload);

        return $this->createTokenFor($payload['username']); // Programming by contract principle: it means I'm sure that the payload will contain username.
    }
}
