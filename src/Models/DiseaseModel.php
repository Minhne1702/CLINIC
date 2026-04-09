<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class DiseaseModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('diseases');
    }

    public function createDisease($data)
    {
        $data['categoryId'] = new ObjectId($data['categoryId']);
        $data['isActive'] = 1;
        $data['createdAt'] = new UTCDateTime();
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function findByIcdCode($code)
    {
        return $this->collection->findOne(['icdCode' => $code, 'isActive' => 1]);
    }
}
