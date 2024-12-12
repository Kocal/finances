<?php

declare(strict_types=1);

namespace App\Tests\Func\Application;

use App\Tests\Func\FunctionalTestCase;

class LoginControllerTest extends FunctionalTestCase
{
    public function testFormLoginWithInvalidEmail(): void
    {
        $this->get('/login');
        self::assertResponseIsSuccessful();

        $this->submitForm('Sign in', [
            '_username' => 'doesNotExist@example.com',
            '_password' => 'password',
        ]);

        self::assertResponseRedirects('/login');
        $this->followRedirect();

        // Ensure we do not reveal if the user exists or not.
        self::assertSelectorTextContains('.alert-danger', 'Invalid credentials.');
    }

    public function testFormLoginWithInvalidPassword(): void
    {
        $this->get('/login');
        self::assertResponseIsSuccessful();

        $this->submitForm('Sign in', [
            '_username' => 'rose@example.net',
            '_password' => 'bad-password',
        ]);

        self::assertResponseRedirects('/login');
        $this->followRedirect();

        // Ensure we do not reveal if the user exists or not.
        self::assertSelectorTextContains('.alert-danger', 'Invalid credentials.');
    }

    public function testFormLoginWithValidCredentials(): void
    {
        $this->get('/login');
        self::assertResponseIsSuccessful();

        // Success - Login with valid credentials is allowed.
        $this->submitForm('Sign in', [
            '_username' => 'rose@example.net',
            '_password' => 'password',
        ]);

        self::assertResponseRedirects('/');
        $this->followRedirect();

        self::assertSelectorNotExists('.alert-danger');
        self::assertResponseIsSuccessful();
    }
}
