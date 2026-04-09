<?php
class UserModel
{
    private $collection;

    public function __construct($db)
    {
        $this->collection = $db->selectCollection('users');
    }

    public function findUserByEmail($email)
    {
        try {
            return $this->collection->findOne(['email' => $email]);
        } catch (Exception $e) {
            return null;
        }
    }

    public function getUserById($userId)
    {
        try {
            return $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($userId)]);
        } catch (Exception $e) {
            return null;
        }
    }

    public function createUser($data)
    {
        $data['password']  = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['createdAt'] = new MongoDB\BSON\UTCDateTime();
        $data['isActive']  = true;

        if ($data['role'] === 'doctor' && !isset($data['doctorProfile'])) {
            $data['doctorProfile'] = [
                'specialtyId' => '',
                'bio'         => '',
                'experience'  => 0,
            ];
        } else if ($data['role'] === 'patient' && !isset($data['patientProfile'])) {
            $data['patientProfile'] = [
                'address' => '',
                'gender'  => '',
                'dob'     => ''
            ];
        }

        $result = $this->collection->insertOne($data);
        return $result->getInsertedId();
    }

    public function login($email, $password)
    {
        $user = $this->collection->findOne([
            'email'    => $email,
            'isActive' => true,
        ]);

        if (!$user) {
            return false;
        }

        $hash = isset($user['password']) ? $user['password'] : null;

        if ($hash && password_verify($password, $hash)) {
            return $user;
        }

        return false;
    }

    public function getAllUsersByRole($role)
    {
        return $this->collection->find(['role' => $role])->toArray();
    }

    public function updateProfile($userId, $updateData)
    {
        try {
            return $this->collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($userId)],
                ['$set' => $updateData]
            );
        } catch (Exception $e) {
            return false;
        }
    }

    public function checkEmailExists($email)
    {
        return $this->collection->findOne(['email' => $email]);
    }
}
