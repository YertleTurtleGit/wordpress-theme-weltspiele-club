<?php

class Genre
{

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

    public function get_description(): string
    {
        return strval(term_description($this->id));
    }

    public function get_url(): string
    {
        return strval(get_term_link($this->id));
    }
}
