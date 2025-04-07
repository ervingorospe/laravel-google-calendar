<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventForm extends Component
{
    public $route;
    public $method;
    public $event;
    /**
     * Create a new component instance.
     */
    public function __construct($route, $method = 'POST', $event = null)
    {
        //
        $this->route = $route;
        $this->method = strtoupper($method);

        if ($event) {
            $this->event = (object) [
                'id' => $event->getId(),
                'title' => $event->getSummary() ?? '—',
                'start' => $this->formatDate($event->getStart()->getDateTime() ?? $event->getStart()->getDate()),
                'end' => $this->formatDate($event->getEnd()->getDateTime() ?? $event->getEnd()->getDate()),
                'description' => $event->getDescription(),
                'location' => $event->getLocation(),
            ];
        } else {
            $this->event = null;
        }
    }

    private function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)->format('Y-m-d\TH:i');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.event-form');
    }
}
