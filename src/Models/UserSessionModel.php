<?php
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class UserSessionModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('user_sessions');
    }

    public function createSession($userId, $tokenHash, $ip, $device)
    {
        $data = [
            'userId'     => new ObjectId($userId),
            'tokenHash'  => $tokenHash,
            'ipAddress'  => $ip,
            'deviceInfo' => $device,
            'expiresAt'  => new UTCDateTime((time() + (86400 * 7)) * 1000), 
        ];
        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function deleteSession($tokenHash)
    {
        return $this->collection->deleteOne(['tokenHash' => $tokenHash]);
    }
}