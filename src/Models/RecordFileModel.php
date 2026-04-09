<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class RecordFileModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('record_files');
    }

    public function uploadFile($data)
    {
        $data['medicalRecordId'] = new ObjectId($data['medicalRecordId']);
        $data['uploadedBy'] = new ObjectId($data['uploadedBy']);
        $data['createdAt'] = new UTCDateTime();
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getFilesByRecord($recordId)
    {
        return $this->collection->find(['medicalRecordId' => new ObjectId($recordId)])->toArray();
    }
}
