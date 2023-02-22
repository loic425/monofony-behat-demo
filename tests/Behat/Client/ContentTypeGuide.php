<?php

declare(strict_types=1);

namespace App\Tests\Behat\Client;

use Symfony\Component\HttpFoundation\Request as HttpRequest;

class ContentTypeGuide implements ContentTypeGuideInterface
{
    private const JSON_CONTENT_TYPE = 'application/json';

    private const PATCH_CONTENT_TYPE = 'application/merge-patch+json';

    private const LINKED_DATA_JSON_CONTENT_TYPE = 'application/ld+json';

    public function guide(string $method): string
    {
        if ($method === HttpRequest::METHOD_PATCH) {
            return self::PATCH_CONTENT_TYPE;
        }

        if ($method === HttpRequest::METHOD_PUT) {
            return self::LINKED_DATA_JSON_CONTENT_TYPE;
        }

        return self::JSON_CONTENT_TYPE;
    }
}
