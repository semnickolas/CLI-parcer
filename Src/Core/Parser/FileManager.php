<?php

namespace Core\Parser;

class FileManager
{
    public static function save(String $file_name, Array $data) : void
    {
        $file_path = './Reports/' . $file_name . '.csv';
        $fp = fopen($file_path, 'a+');
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        echo(self::getFilePath($file_path) . "\n");
    }

    private static function getFilePath(String $path) : String
    {
        return realpath($path);
    }
}
