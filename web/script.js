$(document).ready(function() {
    $(document).on("click", "#creerTache", function() {
        $.ajax({
            method: "POST",
            url: "http://localhost/Todo%20List/api/index.php",
            data: JSON.stringify({titre: $("#titre").val(), cat: $("#cat").val(), importance: $("#importance").val()})
        })
        .done(function(data, textStatus, jqXHR) {
            $("#message").val("Succes !");
            alert("Réponse reçue avec succès !");
            console.log(data); // Réponse HTTP (body)
            console.log(textStatus); // Statut de la requête AJAX
            console.log(jqXHR); // Objet jqXHR (infos de la requête AJAX)
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            $("#message").val("Erreur !");

            alert("Erreur survenue !");
            console.log(jqXHR); // Objet jqXHR (infos de la requête AJAX)
            console.log(textStatus); // Statut de la requête AJAX
            console.log(errorThrown); // = statusText (type de l’erreur)
        });
    });
});