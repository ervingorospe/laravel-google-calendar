<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Google\Service\Calendar\Event;

class EventsTable extends Component
{
    public array $events = [];
    /**
     * Create a new component instance.
     */
    public function __construct(array $events)
    {
        $this->events = array_map(function (Event $event) {
            return (object) [
                'id' => $event->getId(),
                'title' => $event->getSummary() ?? '—',
                'start' => $this->formatDate($event->getStart()->getDateTime() ?? $event->getStart()->getDate()),
                'end' => $this->formatDate($event->getEnd()->getDateTime() ?? $event->getEnd()->getDate()),
                'description' => $event->getDescription(),
            ];
        }, $events);
    }

    private function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)->format('M d, Y h:i A');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.events-table');
    }
}
