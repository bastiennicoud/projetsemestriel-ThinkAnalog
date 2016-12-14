// Bastien Nicoud - Think Analog
// Projet semestriel - novembre 2016

// Attend jquery
$(document).ready(function(){

  /* ecoute les checkbox et modifie les champs proposés en fonction de la case cheked slon notre type de formation */
  $("[name=optionsRadios]").change(function(){
    
    $checked = $(this).val();

    // je lance une requete ajax via POST
    $.post(
      // je précise le fichier php visé
      'productscategory.php',
      // les paramètres que je fais passer en post
      {
        category: $checked
      },

      // la fonction que je vais utiliser pour generer le retour visuel
      function ajaxReturnFunction(data){
        $("#products-display").html(data);
      },
      // le type de données atendues
      'html'
    );

  });

});