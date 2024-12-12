<?php

declare(strict_types=1);

namespace App\Tests\Func\Application;

use App\Tests\Func\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestWith;

final class SmokeTest extends FunctionalTestCase
{
    #[TestWith(['/', 302, '/login'])]
    #[TestWith(['/login', 200])]
    #[Group('smoke')]
    public function testUrl(string $url, int $expectedStatusCode, ?string $expectedRedirectionUrl = null): void
    {
        $this->get($url);

        self::assertResponseStatusCodeSame($expectedStatusCode);
        if ($expectedRedirectionUrl) {
            self::assertResponseRedirects($expectedRedirectionUrl);
        }
    }
}
