// JavaScript Document
jQuery(document).ready(function() {
	"use strict";
	//Crea dei link per le colonne dei dispositivi
	$(".dato").click(function () {
		window.location = $(this).data("href"); //vai al indirizzo indicato nel HTML su href
	});

	//per controllo scansione, permette l'accettazione cliccanto sulla riga
	$(".cont_richiesta").click(function () {
		$(this).children(".richiesta").submit();
	});


	//variabili per icone dei filtri
	var root = '/inventario',
		az = 'az-order.png',
		za = 'za-order.png',
		azpath = root + '/images/' + az,
		zapath = root + '/images/' + za;

	//quando si passa col mouse sull'intestazioni dei campi per filtro
	$("th").children("a").mouseenter(function () {
		var x = $(this).parent().data("id_camp"),
			img = $(this).parent().children("a").children("img");

		//inverte icona, se non c'è l'ha mostra
		if (img.attr('src') === azpath) {
			img.attr('src', zapath);
		} else if (img.attr('src') === zapath) {
			img.attr('src', azpath);
		} else if (img.attr('src') === undefined) { //mostra filtro quando non è attivo 
			$(this).parent().append("<a id=\"added\" href=\"?f=" + x + "&o=1\"><img style=\"opacity: 1;\" align=\"top\" src=\"" + azpath + "\"></a>");
		}
		img.css("opacity", "1");
	});

	//quando si toglie il mouse dall'intestazioni dei campi per filtro
	$("th").children("a").mouseleave(function () {
		var img = $(this).parent().children("a").children("img");

		//inverte icona, se non c'è l'ha mostra
		if (img.attr('src') === azpath) {
			img.attr('src', zapath);
		} else if (img.attr('src') === zapath) {
			img.attr('src', azpath);
		}
		$("#added").remove();
		img.css("opacity", "0.7");
	});

});
