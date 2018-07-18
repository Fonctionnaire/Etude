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
        //return preg_replace('/\s+/', '-', mb_strtolower(trim(strip_tags($string)), 'UTF-8'));
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    }
}