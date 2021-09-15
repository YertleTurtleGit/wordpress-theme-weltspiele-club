<?php

// TODO Implement Category class.

class Category
{
    private const SLUG = 'kategorie';

    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
