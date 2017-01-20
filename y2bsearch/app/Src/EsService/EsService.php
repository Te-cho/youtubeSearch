<?php

namespace App\Src\EsService;

use App\Src\AbstractBaseClass;
use Elasticsearch\ClientBuilder;


class EsService extends AbstractBaseClass
{
    public static function generateESConnection()
    {
        $hosts = [
            'y2search_elk:9200',         // IP + Port
        ];
        return ClientBuilder::create()->setHosts($hosts)->build();
    }
}
