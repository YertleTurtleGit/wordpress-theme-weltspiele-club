<?php

class EventFormat
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function get_id(): int
    {
        return $this->id;
    }

    public function get_name(): string
    {
        return strval(get_term($this->id)->name);
    }

    public function get_description(): string
    {
        return strval(term_description($this->id));
    }

    public function has_time_interval(): bool
    {
        return boolval(get_term_meta($this->id, 'zeitraum', true));
    }

    public function get_begin_time(): DateTime
    {
        return date_create(strval(get_term_meta($this->id, 'begin_time', true)));
    }

    public function get_end_time(): DateTime
    {
        return date_create(strval(get_term_meta($this->id, 'end_time', true)));
    }

    public function get_image_id(): int
    {
        return intval(get_term_meta($this->id, 'bild', true));
    }

    public function get_image_url(string $size = 'large'): string
    {
        $image_url = wp_get_attachment_image_src($this->get_image_id(), $size);
        if ($image_url) {
            return strval($image_url[0]);
        }
        return '';
    }

    public function get_frequency(): string
    {
        return strval(get_term_meta($this->id, 'frequenz', true));
    }

    public function get_time_string(): string
    {
        $time_string = $this->get_begin_time()->format('G:i');
        $time_string .= Event::TIME_SEP;
        $time_string .= $this->get_end_time()->format('G:i');
        return $time_string;
    }

    public function get_frequency_string(): string
    {
        $frequency_string = $this->get_frequency();

        if ($this->has_time_interval()) {
            $frequency_string .= '<br />';
            $frequency_string .= $this->get_time_string();
        }

        return $frequency_string;
    }
}
