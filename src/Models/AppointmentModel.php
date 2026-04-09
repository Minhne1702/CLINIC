<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class AppointmentModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('appointments');
    }

    public function createAppointment($data)
    {
        $data['patientId'] = new ObjectId($data['patientId']);
        $data['doctorScheduleId'] = new ObjectId($data['doctorScheduleId']);
        $data['clinicId'] = new ObjectId($data['clinicId']);
        $data['createdAt'] = new UTCDateTime();
        $data['status'] = 'pending';
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function cancelAppointment($id, $reason)
    {
        return $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => ['status' => 'cancelled', 'cancelReason' => $reason]]
        );
    }
}
