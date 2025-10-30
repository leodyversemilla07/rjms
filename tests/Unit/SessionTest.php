<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Core\Session;

class SessionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Clear any existing session
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    public function testSessionCanStartAndSetValues()
    {
        Session::start();
        Session::set('test_key', 'test_value');
        
        $this->assertEquals('test_value', Session::get('test_key'));
        $this->assertTrue(Session::has('test_key'));
    }

    public function testSessionCanRemoveValues()
    {
        Session::start();
        Session::set('test_key', 'test_value');
        Session::remove('test_key');
        
        $this->assertFalse(Session::has('test_key'));
        $this->assertNull(Session::get('test_key'));
    }

    public function testSessionFlashMessages()
    {
        Session::start();
        Session::flash('message', 'Hello World');
        
        $this->assertTrue(Session::hasFlash('message'));
        $this->assertEquals('Hello World', Session::getFlash('message'));
        $this->assertFalse(Session::hasFlash('message')); // Should be removed after first get
    }
}
