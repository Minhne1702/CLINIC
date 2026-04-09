<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class InvoiceModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('invoices');
    }

    public function createInvoice($data)
    {
        $data['patientId'] = new ObjectId($data['patientId']);
        $data['medicalRecordId'] = new ObjectId($data['medicalRecordId']);
        $data['status'] = 'unpaid';
        $data['createdAt'] = new UTCDateTime();
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function updateStatus($id, $status)
    {
        return $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => ['status' => $status]]
        );
    }
}
