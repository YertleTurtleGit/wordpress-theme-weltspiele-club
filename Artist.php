<?php

class Artist
{
    private const IMAGE = 'image';

    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function get_name(): string
    {
        return strval(get_term($this->id)->name);
    }

    public function get_id(): int
    {
        return $this->id;
    }

    public function get_url(): string
    {
        return strval(get_term_link($this->id));
    }

    public function get_description(): string
    {
        return strval(term_description($this->id));
    }

    public function get_image_id(): int
    {
        return intval(get_post_meta($this->id, Artist::IMAGE, true));
    }

    public function get_image_url($size = 'large'): string
    {
        $image_url = wp_get_attachment_image_src($this->get_image_id(), $size);
        if ($image_url) {
            return strval($image_url[0]);
        }
        return '';
    }
}
