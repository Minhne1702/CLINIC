<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class MedicalRecordModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('medical_records');
    }

    public function createRecord($data)
    {
        $data['patientId'] = new ObjectId($data['patientId']);
        $data['doctorId'] = new ObjectId($data['doctorId']);
        $data['appointmentId'] = new ObjectId($data['appointmentId']);
        $data['status'] = 'examining';
        $data['createdAt'] = new UTCDateTime();
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function updateDiagnosis($id, $icdCode, $note)
    {
        return $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => [
                'diagnosisCode' => $icdCode, 
                'diagnosisNote' => $note,
                'status' => 'examined'
            ]]
        );
    }
}
