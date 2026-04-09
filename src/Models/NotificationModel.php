<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class NotificationModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('notifications');
    }

    public function createNotification($data)
    {
        $data['userId'] = (!empty($data['userId'])) ? new ObjectId($data['userId']) : null;
        $data['status'] = 'pending';
        $data['createdAt'] = new UTCDateTime();
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function markAsRead($id)
    {
        return $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => ['status' => 'read']]
        );
    }
}
