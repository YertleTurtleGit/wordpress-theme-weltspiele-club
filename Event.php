<?php

class Event
{
    private const SLUG = 'show';

    private const FORMAT = 'format';
    private const ARTISTS = 'artists';
    private const GENRES = 'genres';
    private const IMAGE = 'image';
    private const MULTI_DAY = 'multi_day';
    private const STREAM_URL = 'stream-link';
    private const EMBED_STREAM_LINK = 'embed-stream-link';

    private const DATE_SEP = ' – ';
    public const TIME_SEP = '–';
    private const DATE_TIME_SEP = ' / ';

    private int $id;

    public static function get_the_current(): Event
    {
        $loop = new WP_Query(
            array(
                'post_type' => 'show',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'meta_key' => 'begin_date',
                'orderby' => 'meta_value_num',
                'meta_type' => 'DATE',
                'order' => 'ASC'
            )
        );

        while ($loop->have_posts()) : $loop->the_post();
            $show_id = get_the_ID();
            $show = new Event($show_id);

            if (!$show->is_in_past()) {
                wp_reset_query();
                return $show;
            }

        endwhile;
        wp_reset_query();

        return null;
    }

    public static function get_next(): Event
    {
        $loop = new WP_Query(
            array(
                'post_type' => Event::SLUG,
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'meta_key' => 'begin_date',
                'orderby' => 'meta_value_num',
                'meta_type' => 'DATE',
                'order' => 'ASC'
            )
        );

        $hopped = false;

        while ($loop->have_posts()) : $loop->the_post();
            $event_id = get_the_ID();
            $event = new Event($event_id);

            if (!$event->is_in_past()) {
                if ($hopped) {
                    wp_reset_query();
                    return $event;
                } else {
                    $hopped = true;
                }
            }

        endwhile;
        wp_reset_query();

        return null;
    }

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function get_title(): string
    {
        $title = $this->get_format()->get_name();
        $title .= " w/ ";
        $artists = $this->get_artists();
        $artists_names = [];
        foreach ($artists as $artist) {
            array_push($artists_names, $artist->get_name());
        }
        $title .= implode(", ", $artists_names);
        return $title;
    }

    public function get_excerpt(): string
    {
        return get_the_excerpt($this->id);
    }

    public function get_id(): int
    {
        return $this->id;
    }

    public function get_url(): string
    {
        return get_permalink($this->id);
    }

    public function is_the_current(): bool
    {
        return Event::get_the_current()->get_id() == $this->id;
    }

    public function is_in_past(): bool
    {
        $end_time = $this->get_end_time();

        if ($this->is_multi_day()) {
            $end_date = $this->get_end_date();

            if ($end_date->format('Ymd') < current_time('Ymd')) {
                return true;
            } elseif (
                $end_date->format('Ymd') == current_time('Ymd')
                && !is_null($end_time)
                && $end_time->format('Gi') < current_time('Gi')
            ) {
                return true;
            }
            return false;
        }

        $begin_date = $this->get_begin_date();

        if ($begin_date->format('Ymd') < current_time('Ymd')) {
            return true;
        } elseif ($begin_date->format('Ymd') == current_time('Ymd') && !is_null($end_time) && $end_time->format('Gi') < current_time('Gi')) {
            return true;
        }
        return false;
    }

    public function get_format(): EventFormat
    {
        $eventFormatId = intval(get_post_meta($this->id, Event::FORMAT, true));
        return new EventFormat($eventFormatId);
    }

    /**
     * @return Artist[] 
     */
    public function get_artists(): array
    {
        $artists = [];
        $artists_meta = get_post_meta($this->id, Event::ARTISTS)[0];

        foreach ($artists_meta as $artist_meta) {
            array_push($artists, new Artist(intval($artist_meta)));
        }
        return $artists;
    }

    public function get_artists_string(bool $one_line = false): string
    {
        $artists_string = '<span>';
        $artists = $this->get_artists();

        foreach ($artists as $artist) {
            $artist_name = $artist->get_name();
            $artist_link = $artist->get_url();

            $artists_string .= '<a style="display: inline;" href="' . $artist_link . '" >with ' . $artist_name . '</a>';
            if (!$one_line) {
                $artists_string .= '</ br></ br>';
            }
        }

        $artists_string .= "</span>";
        return $artists_string;
    }

    /** @return Genre[] */
    public function get_genres(): array
    {
        $genres = [];
        $genre_ids = get_post_meta($this->id, Event::GENRES)[0];

        if ($genre_ids) {
            foreach ($genre_ids as $genre_id) {
                array_push($genres, new Genre(intval($genre_id)));
            }
        }
        return $genres;
    }

    public function get_genres_string(bool $one_line = false): string
    {
        $genres_string = '<span class="genre-tags">';
        $genres = $this->get_genres();

        foreach ($genres as $genre) {
            $genre_name = $genre->get_name();
            $genre_link = $genre->get_url();

            $genres_string .= '<a class="tag genre-tag" href="' . $genre_link . '" >' . $genre_name . '</a>';
            if (!$one_line) {
                $genres_string .= '</ br></ br>';
            }
        }

        $genres_string .= "</span>";
        return $genres_string;
    }

    public function is_multi_day(): bool
    {
        return boolval(get_post_meta($this->id, Event::MULTI_DAY, true));
    }

    public function is_show_time_according_to_format(): bool
    {
        return boolval(get_post_meta($this->id, 'zeitraum_nach_format', true));
    }

    public function get_begin_date(): DateTime
    {
        return date_create(strval(get_post_meta($this->id, 'begin_date', true)));
    }

    public function get_end_date(): DateTime
    {
        return date_create(strval(get_post_meta($this->id, 'end_date', true)));
    }

    public function get_begin_time(): DateTime
    {
        if ($this->get_format()->has_time_interval()) {
            if ($this->is_show_time_according_to_format()) {
                return $this->get_format()->get_begin_time();
            }
            return date_create(strval(get_post_meta($this->id, 'begin_time', true)));
        }
        return null;
    }

    public function get_end_time(): DateTime
    {
        if ($this->get_format()->has_time_interval()) {
            if ($this->is_show_time_according_to_format()) {
                return $this->get_format()->get_begin_time();
            }
            return date_create(strval(get_post_meta($this->id, 'end_time', true)));
        }
        return null;
    }

    public function get_date_string(bool $with_date = true): string
    {
        $multi_day = $this->is_multi_day();
        $begin_date =  $this->get_begin_date();
        $begin_time = $this->get_begin_time();
        $end_time = $this->get_end_time();
        $date_string = '';

        if ($begin_time && $end_time) {
            $begin_time_str = $begin_time->format('G:i');
            $end_time_str = $end_time->format('G:i');
        }

        if ($multi_day) {
            $end_date = $this->get_end_date();

            $begin_date = $begin_date->format('d.m.');
            $end_date = $end_date->format('d.m.y');
            if ($with_date) {
                $date_string .= $begin_date . Event::DATE_SEP . $end_date;
            }
            if ($begin_time && $end_time) {
                $date_string .= Event::DATE_TIME_SEP . $begin_time_str;
                $date_string .= Event::DATE_SEP . $end_time_str . ' Uhr';
            }
            return $date_string;
        }

        if ($with_date) {
            $begin_date = $begin_date->format('d.m.y');
            $date_string = $begin_date;
        }

        if ($begin_time && $end_time) {
            if ($with_date) {
                $date_string .= Event::DATE_TIME_SEP;
            }
            $date_string  .=  $begin_time_str . Event::TIME_SEP . $end_time_str . ' Uhr';
        }
        return $date_string;
    }

    public function get_image_id(): int
    {
        return intval(get_post_meta($this->id, Event::IMAGE, true));
    }

    public function get_image_url(string $size = 'large'): string
    {
        $image_url = wp_get_attachment_image_src($this->get_image_id(), $size);
        if ($image_url) {
            return strval($image_url[0]);
        }
        return '';
    }

    public function get_stream_url(): string
    {
        return strval(get_post_meta($this->id, Event::STREAM_URL, true));
    }

    public function stream_embedded():bool{
        return boolval(get_post_meta($this->id, Event::EMBED_STREAM_LINK, true));
    }
}
