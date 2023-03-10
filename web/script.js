$(document).ready(function() {
    const URI = "http://localhost/Todo%20List/api/index.php";

    var titr = $("#titre");
    var categ = $("#cat");
    var imp = $("#importance");

    $(document).on("keypress", "#form", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
          // Cancel the default action, if needed
          event.preventDefault();
          // Trigger the button element with a click
          $("#creerTache").click();
        }
      }); 
    $(document).on("click", "#creerTache", function() {
        var continu = true;
        if (titr.val() == "" || categ.val() == "" || imp.val() == "" || imp > 5 || imp < 1) {
            alert("Merci de remplir tout les champs correctement");
            continu = false
        }
        if (continu) {
            $.ajax({
                method: "POST",
                url: URI,
                data: JSON.stringify({titre: titr.val(), cat: categ.val(), importance: imp.val()})
            })
            .done(function(data, textStatus, jqXHR) {
                alert("Tâche créée avec succès !");
                titr.val("");
                categ.val("");
                console.log(data); // Réponse HTTP (body)
                console.log(textStatus); // Statut de la requête AJAX
                console.log(jqXHR); // Objet jqXHR (infos de la requête AJAX)
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                alert("Erreur lors de l'envoi des données");
                console.log(jqXHR); // Objet jqXHR (infos de la requête AJAX)
                console.log(textStatus); // Statut de la requête AJAX
                console.log(errorThrown); // = statusText (type de l’erreur)
            });
        }
    });

    $.ajax({
        method: "GET",
        url: URI,
        dataType: "json",
        success: function(data) {
           // Define an empty array to store trs in
           var rows = [];

           // Iterate and append into <tr>s
           $.each(data, function(i, tache) {
                var impString = importance(tache.importance);
               // Create a new tr element with all table cell elements
               var row = $('<tr>').append(
                   $('<td>').text(tache.titre),
                   $('<td>').text(tache.cat),
                   $('<td>').text(importance(tache.importance)),
                   $('<td>').text("<button class='tache' id='" + tache.id +"'>Modifier</button>"),
                   $('<td>').text("<button class='tache' id='" + tache.id +"'>Supprimer</button>"),
               );
               // Push this row to our rows array
               rows.push(row);
           });

           // Append all rows to the tbody at once for better performance
           $('#taches').find('tbody').append(rows);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    })

    function importance(imp) {
        switch (imp) {
            case "1":
                return "Très Peu Important";
            case "2":
                return "Peu Important";
            case "3":
                return "Important";
            case "4":
                return "Très Important";
            case "5":
                return "URGENT";
            default:
                return "Erreur";
        }
    }
});