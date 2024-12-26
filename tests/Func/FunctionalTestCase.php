<?php

declare(strict_types=1);

namespace App\Tests\Func;

use App\Application\CQRS\Command;
use App\Application\CQRS\CommandBus;
use App\Application\CQRS\Query;
use App\Application\CQRS\QueryBus;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Clock\Test\ClockSensitiveTrait;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class FunctionalTestCase extends WebTestCase
{
    use ClockSensitiveTrait;

    private static KernelBrowser|null $client;

    protected function setUp(): void
    {
        parent::setUp();
        self::ensureKernelShutdown();
        static::$client = static::createClient();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        static::$client = null;
        unset($this->legalMonologLogger);
    }

    protected static function createClient(array $options = [], array $server = []): KernelBrowser
    {
        return parent::createClient($options, $server + [
            'HTTPS' => true,
        ]);
    }

    protected function get(
        string $uri,
        array $parameters = [],
        array $files = [],
        array $server = [],
        ?string $content = null,
        bool $changeHistory = true
    ): Crawler {
        return self::$client->request(
            method: 'GET',
            uri: $uri,
            parameters: $parameters,
            files: $files,
            server: $server,
            content: $content,
            changeHistory: $changeHistory
        );
    }

    /**
     * @param array<string, mixed> $formData
     * @param array<string,UploadedFile> $files
     * @param $headers<string, string|array<string>> $headers
     */
    protected function postFormData(
        string $url,
        array $formData = [],
        array $files = [],
        $headers = [
            'Content-Type' => 'multipart/form-data',
        ],
    ): void {
        self::$client->request(
            'POST',
            $url,
            $formData,
            $files,
            $headers,
        );
    }

    protected function submitForm(string $button, array $fieldValues = [], string $method = 'POST', array $serverParameters = []): Crawler
    {
        return self::$client->submitForm($button, $fieldValues, $method, $serverParameters);
    }

    protected function followRedirect(): Crawler
    {
        return self::$client->followRedirect();
    }

    /**
     * @template T
     * @param class-string<T> $class
     * @return object<T>
     */
    protected function getService(string $class): object
    {
        $service = self::getContainer()->get($class);

        self::assertInstanceOf($class, $service);

        return $service;
    }

    protected function handleCommand(Command $command): mixed
    {
        $commandBus = self::getService(CommandBus::class);

        return $commandBus->handle($command);
    }

    protected function handleQuery(Query $query): mixed
    {
        $queryBus = self::getService(QueryBus::class);

        return $queryBus->handle($query);
    }
}
