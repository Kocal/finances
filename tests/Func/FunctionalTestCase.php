<?php
declare(strict_types=1);

namespace App\Tests\Func;

use App\Application\CQRS\Command;
use App\Application\CQRS\CommandBus;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class FunctionalTestCase extends WebTestCase
{
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
        return parent::createClient($options, $server + ['HTTPS' => true]);
    }

    /**
     * @param string $url
     * @param array<string, mixed> $formData
     * @param array<string,UploadedFile> $files
     * @param $headers<string, string|array<string>> $headers
     */
    protected function postFormData(
        string $url,
        array $formData = [],
        array $files = [],
        $headers = ['Content-Type' => 'multipart/form-data'],
    ): void {
        self::$client->request(
            'POST',
            $url,
            $formData,
            $files,
            $headers,
        );
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
}
