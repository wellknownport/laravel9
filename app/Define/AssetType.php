<?php

declare(strict_types=1);

namespace App\Define;

/**
 *
 */
class AssetType extends Define
{
    const IMAGE_JPEG = 1;

    protected static array $data = [
        self::IMAGE_JPEG => [
            'key'          => self::IMAGE_JPEG,
            'name'         => 'image/jpeg',
            'content_type' => 'image/jpeg',
        ],

    ];
}
