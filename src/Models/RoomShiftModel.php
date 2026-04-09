<?php

use MongoDB\BSON\ObjectId;

class RoomShiftModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('room_shifts');
    }

    public function createRoomShift($data)
    {
        $data['roomId'] = new ObjectId($data['roomId']);
        $data['shiftId'] = new ObjectId($data['shiftId']);
        $data['clinicId'] = new ObjectId($data['clinicId']);
        $data['isActive'] = 1;
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getActiveConfigs()
    {
        return $this->collection->find(['isActive' => 1])->toArray();
    }
}
