<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class DoctorScheduleModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('doctor_schedules');
    }

    public function createSchedule($data)
    {
        $data['doctorId'] = new ObjectId($data['doctorId']);
        $data['shiftId'] = new ObjectId($data['shiftId']);
        $data['roomId'] = new ObjectId($data['roomId']);
        $data['clinicId'] = new ObjectId($data['clinicId']);
        $data['workDate'] = new UTCDateTime(strtotime($data['workDate']) * 1000);
        $data['status'] = 'scheduled';
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
