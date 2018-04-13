<?php

namespace Core;

class Helper
{
    private $info;

    public static function getHelp() : void
    {
        $info = file_get_contents('./User_guide/guide.txt');
        echo $info;
    }
}
