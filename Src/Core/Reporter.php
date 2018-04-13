<?php

namespace Core;

class Reporter
{
    private $file_path;

    public function __construct(String $domain)
    {
        $this->file_path = './Reports/' . $domain . '.csv';
    }

    public function getReport() : void
    {
        $fp = fopen($this->file_path, 'r');
        $report;
        while (($report = fgetcsv($fp)) !== FALSE) {
            print_r($report);
        }
        fclose($fp);
    }
}
