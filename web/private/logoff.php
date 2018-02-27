<!DOCTYPE html>
<?php 
include_once dirname(__FILE__) . '/../includes/classi.inc.php';
IO::start();
?>
<html>

<?php IO::head(); ?>

<body>
	<?php
	if ( isset( $_SESSION[ 'password' ] ) ) {
		unset( $_SESSION[ 'password' ] );
		IO::success( 'Ti sei disconnesso' );
	} else {
		if ( !isset( $_POST[ 'password' ] ) )
			IO::error( 'Non sei connesso', false );
	}
	include $_SERVER[ 'DOCUMENT_ROOT' ] . $root . '/index.php';

	?>
</body>

</html>