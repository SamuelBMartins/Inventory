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
	if (isset($_POST['tipo'])){
	
		include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/db.inc.php';

		try{
			$sql = 'INSERT INTO tipo(`tipo`)
					VALUES (:tipo)';
			$result = $pdo->prepare($sql);
			$result->bindValue(':tipo', $_POST['tipo']);
			$result->execute();
		}catch (PDOException $e){
			$error = 'Errore richiesta dispositivo database.';
			include $_SERVER['DOCUMENT_ROOT'] . $root . '/includes/error.inc.php';
			exit();
		}
		IO::success('Tipo aggiunto.');
	}
IO::menu( 2 );
?>
<div class="login">
<form action="" method="post">
 
  <p>Tipo:</p>
  <input type="text" name="tipo"><br>
   <input type="submit" value="Aggiungi">
</form> </div>

</body>
</html>