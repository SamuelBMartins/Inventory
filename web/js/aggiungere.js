// JavaScript Document
$(function () {
	"use strict";

	var x = 1;
	$(".piu_mac").click(function () {
		var macadd = $("#macaddr");
		x += 1;
		macadd.append('<br><div class="sinistra_agg">Mac Adress:</div> <input type="text" name="macadress' + x + '"><span class="note_agg">note:</span><input type="text" name="macnote' + x + '">');
	});
});
