<?php

declare(strict_types=1);

namespace App\Tests\Behat\Client;

interface ApiSecurityClientInterface
{
    public function prepareLoginRequest(): void;

    public function setEmail(string $email): void;

    public function setPassword(string $password): void;

    public function call(): void;

    public function isLoggedIn(): bool;

    public function getErrorMessage(): string;

    public function logOut(): void;
}
