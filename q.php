<?php
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////LICENCA LIBERADA PARA USO DESDE QUE SE MANTENHA OS DIREITOS AUTORAIS////
//////DESENVOLVIDO POR: MESTRE HAKUNA ////////////////////////////////////////
//////CRIADO EM: 03/02/2023///////MODIFICADO EM: 03/02/2023///////////////////
//////DISCORD: MESTRE HAKUNA#9901/////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
require('conex.php');
// Get search keyword
$keyword = $_GET['keyword'];

// Prepare and execute SQL query
$sql = "SELECT * FROM $arkshopdb WHERE SteamId LIKE '%$keyword%' OR Kits LIKE '%$keyword%' LIMIT 5";
$result = $conn->query($sql);

	// Display search result
	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	echo "<a href='https://steamcommunity.com/profiles/".$row['SteamId']."' target='_blank'>".$row["SteamId"]."</a> | ";

	$steamid = $row['SteamId']; // Substitua pelo ID da Steam do jogador
	// Obtém as informações do perfil do jogador usando a API Steam
	$get_steamid_bd = $row['SteamId'];
	$json = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$api_key_steam&steamids=$get_steamid_bd");
	$data = json_decode($json, true);
	$personaname = $data['response']['players'][0]['personaname']; //nome do jogador na Steam
	echo $personaname;
	echo " | <a href='perfil.php?steamid=".$row['SteamId']."&id=".$row['Id']."'><span style='font-size:12px; color:#000000; height:12px; width:100px; border:1px solid #dddddd;'>Perfil</span></a>";
	echo " | Pontos: ".$row["Points"]."<br>";
    }
	} else {
    echo "Nenhum resultado encontrado.";
	}

	$conn->close();
?>