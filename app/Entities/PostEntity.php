<?php

declare(strict_types=1);

namespace App\Entities;

/**
 * @property int $id
 * @property string $content
 * @property int $user_id
 * @property string $release_at
 * @property string $created_at
 * @property string $updated_at
 */
class PostEntity extends Entity
{
    protected array $data = [
        'id'         => 0,
        'content'    => '',
        'user_id'    => 1,
        'created_at' => '',
        'updated_at' => '',
        'release_at' => '',
    ];
}
