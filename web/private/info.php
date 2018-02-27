<!DOCTYPE html>
<?php 
include_once dirname(__FILE__) . '/../includes/classi.inc.php';
IO::start();
IO::check();
?>
<html>

<?php IO::head(); ?>

<body>

	<?php 
$db = new DB();
if (isset($_GET['idpc'])){
	$id = $_GET['idpc'];
	
	$row = $db->r_disp4info($id);
}
if (!isset($id)){
	IO::error('Nessun dispositivo dichiarato' , false);
	IO::menu(10);
	exit();
}


//aggiornamento campi semplici
if (isset($_POST['campo'])){
	$db->update($id, $_POST['campo'], $_POST['valore']);
	$str = 'aggiornato campo ' . $_POST['campo'] . '.';	
	IO::success($str);
}

//aggiornamento mac adress
if (isset($_POST['idmac'])){
	$db->update_mac($_POST['idmac'], $_POST['macadress'], $_POST['valore']);
	IO::success('MacAddress aggiornato');
}

//aggiunta mac address
for ($i = 1; $i <= 9; $i++) {
	if (!empty($_POST["macadress$i"])){
		$db->i_mac($_POST["macadress$i"], $_POST["macnote$i"], $row['idDispositivi']);
		$x = '1';
	}
}
if (isset($x))
	IO::success('Aggiunto/i MacAddress');
$row = $db->r_disp4info($id);
IO::menu(1);
//campi per mostrare dati
$campi = array('serial_number', 
			   'product_name', 
			   'product_number',
			   'inizio_garanzia',
			   'fine_garanzia',
			   'etichetta',
			   'note',
			   'smaltito',
			   'Aula_idAula',
			   'Marca_idMarca',
			   'Tipo_idTipo');

$nomi = array('Serial number',
			  'Product name',
			  'Product number',
			  'Inizio garanzia',
			  'Fine garanzia',
			  'Etichetta',
		  	  'Note',
			  'Smaltito',
			  'Aula',
			  'Marca',
			  'Tipo');

//mostrare dati
for ($i=0; $i<count($campi); $i++){
	//elenco tendina tipo
	if ($campi[$i]=='Tipo_idTipo'){
		$var=1;
		//mostrare il valore attuale
		$tipo = $db->r_array("tipo");
		
		echo '<form action="" method="post">
				<div class="sinistra_agg">' .$nomi[$i].'</div>
				<input type="hidden" name="campo" value="' .$campi[$i].'">
				<div class="sinistra_info"><select name="valore">
				<option value="' . $row['Tipo_idTipo'] .'">'.$tipo[$row['Tipo_idTipo']].'</option>';
		unset($tipo[$row['Tipo_idTipo']]);
		$opit = array_flip($tipo);
		foreach ($tipo as $tip){
			echo '<option value="' . $opit[$tip] . '">' . $tip . '</option>';
		}
		echo '</select></div>
				<input type="submit" value="Invia modifiche">
				</form><br>';
	}
	
	
	if ($campi[$i]=='Marca_idMarca'){
		$var=1;
		//mostrare il valore attuale
		$marca = $db->r_array("marca");
		
		echo '<form action="" method="post">
				<div class="sinistra_agg">' .$nomi[$i].'</div>
				<input type="hidden" name="campo" value="' .$campi[$i].'">
				<div class="sinistra_info"><select name="valore">
				<option value="' . $row['Marca_idMarca'] .'">'.$marca[$row['Marca_idMarca']].'</option>';
		unset($marca[$row['Marca_idMarca']]);
		$acram = array_flip($marca);
		foreach ($marca as $marc){
			echo '<option value="' . $acram[$marc] . '">' . $marc . '</option>';
		}
		echo '</select></div>
				<input type="submit" value="Invia modifiche">
				</form><br>';
	}
	
	
	
	if ($campi[$i]=='Aula_idAula'){
		$var=1;
		//mostrare il valore attuale
		$aula = $db->r_array("aula");
		
		echo '<form action="" method="post">
				<div class="sinistra_agg">' .$nomi[$i].'</div>
				<input type="hidden" name="campo" value="' .$campi[$i].'">
				<div class="sinistra_info"><select name="valore">
				<option value="' . $row['Aula_idAula'] .'">'.$aula[$row['Aula_idAula']].'</option>';
		unset($aula[$row['Aula_idAula']]);
		$alua = array_flip($aula);
		foreach ($aula as $aul){
			echo '<option value="' . $alua[$aul] . '">' . $aul . '</option>';
		}
		echo '</select></div>
				<input type="submit" value="Invia modifiche">
				</form><br>';
	}
	
	
	if ($campi[$i]=='smaltito'){
		$var = 1;
		echo '<form action="" method="post">
		<div class="sinistra_agg">' .$nomi[$i].'</div>
				<input type="hidden" name="campo" value="' .$campi[$i].'">
	 			
					 <div class="sinistra_info"><select name="valore">';
		if ($row['smaltito']=='0'){
			echo '<option selected="selected" value="0">Non Smaltito</option>
				 <option value="1">Smaltito</option>';
		}else{
			echo '<option selected="selected" value="1">Smaltito</option>
				  <option value="0">Non Smaltito</option>';
			}
			echo '</select></div>
				
					<input type="submit" value="Invia modifica">
				
	  </form><br>';
	}if(!isset($var)){
	
	echo '<form action="" method="post">
		<div class="sinistra_agg">' .$nomi[$i].'</div>
				<input type="hidden" name="campo" value="' .$campi[$i].'">
	 			
					<div class="sinistra_info"><div id="campo_valore'.$i.'">' . $row[$campi[$i]] . '</div></div>
				
					<div id="modifica'.$i.'">
						<button onclick="modifica('.$i.')">modifica</button>
					</div>
				
	  </form><br>';
	}
}


echo '<div class="sinistra_agg"><button onclick="addmac()">+ MAC address</button></div><div class="clear"></div>';
		if (isset($row['macadress'])){
			$result = $db->r_mac($row['idDispositivi']);
foreach ($result as $index => $mac){
	$index = $index +1;
	echo '<form action="" method="post">
		<div class="sinistra_agg">Mac Address:</div>
				<div class="sinistra_info"><div id="maccampo_valore'.$index.'">'.$mac[0].'</div></div>
				<input type="hidden" name="idmac" value="'.$mac[2].'">
	 			<div class="note_info" left;">Note:</div>
					<div class="sinistra_info"><div id="campo_note'.$index.'">' . $mac[1] . '</div></div>		
					<div id="macmodifica'.$index.'">
						<button onclick="modmac('.$index.')">modifica</button>
					</div>
	  </form>';
}
}

?>
<br>
	<form action="" method="post">

		<div id="macaddr">
			<div class="sinistra_agg">Mac Address:</div>
			<div class="sinistra_info"><input type="text" name="macadress1">
			</div>
			<div class="note_info">note:</div>
			<div class="sinistra_info"><input type="text" name="macnote1">
			</div>
		</div>


		<br><br>
		<input type="submit" value="Aggiungi Mac Address">
	</form>
	<br><br>
	<?php
	include_once $_SERVER[ 'DOCUMENT_ROOT' ] . $root . '/includes/classi.inc.php';
	QR::online( $_GET[ 'idpc' ], '300' );

	$db = new DB();
	$row = $db->r_1disp( $_GET[ 'idpc' ] );
	QR::offline( $row, '300' );
	echo '<script src="' . $root . '/js/jquery-3.2.1.min.js"></script>';
	echo '<script src="' . $root . '/js/info.js"></script>';
	?>
</body>

</html>