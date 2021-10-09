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
    private const WARNINGS = 'warnhinweise';
    private const WELTSPIELE = 'weltspiele';
    private const SAAL_III = 'saal_iii';
    private const TICKET_URL = 'tickets';
    private const FACEBOOK_URL = 'facebook';
    private const INSTAGRAM_URL = 'instagram';
    private const SOUND_CLOUD_URL = 'soundcloud';

    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function get_title(): string
    {
        return strval(get_the_title($this->id));
    }

    public function get_content(): string
    {
        return strval(apply_filters('the_content', get_post_field('post_content', $this->id)));
    }

    public function get_url(): string
    {
        return strval(get_the_permalink($this->id));
    }

    public function get_category(): EventCategory
    {
        if (metadata_exists('post', $this->id, Event::CATEGORY)) {
            $categoryId = get_post_meta($this->id, Event::CATEGORY, true);
            return new EventCategory(intval($categoryId));
        }
        return null;
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
            if (date_format($begin_day, 'm') == date_format($end_day, 'm')) {
                $date_string .= date_to_str($begin_day, 'D j') . ' – ' . date_to_str($end_day, 'D j');
                $date_string .= '<br>' . date_to_str($end_day, 'F');
            } else {
                $date_string .= date_to_str($begin_day, 'D j F') . ' – ' . date_to_str($end_day, 'D j F');
            }
        } else {
            $date_string .= date_to_str($begin_day, 'D j');
            $date_string .= '<br>' . date_to_str($end_day, 'F');
        }

        if (!$whole_day) {
            $date_string .= '<br>' . date_to_str($start_time, 'G:i') . '–' . date_to_str($end_time, 'G:i');
        }

        return $date_string;
    }

    public function get_begin_date(): DateTime
    {
        return date_create(get_post_meta($this->id, Event::BEGIN_DATE, true));
    }

    public function get_image_url(string $size = 'large'): string
    {
        if (metadata_exists('post', $this->id, Event::IMAGE)) {
            $image = get_post_meta($this->id, Event::IMAGE, true);
            return strval(wp_get_attachment_image_src($image, $size)[0]);
        } else {
            return null;
        }
    }

    public function get_warning_text(): string
    {
        return strval(get_post_meta($this->id, Event::WARNINGS, true));
    }

    public function get_weltspiele_text(): string
    {
        return strval(get_post_meta($this->id, Event::WELTSPIELE, true));
    }

    public function get_saal_iii_text(): string
    {
        return strval(get_post_meta($this->id, Event::SAAL_III, true));
    }

    public function get_ticket_url(): string
    {
        return strval(get_post_meta($this->id, Event::TICKET_URL, true));
    }

    public function get_facebook_url(): string
    {
        return strval(get_post_meta($this->id, Event::FACEBOOK_URL, true));
    }

    public function get_instagram_url(): string
    {
        return strval(get_post_meta($this->id, Event::INSTAGRAM_URL, true));
    }

    public function get_sound_cloud_url(): string
    {
        return strval(get_post_meta($this->id, Event::SOUND_CLOUD_URL, true));
    }
}
