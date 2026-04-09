<?php

use MongoDB\BSON\ObjectId;

class PrescriptionItemModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('prescription_items');
    }

    public function addItems($items)
    {
        foreach ($items as &$item) {
            $item['prescriptionId'] = new ObjectId($item['prescriptionId']);
            $item['drugId'] = new ObjectId($item['drugId']);
        }
        return $this->collection->insertMany($items);
    }

    public function getItemsByPrescription($prescriptionId)
    {
        return $this->collection->find(['prescriptionId' => new ObjectId($prescriptionId)])->toArray();
    }
}
