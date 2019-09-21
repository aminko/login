<?php

namespace Demo\Controller;

use Demo\Base\Controller;

class RegistrationController extends Controller
{
    public function register($request = [])
    {
        return $this->view->render('register.twig', $request);
    }

    public function registration()
    {
        $request = $this->request->post;

        if( empty($request['email']) || 
            empty($request['password']) ||
            strlen($request['password']) < 10
        ) {
            $this->request->back();
        }
        
        $response = $this->proccessRegistration($request);

        if($response['status'] === true) {
            
            $this->auth->admin()->logInAsUserById($response['body']);
            $this->request->redirect('/');
        }
    }

    /**
     * Register new user and returns new user id
     * 
     * I case of error returns error message
     *
     * @param array $request
     * @return (integer | string)
     */
    private function proccessRegistration($request)
    {
        $response['status'] = 0;
        try {
            $response['body'] = $this->auth->register($request['email'], $request['password']);
            $response['status'] = true;
        } catch (\Delight\Auth\InvalidEmailException $e) {
            $response['body'] = 'Wrong email format';
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            $response['body'] = 'Choose different password';
        } catch (\Delight\Auth\UserAlreadyExistsException  $e) {
            $response['body'] = 'User with same email already exists';
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            $response['body'] = 'Slow down, too many requests!';
        }
        return $response;
    }
}