<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class InventoryItemModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('inventory_items');
    }

    public function addBatch($data)
    {
        $data['drugId'] = new ObjectId($data['drugId']);
        $data['expiryDate'] = new UTCDateTime(strtotime($data['expiryDate']) * 1000);
        $data['createdAt'] = new UTCDateTime();
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getStockForDispensing($drugId)
    {
        $now = new UTCDateTime();
        return $this->collection->find(
            [
                'drugId' => new ObjectId($drugId),
                'quantity' => ['$gt' => 0],
                'expiryDate' => ['$gt' => $now]
            ],
            ['sort' => ['expiryDate' => 1]]
        )->toArray();
    }
}
