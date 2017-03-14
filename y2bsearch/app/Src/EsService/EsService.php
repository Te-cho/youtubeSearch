<?php

namespace App\Src\EsService;

use App\Src\AbstractBaseClass;
use Elasticsearch\ClientBuilder;


class EsService extends AbstractBaseClass
{
    public static function generateESConnection()
    {
        $hosts = [env('ES_HOST')];

        return ClientBuilder::create()->setHosts($hosts)->build();
    }
}
