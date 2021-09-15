<?php

class Event
{
    private const SLUG = 'veranstaltung';

    private const EVENT_SERIES = 'event_series';
    private const MULTI_DAY = 'mehrtagig';
    private const BEGIN_DATE = 'startdatum';
    private const END_DATE = 'enddatum';
    private const WHOLE_DAY = 'ganztagig';
    private const OPEN_END = 'offenes_ende';
    private const BEGIN_TIME = 'startzeit';
    private const END_TIME = 'endzeit';
    private const CATEGORY = 'kategorie';
    private const TICKET_URL = 'tickets';
    private const FACEBOOK_URL = 'facebook';
    private const INSTAGRAM_URL = 'instagram';
    private const SOUND_CLOUD_URL = 'soundcloud';

    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
