<?php

namespace App\Listeners;

use App\Events\NewsCreated;
use App\Events\NewsUpdated;
use App\Events\NewsDeleted;
use Illuminate\Support\Facades\Log;

class NewsEventLogger
{
    public function logNewsEvent($event)
    {
        // Log news event details
        Log::info("News event [{$event->news->title}] - {$event->event}");
    }

    public function handleNewsCreated(NewsCreated $event)
    {
        $event->event = 'created';
        $this->logNewsEvent($event);
    }

    public function handleNewsUpdated(NewsUpdated $event)
    {
        $event->event = 'updated';
        $this->logNewsEvent($event);
    }

    public function handleNewsDeleted(NewsDeleted $event)
    {
        $event->event = 'deleted';
        $this->logNewsEvent($event);
    }
}
