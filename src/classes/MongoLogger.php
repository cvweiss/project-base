<?php

namespace cvweiss\projectbase;

use \Monolog\Handler\AbstractProcessingHandler;

class MongoLogger extends AbstractProcessingHandler
{
    protected function write(array $record)
    {
        unset($record["formatted"]);
        $dttm = new \MongoDB\BSON\UTCDateTime($record['datetime']->getTimestamp() * 1000);
        $record['dttm'] = $dttm;
        
        $doc = new MongoDoc("log", $record);
        $doc->save();
    }
}
