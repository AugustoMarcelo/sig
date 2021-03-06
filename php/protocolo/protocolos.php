<?php
	
	require("../db/db.php");
	session_start();
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$tombo = null;
	$mysqli->query('SET CHARACTER SET utf8');
	$sql = "SELECT p.*, pa.tombo, pa.denominacao, pa.especificacoes FROM protocolos p, patrimonios pa WHERE pa.id = p.id_patrimonio ORDER BY data DESC LIMIT $start, $limit";
	
	/* SE O PARÂMETRO 'tombo' ESTIVER COM ALGUM VALOR, 
	 * RETORNE OS DADOS REFERENTES AO ÚLTIMO EMPRÉSTIMO DESSE PATRIMÔNIO.
	 * 
	 * O OS VALORES RETORNADOS POR ESTE SELECT, SERÃO UTILIZADOS NO FORM DE DEVOLUÇÃO DO EMPRÉSTIMO.
	*/
	if(isset($_POST['tombo'])) {
		$tombo = $_POST['tombo'];
		$sql = "SELECT pa.especificacoes, pa.tombo, pa.denominacao, pa.especificacoes, p.mediador, p.solicitante, p.data AS dataEmprestimo FROM protocolos p, patrimonios pa WHERE tombo = '$tombo' AND data = (SELECT MAX(data) FROM protocolos WHERE tombo = '$tombo') AND p.id_patrimonio = pa.id";	
	}

	$result = array();
	if ($resultdb = $mysqli->query($sql)) {
		while($profile = $resultdb->fetch_assoc()) {
			$result[] = $profile;
		}	
		$resultdb->close();
	}

	$sqlTotal = $mysqli->query("SELECT COUNT(*) AS num FROM protocolos");
	$row = $sqlTotal->fetch_assoc();
	$total = $row['num'];

	echo json_encode(array(
		"success" => $mysqli->connect_errno == 0,
		"total" => $total,
		"data" => $result
	));	
	/* close connection */
	$mysqli->close();
?>