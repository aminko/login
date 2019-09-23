<?php

namespace Demo\Controller;

use Demo\Base\Controller;
use Demo\Model\ProfileRepository;

class ProfileController extends Controller
{
    public function show()
    {
        $profileRepository = new ProfileRepository($this->container);
        $profile = $profileRepository->getProfile($this->auth->getUserId());
       
        return $this->view->render('profile.twig', $profile);
    }

    public function edit()
    {
        $profileRepository = new ProfileRepository($this->container);
        $profile = $profileRepository->getProfile($this->auth->getUserId());
       
        return $this->view->render('profile.edit.twig', $profile);
        
    }

    public function save()
    {
        $params = $this->request->post;
        $profile = new ProfileRepository($this->container);
        $profile->updateProfile($this->auth->getUserId(), $params);
        
        $this->request->redirect('/profile');
    }
}