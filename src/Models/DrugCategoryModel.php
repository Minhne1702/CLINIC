<?php

use MongoDB\BSON\UTCDateTime;

class DrugCategoryModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('drug_categories');
    }

    public function createCategory($name, $description = "")
    {
        $data = [
            'name' => $name,
            'description' => $description,
            'createdAt' => new UTCDateTime()
        ];
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getAll()
    {
        return $this->collection->find()->toArray();
    }
}
