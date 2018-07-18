<?php

class UserController{
	
    public function httpGetMethod(Http $http, array $queryFields){

    }

    public function httpPostMethod(Http $http, array $formFields){
    	var_dump($formFields);
    	$userModel = new UserModel();
    	var_dump($userModel->saveUser(
    			$formFields['lastName'],
    			$formFields['firstName'],
				$formFields['birthDate'],
				$formFields['address'],
				$formFields['city'],
				$formFields['zipCode'],
				$formFields['phone'],
				$formFields['email'],
				$formFields['password']));

    }

}