<?php

// TODO Implement Event class.

class Event
{
    private const SLUG = 'veranstaltung';

    private const IMAGE = 'bild';
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

    public function get_date_string(): string
    {
        $multi_day = boolval(get_post_meta($this->id, Event::MULTI_DAY, true));
        $begin_day = date_create(get_post_meta($this->id, Event::BEGIN_DATE, true));
        $end_day = date_create(get_post_meta($this->id, Event::END_DATE, true));
        $whole_day = boolval(get_post_meta($this->id, Event::WHOLE_DAY, true));
        $start_time = date_create(get_post_meta($this->id, Event::BEGIN_TIME, true));
        $end_time = date_create(get_post_meta($this->id, Event::END_TIME, true));

        $date_string = '';

        if ($multi_day) {
            if (date_format($begin_day, 'Y') == date_format($end_day, 'Y')) {
                if (date_format($begin_day, 'm') == date_format($end_day, 'm')) {
                    $date_string .= date_to_str($begin_day, 'd.') . ' – ' . date_to_str($end_day, 'd. F Y');
                } else {
                    $date_string .= date_to_str($begin_day, 'd. F') . ' – ' . date_to_str($end_day, 'd. F Y');
                }
            } else {
                $date_string .= date_to_str($begin_day, 'd. F Y') . ' – ' . date_to_str($end_day, 'd. F Y');
            }
        } else {
            $date_string .= date_to_str($begin_day, 'd. F Y',);
        }

        if (!$whole_day) {
            $date_string .= ' / ' . date_to_str($start_time, 'G:i') . ' – ' . date_to_str($end_time, 'G:i') . ' Uhr';
        }

        return $date_string;
    }

    public function get_image_url(string $size = 'large'): string
    {
        $image = get_post_meta($this->id, Event::IMAGE, true);
        return wp_get_attachment_image_src($image, $size)[0];
    }

    public function get_ticket_url(): string
    {
        return strval(get_post_meta($id, 'tickets', true));
    }

    public function get_facebook_url(): string
    {
        return strval(get_post_meta($id, 'facebook', true));
    }

    public function get_instagram_url(): string
    {
        return strval(get_post_meta($id, 'instagram', true));
    }

    public function get_sound_cloud_url(): string
    {
        return strval(get_post_meta($id, 'soundcloud', true));
    }
}
