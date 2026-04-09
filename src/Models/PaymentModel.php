<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class PaymentModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('payments');
    }

    public function recordPayment($data)
    {
        $data['invoiceId'] = new ObjectId($data['invoiceId']);
        $data['cashierId'] = new ObjectId($data['cashierId']);
        $data['paidAt'] = new UTCDateTime(); 
        return $this->collection->insertOne($data)->getInsertedId();
    }
}
