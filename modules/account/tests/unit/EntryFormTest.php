<?php

use app\modules\account\forms\EntryForm;

class EntryFormTest extends \Codeception\Test\Unit
{
    private $form;
    
    protected function _before()
    {
        $this->form = new EntryForm();
    }

    // tests
    public function testUsernameIsRequired()
    {
        $this->assertFalse($this->form->validate());
        $this->assertArrayHasKey('username', $this->form->errors);
    }

    public function testUsernameTooShort()
    {
        $this->form->username = 'aa';
        $this->assertFalse($this->form->validate());
        $this->assertArrayHasKey('username', $this->form->errors);
    }

    public function testUsernameTooBig()
    {
        $this->form->username = 
            'aaaaaaaaaa' .
            'aaaaaaaaaa' .
            'aaaaaaaaaa' .
            'aaaaaaaaaa';
        $this->assertFalse($this->form->validate());
        $this->assertArrayHasKey('username', $this->form->errors);
    }

    public function testRememberMe()
    {
        $this->form->rememberMe = 2;
        $this->assertFalse($this->form->validate());
        $this->assertArrayHasKey('rememberMe', $this->form->errors);
    }

    public function testValidForm()
    {
        $this->form->username = 'valid_name';
        $this->assertTrue($this->form->validate());
    }
}