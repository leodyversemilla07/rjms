<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Core\CSRF;
use App\Core\Session;

class CSRFTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        Session::start();
    }

    public function testCanGenerateToken()
    {
        $token = CSRF::generateToken();
        
        $this->assertNotEmpty($token);
        $this->assertEquals(64, strlen($token)); // 32 bytes = 64 hex chars
    }

    public function testCanValidateToken()
    {
        $token = CSRF::generateToken();
        
        $this->assertTrue(CSRF::validateToken($token));
        $this->assertFalse(CSRF::validateToken('invalid_token'));
    }

    public function testCanGenerateField()
    {
        $field = CSRF::field();
        
        $this->assertStringContainsString('<input', $field);
        $this->assertStringContainsString('type="hidden"', $field);
        $this->assertStringContainsString('name="csrf_token"', $field);
    }
}
