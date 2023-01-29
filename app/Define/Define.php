<?php

declare(strict_types=1);

namespace App\Define;

/**
 *
 */
abstract class Define
{
    /**
     * @var array
     */
    protected static array $data = [];

    /**
     * @return array
     */
    public static function getAll(): array
    {
        return static::$data;
    }

    /**
     * @param string $value_key
     * @return array
     */
    public static function getKeyValue(string $value_key = 'name'): array
    {
        $list = [];
        foreach (static::$data as $row) {
            $list[$row['key']] = $row[$value_key];
        }

        return $list;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function getValue(string $key): mixed
    {
        $result = false;
        if (isset(static::$data[$key])) {
            $result = static::$data[$key];
        }

        return $result;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function getName(string $key): mixed
    {
        $result = false;
        if (isset(static::$data[$key])) {
            $result = static::$data[$key]['name'];
        }

        return $result;
    }

    /**
     * @param string $key
     * @param string $data_key
     * @return mixed
     */
    public static function findBy(string $key, string $data_key): mixed
    {
        $result = false;

        if (isset(static::$data[$key][$data_key])) {
            $result = static::$data[$key][$data_key];
        }

        return $result;
    }
}
