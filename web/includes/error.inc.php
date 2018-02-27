<?php
include_once dirname( __FILE__ ) . '/classi.inc.php';

errhandling( $e, '', '', '' );

echo
	'<div id="err" style="display: none;">' . $e->getMessage() . '</div>
	<div id="errore" class="bar-error">' . $error .
		' <button id="btn">Dettagli</button>
	</div><br>';

echo '<script src="' . $GLOBALS['root'] . '/js/jquery-3.2.1.min.js"></script>';
echo '<script src="' . $GLOBALS['root'] . '/js/error.js"></script>';
?>