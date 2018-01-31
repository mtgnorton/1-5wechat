<?php
namespace App\Api\Services;

use Symfony\Component\DomCrawler\Crawler;


class MovieService extends Service {

    public function init(...$args){

        $arg = urlencode(iconv('utf-8','gb2312',$args[0]));
        $this->setBaseUrl('http://s.dydytt.net')->setSubUrl('/plus/search.php?keytype=0&keyword='.$arg);
    }

    public function organizeData($crawler){
        $tables = $crawler->filter('.co_content8 table');

       $urlMap =  $tables->each(function(Crawler $table,$li){
           $a = $table->children()->eq(0)->filter('a');
           $url = $a->attr('href');
           $name =$a->html();
           $encode = mb_detect_encoding($name, array("ASCII","UTF-8","GB2312","GBK","BIG5"));
           return compact('url','name');
        });
    dump($urlMap);
    exit;

    }
}

