<?php

############

function numer(){
$sql = "SELECT * FROM uzytkownicy_online";
$result = mysql_query($sql);
return $result;
}

function numer2($funkcja_numer){
global $numergg;
$result = $funkcja_numer;
while ($pokaz = mysql_fetch_assoc($result)){// otrzymanie w wyniku tablicy
	$czesc1 = $pokaz['numergg'];
	$czesc2 = $pokaz['num_c'];
	//$czesc2 = $pokaz['uzytk_online'];
	if ($czesc1 == $numergg & isset($czesc2)){
	return 1;
	}
	}
	
	
}	 	
###############

//dodanie numeru do bazy
###########

function dodanie_numeru($numergg, $czas, $numer_prawidlowy){
$zapytanie = "INSERT INTO uzytkownicy_online (numergg, data3, num_c) VALUES ('$numergg', '$czas', '$numer_prawidlowy')";
        $wyslij = mysql_query($zapytanie);
				if ($wyslij){
				return 1;
				}
				else "Nieudane dodanie numeru1";
				
}				
function dodanie_numeru1($loginek){
global $numergg;	
				if ($loginek != 1) {				
				$zapytanie = "INSERT INTO baza (data, numergg) VALUES (CURDATE(), '$numergg')";
				$wstaw = mysql_query($zapytanie);				
				if ($wstaw) {
		return 1;        
				}
				else echo "Nieudane dodanie numeru";
				die;
				}
}

#################

#######nazwa kanalu w ktorym sie przebywa#####

function ban5(){
$wynik = num_czat(numer());
$sql = "SELECT * FROM ban WHERE numer_c='$wynik'";
$result = mysql_query($sql);
return $result;
 }

#######

########lista wszystkich osob online do wiadomosci globalnej
function globalna(){
$sql = "SELECT * FROM uzytkownicy_online";
$result = mysql_query($sql);
return $result;
}

###############



#####lista numerow kanalowych####

function rangi_sql(){
$wynik = num_czat(numer());
$sql = "SELECT * FROM rangi INNER JOIN uzytkownicy_online ON rangi.numergg = uzytkownicy_online.numergg WHERE num_c2='$wynik'";
$result = mysql_query($sql);
return $result;
}


#####baza rang
function rangi_baza(){
$sql = "SELECT * FROM rangi";
$result = mysql_query($sql);
return $result;
}

function kolor_numer($funkcja, $numerek){
$result2 = $funkcja;
while ($pokaz = mysql_fetch_assoc($result2)){
if ($numerek == $pokaz['numergg']){
$kolor = $pokaz['kolor'];
return $kolor;
}
}

}

#####
#################



function login(){
$sql2 = "SELECT * FROM baza";
$result2 = mysql_query($sql2);
return $result2;
}

 
########
function login2($numergg, $funkcja){

$result2 = $funkcja;
while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy

	$czesc1 = $pokaz['numergg'];
	if ($czesc1 == $numergg){
	return 1; 
}
}	 
}	
###########
function login3($numergg, $funkcja){
$result2 = $funkcja;
while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy

	$czesc1 = $pokaz['numergg'];
	if ($czesc1 == $numergg){
	$czesc2 = $pokaz['uzytk_online'];
if (empty($czesc2)){
return 1;
}
else return $czesc2;	 
}
}	 
}	

###############
///////////////koniec dodania numeru do bazy
##########################
//////////dodanie loginu do bazy


function dodanie_nicku($login){
global $numergg;
$login = trim($login);
if (empty($login)){
	die('Nick nie moze byc pusty, podaj swoj nick jeszcze raz' . "\r\n\r\n" . 'Problem z dolaczeniem do czatu? Napisz na numer gg ' . $numer_admina);
	}
	if (is_numeric($login)){
	die('Nick nie moze byc liczba, podaj swoj nick jeszcze raz' . "\r\n\r\n" . 'Problem z dolaczeniem do czatu? Napisz na numer gg ' . $numer_admina);
	}
sprawdzenie_nicku(login(), $login);
$zapytanie = "UPDATE baza SET uzytk_online ='$login' WHERE numergg='$numergg'";
   $wstaw = mysql_query($zapytanie);
   if ($wstaw){	
return 1;
}
}


##########
function sprawdzenie_nicku($funkcja, $login){
global $numer_admina;
$result2 = $funkcja;
while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy

	$czesc1 = $pokaz['uzytk_online'];
	$czesc1 = mb_strtolower($czesc1,"UTF-8");
	if ($czesc1 == mb_strtolower($login,"UTF-8")){
	
  die('Taki uzytkownik jest juz w bazie, podaj inny nick.' . "\r\n\r\n" . 'Problem z dolaczeniem do czatu? Napisz na numer gg ' . $numer_admina);
}
}	 
}	
####################
//////////////koniec dodawania nicku do bazy
###################


///////////rozmowa czatowa

############jaki numer czatu
function num_czat($funkcja){
global $numergg;

$result2 = $funkcja;
while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy

	$czesc1 = $pokaz['numergg'];
	if ($czesc1 == $numergg){
	$czesc2 = $pokaz['num_c'];
if (!empty($czesc2)){
return $czesc2;
}
	 
}
}
}

########3

##############
function nazwa_nicku(){
$wynik = num_czat(numer());
$sql = "SELECT * FROM baza INNER JOIN uzytkownicy_online ON baza.numergg = uzytkownicy_online.numergg WHERE num_c='$wynik'";
$result = mysql_query($sql);
return $result;
} 
function user_zbanowany(){
$sql = "SELECT * FROM ban";
$result = mysql_query($sql);
return $result;
}
#############

#####sprawdzenie tematu

function temat_sql(){

$wynik = num_czat(numer());
$sql = "SELECT * FROM numery_czat WHERE num_c='$wynik'";
$result = mysql_query($sql);
return $result;
}

#####koniec sprawdzania tematu

#####konta adminow
function konta_adminow(){
global $numergg;
$sql = "SELECT * FROM konta WHERE admin='$numergg'";
$result = mysql_query($sql);
return $result;
}
#################

###################
function rozmowa($funkcja, $wyslane){
global $numergg, $numer_bota, $login_bota, $haslo_bota;
$M = new MessageBuilder();
$result2 = $funkcja;
while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy
	
	if ($pokaz['numergg'] == $numergg || empty($pokaz['uzytk_online'])) {//usuniecie z tablicy wlasnego numeru gg
	unset ( $pokaz['numergg'] );
}
	$klucz[] = $pokaz['numergg'];
	$M->setRecipients($klucz);
	}	
	$nick = login3($numergg, login());
	$M->addText($nick . ': ' . $wyslane);
	$P = new PushConnection($numer_bota, $login_bota, $haslo_bota);	
	$P->push($M); // wys³anie wiadomoœci do odbiorców
	$M->clear();
	 
} 
######################
function rozmowa2($funkcja, $wyslane){
global $numergg, $numer_bota, $login_bota, $haslo_bota, $numer_admina;
$M = new MessageBuilder();
$result2 = $funkcja;
while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy
	
////////////////kolorowe nicki i rangi
	
	if ($pokaz['numergg'] == $numergg) {//usuniecie z tablicy wlasnego numeru gg
	$liczba = $pokaz['numergg'];
	$wynik = rangi_sql2(rangi_sql(), $liczba);
	$czesc2 = $wynik;
	$pokaz['kolor'] = kolor_numer(rangi_baza(),$liczba);
	if ($czesc2 == 1 | $czesc2 == 2){
	$czesc3 = $pokaz['uzytk_online'];
	$czesc4 = $pokaz['kolor'];
	$M->addBBcode('[b][color=' . $czesc4 . ']@' . $czesc3 . ': ' . $wyslane . '[/color][/b]');
	}
	else if ($czesc2 == 3){
	$czesc3 = $pokaz['uzytk_online'];
	$czesc4 = $pokaz['kolor'];
	$M->addBBcode('[u][color=' . $czesc4 . ']<Mod>' . $czesc3 . ': ' . $wyslane . '[/color][/u]');
	}
	else if ($czesc2 == 4){
	$czesc3 = $pokaz['uzytk_online'];
	$czesc4 = $pokaz['kolor'];
	$M->addBBcode('[color=' . $czesc4 . ']<Vip>' . $czesc3 . ': ' . $wyslane . '[/color]');
	}
	else if ($numergg == $numer_admina){
	$czesc3 = "LuckyLuke";
	$czesc4 = '008000';
	$M->addBBcode('[b][u][color=' . $czesc4 . ']<HeadAdmin>' . $czesc3 . ': ' . $wyslane . '[/color][/u][/b]');
	}
	else {
	$czesc3 = $pokaz['uzytk_online'];
	$M->addText($czesc3 . ': ' . $wyslane);
	}
	
	unset ( $pokaz['numergg'] );
	
}
if (empty($pokaz['uzytk_online'])){
unset ( $pokaz['numergg'] );
}
	$klucz[] = $pokaz['numergg'];
	$M->setRecipients($klucz);
	
	}
	$P = new PushConnection($numer_bota, $login_bota, $haslo_bota);	
	$P->push($M); // wys³anie wiadomoœci do odbiorców
	$M->clear();
	 
} 
################
//////////koniec rozmowy
########

/////////komendy czatowe podczas rozmowy
#################
function wyjscie(){
global $numergg;
$wiadomosc2 = 'wyszedl/la z czatu';
	rozmowa(nazwa_nicku(), $wiadomosc2);
$zapytanie10 ="DELETE FROM `uzytkownicy_online` WHERE `numergg`='$numergg'";
	$wstaw10 = mysql_query($zapytanie10);
	if ($wstaw10)	{
	echo "Wyszedles/as z czatu, aby powrocic, wpisz ponownie numer czatu";
	
}
else
      echo "Wyjscie z czatu nie powiodlo sie";
   
}
#######################
///////////////////koniec komend
###############



####zablokowanie zbanowanych

function zbanowani($funkcja){
global $numergg, $malelitery;

while ($pokaz = mysql_fetch_assoc($funkcja)){
	czas_minal($pokaz['czas'], $pokaz['numergg'], $pokaz['numer_c']);
	if (($pokaz['numergg'] == $numergg) && ($malelitery == $pokaz['numer_c'])){
		
	die('Bardzo nam przykro ale na tym kanale dostales/as bana, zapraszamy na inny :)');
}
}
}
##################zablokowanie zbanowanych

#########czas bana minal
function czas_minal($cos_tam, $numer, $kanal){
global $numer_bota, $login_bota, $haslo_bota;
$M = new MessageBuilder();
$czas=date('Y-m-d H:i:s');
if ($czas > $cos_tam){
	$zapytanie ="DELETE FROM `ban` WHERE `numergg`='$numer'";
	mysql_query($zapytanie);
	$M->addText('Zostales/as odbanowany/a na czacie o kanale: ' . $kanal);
	$M->setRecipients($numer);
	$P = new PushConnection($numer_bota, $login_bota, $haslo_bota);
	$P->push($M); // wys³anie wiadomoœci do odbiorców
	$M->clear();
	die();
} 

}


########

###spamowanie###


function spam_numer(){
global $numergg;
$sql = "SELECT * FROM uzytkownicy_online WHERE numergg='$numergg'";
$result = mysql_query($sql);
return $result;
}


function spamowanie($funkcja){
global $numergg;
$czas_przeb = $czas=date('Y-m-d H:i:s', time()-1);
$result = $funkcja;

if(!empty($result)){

$pokaz = mysql_fetch_array($result);// otrzymanie w wyniku tablicy


if ($pokaz['numergg'] == $numergg) {//usuniecie z tablicy wlasnego numeru gg

if ($czas_przeb <= $pokaz['data3']){
	die('Autoodpowiedz: poczekaj kilka sekund zanim przeslesz nastepna wiadomosc...');
	}	
} 
}
}


####koniec spamowania

########kick bez opcji +1


function kick3($funkcja, $numergg, $powod){
global $numer_bota, $login_bota, $haslo_bota;
$M = new MessageBuilder();
$wiadomosc = $powod;
$result2 = $funkcja;
while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy
		if ($pokaz['numergg'] == $numergg){
	if ($pokaz['ranga'] == 1 | $pokaz['ranga'] == 2){
	die('Obslugi kick nie obowiazuje');
	
	}
		$klucz2 = $pokaz['numergg'];
		$klucz3 = $pokaz['uzytk_online'];
	}

}
if (empty($klucz2)){
die('Brak uzytkownika online');
}
		$zapytanie ="DELETE FROM `uzytkownicy_online` WHERE `numergg`='$klucz2'";
	$kick = mysql_query($zapytanie);
if ($kick) {
	$M->setRecipients($klucz2);
  $M->addText('Zostales wyproszony z czatu. Powod: ' . $wiadomosc);
	$P = new PushConnection($numer_bota, $login_bota, $haslo_bota);
	$P->push($M); // wys³anie wiadomoœci do odbiorców
	$M->clear();	
	$wiadomosc2 = 'zostal wyproszony z czatu. Powod: ' . $wiadomosc;
	rozmowa(nazwa_nicku(), $wiadomosc2);
}
else echo "nie zostal wyproszony";
}



############## koniec kickowania
#####banowanie
function ban2($funkcja, $numergg, $powod){
global $numergg, $numer_bota, $login_bota, $haslo_bota, $numer_admina;
$M = new MessageBuilder();
$wiadomosc = $powod;
$result2 = $funkcja;

while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy
			if ($pokaz['numergg'] == $numergg){
	if ($pokaz['ranga'] == 1){
	die('Obslugi kick nie obowiazuje');
	
	}
		$klucz2 = $pokaz['numergg'];
		$klucz3 = $pokaz['uzytk_online'];
	}
}
if (empty($klucz2)){
die('Brak uzytkownika online');
}
		if (!empty($klucz2)){
		$zapytanie ="DELETE FROM `uzytkownicy_online` WHERE `numergg`='$klucz2'";
	mysql_query($zapytanie);
	}
	$zapytanie ="INSERT INTO ban (databana, numergg, loginban, powodban) VALUES (CURDATE(), '$klucz2', '$klucz3', '$wiadomosc')";
	$ban = mysql_query($zapytanie);
if ($ban) {
		
		$M->setRecipients($klucz2);
  $M->addText('Dostales bana. Powod: ' . $wiadomosc . ' , aby sie odwolac, napisz na numer ' . $numer_admina);
	$P = new PushConnection($numer_bota, $login_bota, $haslo_bota);
	$P->push($M); // wys³anie wiadomoœci do odbiorców
	$M->clear();	
	$wiadomosc2 = 'zostal zbanowany. Powod: ' . $wiadomosc;
	rozmowa(nazwa_nicku(), $wiadomosc2);
}
else echo "nie zostal zbanowany";
}


#####banowanie
######ustawienie tematu
function temat($funkcja, $wyslane){
		
		$temat = explode(" ", $wyslane);
		if (empty($temat[1])) die('Temat nie moze byc pusty');
		$wiadomosc = strstr($wyslane, $temat[1]);
		$wynik = num_czat(numer());
		
		$zapytanie ="UPDATE numery_czat SET temat='$wiadomosc' WHERE num_c='$wynik'";
		$rozmowy = mysql_query($zapytanie);
		if ($rozmowy){
		echo "Temat rozmowy zmieniony na: " . $wiadomosc;
		
		$wiadomosc2 = 'zmienil temat rozmowy na: ' . $wiadomosc;
		rozmowa(nazwa_nicku(), $wiadomosc2);
		
		}
	}

####koniec tematu
########

 ####czy temat jest ustawiony
 function czy_temat($funkcja){
	$wynik = num_czat(numer());
	while ($pokaz = mysql_fetch_assoc($funkcja)){
	if (!empty($pokaz['temat']) && ($pokaz['num_c'] == $wynik)){
	return "Aktualny temat rozmowy to: " . $pokaz['temat'];

	}
	else return "Aktualny temat: Brak tematu";
	}
  }
 
 #######
 ###########zalozenie kanalu z poziomu gg
 function zalozenie_kanalu(){
 
 $sql = "SELECT num_c, nazwa_c, admin FROM `numery_czat` ORDER BY num_c";
$result = mysql_query($sql);
return $result;
 
 }
 ##################koniec zalozeina kanalu
 
 #####konta adminow2
function konta_adminow2(){
global $numergg;
$sql = "SELECT * FROM konta";
$result = mysql_query($sql);
return $result;
}
#################
 
 ##########Pierwsze 10 kanalow na liscie
function pierwsze($funkcja){
$result = $funkcja;
$a=0;
while ($pokaz = mysql_fetch_assoc($result)){
if ($a<10){
echo "<" . $pokaz['num_c'] . " " . $pokaz['nazwa_c'] . ">\r\n";
$a++;
}
}
} 
 
 ################

?>