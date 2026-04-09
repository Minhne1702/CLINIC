<?php

use MongoDB\BSON\ObjectId;

class DoctorModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('doctors');
    }

    public function createProfile($data)
    {
        $data['userId'] = new ObjectId($data['userId']);
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getByDoctorCode($code)
    {
        return $this->collection->findOne(['doctorCode' => $code]);
    }

    public function updateBio($id, $bio)
    {
        return $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => ['bio' => $bio]]
        );
    }
}
