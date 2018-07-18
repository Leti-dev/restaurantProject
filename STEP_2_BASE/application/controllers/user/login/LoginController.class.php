<?php

class LoginController{
	
    public function httpGetMethod(Http $http, array $queryFields){

    }

    public function httpPostMethod(Http $http, array $formFields){
    	$userModel = new UserModel();
        $user = $userModel->findWithEmailPassword($formFields['email'], $formFields['password']);

        $userSession = new UserSession();
        $userSession->create($user['Id'], $user['FirstName'], $user['LastName'], $user['Email']);
        $userSession->isAuthenticated();
    }

}