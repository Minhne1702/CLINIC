<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class ShiftModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('shifts');
    }

    public function createShift($name, $startTime, $endTime, $desc)
    {
        $data = [
            'name'        => $name,
            'startTime'   => $startTime,
            'endTime'     => $endTime,
            'description' => $desc,
            'isActive'    => 1,
            'createdAt'   => new UTCDateTime()
        ];
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getActiveShifts()
    {
        return $this->collection->find(['isActive' => 1])->toArray();
    }
}
