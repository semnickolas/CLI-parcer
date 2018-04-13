<?php

namespace Src;

require_once './Src/Core/Parser/Parser.php';
require_once './Src/Core/Reporter.php';
require_once './Src/Core/Helper.php';

use Core\Parser\Parser;
use Core\Reporter;
use Core\Helper;

class Controller
{
    private $parser;
    private $reporter;

    public static function parse(String $url) : void
    {
        $parser = new Parser($url);
        $parser->parse();
    }

    public static function report(String $domain) : void
    {
        $reporter = new Reporter($domain);
        $reporter->getReport();
    }

    public static function help() : void
    {
        Helper::getHelp();
    }
}
