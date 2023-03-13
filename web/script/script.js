$(document).ready(function() {
    const URI = "http://localhost/Todo-List/api/index.php";

    var titr = $("#titre");
    var categ = $("#cat");
    var imp = $("#importance");
    
    /**
     * Loads data into the table
     */
    tableFill();
    $(document).on("click", "#recharger", function() {
        tableFill();
    });
    setInterval(tableFill, 60000);

    /**
     * When enter is pressed, it presses "Créer Tache"
     */
    $(document).on("keypress", "#form", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
          // Cancel the default action, if needed
          event.preventDefault();
          // Trigger the button element with a click
          $("#creerTache").click();
        }
    }); 
      
    /**
     * Sends data to create task
     */
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
                tableFill();
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

    /**
     * Deletes a task
     * @param {*} taskId id of the task we need to delete
     */
    function supprimer(taskId){
        $.ajax({
            method: "DELETE",
            url: URI,
            dataType: "json",
            data: JSON.stringify({id: taskId}),
            success: function(data) {
                tableFill();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        })
    }

    /**
     * Modifies a task based on what the user inputed
     * @param {*} tache id of the task
     */
    function modifier(tache) {
        var titre = $('td.taskTitre'+tache+' input').val();
        var category = $('td.taskCat'+tache+' input').val();
        var importance = $('td.taskImp'+tache+' select').val();

        $.ajax({
        method: "PUT",
        url: URI,
        contentType: "application/json",
        data: JSON.stringify({ id: tache, titre: titre, cat: category, importance: importance }),
        success: function (response) {
            tableFill();
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
        });
    }

    /**
     * Translates the number of importance into text
     * @param {*} imp Importance of the task (number)
     * @returns String
     */
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

    /**
     * Fills the table with the tasks
     */
    function tableFill() {
        $('#taches').find('tbody').empty();
        $.ajax({
            method: "GET",
            url: URI,
            dataType: "json",
            success: function(data) {
                // Define an empty array to store trs in
                var rows = [];
                

                $.each(data, function(i, tache) {
                    var $tableCell = $('<td>');
                    var modifButton = $('<button>', { 
                        class: 'task button modifier', 
                        text: 'Modifier', 
                        id: tache.id, 
                    }).click(function () {
                        modifier(tache.id);
                    });

                    var supprButton = $('<button>', {
                        class: 'task button supprimer', 
                        text: 'Supprimer', 
                        id: tache.id,
                    }).click(function () {
                        supprimer(tache.id);
                    });

                    const inputTitre = $('<input type="text">').val(tache.titre);
                    
                    const inputCategory = $('<input type="text">').val(tache.cat);
                    
                    //create select box for importance filled options from 1 to 5
                    const selectImp = $('<select />', {
                        html: '<option value="">Veuillez choisir une option</option><option value="1">Très Peu Important</option><option value="2">Peu important</option><option value="3">Important</option><option value="4">Très Important</option><option value="5">URGENT</option>'
                    })
                    selectImp.val(tache.importance);

                    // Build row, and append it to table body
                    const row = $("<tr id='"+tache.id+"'>").append(
                        $("<td class='taskTitre"+tache.id+"''>").append(inputTitre),
                        $("<td class='taskCat"+tache.id+"''>").append(inputCategory),
                        $("<td class='taskImp"+tache.id+"''>").append(selectImp),
                        $("<td>").append(modifButton),
                        $("<td>").append(supprButton),
                    );

                    $("#taches tbody").append(row);
                    });

                // Append all rows to the tbody at once for better performance
                $('#taches').find('tbody').append(rows);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        })
    }
});