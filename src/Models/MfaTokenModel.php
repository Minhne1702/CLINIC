<?php

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class MfaTokenModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('mfa_tokens');
    }

    public function createToken($userId, $token, $type = 'email')
    {
        $data = [
            'userId'    => new ObjectId($userId),
            'token'     => (string)$token,
            'type'      => $type,
            'expiresAt' => new UTCDateTime((time() + 300) * 1000),
            'isUsed'    => 0,
            'createdAt' => new UTCDateTime()
        ];
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function verifyToken($userId, $token)
    {
        $now = new UTCDateTime();
        $query = [
            'userId'    => new ObjectId($userId),
            'token'     => (string)$token,
            'isUsed'    => 0,
            'expiresAt' => ['$gt' => $now]
        ];
        $result = $this->collection->findOne($query);
        if ($result) {
            $this->collection->updateOne(['_id' => $result['_id']], ['$set' => ['isUsed' => 1]]);
            return true;
        }
        return false;
    }
}
