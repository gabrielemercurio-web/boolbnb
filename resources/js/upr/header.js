$(document).ready(function() {

    // *** Hamburger Menu OPEN e CLOSE + LINK
    // Cliccando sul menu hamburger, si attiva il menu modale e
    // vengono nascoste le sezioni della pagina per evitare che si possa 
    // continuare a scrollare verso il footer con il menu modale attivo
    // e così evitare conseguenti errori e bug di visualizzazione
    $(".open-hamburger-menu").click(function () {
        $("header .container nav .nav-right ul.hamburger-menu").addClass("my-active");
        $('.nav-brand, main, footer').hide();
    });

// Cliccando sulle voci di menu e sulla "X", scompare il menu modale 
// e riappaiono le sezioni della pagina nascoste precedentemente
    $(".close-hamburger-menu, .hamburger-menu .menu-item").click(function() {
        $('.nav-brand, main, footer').show();
        $("header .container nav .nav-right ul.hamburger-menu").removeClass("my-active");
    });

});
