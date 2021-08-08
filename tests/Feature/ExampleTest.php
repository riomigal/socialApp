<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {

        $user = User::create([
            'name' => 'Saverio',
            'email' => 'saverio23@migale.eu',
            'password' => Hash::make('asdfasdf'),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}