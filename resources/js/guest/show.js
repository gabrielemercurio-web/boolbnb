$(document).ready(function() {

    //Slider con immagini House che scorrono cliccando sulle freccie
    // intercettare il click sulla classe .prev
    $("#slider .prev").click(function() {
        // intercettare l'immagine con la classe .visible
        var img_corrente = $("img.visible");
        var pallino_corrente = $(
            ".fa-circle.visible"
        );

        // rimuovo la classe .visible all'img corrente
        img_corrente.removeClass("visible");
        pallino_corrente.removeClass("visible");

        // intercettare l'immagine successiva
        var img_precedente = img_corrente.prev(
            "img"
        );
        var pallino_precedente = pallino_corrente.prev(
            ".fa-circle"
        );
        // aggiungo la classe .visible a img_successiva
        // Se img_successiva è l'ultima si ricomincia da capo
        if (img_precedente.length != 0) {
            img_precedente.addClass("visible");
            pallino_precedente.addClass("visible");
        } else {
            img_precedente = $("img:last-of-type");
            img_precedente.addClass("visible");
            $(".fa-circle:last-child").addClass(
                "visible"
            );
        }
    });

    // intercettare il click sulla classe .next
    $("#slider .next").click(function() {
        // intercettare l'immagine con la classe .visible
        var img_corrente = $("img.visible");
        var pallino_corrente = $(
            ".fa-circle.visible"
        );

        // rimuovo la classe .visible all'img corrente
        img_corrente.removeClass("visible");
        pallino_corrente.removeClass("visible");

        // intercettare l'immagine successiva
        var img_successiva = img_corrente.next(
            "img"
        );
        var pallino_successivo = pallino_corrente.next(
            ".fa-circle"
        );

        // aggiungo la classe .visible a img_successiva
        // Se img_successiva è l'ultima si ricomincia da capo
        if (img_successiva.length != 0) {
            img_successiva.addClass("visible");
            pallino_successivo.addClass("visible");
        } else {
            img_successiva = $("img:first-of-type");
            img_successiva.addClass("visible");
            $(".fa-circle:first-child").addClass(
                "visible"
            );
        }
    });

    // Click sul bullet per selezionale la slide relativa
    $(".bullets .fa-circle").click(function() {
        // recupero l'immagine corrente
        var immagine_corrente = $("img.visible");

        // recupero il pallino corrente
        var pallino_corrente = $(
            ".fa-circle.visible"
        );

        // Elimino la classe visible all'immagine corrente
        immagine_corrente.removeClass("visible");

        // Elimino la classe visible al pallino corrente
        pallino_corrente.removeClass("visible");

        // Aggiungo la classe visible al pallino su cui l'utente ha cliccato
        $(this).addClass("visible");

        // Recupero l'immagine corrispondente al pallino su cui l'utente ha cliccato
        // Recupero la posizione del pallino su cui l'utente ha cliccato
        var posizione = $(this).index();

        // Recupero l'immagine con la stessa posizione del pallino
        var nuova_immagine = $(".images img").eq(
            posizione
        );

        // Aggiungo la classe visible all'immagine recuperata
        nuova_immagine.addClass("visible");
    });
});


