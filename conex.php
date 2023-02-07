<?php
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////LICENCA LIBERADA PARA USO DESDE QUE SE MANTENHA OS DIREITOS AUTORAIS////
//////DESENVOLVIDO POR: MESTRE HAKUNA ////////////////////////////////////////
//////CRIADO EM: 03/02/2023///////MODIFICADO EM: 03/02/2023///////////////////
//////DISCORD: MESTRE HAKUNA#9901/////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
$host_bd = 'localhost';
$user = 'USUARIO DO MYSQL';
$password_bd = 'SENHA DO MYSQL';
$dbname = 'BANCO DE DADOS DO ARKSHOP';
$arkshopdb = 'TABELA DO ARKSHOP';
$pass_admin = 'SENHA DO ADMIN';
$admin_name = 'admin';

// Create connection
$conn = mysqli_connect($host_bd, $user, $password_bd, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$dia_atual = date('d');
$mes_atual = date('m');
$ano_atual = date('Y');

//1) INSTALE O APACHE SOMENTE, SEM O MYSQL
//2) CONFIGURE A CONEXÃO DO BANCO DE DADOS COM AS INFORMAÇÕES DO SEU MYSQL
//3) TROQUE A SENHA DO ADMIN NO ARQUIVO LOGIN.PHP ANTES DE ACESSAR O SCRIPT
//4) OBTENHA SUA CHAVE DA API STEAM NO LINK ABAIXO E ADICIONBE AQUI
//
//VOCÊ PODE OBTER SUA CHAVE DA API DA STEAM ATRAVÉS DO LINK ABAIXO
//https://steamcommunity.com/login/home/?goto=%2Fdev%2Fapikey
//
//
//OBTENHA INFORMAÇÕES SOBRE DADOS OBTIDOS ATRAVÉS DA API NO LINK ABAIXO
//https://developer.valvesoftware.com/wiki/Steam_Web_API.
$api_key_steam = "SUA CHAVE API STEAM";

//QUANTIDADE DE ITENS NA TELA DE LISTAGEM (MUITOS ITENS NA PAGINFAZ COM QUE A
//PAGINA DEMORE MAIS CARREGAR.
$limit_itens_list = "30";
?>