<?php

	//wiadomosci prywatne
	
	function priv($funkcja, $wyslane){
	global $numergg, $numer_bota, $login_bota, $haslo_bota;
	
	
	$M = new MessageBuilder();
	
	$uzytkownik = explode(" ", $wyslane);
	$wiadomosc = strstr($wyslane, $uzytkownik[2]);
	$usyr = $uzytkownik[1];
	$usyr = mb_strtolower($usyr,"UTF-8");
	$result2 = $funkcja;
	
	while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy
	$test = $pokaz['uzytk_online'];
	$test = mb_strtolower($test,"UTF-8");
	if ($test == $usyr){
	$nick = login3($numergg, login());
	$privnum = $pokaz['numergg'];
	$privuzyt = $pokaz['uzytk_online'];
	
	echo "Wiadomosc zostala wyslana do " . $privuzyt;
	$privuzyt = mb_strtolower($privuzyt,"UTF-8");
	$M->setRecipients($privnum);
	
	$M->addText($nick . ' przesyla prywatna wiadomosc: ' . $wiadomosc);
	
	}
	
	}
	if ($privuzyt != $usyr) 
		die ("Blad, wiadomosc nie zostala dostarczona, brak uzytkownika jako online");
	$P = new PushConnection($numer_bota, $login_bota, $haslo_bota);	
	$P->push($M); // wys³anie wiadomoœci do odbiorców
	$M->clear();
	
	}
	##############koniec wiadomosci prywatnych
/////////pokazanie rang
function rangi($funkcja){
	global $numergg, $numer_admina;
	$result2 = $funkcja;
	while ($pokaz = mysql_fetch_assoc($result2)){
	
	if ($pokaz['numergg'] == $numergg) {//usuniecie z tablicy wlasnego numeru gg
	$czesc2 = $pokaz['ranga'];
	if ($czesc2 == 1){
	return "sadmin";
	}
	else if ($czesc2 == 2){
	return "admin";
	}
	else if ($czesc2 == 3){
	return "mod";
	}
	else if ($czesc2 == 4){
	return "vip";
	}
}
}
if ($numergg == $numer_admina){
return "hadmin";
}
}
///////////////////
################obsluga
function obsluga($funkcja){
$M = new MessageBuilder();
	$result2 = $funkcja;
	while ($pokaz = mysql_fetch_assoc($result2)){
	$liczba = $pokaz['numergg'];
	$wynik = rangi_sql2(rangi_sql(), $liczba);
	$pokaz['ranga'] = $wynik;
	
if ($pokaz['ranga'] == 1 || $pokaz['ranga'] == 2)
{
$admini[] = $pokaz['uzytk_online'] . "\r\n";
}
if ($pokaz['ranga'] == 3)
{
$modzi[] = $pokaz['uzytk_online'] . "\r\n";
}
if ($pokaz['ranga'] == 4)
{
$vipy[] = $pokaz['uzytk_online'] . "\r\n";	
} 	
}
$M->addText('Administratorzy' . "\r\n");
for ($a = 0; $a < count($admini); $a++){
$M->addText($admini[$a]);
}
	$M->addText("\r\n" . 'Moderatorzy' . "\r\n");
for ($b = 0; $b < count($modzi); $b++){
$M->addText($modzi[$b]);
}
	$M->addText("\r\n" . 'VIP' . "\r\n");
for ($x = 0; $x < count($vipy); $x++){
$M->addText($vipy[$x]);
}
  $M->reply();
}
#######################koniec komendy obsluga

#### komenda online
//////////online

function online($funkcja){
$M = new MessageBuilder();
$result2 = $funkcja;
	while ($pokaz = mysql_fetch_assoc($result2)){
			if (!empty($pokaz['uzytk_online'])){
	$liczba = $pokaz['numergg'];
	$wynik = rangi_sql2(rangi_sql(), $liczba);
	$czesc2 = $wynik;
	if ($czesc2 == 1 || $czesc2 == 2){
	$pokaz['uzytk_online'] = '@' . $pokaz['uzytk_online'];
	}
	else if ($czesc2 == 3){
	$pokaz['uzytk_online'] = '<Mod>' . $pokaz['uzytk_online'];
	}
	else if ($czesc2 == 4){
	$pokaz['uzytk_online'] = '<Vip>' . $pokaz['uzytk_online'];
	}

	$klucz = $pokaz['uzytk_online'];
	$M->addText($klucz . "\r\n");
	}
	}
	
	
  $M->reply();
	

}

#####koniec online
################## pokazanie rangi uzytkownika
function rangi_sql2($funkcja, $numerek){
$result2 = $funkcja;
	while ($pokaz = mysql_fetch_assoc($result2)){
	if ($numerek == $pokaz['numergg']){
	$czesc2 = $pokaz['ranga'];
	return $czesc2;
	}
	
}

}

#######

########rejestracja kanalu i sprawdzenie
function zarejestrowanie($funkcja, $wyslane){
global $numergg;
$result2 = $funkcja;

$rozgrupowanie = explode(" ", $wyslane);
$nazwa = strstr($wyslane, $rozgrupowanie[2]);
$numer_kanalu = $rozgrupowanie[1];
if (!is_numeric($numer_kanalu)){
die('Numer kanalu wpisany niepoprawnie');
}
if (!preg_match ("/^([0-9]+)$/",$numer_kanalu)){
die('Numer kanalu wpisany niepoprawnie');
}
if (empty($nazwa) & empty($numer_kanalu)){
die('Wszystkie dane musza zostac wypelnione');
}
if (strlen($nazwa)>20) {
die ('Nazwa kanalu za dluga');
}
if (strlen($numer_kanalu)>10) {
die ('Nnumer kanalu za dlugi');
}

	while ($pokaz = mysql_fetch_assoc($result2)){
	
	if ($numergg == $pokaz['admin']){
	die('Juz posiadasz wlasny kanal');
	}
	if ($numer_kanalu == $pokaz['num_c']){
	die('Taki numer kanalu juz istnieje');
	}	
	}
	$zapytanie = "INSERT INTO numery_czat (num_c, nazwa_c, admin, prywatny) VALUES ('$numer_kanalu', '$nazwa', '$numergg', '0')";
	$dodanie = mysql_query($zapytanie);
	if ($dodanie) {
	echo 'Kanal o numerze ' .$numer_kanalu. ' i nazwie ' .$nazwa. ' zostal utworzony. ';
	}
	else die('Dodanie kanalu nie powiodlo sie');
		
	$zapytanie3 ="INSERT INTO rangi (numergg, ranga, kolor, num_c2) VALUES ('$numergg', '1', 'ff0000', '$numer_kanalu')";
	$admin3 = mysql_query($zapytanie3);
	if ($admin3){
	echo 'Otrzymales range Super Administratora';
	}
	else echo 'Niestety nie udalo sie przyznac rangi Super Administratora';
	
}
###########koniec rejestracji kanalu


########



?>