<?php

class LoginController{
	
    public function httpGetMethod(Http $http, array $queryFields){

    }

    public function httpPostMethod(Http $http, array $formFields){
    	try{
            $userModel = new UserModel();
            $user = $userModel->findWithEmailPassword($formFields['email'], $formFields['password']);

            $userSession = new UserSession();
            $userSession->create($user['Id'], $user['FirstName'], $user['LastName'], $user['Email']);
            $userSession->isAuthenticated();

            $flashMess = new FlashBag();
            $flashMess->add('Vous êtes maintenant connecté.');

            $http->redirectTo('/');
        }
        catch(Exception $e){
            $errorMess = $e->getMessage();
            return [ 'error' => $errorMess];
        }


    }

}