<?php

namespace Core\Parser;

class Client
{
    private $url;
    private $ch;
    private $content;
    const USER_AGENT = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36";

    public function __construct(String $url)
    {
        $this->url = $url;
        $this->ch = curl_init();
        self::setCurpOpt($this->ch, $this->url);
    }

    public static function setCurpOpt($ch, $url) : void
    {
        curl_setopt_array($ch, [
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_HEADER => 0,
          CURLOPT_FOLLOWLOCATION => 1,
          CURLOPT_ENCODING => "",
          CURLOPT_USERAGENT => self::USER_AGENT,
          CURLOPT_CONNECTTIMEOUT => 120,
          CURLOPT_TIMEOUT => 120,
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_SSL_VERIFYPEER => false
        ]);
    }

    public function getWebPage() : String
    {
        $this->content = curl_exec($this->ch);

        /*For debug uncomment that block and dump $errmsg
        $err = curl_errno($this->ch);
        $errmsg = curl_error($this->ch);
        $header = curl_getinfo($this->ch);
        */

        curl_close($this->ch);
        return $this->content;
    }
}
