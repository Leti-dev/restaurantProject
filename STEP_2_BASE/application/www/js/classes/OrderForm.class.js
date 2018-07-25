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
                $('#meal-details img').attr('src', getWwwUrl() + "/images/meals/" + data['Photo']);
                $('#meal-details p').text(data['Description']);
                $("#meal-details strong").text(formatMoneyAmount(data['SalePrice']));
            
              // Enregistrement du prix dans un champ de formulaire caché.
                $('#order-form').find('input[name=salePrice]').val(data.SalePrice);
                console.log(data);
            }
            
    );
};

OrderForm.prototype.run = function() {
  
  /* Installation d'un gestionnaire d'évènement sur la sélection d'un aliment
  * dans la liste déroulante des aliments. */
    $("#meal").on('change', this.onChangeMeal.bind(this))
    // on force un change sur l'élément avant l'événement précédent.
    $("#meal").trigger('change');
    $('#order-form').on('submit', this.onSubmitForm.bind(this));
    this.refresh();
    $(document).on('click', '.delete-meal',this.delete.bind(this));
};

OrderForm.prototype.onSubmitForm = function(event) {
    // Pour bloquer comportement par défaut : POST en PHP qui renvoie la page.
        event.preventDefault();

    // STEP 1 : Ajout de l'article dans le panier.
        this.basketSession.add($('#meal').val(), 
                               $('#meal option:selected').text(), 
                               $('#order-form input[name=\'quantity\']').val(), 
                               $('#order-form input[name=\'salePrice\']').val());

    // STEP 2 : mise a jour de l'affichage
    this.refresh();

    // STEP 3 : reset le form
    

    // STEP 4 : prevent default navigateur

};

OrderForm.prototype.refresh = function(){
    var formFields = {'basket' : this.basketSession.items};
    console.log(this.basketSession.items);
    if(!this.basketSession.isEmpty()){
        $.post(
            getRequestUrl() + "/basket",
            formFields,
            function (data) {
                $("#order-summary").html(data);
            }
        )
    }else{
        $("#order-summary").html("<p>Votre panier est vide.</p>");
    }
}

OrderForm.prototype.delete = function(e){
    console.log(e);
    this.basketSession.remove($(e.currentTarget).attr('id'));
    this.refresh();
}