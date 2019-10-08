<?php

namespace App\Handler\Router;

use Pecee\SimpleRouter\Event\EventArgument;
use Pecee\SimpleRouter\Router;

class DatabaseEventHandler implements IEventHandler
{

    /**
     * Debug callback
     * @var \Closure
     */
    protected $callback;

    public function __construct()
    {
        $this->callback = function (EventArgument $argument) {
            // todo: store log in database
        };
    }

    /**
     * Get events.
     *
     * @param string|null $name Filter events by name.
     * @return array
     */
    public function getEvents(?string $name): array
    {
        return [
            $name => [
                $this->callback,
            ],
        ];
    }

    /**
     * Fires any events registered with given event-name
     *
     * @param Router $router Router instance
     * @param string $name Event name
     * @param array ...$eventArgs Event arguments
     */
    public function fireEvents(Router $router, string $name, ...$eventArgs): void
    {
        $callback = $this->callback;
        $callback(new EventArgument($router, $eventArgs));
    }

    /**
     * Set debug callback
     *
     * @param \Closure $event
     */
    public function setCallback(\Closure $event): void
    {
        $this->callback = $event;
    }

}