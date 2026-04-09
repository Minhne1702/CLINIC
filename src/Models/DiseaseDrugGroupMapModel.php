<?php

use MongoDB\BSON\ObjectId;

class DiseaseDrugGroupMapModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('disease_drug_group_maps');
    }

    public function addGroupMapping($diseaseId, $drugCategoryId, $priority = 1)
    {
        $data = [
            'diseaseId' => new ObjectId($diseaseId),
            'drugCategoryId' => new ObjectId($drugCategoryId),
            'priority' => (int)$priority
        ];
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getSuggestedGroups($diseaseId)
    {
        return $this->collection->find(
            ['diseaseId' => new ObjectId($diseaseId)],
            ['sort' => ['priority' => 1]]
        )->toArray();
    }
}
