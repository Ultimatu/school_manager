<?php

namespace Tests\Unit;

use App\Http\Controllers\ExamenController;
use PHPUnit\Framework\TestCase;

class ExamenControllerTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_example(): void
    {
        $controller = new ExamenController();
        $this->assertTrue(true);

        $this->assertEquals('index', $controller->index());

        $this->assertEquals('create', $controller->create());
    }
}
