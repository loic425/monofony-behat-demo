<?php

declare(strict_types=1);

namespace App\Tests\Behat\Client;

interface RequestFactoryInterface
{
    public function index(
        ?string $section,
        string $resource,
        string $authorizationHeader,
        ?string $token = null,
    ): RequestInterface;

    public function subResourceIndex(
        string $section,
        string $resource,
        string $id,
        string $subResource,
    ): RequestInterface;

    public function show(
        ?string $section,
        string $resource,
        string $id,
        string $authorizationHeader,
        ?string $token = null,
    ): RequestInterface;

    public function create(
        ?string $section,
        string $resource,
        string $authorizationHeader,
        ?string $token = null,
    ): RequestInterface;

    public function update(
        ?string $section,
        string $resource,
        string $id,
        string $authorizationHeader,
        ?string $token = null,
    ): RequestInterface;

    public function delete(
        ?string $section,
        string $resource,
        string $id,
        string $authorizationHeader,
        ?string $token = null,
    ): RequestInterface;

    public function upload(
        string $section,
        string $resource,
        array $files,
        string $authorizationHeader,
        ?string $token = null,
    ): RequestInterface;

    public function transition(
        string $section,
        string $resource,
        string $id,
        string $transition,
    ): RequestInterface;

    public function customItemAction(
        string $section,
        string $resource,
        string $id,
        string $type,
        string $action,
    ): RequestInterface;

    public function custom(
        string $url,
        string $method,
        array $additionalHeaders = [],
        ?string $token = null,
    ): RequestInterface;
}
