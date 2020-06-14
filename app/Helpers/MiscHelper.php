<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Helpers;

use NotificationChannels\Discord\Discord;

class MiscHelper
{
    /**
     * Get the hash of the current git HEAD.
     *
     * @param string $branch The git branch to check
     *
     * @return mixed Either the hash or a boolean false
     */
    public static function get_current_git_commit($branch = 'master')
    {
        $rev = exec('git rev-parse --short HEAD');

        return $rev;
    }

    public static function sendDiscord($content)
    {
        $dc = Discord::class;
    }

    public static function sendTelegram($content)
    {
        \Telegram::sendMessage([
            'chat_id'                  => 51419661,
            'text'                     => $content,
            'parse_mode'               => 'markdown',
            'disable_web_page_preview' => true,
        ]);
    }

    /**
     * Get difference between two multidimensinal arrays
     *
     * @param $array1
     * @param $array2
     * @return array
     */
    public static function array_diff_assoc_recursive($array1, $array2)
    {
        $difference = [];
        foreach ($array1 as $key => $value) {
            if (is_array($value)) {
                if (! isset($array2[$key]) || ! is_array($array2[$key])) {
                    $difference[$key] = $value;
                } else {
                    $new_diff = self::array_diff_assoc_recursive($value, $array2[$key]);
                    if (! empty($new_diff)) {
                        $difference[$key] = $new_diff;
                    }
                }
            } elseif (! array_key_exists($key, $array2) || $array2[$key] !== $value) {
                $difference[$key] = $value;
            }
        }

        return $difference;
    }

    /**
     * Calculate Game Popularity
     *
     * @param $views
     * @param $max
     * @return float|int
     */
    public static function getPopularity($views, $max)
    {
        if ($max == 0 || $views == 0) {
            $ret = 0;
        } else {
            $ret = ($views / $max) * 100;
        }

        return $ret;
    }

    /**
     * COnvert Bytes to readable Format
     *
     * @param int $size
     *
     * @return string
     */
    public static function getReadableBytes($size)
    {
        $bytes = $size;

        if ($bytes == 0) {
            return '0.00 B';
        }

        $s = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];
        $e = floor(log($bytes, 1024));

        return round($bytes / pow(1024, $e), 2).' '.$s[$e];
    }
}
