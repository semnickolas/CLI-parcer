<?php

namespace Core\Parser;

require_once './Src/Core/Parser/LinkManager.php';
require_once './Src/Core/Parser/Client.php';

use Core\Parser\LinkManager;
Use Core\Parser\Client;

class LinkParser
{
    public static function getAllDomainLinks(Array $urls, String $domain) : Array
    {
        echo "Accumulate domain links...\n";
        $all_links = $urls;
        $temp_urls = [];
        foreach ($all_links as $link) {
            $temp_client = new Client($link);
            $tmp_urls = self::parse($temp_client->getWebPage(), $domain);
            $all_links = array_merge($all_links, $tmp_urls);
            $all_links = array_unique($all_links);
            echo '#';
        }
        echo "\n";
        return $all_links;
    }

    public static function parse(String $page, String $domain) : Array
    {
        $links = [];
        $temp_page = $page;
        $cursor = strpos($temp_page, "<a");
        while($cursor) {
            $temp_page = substr($temp_page, $cursor+2);
            $temp_link = LinkManager::getHrefLinks($temp_page);
            $temp_domain = parse_url($temp_link, PHP_URL_HOST);
            if($temp_domain == $domain || $temp_link[0] == '/') {
                $links[] = LinkManager::setFullLink($temp_link, $domain);
            }
            $cursor = strpos($temp_page, "<a");
        }
        return $links;
    }
}
