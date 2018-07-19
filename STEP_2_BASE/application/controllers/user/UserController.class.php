<?php

class UserController{
	
    public function httpGetMethod(Http $http, array $queryFields){

    }

    public function httpPostMethod(Http $http, array $formFields){
    	try{
            $userModel = new UserModel();
    	    $userModel->saveUser(
    			$formFields['lastName'],
    			$formFields['firstName'],
				$formFields['birthDate'],
				$formFields['address'],
				$formFields['city'],
				$formFields['zipCode'],
				$formFields['phone'],
				$formFields['email'],
				$formFields['password']);

            $flashMess = new FlashBag();
            $flashMess->add('Votre inscription est terminée, vous pouvez maintenant réserver ou commander nos produits.');

    	   $http->redirectTo('/');
        }
        catch(Exception $e){
            $errorMess = $e->getMessage();
            return [ 'error' => $errorMess];
        }
    }

}