<?php
namespace App\Api\Services;

use Symfony\Component\DomCrawler\Crawler;


class TorrentService extends Service {


    public function init(...$args){
        $this->setSubUrl("/search/{$args[0]}/{$args[1]}");
    }

    public function organizeData($crawler){


        $trs = $crawler->filter('#archiveResult tr');

        if ($trs->count() == 2){
            $table = [];
        }else{

            $table =$trs->each(function(Crawler $node,$li){

                $children = $node->children()->extract(array('_text'));
                if ( !$node->children()->last()->text())
                    return '';
                $children['xl'] = $node->children()->last()->children()->eq(1)->attr('href');

                return $children;
            });
            $table = array_values(array_filter($table));

        }


       if ($crawler->filter('.pagination')->count() == 0){
            $page = 1;
       }
       else{

           $pagination = $crawler->filter('.pagination')->children()->extract('_text');

           $page = collect($pagination)->map(function($item){
               return $item > 0 ? $item : false;
           })->filter()->max();

       }

        return compact('table','page');

    }


}