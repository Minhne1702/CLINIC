<?php
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class PatientModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('patients');
    }

    public function createPatient($data)
    {
        try {
            $data['createdAt'] = new UTCDateTime();
            $data['userId'] = (!empty($data['userId'])) ? new ObjectId($data['userId']) : null;
            
            $result = $this->collection->insertOne($data);
            return $result->getInsertedId();
        } catch (Exception $e) { return false; }
    }

    public function getPatientById($id)
    {
        try {
            return $this->collection->findOne(['_id' => new ObjectId($id)]);
        } catch (Exception $e) { return null; }
    }

    public function findByUniqueInfo($patientId = null, $cccd = null, $bhyt = null, $phone = null)
    {
        $filters = [];
        if ($patientId) $filters[] = ['patientId' => $patientId]; // Mã bệnh nhân phân biệt [cite: 9]
        if ($cccd)      $filters[] = ['cccd' => $cccd];
        if ($bhyt)      $filters[] = ['bhyt' => $bhyt];
        if ($phone)     $filters[] = ['phone' => $phone];

        if (empty($filters)) return null;
        return $this->collection->findOne(['$or' => $filters]);
    }
}