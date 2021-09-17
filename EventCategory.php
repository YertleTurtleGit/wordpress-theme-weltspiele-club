<?php

class EventCategory
{
    private const SLUG = 'kategorie';

    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function get_title(): string
    {
        return strval(get_term($this->id)->name);
    }
}
