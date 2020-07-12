<?php

namespace Tests\Feature;

use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParticipantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testAddParticipantInDB()
    {
       $response = $this->post('participants', [
           'first_name' => 'David',
           'last_name' => 'Linch',
           'email' => 'davidlinch@gmail.com'
       ]);

       $participant = Participant::first();

       $this->assertCount(1, Participant::all());
       $response->assertRedirect('participants/' . $participant->id);
    }

    /** @test */
    public function testFirstNameIsRequired()
    {
        $response = $this->post('participants', [
            'first_name' => '',
            'last_name' => 'Laurentius',
            'email' => 'laurentius@gmail.com'
        ]);

        $response->assertSessionHasErrors('first_name');
    }

    /** @test */
    public function testLastNameIsRequired()
    {
        $response = $this->post('participants', [
            'first_name' => 'Laura',
            'last_name' => '',
            'email' => 'laura@gmail.com'
        ]);

        $response->assertSessionHasErrors('last_name');
    }

    /** @test */
    public function testEmailIsRequired()
    {
        $response = $this->post('participants', [
            'first_name' => 'Anna',
            'last_name' => 'Maria',
            'email' => ''
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function testUpdateParticipant()
    {
        $this->withoutExceptionHandling();

        $this->post('participants', [
            'first_name' => 'David',
            'last_name' => 'Linch',
            'email' => 'davidlinch@gmail.com'
        ]);

        $participant = Participant::first();

        $response = $this->patch('/participants/' . $participant->id, [
            'first_name' => 'Max',
            'last_name' => 'Ginger',
            'email' => 'maxginger@gmail.com'
        ]);

        $this->assertEquals('Max', Participant::first()->first_name);
        $this->assertEquals('Ginger', Participant::first()->last_name);
        $this->assertEquals('maxginger@gmail.com', Participant::first()->email);
        $response->assertRedirect('/participants/' . $participant->id);
    }

    /** @test */
    public function testDeleteParticipant()
    {
        $this->withoutExceptionHandling();
        $this->post('participants', [
            'first_name' => 'David',
            'last_name' => 'Linch',
            'email' => 'davidlinch@gmail.com'
        ]);

        $participant = Participant::first();

        $response = $this->delete('/participants/' . $participant->id);

        $this->assertCount(0, Participant::all());
        $response->assertRedirect('/participants');
    }
}
