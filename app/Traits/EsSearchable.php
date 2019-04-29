<?php

namespace App\Traits;

trait EsSearchable
{
    public $searchSettings = [
        'attributesToHighlight' => [
            '*'
        ],
    ];

    public $highlight = [];
}