// JavaScript Document
$(function(){
	"use strict";
	
	var errore = $("#errore");
	errore.insertBefore("nav");
	$("#btn").click(function () {
		var err = $("#err");
		err = err.html();
		errore.html(err);
		errore.css("width", "auto");
	});
});