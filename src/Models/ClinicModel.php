<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class ClinicModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('clinics');
    }

    public function createClinic($name, $code)
    {
        $data = [
            'name'     => $name,
            'code'     => $code,
            'isActive' => 1,
            'createdAt' => new UTCDateTime()
        ];
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getAllActive()
    {
        return $this->collection->find(['isActive' => 1])->toArray();
    }
}
