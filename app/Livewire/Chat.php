<?php

namespace App\Livewire;

use App\Models\message;
use Livewire\Component;

class Chat extends Component
{
    public $messageText;

    public function render()
    {
        $messages = message::with('user')->latest()->take(10)->get()->sortBy('id');

        return view('livewire.chat', compact('messages'));
    }

    public function sendMessage()
    {
        message::create([
            'user_id' => auth()->user()->id,
            'message_text' => $this->messageText,
        ]);

        $this->reset('messageText');
    }
}
