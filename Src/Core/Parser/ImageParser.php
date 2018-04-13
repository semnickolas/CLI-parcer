<?php

namespace Core\Parser;

require_once './Src/Core/Parser/LinkManager.php';

use Core\Parser\LinkManager;

class ImageParser
{
    public static function parse(String $page, String $domain) : Array
    {
        $images = [];
        $temp_page = $page;
        $cursor = strpos($temp_page, "<img");
        while($cursor) {
            if(substr($temp_page, ($cursor - 4), 4) == "<!--") {
                $cursor = strpos($temp_page, "<img", ($cursor+4));
            }
            $temp_page = substr($temp_page, $cursor+4);
            $images[] = LinkManager::setFullLink(LinkManager::getImageLinks($temp_page), $domain);
            $cursor = strpos($temp_page, "<img");
        }
        return $images;
    }
}
