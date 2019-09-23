<?php

namespace Demo\Model;

use Demo\Base\Model;

/**
 * Implementation is not reliable, should be refactored 
 * 
 * Class should rely on specific model
 */
class TaskRepository extends Model
{
    private $fileds = ['user_id', 'name', 'details', 'done', 'important', 'created_at', 'updated_at'];

    public function getTask($taskId)
    {
        $userId = $this->container->get('auth')->getUserId();
        $sql = 'SELECT * from tasks where user_id = ? and id = ?';
        $response = $this->connection->fetch($sql, [$userId, $taskId]);
        
        if(!empty($response)) {
            $response = $response[0];
        }

        return $response;
    }

    public function getTasks()
    {
        $userId = $this->container->get('auth')->getUserId();
        $sql = 'SELECT * from tasks where user_id = ?';
        $response = $this->connection->fetch($sql, [$userId]);

        return $response;
    }

    /**
     * create task
     *
     * @param array $params
     * @return void
     */
    public function createTask($params)
    {
        $this->filter($params);
        $params['user_id'] = $this->container->get('auth')->getUserId();
        $params['created_at'] = time();

        // TODO: move sql to Query Builder and use model instead of hardcoded table name... 
        $columnNames = join(', ', array_keys($params));         
        $placeholder = ':' . join(', :', array_keys($params)); 

        $sql = sprintf("INSERT INTO tasks (%s) VALUES (%s)", $columnNames, $placeholder );
        $result = $this->connection->execute($sql, $params);
        return $result ? $this->connection->lastInsertId() : 0; 
    }

    /**
     * Update task
     *
     * @param integer $userId
     * @param array $params
     * @return void
     */
    public function updateTask($taskId, $params)
    {
        $this->filter($params);

        if(array_key_exists('user_id', $params)) {
            unset($params['user_id']);
        }

        $params['updated_at'] = time();

        $keys = array_map(function($key){return $key .' = :'. $key;}, array_keys($params));
        $placeholder = implode(', ',$keys);
        $params['id'] = $taskId;

        $sql = sprintf("UPDATE tasks SET %s where id = :id",  $placeholder);
        return $this->connection->execute($sql, $params);
    }

    public function markAsDone($id, $state)
    {
        $sql = "UPDATE tasks SET done = ?, updated_at = ? where id = ?";
       return $this->connection->execute($sql, [$state, time(), $id]);
    }

    public function markAsImportant($id, $state)
    {
        $sql = "UPDATE tasks SET done = true, updated_at = ? where id = ?";
        return $this->connection->execute($sql, [$state, time(), $id]);
    }

    public function delete($id)
    {
       $sql = "DELETE FROM tasks WHERE id = ?";
       return $this->connection->execute($sql, [$id]);
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