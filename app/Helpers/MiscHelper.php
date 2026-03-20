<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

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
            $ret = ($views * 100) / $max;
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

    /**
     * Retrieve query string and convert it to string format: ?query1=value1&query2=value2
     * In case of no existing query string data returns empty string.
     *
     * @return string
     */
    public static function getQueryString($keepPage = false)
    {
        if ($keepPage) {
            if (count(Request::query()) > 0) {
                return '?' . http_build_query(Request::query());
            } else {
                return '';
            }
        } else {
            if (count(array_filter(Request::query(), function ($key) {
                return $key !== 'page';
            }, ARRAY_FILTER_USE_KEY)) > 0) {
                return '?' . http_build_query(array_filter(Request::query(), function ($key) {
                    return $key !== 'page';
                }, ARRAY_FILTER_USE_KEY));
            } else {
                return '';
            }
        }
    }
}
