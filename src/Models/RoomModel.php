<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class RoomModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('rooms');
    }

    public function createRoom($roomNumber, $floor)
    {
        $data = [
            'roomNumber' => $roomNumber,
            'floor'      => (int)$floor,
            'isActive'   => 1,
            'createdAt'  => new UTCDateTime()
        ];
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getRoomsByFloor($floor)
    {
        return $this->collection->find(['floor' => (int)$floor, 'isActive' => 1])->toArray();
    }
}
