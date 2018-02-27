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
	if ( isset( $_POST[ 'id' ] ) ) {
		$db = new DB();
		$db->consenti( $_POST[ 'id' ] );
		IO::success( 'Dispositivo consentito' );
	}
	IO::menu( 0 );
	//$data = date("Y-m-d", strtotime( '-1 days' ));
	$data = '"' . date( "Y-m-d" ) . '"';

	$table = new table();
	
	$sql = 'SELECT COUNT(RichiesteScan.idRichiesteScan) as rows
			FROM RichiesteScan 
			LEFT JOIN Consentiti
				ON idRichiesteScan = RichiesteScan_idRichiesteScan 
			WHERE RichiesteScan_idRichiesteScan IS NULL
				AND RichiesteScan.data > "2017-07-20"';
	$table->nrow( $sql );
	
	$fields = array( 'Nome e cognome',
		'Chiave',
		'IP',
		'Versione browser',
		'Data richiesta' );
	$table->header( $fields );
	$dati = array( 'nome_cognome',
		'"key"',
		'ip',
		'versione_software',
		'data' );
	$table->setdati( $dati );
	$sql = 'SELECT 
			r.idRichiesteScan, 
			r.key, 
			r.data, 
			r.nome_cognome, 
			r.versione_software, 
			r.ip 
		FROM RichiesteScan AS r 
		LEFT JOIN Consentiti as c
			ON r.idRichiesteScan = c.RichiesteScan_idRichiesteScan 
		WHERE c.RichiesteScan_idRichiesteScan IS NULL
			AND r.data > ' . $data;
	$table->query( $sql );
	

	$table->popola_cons();
	$table->end();

	?>
</body>

</html>