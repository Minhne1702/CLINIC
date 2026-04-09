<?php

use MongoDB\BSON\ObjectId;

class DiseaseToSpecificDrugMapModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('disease_to_specific_drug_maps');
    }

    public function addSpecificMapping($diseaseId, $drugId, $priority = 1)
    {
        $data = [
            'diseaseId' => new ObjectId($diseaseId),
            'drugId' => new ObjectId($drugId),
            'priority' => (int)$priority
        ];
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getSpecificDrugs($diseaseId)
    {
        return $this->collection->find(
            ['diseaseId' => new ObjectId($diseaseId)],
            ['sort' => ['priority' => 1]]
        )->toArray();
    }
}
