<?php

class HomeController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

        // Récupération de tous les produits alimentaires.
        $mealModel = new MealModel();
        $meals     = $mealModel->listAll();

        // Les controller passent les données a nos vus via des "return" en tableau associatifs
        // dans ce cas precis, mon controller retourne du contenu référencé par une clé "meals" et qui contient le retour de la métode listAll
        return
        [
            'meals'    => $meals,
        ];
    }

}