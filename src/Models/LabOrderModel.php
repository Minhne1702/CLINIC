<?php

use MongoDB\BSON\ObjectId;

class LabOrderModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('lab_orders');
    }

    public function createOrder($data)
    {
        $data['medicalRecordId'] = new ObjectId($data['medicalRecordId']);
        $data['status'] = 'pending';
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function updateResult($id, $resultData)
    {
        $resultData['lab_technician_id'] = new ObjectId($resultData['lab_technician_id']);
        $resultData['status'] = 'completed';
        return $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => $resultData]
        );
    }
}
