<?php

/*
 * This file is part of monofony-behat-demo.
 *
 * (c) Mobizel
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

final class GenerateSlugAction
{
    #[Route(
        path: 'admin/_partial/book/generate-slug/{name}',
        name: 'app_backend_book_generate_slug',
        requirements: [
            'name' => '.+(?<!/)',
        ],
        defaults: ['name' => ''],
        format: 'json',
    )]
    public function __invoke(string $name): Response
    {
        $slugger = new AsciiSlugger();
        $slug = strtolower($slugger->slug($name)->toString());

        return new JsonResponse([
            'slug' => $slug,
        ]);
    }
}
