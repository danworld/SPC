<?php

class IndexControllerTest extends ControllerTestCase
{
    public function testCallingRootTriggersIndex()
    {
        $this->dispatch('/');
        $this->assertController('index');
        $this->assertAction('index');
    }

    public function testCallingBogusTriggersError()
    {
        $this->dispatch('/bogus');
        $this->assertController('error');
        $this->assertAction('error');
        $this->assertResponseCode(404);
    }

    public function testCallingCheckTriggers()
    {
        $this->dispatch('/check');
        $this->assertController('check');
        $this->assertAction('index');
        $this->assertResponseCode(200);
        $this->assertQueryContentContains('title', 'SPC - Standard Password Checker');
    }
}