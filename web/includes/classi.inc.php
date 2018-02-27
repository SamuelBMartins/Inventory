<?php
$root = '/inventario';
function errhandling($errno, $errstr, $errfile, $errline) {
	$data = date("d-m-Y G:i:s");
	
	if (empty($errfile))
		error_log("Errore: $errno\ndata: $data\n_______________________________\n", 3, $_SERVER['DOCUMENT_ROOT'] . $GLOBALS["root"] . '/log/errors_db.log');
	else
		error_log("Errore numero:$errno | Errore: $errstr | File:$errfile | Riga:$errline | Data: $data\n", 3, $_SERVER['DOCUMENT_ROOT'] . $GLOBALS["root"] . '/log/errors.log');
}
set_error_handler("errhandling");


class IO
{
	static function start()//avvia session
	{
		if(!isset($_SESSION))
		{
			session_start();
		}
	}
	
	static function check()//controlla se è autenticato
	{
		global $_SESSION, $root;
		if (!isset($_SESSION['password']) or $_SESSION['data'] < date('Y-m-d')){
			SELF::error('Accesso negato', false);
			include $_SERVER[ 'DOCUMENT_ROOT' ] . $GLOBALS['root'] . '/index.php';
			exit();
		}
	}
	
	static function head()//genera head HTML pagine
	{
		echo
			'<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<title>Inventario</title>
				<link rel="stylesheet" href="' . $GLOBALS['root'] . '/stili/stili.css">
				<link rel="stylesheet" href="' . $GLOBALS['root'] . '/stili/menu.css">
				<link rel="stylesheet" href="' . $GLOBALS['root'] . '/stili/table.css">
				<link rel="stylesheet" href="' . $GLOBALS['root'] . '/stili/stampa.css">
				<link rel="stylesheet" href="' . $GLOBALS['root'] . '/stili/pr_stampa.css" media="print">
				<link rel="stylesheet" href="' . $GLOBALS['root'] . '/stili/aggiungere.css">
			</head>';
	}
	
	static function menu($active)//mostra menu
	{
		global $_SESSION;
		if (isset($_SESSION['password']) and $_SESSION['data'] >= date('Y-m-d')){

			$voci = array('Controllo',
						 'Dispositivi',
						 'Aggiungi',
						 'Ricerca',
						 'Disconnetti');
			
			$path = array('#',
						 '#',
						 '#',
						 '/private/ricerca.php',
						 '/private/logoff.php');
			
			echo'<nav><ul>';
			foreach ($voci as $i => $voce){
				if ($i == $active)
					$sel = 'active';
				else
					$sel = '';
				
				switch($voce){
					case "Controllo":
						echo 
							'<li class="dropdown ' . $sel . '">
    							<a href="javascript:void(0)">' . $voce . '</a>
								<div>
     		 						<a href="' . $GLOBALS['root'] . '/private/consenti.php">Richieste</a>
      								<a href="' . $GLOBALS['root'] . '/private/lista.php">Dispositivi da controllare</a>
    							</div>
  							</li>';
						break;
					case "Dispositivi":
						echo 
							'<li class="dropdown ' . $sel . '">
    							<a href="javascript:void(0)">' . $voce . '</a>
								<div>
     		 						<a href="' . $GLOBALS['root'] . '/private/esporta.php">Esporta</a>
      								<a href="' . $GLOBALS['root'] . '/private/importa.php">Importa</a>
									<a href="' . $GLOBALS['root'] . '/private/stampa.php">Stampa</a>
    							</div>
  							</li>';
						break;
					case "Aggiungi":
						echo 
							'<li class="dropdown ' . $sel . '">
    							<a href="javascript:void(0)">' . $voce . '</a>
								<div>
     		 						<a href="' . $GLOBALS['root'] . '/private/aggiungere.php">Dispositivo</a>
      								<a href="' . $GLOBALS['root'] . '/private/tipo.php">Tipo</a>
									<a href="' . $GLOBALS['root'] . '/private/marca.php">Marca</a>
    							</div>
  							</li>';
						break;
					default:
						echo '<li class="' . $sel . '"><a href="' . $GLOBALS['root'] . $path[$i] . '">' . $voce . '</a></li>';
				}
				
			}

			echo '</ul></nav><br>';
		}else{

			echo
				'<nav><ul>
    				<li class="active"><a href="' . $GLOBALS['root'] . '/index.php">Login</a></div>
				</ul></nav><br>';
		}
	}
	
	static function error($str, $exit = true)//mostra errore
	{
		echo '<div class="bar-error">' . $str . '</div>';
		if ($exit == true)
			exit();
	}
	
	static function success($str)//mostra errore
	{
		echo '<div class="bar-verde">' . $str . '</div>';
	}
	
	static function key()//genera footprint dispositivo utente
	{
		$key = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . date('Y-m-d'));
		return $key;
	}
	
	static function data($data)//riscrive correttamente data
	{
		$data = date("Y-m-d", strtotime($data));
		if ($data == "1970-01-01")
			unset($data);
		return $data;
	}
	
	static function m_tend($table)//genera menu tendina per tipo marca aula
	{
		$db = new DB();
		$result = $db->r_array($table);
		for($i=0;$i<=count($result);$i++){
			if (isset($result[$i]))
				echo '<option value="' . $i . '">' . $result[$i] . '</option>';
  		}
	}
	
	static function camp_ricerca($campo)//aggiunge '%' a una variabile per le ricerche sul DB
	{
		$return = '%' . str_replace(' ', '%', $campo) . '%';
		return $return;
	}
}

class DB
{
	protected
		$pdo = '',
		$sql4table = '',
		$sql4count = '';
	
	public function __construct()//crea connesione DB
	{
		try{
			$pdo = new PDO('mysql:host=localhost;dbname=nren_inventario', 'root', '');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->exec('SET NAMES "utf8"');
		}catch (PDOException $e){
			$error = 'Impossibile connettersi al server di database.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		$this->pdo = $pdo;//salva connessione nella variabile verra poi richiamata da tutte le funzioni
	}
	
	public function getsql()//ritorna la variabile sql
	{
		return $this->sql4table;
	}
	
	public function getsql4count()//ritorna la variabile sql
	{
		return $this->sql4count;
	}
	
	public function password()//recupera password
	{
		try{
			$sql = 'SELECT *
					FROM accesso 
					WHERE idAccesso = 1';
			$result = $this->pdo->query($sql);
		}catch (PDOException $e){
			$error = 'Errore recupero informazioni.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		$row = $result->fetch();
		return $row;
	}
	
	public function accessi($id)//registra accesso sul DB
	{
		try {
			$sql = 'INSERT INTO Registro_accessi(`data`, `Accesso_idAccesso`)
					VALUES (NOW(), :id)';
			$result = $this->pdo->prepare( $sql );
			$result->bindValue( ':id', $id, PDO::PARAM_INT );
			$result->execute();
		} catch ( PDOException $e ) {
			$error = 'Errore accesso.';
			include $_SERVER[ 'DOCUMENT_ROOT' ] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
	}
	
	public function contr_scan($key)//controllo se utente ha la possibilita di scansionare
	{
		try{
			$sql = 'SELECT 
						RichiesteScan.key, 
						Consentiti.idConsentiti 
					FROM richiestescan 
					INNER JOIN consentiti 
						ON idRichiesteScan = RichiesteScan_IdRichiesteScan
							AND RichiesteScan.key = :key';
			$result = $this->pdo->prepare($sql);
			$result->bindValue(':key', $key, PDO::PARAM_STR);
			$result->execute();
		}catch (PDOException $e){
			$error = 'Errore controllo accesso.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		$accesso = $result->fetch();
		
		return $accesso['idConsentiti'];
	}
	
	public function agg_contr($idDispositivi, $idConsentiti)//aggiorna ultimo controllo dispoditivo
	{
		try{
			$sql = 'INSERT INTO controllo SET
					data = NOW(),
					Dispositivi_idDispositivi = :idDispositivi,
					Consentiti_idConsentiti = :idConsentiti';
			$result = $this->pdo->prepare($sql);
			$result->bindValue(':idDispositivi', $idDispositivi, PDO::PARAM_INT);
			$result->bindValue(':idConsentiti', $idConsentiti, PDO::PARAM_INT);
			$result->execute();
		}catch (PDOException $e){
			$error = 'Errore aggiornamento dispositivo.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
	}
	
	public function i_rscan($nome, $key)//inserisce richeista scan nel DB
	{
		try{
			$sql = 'INSERT INTO `RichiesteScan`(
						`key`,
						`data`,
						`nome_cognome`,
						`versione_software`,
						`ip`) 
					VALUES (:key,NOW(),:nome_cognome,:v_software,:ip)';	
			$result = $this->pdo->prepare($sql);
			$result->bindValue(':nome_cognome', $nome, PDO::PARAM_STR);
			$result->bindValue(':key', $key, PDO::PARAM_STR);
			$result->bindValue(':v_software', $_SERVER['HTTP_USER_AGENT'], PDO::PARAM_STR);
			$result->bindValue(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
			$result->execute();
		}catch (PDOException $e){
			$error = 'Errore richiesta.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
	}
	
	public function consenti($id)//Consente richiesta scansione
	{
		try {
			$sql = 'INSERT INTO `Consentiti`(`data`, `RichiesteScan_idRichiesteScan`)
			VALUES (NOW(),:id)';
			$result = $this->pdo->prepare( $sql );
			$result->bindValue( ':id', $id );
			$result->execute();
		} catch ( PDOException $e ) {
			$error = 'Errore richiesta dispositivo database.';
			include $_SERVER[ 'DOCUMENT_ROOT' ] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
	}
	
	public function r_array($tabella)//recupera array contenente tutti i valori delle prime due colonne di una tabella (es. marca, tipo, aula)
	{
		if (!isset($tipo)){//evitare richieste inutili
			$tabella = addslashes($tabella);
		
			try{
				$sql = 'SELECT *
						FROM ' . $tabella;
				$result = $this->pdo->query($sql);
			}catch (PDOException $e){
				$error = 'Errore recupero informazioni.';
				include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
				exit();
			}
		
			foreach ($result as $row)
				$tipo[$row[0]] = $row[1]; //array con indice id e valore il dato
		}
		return $tipo;
	}
	
	public function r_1disp($id)//recupero info singolo dispositivo
	{
		try{
			$sql = 'SELECT 
						d.idDispositivi,
						d.serial_number,
						d.product_name,
						d.product_number,
						d.inizio_garanzia,
						d.fine_garanzia,
						d.etichetta,
						d.note,
						d.smaltito,
						a.aula,
						t.tipo,
						m.marca,
						mac.macadress
					FROM dispositivi AS d 
					INNER JOIN aula AS a 
						ON d.Aula_idAula = a.idAula
					INNER JOIN tipo AS t
						ON d.Tipo_idTipo = t.idTipo
					INNER JOIN marca AS m
						ON d.Marca_idMarca = m.idMarca
					LEFT JOIN macadress AS mac
						ON d.idDispositivi = mac.dispositivi_idDispositivi
					WHERE d.idDispositivi = :id';
			$result = $this->pdo->prepare($sql);
			$result->bindValue(':id', $id, PDO::PARAM_INT);
			$result->execute();
		}catch (PDOException $e){
			$error = 'Errore recupero informazioni.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		$row = $result->fetch();
		return $row;
	}
	
	public function r_disp4info($id)//recupera info dispositivo per info.php
	{
		try{
			$sql = 'SELECT 
						d.idDispositivi,
						d.serial_number,
						d.product_name,
						d.product_number,
						d.inizio_garanzia,
						d.fine_garanzia,
						d.etichetta,
						d.note,
						d.smaltito,
						d.Aula_idAula,
						d.Tipo_idTipo,
						d.Marca_idMarca,
						mac.macadress
					FROM dispositivi AS d 
					LEFT JOIN MacAdress AS mac
						ON d.idDispositivi = mac.dispositivi_idDispositivi
					WHERE d.idDispositivi = :id';
			$result = $this->pdo->prepare($sql);
			$result->bindValue(':id', $id, PDO::PARAM_INT);
			$result->execute();
		}catch (PDOException $e){
			$error = 'Errore recupero informazioni.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		$row = $result->fetch();
		return $row;
	}
	
	public function r_disp()//recupero info di tutti i dispositivi
	{
		try{
			$sql = 'SELECT 
						d.idDispositivi,
						d.serial_number,
						d.product_name,
						d.product_number,
						d.inizio_garanzia,
						d.fine_garanzia,
						d.etichetta,
						d.note,
						a.aula,
						t.tipo,
						m.marca,
						mac.macadress
					FROM dispositivi AS d 
					INNER JOIN aula AS a 
						ON d.Aula_idAula = a.idAula
					INNER JOIN tipo AS t
						ON d.Tipo_idTipo = t.idTipo
					INNER JOIN marca AS m
						ON d.Marca_idMarca = m.idMarca
					LEFT JOIN macadress AS mac
						ON d.idDispositivi = mac.dispositivi_idDispositivi
					ORDER BY a.aula';
			$result = $this->pdo->query($sql);
		}catch (PDOException $e){
			$error = 'Errore recupero informazioni.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		return $result;
	}
	
	protected function r_disp_no_mac()//recupero info di tutti i dispositivi senza macaddress
	{
		try{
			$sql = 'SELECT 
						d.idDispositivi,
						d.serial_number,
						d.product_name,
						d.product_number,
						d.inizio_garanzia,
						d.fine_garanzia,
						d.etichetta,
						d.note,
						d.smaltito,
						a.aula,
						t.tipo,
						m.marca,
						mac.macadress
					FROM dispositivi AS d 
					INNER JOIN aula AS a 
						ON d.Aula_idAula = a.idAula
					INNER JOIN tipo AS t
						ON d.Tipo_idTipo = t.idTipo
					INNER JOIN marca AS m
						ON d.Marca_idMarca = m.idMarca
					LEFT JOIN macadress AS mac
						ON d.idDispositivi = mac.dispositivi_idDispositivi
					WHERE mac.macadress IS NULL
						OR mac.macadress = ""
					ORDER BY a.aula';
			$result = $this->pdo->query($sql);
		}catch (PDOException $e){
			$error = 'Errore recupero informazioni.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		return $result;
	}
	
	protected function r_dispmac()//recupero di tutti i dispositivi che hanno un mac address
	{
		try{
			$sql = 'SELECT dispositivi_idDispositivi
					FROM macadress
					GROUP BY dispositivi_idDispositivi';
			$result = $this->pdo->query($sql);
		}catch (PDOException $e){
			$error = 'Errore recupero informazioni.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		return $result;
	}
	
	public function r_mac($id)//recupero di tutti i MAC address di un dispositivo
	{	
		try{
			$sql = 'SELECT 
						idMacAdress,
						macadress,
						note
					FROM macadress
					WHERE dispositivi_idDispositivi = :id';
			$result = $this->pdo->prepare($sql);
			$result->bindValue(':id', $id, PDO::PARAM_INT);
			$result->execute();
		}catch (PDOException $e){
			$error = 'Errore recupero informazioni.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		
		$mac = array();
		
		foreach ($result as $i => $row){//salva in un array mac e note
			$mac[$i][] = $row['macadress'];
			$mac[$i][] = $row['note'];
			$mac[$i][] = $row['idMacAdress'];
		}
		
		return $mac;
	}
	
	public function array_sn()//crea un array contenente tutti i serial number del DB
	{
		try{
			$sql = 'SELECT serial_number
					FROM dispositivi';
			$result = $this->pdo->query($sql);
		}catch (PDOException $e){
			$error = 'Errore recupero informazioni.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		
		foreach ($result as $row)
			$sn[] = $row['serial_number'];
		
		return $sn;
	}
	
	protected function array_sn_double()//crea un array contenente tutti i serial number dei dispositivi doppi
	{
		try{
			$sql = 'SELECT serial_number, COUNT(*)
					FROM dispositivi
					GROUP BY serial_number
					HAVING COUNT(*) > 1';
			$result = $this->pdo->query($sql);
		}catch (PDOException $e){
			$error = 'Errore recupero informazioni.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		
		foreach ($result as $row)
			$sn[] = $row['serial_number'];
		
		return $sn;
	}
	
	public function i_disp($serial_number, $product_name, $product_number, $inizio_garanzia, $fine_garanzia, $etichetta, $note, $smaltito, $Aula_idAula, $Marca_idMarca, $Tipo_idTipo)//inserisci dispositivo
	{
		try{
			$sql = 'INSERT INTO Dispositivi (
						serial_number,
						product_name,
						product_number,
						inizio_garanzia,
						fine_garanzia,
						etichetta,
						note,
						smaltito,
						Aula_idAula,
						Marca_idMarca,
						Tipo_idTipo) 
					VALUES (
						:serial_number, 
						:product_name, 
						:product_number, 
						:inizio_garanzia, 
						:fine_garanzia, 
						:etichetta, 
						:note, 
						:smaltito, 
						:Aula_idAula, 
						:Marca_idMarca, 
						:Tipo_idTipo)';
			$result = $this->pdo->prepare($sql);
			$result->bindValue(':serial_number', $serial_number, PDO::PARAM_STR);
			$result->bindValue(':product_name', $product_name, PDO::PARAM_STR);
			$result->bindValue(':product_number', $product_number, PDO::PARAM_STR);
			$result->bindValue(':inizio_garanzia', $inizio_garanzia, PDO::PARAM_STR);
			$result->bindValue(':fine_garanzia', $fine_garanzia, PDO::PARAM_STR);
			$result->bindValue(':etichetta', $etichetta, PDO::PARAM_STR);
			$result->bindValue(':note', $note, PDO::PARAM_STR);
			$result->bindValue(':smaltito', $smaltito, PDO::PARAM_INT);
			$result->bindValue(':Aula_idAula', $Aula_idAula, PDO::PARAM_INT);
			$result->bindValue(':Marca_idMarca', $Marca_idMarca, PDO::PARAM_INT);
			$result->bindValue(':Tipo_idTipo', $Tipo_idTipo, PDO::PARAM_INT);
			$result->execute();
			$id = $this->pdo->lastInsertId();
		}catch (PDOException $e){
			$error = 'Errore inserimento dati.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		return $id;
	}
	
	public function i_mac($MACaddress, $note, $id)//inserisci mac address
	{
		try{
			$sql = 'INSERT INTO MacAdress (
						macadress,
						note,
						dispositivi_idDispositivi
					) 
					VALUES (
						:macadress, 
						:note, 
						:id
					)';
			$result = $this->pdo->prepare($sql);
			$result->bindValue(':macadress', $MACaddress, PDO::PARAM_STR);
			$result->bindValue(':note', $note, PDO::PARAM_STR);
			$result->bindValue(':id', $id, PDO::PARAM_INT);
			$result->execute();
			$id = $this->pdo->lastInsertId();
		}catch (PDOException $e){
			$error = 'Errore inserimento dati.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		return $id;
	}
	
	public function update($id, $campo, $valore)//aggiorna un campo di un dispoditivo
	{
		try{
			$sql = 'UPDATE Dispositivi SET '.$campo.'=:valore
					WHERE idDispositivi = :id';
			$result = $this->pdo->prepare($sql);
			$result->bindValue(':id', $id, PDO::PARAM_INT);
			$result->bindValue(':valore', $valore, PDO::PARAM_STR);
			$result->execute();
		}catch (PDOException $e){
			$error = 'Errore aggiornamento dati.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
	}
	
	public function update_mac($id, $macaddress, $note)//aggiorna mac address
	{
		try{
			$sql = 'UPDATE MacAdress SET note=:note, macadress=:mac
					WHERE idMacAdress = :id';
			$result = $this->pdo->prepare($sql);
			$result->bindValue(':id', $id, PDO::PARAM_INT);
			$result->bindValue(':note', $note, PDO::PARAM_STR);
			$result->bindValue(':mac', $macaddress, PDO::PARAM_STR);
			$result->execute();
		}catch (PDOException $e){
			$error = 'Errore aggiornamento dati.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
	}
	
	protected function rm_disp()//elimina tutti i dati nella tabella dispositivi
	{
		try{
			$sql = 'DELETE FROM dispositivi';
			$result = $this->pdo->query($sql);
		}catch (PDOException $e){
			$error = 'Errore recupero informazioni.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
	}
	
	//i seguenti non fanno richieste al DB
	public function controllo($data)//recupera tutti i dispositivi non scansionati dopo $data
	{
		$sql = 'SELECT 
					d.idDispositivi,
					d.serial_number,
					d.product_name,
					d.product_number,
					d.inizio_garanzia,
					d.fine_garanzia,
					d.etichetta,
					d.note,
					d.smaltito,
					a.aula,
					t.tipo,
					m.marca
				FROM dispositivi AS d 
				INNER JOIN aula AS a 
					ON d.Aula_idAula = a.idAula
				INNER JOIN tipo AS t
					ON d.Tipo_idTipo = t.idTipo
				INNER JOIN marca AS m
					ON d.Marca_idMarca = m.idMarca
				LEFT JOIN controllo AS c
					ON d.idDispositivi = c.Dispositivi_idDispositivi
				WHERE c.data < "' . $data . '" 
					OR c.data IS NULL';
		$this->sql4table = $sql;
		
		$this->sql4count = 'SELECT count(d.idDispositivi) AS rows
					FROM dispositivi AS d 
					INNER JOIN aula AS a 
						ON d.Aula_idAula = a.idAula
					INNER JOIN tipo AS t
						ON d.Tipo_idTipo = t.idTipo
					INNER JOIN marca AS m
						ON d.Marca_idMarca = m.idMarca
					LEFT JOIN controllo AS c
						ON d.idDispositivi = c.Dispositivi_idDispositivi
					WHERE c.data < "' . $data . '"
						OR c.data IS NULL';
		
		return $this->sql4table;
	}
	
	public function ricerca($str)//ricerca semplice
	{
		$str = addslashes($str);
		$sql = 'SELECT 
					d.idDispositivi,
					d.serial_number,
					d.product_name,
					d.product_number,
					d.inizio_garanzia,
					d.fine_garanzia,
					d.etichetta,
					d.note,
					d.smaltito,
					a.aula,
					m.marca,
					t.tipo,
					mac.macadress
				FROM dispositivi AS d 
				INNER JOIN aula AS a 
					ON d.Aula_idAula = a.idAula
				INNER JOIN tipo AS t
					ON d.Tipo_idTipo = t.idTipo
				INNER JOIN marca AS m
					ON d.Marca_idMarca = m.idMarca
				LEFT JOIN macadress AS mac
					ON d.idDispositivi = mac.dispositivi_idDispositivi
				WHERE serial_number LIKE "' . $str . '"
					OR product_name LIKE "' . $str . '"
					OR product_number LIKE "' . $str . '"
					OR inizio_garanzia LIKE "' . $str . '"
					OR fine_garanzia LIKE "' . $str . '"
					OR etichetta LIKE "' . $str . '"
					OR d.note LIKE "' . $str . '"
					OR aula LIKE "' . $str . '"
					OR marca LIKE "' . $str . '"
					OR tipo LIKE "' . $str . '"
					OR mac.macadress LIKE "' . $str . '"';
		$this->sql4table = $sql;
		
		$this->sql4count = 'SELECT count(d.idDispositivi) AS rows
					FROM dispositivi AS d 
					INNER JOIN aula AS a 
						ON d.Aula_idAula = a.idAula
					INNER JOIN tipo AS t
						ON d.Tipo_idTipo = t.idTipo
					INNER JOIN marca AS m
						ON d.Marca_idMarca = m.idMarca
					LEFT JOIN macadress AS mac
						ON d.idDispositivi = mac.dispositivi_idDispositivi
					WHERE serial_number LIKE "' . $str . '"
						OR product_name LIKE "' . $str . '"
						OR product_number LIKE "' . $str . '"
						OR inizio_garanzia LIKE "' . $str . '"
						OR fine_garanzia LIKE "' . $str . '"
						OR etichetta LIKE "' . $str . '"
 						OR d.note LIKE "' . $str . '"
						OR aula LIKE "' . $str . '"
						OR marca LIKE "' . $str . '"
						OR tipo LIKE "' . $str . '"
						OR mac.macadress LIKE "' . $str . '"';
		
		return $this->sql4table;
	}
	
	public function ricerca_av($serial_number = '%', $product_name = '%', $product_number = '%', &$inizio_garanzia = '%', &$fine_garanzia = '%', $etichetta = '%', $note = '%', $smaltito = '%', $aula = '%', $marca = '%', $tipo = '%', $macaddress = '%')//ricerca avanzata
	{
		$inizio_garanzia = IO::data($inizio_garanzia);
		$fine_garanzia = IO::data($fine_garanzia);
		
		for ($i=0;$i<func_num_args();$i++){
				$campi[] = addslashes(IO::camp_ricerca(func_get_arg($i)));
		}
		
		$sql = 'SELECT 
					d.idDispositivi,
					d.serial_number,
					d.product_name,
					d.product_number,
					d.inizio_garanzia,
					d.fine_garanzia,
					d.etichetta,
					d.note,
					d.smaltito,
					a.aula,
					m.marca,
					t.tipo,
					mac.macadress
				FROM dispositivi AS d 
				INNER JOIN aula AS a 
					ON d.Aula_idAula = a.idAula
				INNER JOIN tipo AS t
					ON d.Tipo_idTipo = t.idTipo
				INNER JOIN marca AS m
					ON d.Marca_idMarca = m.idMarca
				LEFT JOIN macadress AS mac
					ON d.idDispositivi = mac.dispositivi_idDispositivi
				WHERE COALESCE(serial_number, \'\') LIKE "' . $campi[0] . '"
					AND COALESCE(d.product_name, \'\') LIKE "' . $campi[1] . '"
					AND COALESCE(d.product_number, \'\') LIKE "' . $campi[2] . '"
					AND COALESCE(d.inizio_garanzia, \'\') LIKE "' . $campi[3] . '"
					AND COALESCE(d.fine_garanzia, \'\') LIKE "' . $campi[4] . '"
					AND COALESCE(d.etichetta, \'\') LIKE "' . $campi[5] . '"
 					AND COALESCE(d.note, \'\') LIKE "' . $campi[6] . '"
					AND COALESCE(d.smaltito, \'\') LIKE "' . $campi[7] . '"
					AND COALESCE(a.aula, \'\') LIKE "' . $campi[8] . '"
					AND COALESCE(m.marca, \'\') LIKE "' . $campi[9] . '"
					AND COALESCE(t.tipo, \'\') LIKE "' . $campi[10] . '"
					AND COALESCE(mac.macadress, \'\') LIKE "' . $campi[11] . '"';
		$this->sql4table = $sql;
		
		$this->sql4count = 'SELECT count(d.idDispositivi) AS rows
					FROM dispositivi AS d 
					INNER JOIN aula AS a 
						ON d.Aula_idAula = a.idAula
					INNER JOIN tipo AS t
						ON d.Tipo_idTipo = t.idTipo
					INNER JOIN marca AS m
						ON d.Marca_idMarca = m.idMarca
					LEFT JOIN macadress AS mac
						ON d.idDispositivi = mac.dispositivi_idDispositivi
				WHERE COALESCE(serial_number, \'\') LIKE "' . $campi[0] . '"
					AND COALESCE(d.product_name, \'\') LIKE "' . $campi[1] . '"
					AND COALESCE(d.product_number, \'\') LIKE "' . $campi[2] . '"
					AND COALESCE(d.inizio_garanzia, \'\') LIKE "' . $campi[3] . '"
					AND COALESCE(d.fine_garanzia, \'\') LIKE "' . $campi[4] . '"
					AND COALESCE(d.etichetta, \'\') LIKE "' . $campi[5] . '"
 					AND COALESCE(d.note, \'\') LIKE "' . $campi[6] . '"
					AND COALESCE(d.smaltito, \'\') LIKE "' . $campi[7] . '"
					AND COALESCE(a.aula, \'\') LIKE "' . $campi[8] . '"
					AND COALESCE(m.marca, \'\') LIKE "' . $campi[9] . '"
					AND COALESCE(t.tipo, \'\') LIKE "' . $campi[10] . '"
					AND COALESCE(mac.macadress, \'\') LIKE "' . $campi[11] . '"';
		
		return sql4table;
	}
	
}

class CSV extends DB
{
	private
		$success = true;
	
	private function contr($info, $value, $riga)//controllo aula marca e tipo
	{
		if (!isset($info_fin))//evita richieste al DB inutili
			$info_int = array_flip($this->r_array($info));//inverte array l'indice è il nome e il valore e l'id
		if (isset($info_int[$value]))
			$value_fin = $info_int[$value];//setta l'indice del dato scelto dal utente
		else{//se dato immesso nel file non esiste mostra errore
			$riga += 1;
			$error = $value . 'Errore nell\'inserimento di <strong>' . $info . '</strong> alla riga <strong>' . $riga . '</strong>, attenzione a maiuscole e spazi';
			IO::error($error);
		}
		return $value_fin;
	}
	
	private function contr_doppi()//controlla se ci sono serial number doppi sul CSV importato
	{
		$sn = $this->array_sn_double();
		if (isset($sn[1])){
			$this->rm_disp();
			for ($i=1;$i<=count($sn);$i++)
				$serial .= $sn[$i] . ' ';
			$error = 'Attenzione i seguenti serial number sono presenti piu volte: ' . $serial;
			IO::error($error, false);
			
			$this->success = false;
		}
	}
	
	public function carica($filecsv)
	{
		$this->rm_disp();//elimina tutti i dispositivi
		
		$file = fopen($filecsv, "r");
		$i = 0;
		while (!feof($file)) {
			$value = (fgetcsv($file, 0, ';'));//punto e virgola = delimitatore
				
    		if ($i > 0) {//esclude intestazione file
				//controllo righe vuote
				if (!($value[0] == '' 
					&& $value[1] == '' 
					&& $value[2] == '' 
					&& $value[3] == '' 
					&& $value[4] == '' 
					&& $value[5] == '' 
					&& $value[6] == '' 
					&& $value[7] == '' 
					&& $value[8] == '' 
					&& $value[9] == '' 
					&& $value[10] == '')) {
				
					//$value[8] = str_replace(" ", "", $value[8]);
					//$value[8] = strtolower($value[8]);
					//invece di avere nome aula si ha il suo id
					$value[8] = $this->contr('aula', $value[8] ,$i);
					$value[9] = $this->contr('marca', $value[9] ,$i);
					$value[10] = $this->contr('tipo', $value[10] ,$i);
				
					$id = $this->i_disp($value[0], $value[1], $value[2], $value[3], $value[4], $value[5], $value[6], $value[7], $value[8], $value[9], $value[10]);//id = id ultimo dispositivo immesso
				
					if (isset($value[11]) and $value[11] != ''){//se esiste un MAC address pe ril dispositivo
						$macs = explode(',', $value[11]);//array di tutti i MAC address
						$notes = explode(',', $value[12]);
				
						foreach ($macs as $index => $mac){
							$this->i_mac($mac, $notes[$index], $id);
						}
					}
				}
    		}
			$i++;
		}
		$this->contr_doppi();
		
		fclose($file);
		
		return $this->success;
	}
	
	public function scarica()
	{
		$output = 'serial_number;product_name;product_number;inizio_garanzia;fine_garanzia;etichetta;note;smaltito;aula;marca;tipo;macaddress(separare con virgole);note (separare con virgole)' . PHP_EOL;//intestazione
		$macs = $this->r_dispmac();//recupera tutti i pc che hanno un MAC address
		
		foreach ($macs as $mac){
			$disp = $this->r_1disp($mac['dispositivi_idDispositivi']);//inserisce valori dispositivo
			$output .= $disp['serial_number'] . ';' 
				. $disp['product_name'] . ';'  
				. $disp['product_number'] . ';' 
				. $disp['inizio_garanzia'] . ';' 
				. $disp['fine_garanzia'] . ';' 
				. $disp['etichetta'] . ';' 
				. $disp['note'] . ';' 
				. $disp['smaltito'] . ';' 
				. $disp['aula'] . ';'
				. $disp['marca'] . ';'
				. $disp['tipo'] . ';';
			
			$disp = $this->r_mac($mac['dispositivi_idDispositivi']);//controlla se il dispositivo ha piu di un MAC address
			$macaddress = array();
			$note = array();
			foreach ($disp as $disp1){
				$macaddress[] .= $disp1[0];//array con tutti i MAC address
				$note[] .= $disp1[1];
			}
			
			$output .= implode(",", $macaddress) . ';';//trasforma array in una stringa, inserisce
			$output .= implode(",", $note) . PHP_EOL;
		}
		
		$results = $this->r_disp_no_mac();//inserisce info tutti i altri dispositivi (che non hanno un MAC address)
		foreach ($results as $disp){
			$output .= $disp['serial_number'] . ';' 
				. $disp['product_name'] . ';'  
				. $disp['product_number'] . ';' 
				. $disp['inizio_garanzia'] . ';' 
				. $disp['fine_garanzia'] . ';' 
				. $disp['etichetta'] . ';' 
				. $disp['note'] . ';' 
				. $disp['smaltito'] . ';' 
				. $disp['aula'] . ';'
				. $disp['marca'] . ';'
				. $disp['tipo'] . PHP_EOL;
		}
		$csv = fopen($_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . "/downloads/inventario.csv", "w") or die("Unable to open file!");
		fwrite($csv, $output);
		fclose($csv);
		
		$host  = $_SERVER['HTTP_HOST'];
		$extra = $GLOBALS['root'] . '/downloads/inventario.csv';
		header("Location: http://$host/$extra");
	}
}

class table extends DB
{
	private
		$limit = 25,
		$sql = '',
		$fields = array(),
		$result = array(),
		$nrow = '',
		$filter = '',
		$dati = array();
	
	public function __construct()//chiama script
	{
		parent::__construct();
		
		echo '<script src="' . $GLOBALS['root'] . '/js/jquery-3.2.1.min.js"></script>';
		echo '<script src="' . $GLOBALS['root'] . '/js/table.js"></script>';
		echo '<table>';
	}
	
	public function nrow($sql)//conta record disponibile della query
	{
		try{
			$result = $this->pdo->query($sql);
		}catch (PDOException $e){
			$error = 'Errore recupero informazioni.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		$nrow = $result->fetch();
		$nrow = $nrow['rows'];
		
		if ($nrow == 0){
			echo '<p class="nodata">Attualmente non ci sono richieste.</p>';
			exit();
		}
		
		$this->nrow = $nrow;
		return $this->nrow;
	}
	
	public function header($fields)//crea intestazione
	{
		global $_GET;
		
		$this->fields = $fields;
		echo '<tr class="header">';
		
		foreach ($fields as $i => $field){
			if ($_GET['o'] == 1 and $_GET['f'] == $i){ 
				$o = 2; 
				$icon = 'az-order.png';
			}else{ 
				$o = 1;
				$icon = 'za-order.png';
			}
			
			 if (isset($_GET['ricerca'])){
			$ricerca = '&ricerca=' . $_GET['ricerca'];
		}elseif (isset($_GET['aula'])){
			$ricerca = '&serial_number=' . $_GET['serial_number'] 
				. '&product_name=' . $_GET['product_name'] 
				. '&product_number=' . $_GET['product_number']
				. '&inizio_garanzia=' . $_GET['inizio_garanzia']
				. '&fine_garanzia=' . $_GET['fine_garanzia']
				. '&etichetta=' . $_GET['etichetta']
				. '&note=' . $_GET['note']
				. '&smaltito=' . $_GET['smaltito']
				. '&aula=' . $_GET['aula']
				. '&marca=' . $_GET['marca']
				. '&tipo=' . $_GET['tipo']
				. '&macaddress=' . $_GET['macaddress'];
		}else
			$ricerca = '';
			
			echo '<th id_camp="' . $i . '"><a href="?f=' . $i . '&o=' . $o . $ricerca . '">' . $field . '</a> ';
			
			if ($_GET['f'] == $i and isset($_GET['f']))
				echo '<a href="?f=' . $i . '&o=' . $o . $ricerca . '"><img align="top" src="' . $GLOBALS['root'] . '/images/' . $icon . '"></a>';
			echo '</th>';
		}
		echo '</tr>';
	}
	
	public function setdati($dati)//contiene nomi delle colonne del DB
	{
		$this->dati = $dati;
		return $dati;
	}
	
	public function setlimit($limit)
	{
		$this->limit = $limit;
	}
	
	private function limit()//imposta numero massimo record per pagina
	{
		global $_GET;
		if (isset($_GET['p'])){
			$limit = $this->limit * $_GET['p'];
			$limit = $limit . ', ' . $this->limit;
		}else
			$limit = $this->limit;
		$limit = 'LIMIT ' . $limit;
		return $limit;
	}
	
	private function filter()//gestisce l'ordine dei record
	{
		global $_GET;
		if (isset($_GET['f'])){
			$dati = $this->dati;
			$filter = $dati[$_GET['f']];
			
			if ($_GET['o'] == 1)
				$order = 'ASC';
			else
				$order = 'DESC';
			$filter = 'ORDER BY ' . $filter . ' ' . $order;
		}else
			$filter = '';
		
		$this->filter = $filter;
		return $filter;
	}
	
	public function query($sql)//esegue query per recuperare dati
	{
		$filter = $this->filter();
		$limit = $this->limit();
		$this->sql = $sql;
		try{
			$sql .= ' ' . $filter . ' ' . $limit;
			//echo $sql;
			$result = $this->pdo->query($sql);
		}catch (PDOException $e){
			$error = 'Errore recupero informazioni.';
			include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . '/includes/error.inc.php';
			exit();
		}
		$this->result = $result;
		return $result;
	}
	
	public function popola_disp()//mostra dati, solo se sono dati riquardanti dispositivi
	{
		$dati = $this->dati;
		foreach ($this->result as $row){
			echo '<tr title="Vedi dettagli" class=\'dato\' data-href=\'' . $GLOBALS['root'] . '/private/info.php?idpc=' . $row['idDispositivi'] . '\'>';
			
			foreach ($dati as $dato){
				if (empty($row[$dato]))
					echo '<td><i>nessun dato<i></td>';
				else
					echo '<td>' . $row[$dato]. '</td>';
			}
			
			echo '</tr>';
		}
	}
	
	public function popola_cons()//mostra richieste di scansione
	{
		if ($this->nrow == 0){
			echo '<p>Attualmente non ci sono richieste.</p>';
		}
		$dati = $this->dati;
		foreach ($this->result as $row){
			echo '<tr title="Consenti" class=\'cont_richiesta\'><form class=\'richiesta\' action="" method="post">
			<input type="hidden" name="id" value="' . $row['idRichiesteScan'] . '">
			</form>';
			
			foreach ($dati as $dato){
				$dato = str_replace('"', '', $dato);
				if (empty($row[$dato]))
					echo '<td><i>nessun dato<i></td>';
				else
					echo '<td>' . $row[$dato] . '</td>';
			}
			
			echo '</tr>';
		}
	}
	
	private function nav_record()//genera menu di navigazione in fondo alla pagina
	{
		global $_GET;
		$npage = $this->nrow / $this->limit;
		$npage = ceil($npage);
		$npage -= 1;
		
		if (isset($_GET['p'])){
			$nexpage = $_GET['p'] + 1;
			$prepage = $_GET['p'] - 1;
		}
		
		if (isset($_GET['f'])){
			$var = '&f=' . $_GET['f'];
			if (isset($_GET['o']))
				$var .= '&o=' . $_GET['o'];
		}else
			$var = '';
		
		if (isset($_GET['ricerca'])){
			$ricerca = '&ricerca=' . $_GET['ricerca'];
		}elseif (isset($_GET['aula'])){
			$ricerca = '&serial_number=' . $_GET['serial_number'] 
				. '&product_name=' . $_GET['product_name'] 
				. '&product_number=' . $_GET['product_number']
				. '&inizio_garanzia=' . $_GET['inizio_garanzia']
				. '&fine_garanzia=' . $_GET['fine_garanzia']
				. '&etichetta=' . $_GET['etichetta']
				. '&note=' . $_GET['note']
				. '&smaltito=' . $_GET['smaltito']
				. '&aula=' . $_GET['aula']
				. '&marca=' . $_GET['marca']
				. '&tipo=' . $_GET['tipo']
				. '&macaddress=' . $_GET['macaddress'];
		}else
			$ricerca = '';

		echo '<div class="npage">';
		if (!isset($_GET['p']) and $npage >= 1){
			echo '<a href="?p=1' . $var . $ricerca . '"><img src="' . $GLOBALS['root'] . '/images/arrow-dx.png"></a>';
			echo '<a href="?p=' . $npage . $var . $ricerca . '"><img src="' . $GLOBALS['root'] . '/images/arrow-2dx.png"></a>';
		}
		
		if ($_GET['p'] != 0 && isset($_GET['p'])){
			echo '<a href="?p=0' . $var . $ricerca . '"><img src="' . $GLOBALS['root'] . '/images/arrow-2sx.png"></a>';
			echo '<a href="?p=' . $prepage . $var . $ricerca . '"><img src="' . $GLOBALS['root'] . '/images/arrow-sx.png"></a>';
		}
		
		if ($_GET['p'] != $npage && isset($_GET['p'])){
			echo '<a href="?p=' . $nexpage . $var . $ricerca . '"><img src="' . $GLOBALS['root'] . '/images/arrow-dx.png"></a>';
			echo '<a href="?p=' . $npage . $var . $ricerca . '"><img src="' . $GLOBALS['root'] . '/images/arrow-2dx.png"></a>';
		}
		echo '</div>';
	}
	
	public function end()//chiude tabella
	{
		echo '</table>';
		$this->nav_record();
	}
}

class QR
{
	private static
		$dimensione = '';
	
	private static function codice($link)//evita di ripetere questo codice nelle funzione online e offline
	{
		echo '<img src="https://chart.googleapis.com/chart?chs=' . self::$dimensione . 'x' . self::$dimensione . '&cht=qr&chl=' . $link . '&choe=UTF-8"/>';
	}
	
	static function online($id, $dimensione = '300')//crea immagine QR code del controllo dispositivo
	{
		self::$dimensione = $dimensione;//setta variabile che poi verra recuperata dalla funzione codice
		global $root;
		$link = 'http://spse.ch'.$root.'/controllo.php?id=' . $id;
		$link = urlencode($link);
		self::codice($link);
	}
	
	static function offline($row, $dimensione = '300')//crea immagine QR code con info dispositivo
	{//row è un array contenente tutte le info del dispositivo
		self::$dimensione = $dimensione;
		//se è presente mac address controllare se c'è ne piu di uno
		if (isset($row[macadress])){
			$ogg = new DB();
			$mac = $ogg->r_mac($row['idDispositivi']);
			foreach ($mac as $macad){
				$macaddress .= 'MAC address: ' . $macad[0] . PHP_EOL . 
					'           note: ' . $macad[1] . PHP_EOL;
			}
		}else
			$macaddress = '';
		$link =
			'Serial Number: ' . $row['serial_number'] . PHP_EOL .
			'Product name: ' . $row['product_name'] . PHP_EOL .
			'Product number: ' . $row['product_number'] . PHP_EOL .
			'Inizio garanzia: ' . $row['inizio_garanzia'] . PHP_EOL .
			'Fine garanzia: ' . $row['fine_garanzia'] . PHP_EOL .
			'Etichetta: ' . $row['etichetta'] . PHP_EOL .
			'Note: ' . $row['note'] . PHP_EOL .
			'Aula: ' . $row['aula'] . PHP_EOL .
			'Tipo: ' . $row['tipo'] . PHP_EOL .
			'Marca: ' . $row['marca'] . PHP_EOL .
			$macaddress;
		$link = urlencode($link);
		self::codice($link);
	}
	
}
?>
