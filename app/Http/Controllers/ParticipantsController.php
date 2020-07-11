<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;

class ParticipantsController extends Controller
{
    public function store()
    {
        Participant::create($this->validateRequest());
    }

    public function update(Participant $participant)
    {
        $participant->update($this->validateRequest());
    }

    protected function validateRequest()
    {
        return request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);
    }
}
