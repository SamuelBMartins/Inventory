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
	$csv = new CSV();
	$csv->scarica();

	header("location: $root/downloads/inventario.csv")
	?>
</body>

</html>