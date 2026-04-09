<?php
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class QueueEntryModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('queue_entries');
    }

    public function addToQueue($data)
    {
        $data['appointmentId'] = new ObjectId($data['appointmentId']);
        $data['patientId'] = new ObjectId($data['patientId']);
        $data['clinicId'] = new ObjectId($data['clinicId']);
        $data['status'] = 'waiting';
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