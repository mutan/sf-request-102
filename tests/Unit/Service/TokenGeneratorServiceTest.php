<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Service\TokenGeneratorService;
use PHPUnit\Framework\TestCase;

class TokenGeneratorServiceTest extends TestCase
{
    /** @var TokenGeneratorService */
    private $tokenGenerator;

    protected function setUp(): void
    {
        $this->tokenGenerator = new TokenGeneratorService();
    }

    public function testGetToken(): void
    {
        $token = $this->tokenGenerator->getToken(16);
        $this->assertInternalType('string', $token);
        $this->assertTrue(16 == \strlen($token));
        $this->assertRegExp('/^[a-zA-Z0-9]*$/', $token);
    }

    public function testGetHexadecimalToken(): void
    {
        $token = $this->tokenGenerator->getHexadecimalToken(16);
        $this->assertInternalType('string', $token);
        $this->assertTrue(16 == \strlen($token));
        $this->assertRegExp('/^[a-f0-9]*$/', $token);
    }

    public function testGetPassword(): void
    {
        $token = $this->tokenGenerator->getPassword(10);
        $this->assertInternalType('string', $token);
        $this->assertTrue(10 == \strlen($token));
        $this->assertRegExp('/^[a-zA-Z0-9]*$/', $token);
    }

    public function testGetCustomPassword(): void
    {
        $token = $this->tokenGenerator->getCustomPassword(12, 3, 3, 3, 3);
        $this->assertInternalType('string', $token);
        $this->assertTrue(12 == \strlen($token));
        $this->assertTrue(3 == preg_match_all('/[a-z]/', $token));
        $this->assertTrue(3 == preg_match_all('/[A-Z]/', $token));
        $this->assertTrue(3 == preg_match_all('/[0-9]/', $token));
        $this->assertTrue(3 == preg_match_all("/[\+\-_=!#$%&?@~]/", $token));
    }

    public function testGetCustomToken(): void
    {
        $token = $this->tokenGenerator->getCustomToken(64, 15);
        $this->assertInternalType('string', $token);
        $this->assertTrue(64 == \strlen($token));
        $this->assertRegExp("/^[a-zA-Z0-9\+\-_=!#$%&?@~]*$/", $token);
    }
}
