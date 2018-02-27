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

	if ( isset( $_POST[ 'smaltito' ] ) ) //se dispositivo immesso
	{
		$sn = $db->array_sn();
		if ( !empty( $_POST[ 'serial_number' ] ) ) {
			if ( in_array( $_POST[ 'serial_number' ], $sn ) ) {
				$error = 'Il serial number ' . $_POST[ 'serial_number' ] . ' è gia presente nel inventario.';
				IO::error( $error, false );
				goto end;
			}
		}

		if ( empty( $_POST[ 'serial_number' ] ) && empty( $_POST[ 'product_name' ] ) && empty( $_POST[ 'product_number' ] ) && empty( $_POST[ 'etichetta' ] ) ) {
			$error = 'Inserire almeno un valore.';
			IO::error( $error, false );
			goto end;
		}

		$igar = IO::data( $_POST[ 'inizio_garanzia' ] );
		$fgar = IO::data( $_POST[ 'fine_garanzia' ] );


		$id = $db->i_disp( $_POST[ 'serial_number' ], $_POST[ 'product_name' ], $_POST[ 'product_number' ], $igar, $fgar, $_POST[ 'etichetta' ], $_POST[ 'note' ], $_POST[ 'smaltito' ], $_POST[ 'aula' ], $_POST[ 'marca' ], $_POST[ 'tipo' ] );

		for ( $i = 1; $i <= 9; $i++ ) {
			if ( !empty( $_POST[ "macadress$i" ] ) )
				$db->i_mac( $_POST[ "macadress$i" ], $_POST[ "macnote$i" ], $id );
		}

		$str = 'Dispositivo aggiunto <a href="' . $root . '/private/info.php?idpc=' . $id . '">Vedi informazioni dispositivo</a>';
		IO::success($str);
		end:
	}
	echo '<script src="' . $root . '/js/jquery-3.2.1.min.js"></script>';
	echo '<script src="' . $root . '/js/aggiungere.js"></script>';
	IO::menu(2);
	?>
	<form action="" method="post">

		<div class="sinistra_agg">Serial number:</div>
		<input type="text" name="serial_number"><br>

		<div class="sinistra_agg">Product name</div>
		<input type="text" name="product_name"><br>

		<div class="sinistra_agg">product number</div>
		<input type="text" name="product_number"><br>

		<div class="sinistra_agg">inizio garanzia</div>
		<input type="text" name="inizio_garanzia" value="es. 20-03-2017"><br>

		<div class="sinistra_agg">fine garanzia</div>
		<input type="text" name="fine_garanzia" value="es. 20-03-2017"><br>

		<div class="sinistra_agg">etichetta</div>
		<input type="text" name="etichetta"><br>

		<div class="sinistra_agg">note</div>
		<textarea name="note" rows="10" cols="30"></textarea>


		<br>
		<div class="sinistra_agg">Smaltito?</div>
		<input type="radio" name="smaltito" value="1">Si
		<input type="radio" name="smaltito" value="0" checked>No<br>


		<br>
		<div class="sinistra_agg">Aula</div>
		<select name="aula">
			<?php IO::m_tend('aula'); ?>
		</select>

		<br>
		<div class="sinistra_agg">Tipo</div>
		<select name="tipo">
			<?php IO::m_tend('tipo'); ?>
		</select>

		<br>
		<div class="sinistra_agg">Marca</div>
		<select name="marca">
			<?php IO::m_tend('marca'); ?>
		</select>
		<br><br><button type="button" class="piu_mac">+ MAC address</button>
		<div id="macaddr">
			<div class="sinistra_agg">Mac Adress:</div> <input type="text" name="macadress1"><span class="note_agg">note:</span><input type="text" name="macnote1">
		</div>

		<div class="sinistra_agg"><input type="submit" value="Aggiungi Dipositivo">
		</div>
	</form>
</body>

</html>