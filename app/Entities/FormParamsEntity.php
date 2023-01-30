<?php

declare(strict_types=1);

namespace App\Entities;

/**
 * @property string $title
 * @property string $btn_submit_title
 */
class FormParamsEntity extends Entity
{
    protected array $data = [
        'title'            => '',
        'btn_submit_title' => '',
    ];
}
