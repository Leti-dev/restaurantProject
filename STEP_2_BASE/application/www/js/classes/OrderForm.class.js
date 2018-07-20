'use strict';

var OrderForm = function() {
  
  // instance de la classe BasketSession dans une prop
    this.basketSession = new BasketSession();

};

// STEP 1 : quand on change le select
OrderForm.prototype.onChangeMeal = function() {
  
  // Récupération de l'id de l'aliment sélectionné dans la liste déroulante.
    var id = $("#meal option:selected").val();

    /*
     * Exécution d'une requête HTTP GET AJAJ (Asynchronous JavaScript And JSON) : index.php/meal?id=***ID_DU_PLAT***
     * pour récupérer les informations de l'aliment sélectionné dans la liste déroulante.
     */

    $.getJSON(
            getRequestUrl() + "/meal?id=" + id,
            function(data){
                console.log(data);
                $('#meal-details img').attr('src', getWwwUrl() + "/images/meals/" + data['Photo']);
                $('#meal-details p').text(data['Description']);
                $("#meal-details strong").text(formatMoneyAmount(data['SalePrice']));
            
              // Enregistrement du prix dans un champ de formulaire caché.
                $('#order-form').find('input[name=salePrice]').val(data.SalePrice);
            }
            
    );
};

OrderForm.prototype.run = function() {
  
  /* Installation d'un gestionnaire d'évènement sur la sélection d'un aliment
  * dans la liste déroulante des aliments. */
    $("#meal").on('change', this.onChangeMeal.bind(this))
    // on force un change sur l'élément avant l'événement précédent.
    $("#meal").trigger('change');
};

OrderForm.prototype.onSubmitForm = function(event) {
  
    // STEP 1 : Ajout de l'article dans le panier.
        $a = this.basketSession.add($('#meal-details select').val(), 
                               $('#meal-details select').txt(), 
                               $('#meal-details input[name=\'quantity\']').val(), 
                               $('#meal-details input[name=\'salePrice\']').val());

        console.log(a);
    // STEP 2 : mise a jour de l'affichage


    // STEP 3 : reset le form


    // STEP 4 : prevent default navigateur

};