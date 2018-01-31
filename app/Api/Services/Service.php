<?php
namespace App\Api\Services;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

abstract  class Service{

    protected $client;

    protected $baseUrl= 'https://www.torrentkitty.tv';

    protected $subUrl = '';


    public function setClient(){
        $this->client = new Client(
            [
                'base_uri'=>$this->baseUrl,
                'headers'=>$this->getHeaders()
            ]
        );
    }


    public function get(...$args){

        $this->init(...$args);

        $this->setClient();

        $response = $this->client->get($this->subUrl);

        return  $this->organizeData(new Crawler($this->toUTF8((string)$response->getBody())));

    }

    public function setBaseUrl($url){
        $this->baseUrl = $url;
        return $this;
    }

    public function setSubUrl($url){
        $this->subUrl = $url;

        return $this;
    }

    function toUTF8($value)
    {
        if(strtolower(substr(PHP_OS, 0, 3)) == 'win') {
            $strType = mb_detect_encoding($value, array("ASCII","UTF-8","GB2312","GBK","BIG5"));

            if($strType == 'EUC-CN' || $strType=='CP936') {
                $value = mb_convert_encoding($value, "UTF-8", "GBK");
            }
        }
        return $value;
    }


    public abstract function init(...$args);

    public abstract function organizeData($content);


    public function getHeaders(){
        return [
            'referer'=>'https://www.torrentkitty.tv/search/',
            'user-agent'=>'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36'
        ];
    }



}