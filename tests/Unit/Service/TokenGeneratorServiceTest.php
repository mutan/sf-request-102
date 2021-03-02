<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Service\TokenGeneratorService;
use Exception;
use PHPUnit\Framework\TestCase;

class TokenGeneratorServiceTest extends TestCase
{
    private TokenGeneratorService $tokenGenerator;

    protected function setUp(): void
    {
        $this->tokenGenerator = new TokenGeneratorService();
    }

    /**
     * @throws Exception
     */
    public function testGetToken(): void
    {
        $token = $this->tokenGenerator->getToken(16);

        self::assertIsString($token);
        self::assertSame(16, \strlen($token));
        self::assertRegExp('/^[a-zA-Z0-9]*$/', $token);
    }

    /**
     * @throws Exception
     */
    public function testGetHexadecimalToken(): void
    {
        $token = $this->tokenGenerator->getHexadecimalToken(16);

        self::assertIsString($token);
        self::assertSame(16, \strlen($token));
        self::assertRegExp('/^[a-f0-9]*$/', $token);
    }

    /**
     * @throws Exception
     */
    public function testGetPassword(): void
    {
        $token = $this->tokenGenerator->getPassword(10);

        self::assertIsString($token);
        self::assertEquals(10, \strlen($token));
        self::assertRegExp('/^[a-zA-Z0-9]*$/', $token);
    }

    /**
     * @throws Exception
     */
    public function testGetCustomPassword(): void
    {
        $token = $this->tokenGenerator->getCustomPassword(12, 3, 3, 3, 3);

        self::assertIsString($token);
        self::assertEquals(12, \strlen($token));
        self::assertEquals(3, preg_match_all('/[a-z]/', $token));
        self::assertEquals(3, preg_match_all('/[A-Z]/', $token));
        self::assertEquals(3, preg_match_all('/[0-9]/', $token));
        self::assertEquals(3, preg_match_all("/[+\-_=!#$%&?@~]/", $token));
    }

    /**
     * @throws Exception
     */
    public function testGetCustomToken(): void
    {
        $token = $this->tokenGenerator->getCustomToken(64, 15);

        self::assertIsString($token);
        self::assertSame(64, \strlen($token));
        self::assertRegExp("/^[a-zA-Z0-9\+\-_=!#$%&?@~]*$/", $token);
    }
}
