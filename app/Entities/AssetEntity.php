<?php

declare(strict_types=1);

namespace App\Entities;

/**
 * @property int $id
 * @property string $content
 * @property int $type
 * @property string $created_at
 * @property string $updated_at
 */
class AssetEntity extends Entity
{
    protected array $data = [
        'id'         => 0,
        'content'    => '',
        'type'       => 1,
        'created_at' => '',
        'updated_at' => '',
    ];
}
