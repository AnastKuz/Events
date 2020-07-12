<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;

class ParticipantsController extends Controller
{
    public function store()
    {
        $participant = Participant::create($this->validateRequest());

        return redirect('participants/' . $participant->id);
    }

    public function update(Participant $participant)
    {
        $participant->update($this->validateRequest());

        return redirect('participants/' . $participant->id);
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();

        return redirect('participants');
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
