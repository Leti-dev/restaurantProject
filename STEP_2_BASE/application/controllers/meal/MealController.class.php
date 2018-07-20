<?php

class MealController{
	
    public function httpGetMethod(Http $http, array $queryFields){
        $mealModel = new MealModel();
        $meal = $mealModel->findMeal($queryFields['id']);
        
        echo json_encode($meal);
        exit;
    }

    public function httpPostMethod(Http $http, array $formFields){
  
    }

}