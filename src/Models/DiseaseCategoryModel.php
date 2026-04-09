<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class DiseaseCategoryModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('disease_categories');
    }

    public function createCategory($data)
    {
        $data['parentId'] = (!empty($data['parentId'])) ? new ObjectId($data['parentId']) : null;
        $data['isActive'] = 1;
        $data['createdAt'] = new UTCDateTime();
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getActiveCategories()
    {
        return $this->collection->find(['isActive' => 1])->toArray();
    }
}
