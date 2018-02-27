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
	if ( isset( $_FILES[ 'csv' ] ) ) {
		$csv = new CSV();
		if ( $csv->carica( $_FILES[ 'csv' ][ 'tmp_name' ] ) ) {
			$str = 'File caricato con successo';
			IO::success( $str );
		}
	}
	IO::menu( 1 );
	?>
	<form enctype="multipart/form-data" method="post" id="uploadForm" action="">
		<input name="csv" id="upload" type="file" accept=".csv"/>
		<input type="submit" value="carica"/>
	</form>
	<p>Attenzione questo cancellera tutti i dati attualmente presenti nell'inventario.</p>
</body>

</html>