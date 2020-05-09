<?php

namespace Tests\Unit;

use App\Inspections\Spam;
use Exception;
use Tests\TestCase;

class SpamTest extends TestCase
{

    /** @test */
    public function it_can_detect_spam_keywords() {
        $spam = new Spam();
        $this->assertFalse($spam->detect("test"));
        $this->expectException(Exception::class);
        $spam->detect('yahoo customer support');
    }

    /** @test */
    public function it_can_detect_key_held_down() {
        $spam = new Spam();
        $this->expectException(Exception::class);
        $spam->detect('aaaaaaaa test');
    }

}
