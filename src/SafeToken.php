<?php declare(strict_types=1);

namespace App;

class SafeToken
{

    private $getToken;

    public function __construct(string $token)
    {
        $this->getToken = function () use ($token) {
            return $token;
        };
    }

    public function __toString(): string
    {
        return $this->getToken->__invoke();
    }

    public function __debugInfo(): array
    {
        return [];
    }
}