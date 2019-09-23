<?php

namespace Demo\Model;

use Demo\Base\Model;

/**
 * Implementation is not reliable, should be refactored 
 * 
 * Class should rely on specific model
 */
class ProfileRepository extends Model
{
    private $fileds = ['user_id', 'first_name', 'last_name', 'title', 'updated_at'];

    public function getProfile($userId)
    {
        $sql = 'SELECT * from profiles where user_id = ?';
        $response = $this->connection->fetch($sql, [$userId]);
        
        if(!empty($response)) {
            $response = $response[0];
        }

        return $response;
    }

    /**
     * create user profile
     *
     * @param array $params
     * @return void
     */
    public function createProfile($params)
    {
        $this->filter($params);
        // TODO: move sql to Query Builder and use model instead of hardcoded table name... 
        $columnNames = join(', ', array_keys($params));         
        $placeholder = ':' . join(', :', array_keys($params)); 

        $sql = sprintf("INSERT INTO profiles (%s) VALUES (%s)", $columnNames, $placeholder );
        $this->connection->execute($sql, $params);
    }

    /**
     * Update user profile
     *
     * @param integer $userId
     * @param array $params
     * @return void
     */
    public function updateProfile($userId, $params)
    {
        $this->filter($params);
        
        if(array_key_exists('user_id', $params)) {
            unset($params['user_id']);
        }
        
        $params['updated_at'] = time();

        $keys = array_map(function($key){return $key .' = :'. $key;}, array_keys($params));
        $placeholder = implode(', ',$keys);
        $params['user_id'] = $userId;

        $sql = sprintf("UPDATE profiles SET %s where user_id = :user_id",  $placeholder);
        return $this->connection->execute($sql, $params);
    }

    private function filter($params)
    {
        foreach($params as $key => $value) {
            if(!in_array($key, $this->fileds)) {
                unset($params[$key]);
            }
        }

        return $params;
    }
}