<?php

namespace Core\Parser;

require_once './Src/Core/Parser/BaseParser.php';
require_once './Src/Core/Parser/Client.php';
require_once './Src/Core/Parser/FileManager.php';
require_once './Src/Core/Parser/LinkParser.php';
require_once './Src/Core/Parser/ImageParser.php';
require_once './Src/Core/Parser/DomainHelper.php';

use Core\Parser\BaseParser;
use Core\Parser\Client;
use Core\Parser\FileManager;
use Core\Parser\LinkParser;
use Core\Parser\ImageParser;
use Core\Parser\DomainHelper;

class Parser extends BaseParser
{
    private $url;
    private $client;
    private $page;
    private $domain;
    private $images = [];
    private $urls = [];
    private $processed_data = [];

    public function __construct(String $url)
    {
        $this->url = $url;
        $this->domain = DomainHelper::setDomain($url);
        $this->client = new Client($this->url);
        $this->page = $this->client->getWebPage();
    }

    public function parse() : void
    {
        echo "Parsing has been started! Ceep kalm and drink some coffe C(_)\n";
        $this->urls = LinkParser::parse($this->page, $this->domain);
        echo "Image parcing...\n";
        $this->processed_data[$this->url] = ImageParser::parse($this->page, $this->domain);
        $this->processed_data[$this->url][] = 'URL(resource page) -> ' . $this->url;
        $this->urls = LinkParser::getAllDomainLinks($this->urls, $this->domain);

        if($this->urls !== 0) {
            foreach ($this->urls as $link) {
                $temp_client = new Client($link);
                $this->images = ImageParser::parse($temp_client->getWebPage(), $this->domain);
                $this->processed_data[$link] = $this->images;
                $this->processed_data[$link][] = 'URL(resource page) -> ' . $link;
                echo "*";
                unset($this->images);
            }
        }

        echo "\n";
        FileManager::save($this->domain, $this->processed_data);
        echo "Parsing sucesfully completed!\n";
    }
}
