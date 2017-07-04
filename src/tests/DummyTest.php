<?php

namespace BackupTool\Test;

use PHPUnit\Framework\TestCase;

class DummyTest extends TestCase
{
    public function testRun():void {
        $this->assertStringEndsWith("World", "Hello World");
    }
}