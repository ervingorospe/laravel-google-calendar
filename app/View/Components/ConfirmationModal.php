<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmationModal extends Component
{
    public $eventId, $show, $title, $message, $buttonText;
    /**
     * Create a new component instance.
     */
    public function __construct($eventId = '', $show = false, $title = 'Alert', $message = '')
    {
        //
        $this->eventId = $eventId;
        $this->show = $show;
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirmation-modal');
    }
}
