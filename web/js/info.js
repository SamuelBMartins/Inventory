// JavaScript Document
	var y = 1;

	function modmac(x) {
		var modifica = document.getElementById("macmodifica" + x);
		var campo_valore = document.getElementById("maccampo_valore" + x);
		var valore = campo_valore.textContent;
		campo_valore.innerHTML = '<input type="text" name="macadress" value="' + valore + '">';
		var campo_note = document.getElementById("campo_note" + x);
		var note = campo_note.textContent;
		campo_note.innerHTML = '<input type="text" name="valore" value="' + note + '">';
		modifica.innerHTML = '<input type="submit" value="Invia modifica">';
	}

	function addmac() {
		var macadd = document.getElementById("macaddr");
		y = y + 1;
		macadd.insertAdjacentHTML('beforeend', '<div class="clear"></div><div class="sinistra_agg">Mac Address:</div> <div class="sinistra_info"><input type="text" name="macadress' + y + '"></div><div class="note_info">note:</div><div class="sinistra_info"><input type="text" name="macnote' + y + '"></div>');
	}

	function modifica(x) {
		var modifica = document.getElementById("modifica" + x);
		var campo_valore = document.getElementById("campo_valore" + x);
		var valore = campo_valore.textContent;
		campo_valore.innerHTML = '<input type="text" name="valore" value="' + valore + '">';
		modifica.innerHTML = '<input type="submit" value="Invia modifica">';
	}
