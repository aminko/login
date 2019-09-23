<?php

namespace Demo\Controller;

use Demo\Base\Controller;

class AuthController extends Controller
{
    public function login()
    {
        
        // return login view
        return $this->view->render('login.twig', []);
    }

    public function logout()
    {
        $request = $this->request->post;
        $this->auth->logOut();
        $this->request->redirect('/');
    }

    public function authenticate()
    {
        $request = $this->request->post;
        $response = $this->proccessAuthentication($request);
        if($response['status'] === true) {
            $this->request->redirect('/'); 
        }

        $this->request->redirect('/login'); // TODO: flash message with response error
    }

    private function proccessAuthentication($request)
    {
        $response['status'] = 0;
        try {
            $response['body'] = $this->auth->login($request['email'], $request['password']);
            $response['status'] = true;
        } catch (\Delight\Auth\InvalidEmailException $e) {
            $response['body'] = 'Wrong email format';
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            $response['body'] = 'Wrong password';
        } catch (\Delight\Auth\EmailNotVerifiedException  $e) {
            $response['body'] = 'Your user account is not verified';
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            $response['body'] = 'Slow down, too many requests!';
        }
        return $response;
    }


}