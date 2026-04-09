<?php

use MongoDB\BSON\ObjectId;

class DiseaseCategoryToDrugMapModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('disease_category_to_drug_maps');
    }

    public function addMapping($diseaseCatId, $drugCatId, $priority = 1)
    {
        $data = [
            'diseaseCategoryId' => new ObjectId($diseaseCatId),
            'drugCategoryId' => new ObjectId($drugCatId),
            'priority' => (int)$priority
        ];
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getDrugGroupsByCategory($diseaseCatId)
    {
        return $this->collection->find(
            ['diseaseCategoryId' => new ObjectId($diseaseCatId)],
            ['sort' => ['priority' => 1]]
        )->toArray();
    }
}
