<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Toast extends Component
{
    protected $listeners = [
        'show-toast' => 'setToast'
    ];

    public $alertTypeClasses = [
        'default' => 'alert-primary',
        'success' => 'alert-success',
        'warning' => 'alert-warning',
        'danger' => 'alert-danger',
    ];

    public $message = '';
    public $alertType = 'default';

    public function setToast ($message, $alertType)
    {
        $this->message = $message;
        $this->alertType = $alertType;

        $this->dispatchBrowserEvent('toast-message-show');
    }

    public function render()
    {
        return view('livewire.toast');
    }
}
