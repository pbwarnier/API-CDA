<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase
{
    /**
     * Tests unitaire de la connexion
     *
     * @return void
     */
    public function testLogin()
    {
        $this->post('/login', [
            'email'=> 'a',
            'password'=> 'a'
        ]);
        $this->assertResponseStatus(200);
        $this->seeJsonContains([
            'email'=> 'a'
        ]);
    }
}
