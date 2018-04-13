<?php

namespace Core\Parser;

class DomainHelper
{
    public static function setDomain(String $link) : String
    {
        $parseUrl = parse_url(trim($link));
        if(isset($parseUrl['host'])) {
            return trim($parseUrl['host']);
        }
        $path = explode('/', $parseUrl['path'], 2);
        return trim(array_shift($path));
    }
}
