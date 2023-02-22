<?php

declare(strict_types=1);

namespace App\Tests\Behat\Client;

interface ContentTypeGuideInterface
{
    public function guide(string $method): string;
}
