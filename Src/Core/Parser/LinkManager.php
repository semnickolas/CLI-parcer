<?php

namespace Core\Parser;

class LinkManager
{
    public static function getImageLinks(String $block) : String
    {
        $block = substr($block, strpos($block, 'src=')+5);
        return substr($block, 0, strpos($block, "\""));
    }

    public static function getHrefLinks(String $block) : String
    {
        $block = substr($block, strpos($block, 'href=')+6);
        return substr($block, 0, strpos($block, "\""));
    }

    public static function setFullLink(String $link, String $domain) : String
    {
        if($link[0] . $link[1] == '//') {
          $link = "http:". $link;
          return $link;
        }

        if($link[0] == '/') {
          $link = $domain . $link;
        }
        
        return $link;
    }
}
