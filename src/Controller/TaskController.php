<?php

namespace Demo\Controller;

use Demo\Base\Controller;
use Demo\Model\TaskRepository;

class TaskController extends Controller
{
    public function index()
    {
        $TaskRepository = new TaskRepository($this->container);
        $tasks = $TaskRepository->getTasks($this->auth->getUserId());
       
        $response = ['response' => $tasks];
        
        return $this->view->render('json.twig', $response);
    }

    public function markAsDone($id)
    {
        $request = $this->request->post;
        
        $TaskRepository = new TaskRepository($this->container);
        $task = $TaskRepository->getTask($id);
        
        if(empty($task)) {
            $response = $this->setResponse(false, 'Action failed');
            return $this->view->render('json.twig', $response); 
        }

        $result = $TaskRepository->markAsDone($id, $request['done']);
        if($result) {
            $response = $this->setResponse(true, $result);
        } else {
            $response = $this->setResponse(false, 'Something went wrong');
        }
        
        return $this->view->render('json.twig', $response);
    }

    public function markAsImportant($id)
    {
        $request = $this->request->post;
        
        $TaskRepository = new TaskRepository($this->container);
        $task = $TaskRepository->getTask($id);
        
        if(empty($task)) {
            $response = $this->setResponse(false, 'Action failed');
            return $this->view->render('json.twig', $response); 
        }

        $result = $TaskRepository->markAsImportant($id, $request['done']);
        if($result) {
            $response = $this->setResponse(true, $result);
        } else {
            $response = $this->setResponse(false, 'Something went wrong');
        }
        
        return $this->view->render('json.twig', $response);
    }

    public function create()
    {
       // return $this->view->render('tasks.twig', []);
    }

    public function delete($id)
    {
        $TaskRepository = new TaskRepository($this->container);
        $task = $TaskRepository->getTask($id);
        
        if(empty($task)) {
            $response = $this->setResponse(false, 'Action failed');
            return $this->view->render('json.twig', $response); 
        }

        $result = $TaskRepository->delete($id);
        if($result) {
            $response = $this->setResponse(true, $result);
        } else {
            $response = $this->setResponse(false, 'Something went wrong');
        }
        
        return $this->view->render('json.twig', $response);
    }

    public function save()
    {
        $request = $this->request->post;

        if(empty(trim($request['name']))) {
            $response = $this->setResponse(false, 'Name should be filled out');
            return $this->view->render('json.twig', $response); 
        }

        $params = [
            'name' => $request['name'],
            'details' => isset($request['details']) ? $request['details'] : '',
            'important' => isset($request['important']) ? 1 : 0,
        ];
        
        $TaskRepository = new TaskRepository($this->container);
        $result = $TaskRepository->createTask($params);

        if($result) {
            $response = $this->setResponse(true, $result);
        } else {
            $response = $this->setResponse(false, 'Something went wrong');
        }
        
        return $this->view->render('json.twig', $response);
    }

    public function edit($id)
    {
        $request = $this->request->post;

        if(empty(trim($request['name']))) {
            $response = $this->setResponse(false, 'Name should be filled out');
            return $this->view->render('json.twig', $response); 
        }

        $TaskRepository = new TaskRepository($this->container);
        $task = $TaskRepository->getTask($id);
        
        if(empty($task)) {
            $response = $this->setResponse(false, 'Task cannot be edited');
            return $this->view->render('json.twig', $response); 
        }

        $params = [
            'name' => $request['name'],
            'details' => isset($request['details']) ? $request['details'] : '',
            'important' => isset($request['important']) ? 1 : 0,
            'done' => isset($request['done']) ? 1 : 0,
        ];

        $result = $TaskRepository->updateTask($id, $params);

        if($result) {
            $response = $this->setResponse(true, $result);
        } else {
            $response = $this->setResponse(false, 'Something went wrong');
        }
        
        return $this->view->render('json.twig', $response);
        
    }


    private function setResponse($status, $message)
    {
       $response = [
            'response' => [
                'response' => $status,
                'message' => $message
            ]
        ];

        return $response;
    }
}