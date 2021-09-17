<?php

class EventSeries
{
    private const SLUG = 'event_series';

    private const TIME_SPAN = 'zeitraum';
    private const FREQUENCY = 'frequenz';
    private const BEGIN_TIME = 'startzeit';
    private const END_DATE = 'endzeit';

    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
