<?php

use MongoDB\BSON\ObjectId;

class InvoiceItemModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('invoice_items');
    }

    public function addItems($invoiceId, $items)
    {
        foreach ($items as &$item) {
            $item['invoiceId'] = new ObjectId($invoiceId);
        }
        return $this->collection->insertMany($items);
    }

    public function getItemsByInvoice($invoiceId)
    {
        return $this->collection->find(['invoiceId' => new ObjectId($invoiceId)])->toArray();
    }
}
