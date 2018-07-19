<?php

class OrderController{
	
    public function httpGetMethod(Http $http, array $queryFields){
        $isConnect = new OrderController();
        $isConnect->redirect();

        $mealModel = new MealModel();
        $meals = $mealModel->listAll();
        return ['meals' => $meals];

    }

    public function httpPostMethod(Http $http, array $formFields){


        $flashMess = new FlashBag();
        $flashMess->add('Votre commande a bien été prise en compte. Merci !');
    }

    public function redirect(){
        $sess = new UserSession();
        if(!$sess->isAuthenticated()){
            $http = new Http();
            $http->redirectTo('/');
        }    
    }

}