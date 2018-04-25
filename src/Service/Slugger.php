<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/01/2018
 * Time: 19:36
 */

namespace App\Service;


class Slugger
{

    public static function slugify(string $string): string
    {
        return preg_replace('/\s+/', '-', mb_strtolower(trim(strip_tags($string)), 'UTF-8'));
    }
}