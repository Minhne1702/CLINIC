<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class DispensingLogModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('dispensing_logs');
    }

    public function logAction($data)
    {
        $data['prescriptionItemId'] = new ObjectId($data['prescriptionItemId']);
        $data['inventoryItemId'] = new ObjectId($data['inventoryItemId']);
        $data['dispensedBy'] = new ObjectId($data['dispensedBy']);
        $data['dispensedAt'] = new UTCDateTime();
        return $this->collection->insertOne($data)->getInsertedId();
    }
}
