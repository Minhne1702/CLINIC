<?php
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class AuditLogModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('audit_logs');
    }

    public function createLog($data)
    {
        $data['userId'] = (!empty($data['userId'])) ? new ObjectId($data['userId']) : null;
        $data['resourceId'] = (!empty($data['resourceId'])) ? new ObjectId($data['resourceId']) : null;
        $data['createdAt'] = new UTCDateTime();

        return $this->collection->insertOne($data)->getInsertedId();
    }

    public function getLogsByResource($resourceType, $resourceId)
    {
        return $this->collection->find([
            'resourceType' => $resourceType,
            'resourceId' => new ObjectId($resourceId)
        ], ['sort' => ['createdAt' => -1]])->toArray();
    }
}