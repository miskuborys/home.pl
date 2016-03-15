<?php

#########zmiana swojego nicka
function zmiana_nicka($wyslane){
global $numergg;

$zmiananicka = explode(" ", $wyslane);
		$nick2 = $zmiananicka[1];
		sprawdzenie_nicku(login(), $nick2);
		$nick = login3($numergg, login());
		$zapytanie ="UPDATE baza SET uzytk_online ='$nick2' WHERE numergg=". $numergg;
		$zmiana = mysql_query($zapytanie);
		if ($zmiana) {
		echo "Zmieniles/as nick na: " . $nick2;
		$wiadomosc2 = 'zmiana nicka. (Poprzedni nick: ' . $nick . ')';
		rozmowa(nazwa_nicku(), $wiadomosc2);
		}
		else echo "Zmiana nicka nie powiodla sie";
}

#######koniec zmiany


########kick bez opcji +1


function kick2($funkcja, $wyslane){
global $numer_bota, $login_bota, $haslo_bota;
$M = new MessageBuilder();
$powodkick = explode(" ", $wyslane);
$wiadomosc = strstr($wyslane, $powodkick[2]);
$result2 = $funkcja;
while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy
		if ($pokaz['uzytk_online'] == $powodkick[1]){
		$liczba = $pokaz['numergg'];
	$wynik = rangi_sql2(rangi_sql(), $liczba);
	$pokaz['ranga'] = $wynik; 
	if ($pokaz['ranga'] == 1 | $pokaz['ranga'] == 2 | $pokaz['ranga'] == 3){
	die('Nie wypraszaj innych osob z obslugi');
	
	}
		$klucz2 = $pokaz['numergg'];
		$klucz3 = $pokaz['uzytk_online'];
	}

}
if (empty($klucz2)){
die('Brak uzytkownika online');
}


echo "Nick " . $klucz3 . " ";
		$zapytanie ="DELETE FROM `uzytkownicy_online` WHERE `numergg`='$klucz2'";
	$kick = mysql_query($zapytanie);
if ($kick) {
	echo "zostal wyproszony z czatu.  Powod: " . $wiadomosc;
	$M->setRecipients($klucz2);
  $M->addText('Zostales wyproszony z czatu. Powod: ' . $wiadomosc);
	$P = new PushConnection($numer_bota, $login_bota, $haslo_bota);
	$P->push($M); // wys³anie wiadomoœci do odbiorców
	$M->clear();	
	$wiadomosc2 = 'wyprosil z czatu uzytkownika ' . $klucz3 . '. Powod: ' . $wiadomosc;
	rozmowa(nazwa_nicku(), $wiadomosc2);
}
else echo "nie zostal wyproszony";
}



############## koniec kickowania

#########kickowanie nieaktywnych

function nieaktywni($funkcja){
global $numergg, $numer_bota, $login_bota, $haslo_bota;
$czas_przeb = $czas=date('Y-m-d H:i:s', time()-60*10);

$M = new MessageBuilder();
while ($pokaz = mysql_fetch_assoc($funkcja)){// otrzymanie w wyniku tablicy
$liczba = $pokaz['numergg'];
	$wynik = rangi_sql2(rangi_sql(), $liczba);
	$pokaz['ranga'] = $wynik; 
if ($pokaz['ranga'] == 1) {
unset ( $pokaz['numergg'] );
}
else if ($pokaz['numergg'] == $numergg) {//usuniecie z tablicy wlasnego numeru gg
unset ( $pokaz['numergg'] );
}
else if ($pokaz['data3'] < $czas_przeb){
		$klucz1 = $pokaz['numergg'];
		$klucz2[] = $pokaz['numergg'];
		$zapytanie ="DELETE FROM `uzytkownicy_online` WHERE `numergg`='$klucz1'";
		$kick = mysql_query($zapytanie);
		$M->setRecipients($klucz2);
	}	
} 	
if (empty($klucz2)){
die('Brak osob nieaktywnych');
}
if ($kick){
$M->addText('Zostales wyproszony z czatu z powodu braku aktywnosci');
	$P = new PushConnection($numer_bota, $login_bota, $haslo_bota);	
	$P->push($M); // wys³anie wiadomoœci do odbiorców
    $M->clear();
$wiadomosc = 'Wyprosil/a nieaktywne osoby z czatu';
rozmowa3(nazwa_nicku(), $wiadomosc);
} 
}
function rozmowa3($funkcja, $wiadomosc){
global $numergg, $numer_bota, $login_bota, $haslo_bota;
$M = new MessageBuilder();
$result2 = $funkcja;
while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy
	if ($pokaz['numergg'] == $numergg) {
	$nick = $pokaz['uzytk_online'];
	}
	$klucz[] = $pokaz['numergg'];
	$M->setRecipients($klucz);
	}		
	$M->addText($nick . ': ' . $wiadomosc);
	$P = new PushConnection($numer_bota, $login_bota, $haslo_bota);	
	$P->push($M); // wys³anie wiadomoœci do odbiorców
	$M->clear();
} 
################
/////////////////koniec kickowania nieaktywnych


########czy ma juz bana
function czy_ban($funkcja, $login){
while ($pokaz = mysql_fetch_assoc($funkcja)){// otrzymanie w wyniku tablicy
if ($pokaz['loginban'] == $login){
return 1;

}
}
}
#####

##########na ile ban
function na_ile($wyslane){
	$czas = date('Y-m-d H:i:s');
	$na_ile = explode(" ", $wyslane);
	$liczba = $na_ile[1];
	if($liczba == "dzien"){
		$czas = date('Y-m-d H:i:s', time()+60*1440);
		return $czas;
	}
	else if ($liczba == "tydzien"){
		$czas = date('Y-m-d H:i:s', time()+60*10080);
		return $czas;
	}
	else if ($liczba == "miesiac"){
		$czas = date('Y-m-d H:i:s', time()+60*43200);
		return $czas;
	}
	else if ($liczba == "rok"){
		$czas = date('Y-m-d H:i:s', time()+60*525600);
		return $czas;
	}
	else if(is_numeric($liczba))
	{
	$liczba = (int)$liczba;
	if (!is_int($liczba))
	{
	die('Podales/as bledna liczbe dni , jest calkowita');
	}
	else if ($liczba>10000){
	die ('Zbyt wielka liczba');
	}
	else if ($liczba>0){
	$czas = date('Y-m-d H:i:s', time()+60*$liczba);
	return $czas;
	}
	else die('Liczba minut nie moze byc ujemna');
	}
	else die('Podales/as bledna liczbe dni');
}

##############

########banowanie admin
function ban($funkcja, $wyslane){
global $numergg, $numer_bota, $login_bota, $haslo_bota, $numer_admina;
$M = new MessageBuilder();
$powodban = explode(" ", $wyslane);
$wiadomosc = strstr($wyslane, $powodban[3]);

na_ile($wyslane);
$do_kiedy = na_ile($wyslane);
if (is_numeric($powodban[1])){
$ilosc_minut = $powodban[1]; 
}
	else if($powodban[1] == "dzien"){
	$slowo = "dzien";	
	}
	else if($powodban[1] == "tydzien"){
	$slowo = "tydzien";	
	}
	else if($powodban[1] == "miesiac"){
	$slowo = "miesiac";	
	}
	else if($powodban[1] == "rok"){
	$slowo = "rok";	
	}

if (czy_ban(ban5(), $powodban[2]) == 1){
die('Ta osoba ma juz bana');
}
$result2 = $funkcja;
while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy
		if ($pokaz['uzytk_online'] == $powodban[2]){
		$liczba = $pokaz['numergg'];
	$wynik = rangi_sql2(rangi_sql(), $liczba);
	$pokaz['ranga'] = $wynik; 
	if ($pokaz['ranga'] == 1){
	die('Nie banuj glownego admina!');
	
	}
		$klucz2 = $pokaz['numergg'];
		$klucz3 = $pokaz['uzytk_online'];
	}
}
if (empty($klucz2)){
die('Brak uzytkownika w bazie');
}
echo "Nick " . $klucz3 . " ";
		
		if (!empty($klucz2)){
		
		$zapytanie ="DELETE FROM `uzytkownicy_online` WHERE `numergg`='$klucz2'";
	mysql_query($zapytanie);
	}
	
	$wynik2 = num_czat(numer());
	$zapytanie ="INSERT INTO ban (databana, numergg, loginban, powodban, numer_c, czas) VALUES (CURDATE(), '$klucz2', '$klucz3', '$wiadomosc', '$wynik2', '$do_kiedy')";
	$ban = mysql_query($zapytanie);
if ($ban) {
		if(empty($ilosc_minut)){
		echo "dostal bana na okres czasu: " . $slowo . ". Powod: " . $wiadomosc;
		$M->addText('Zostales zbanowany na czacie o kanale: ' . $wynik2 . ' na okres czasu:' . $slowo);
		$wiadomosc2 = 'zbanowal/a uzytkownika ' . $klucz3 . ' na okres czasu:' . $slowo . '. Powod: ' . $wiadomosc;
		}
		else
		{
		echo "dostal bana na okres czasu: " . $ilosc_minut . " minut . Powod: " . $wiadomosc;
		
		 $M->addText('Zostales zbanowany na czacie o kanale: ' . $wynik2 . ' na okres czasu: ' . $ilosc_minut . ' minut');
		 $wiadomosc2 = 'zbanowal/a uzytkownika ' . $klucz3 . ' na okres czasu:' . $ilosc_minut . ' minut. Powod: ' . $wiadomosc;
		 }
		 $M->setRecipients($klucz2);
		 $M->addText('. Powod: ' . $wiadomosc);
	$P = new PushConnection($numer_bota, $login_bota, $haslo_bota);
	$P->push($M); // wys³anie wiadomoœci do odbiorców
	$M->clear();	
	
	rozmowa(nazwa_nicku(), $wiadomosc2);
}
else echo "nie zostal zbanowany";
}

###########koniec banowania

#######unban
function unban($funkcja, $wyslane){
global $numer_bota, $login_bota, $haslo_bota;
$M = new MessageBuilder();

$unban = explode(" ", $wyslane);
$user_unban = strstr($wyslane, $unban[1]);
$wynik = num_czat(numer());
while ($pokaz = mysql_fetch_assoc($funkcja)){
		if (($pokaz['loginban'] == $user_unban) && ($pokaz['numer_c'] == $wynik)){
		$user = $pokaz['numergg'];		
		}		
		}	
		
if (empty($user)){
die('Brak uzytkownika w bazie zbanowanych');
}
echo "Nick  " . $user_unban . " ";		
		$zapytanie ="DELETE FROM `ban` WHERE `loginban`='$user_unban' AND `numer_c`='$wynik'";
	$unban = mysql_query($zapytanie);
		if ($unban) {		
		echo "zostal odbanowany";
		$M->setRecipients($user);
  $M->addText('Zostales odbanowany na czacie na kanale: ' . $wynik);	
  $P = new PushConnection($numer_bota, $login_bota, $haslo_bota); // autoryzacja
	$P->push($M); // wys³anie wiadomoœci do odbiorców
  $M->clear();
			//wyslanie wiadomosci
		$wiadomosc2 = 'odbanowal/a uzytkownika ' . $user_unban;
	rozmowa(nazwa_nicku(), $wiadomosc2);
		//koniec wysylania
		}
		else echo "nie zostal odbanowany";
}

########koniec unbana


#######zmiana nicku innej osobie
function zmien_nick($funkcja, $wyslane){
global $numer_bota, $login_bota, $haslo_bota;
$M = new MessageBuilder();
$zmiananicka = explode(" ", $wyslane);
		$pierwszynick = $zmiananicka[1];
		$druginick = $zmiananicka[2];
		if ($pierwszynick == 'KoKs') die ('Nie zmieniaj nicku glownemu adminowi');
	while ($pokaz = mysql_fetch_assoc($funkcja)){
	if ($pokaz['uzytk_online'] == $pierwszynick) {
	sprawdzenie_nicku(login(), $druginick);
	$zapytanie ="UPDATE baza SET uzytk_online ='$druginick' WHERE uzytk_online='$pierwszynick'";
	$zmiana = mysql_query($zapytanie);	
		if ($zmiana) {
		echo "Ustawiles/as nowy nick: " . $druginick;
		$wiadomosc2 = 'Uzytkownikowi ' . $zmiananicka[1] . ' ustawil/a nowy nick: ' . $druginick;
	rozmowa(nazwa_nicku(), $wiadomosc2);
	die();	
	}
	else echo "Ustawienie nowego nicka nie powiodla sie";		
	}	
}
die('Pierwszy nick nie istnieje w bazie');
}		
############koniec zmiany nicku

##########zmiana opisu
function zmiana_opis($wyslane){

$tekscik = substr($wyslane,6);


echo "Nowy opis ustawiony";
$P = new PushConnection(numer bota, 'czacior@gmail.com', 'michi007michi007');
$P->setStatus($tekscik);

die();
} 


##############koniec zmiany opisu
 
 ####czy ta osoba ma range
 function czy_ranga($funkcja, $loginek, $wynik, $ranga1){
	global $numergg, $numer_admina;
	while ($pokaz = mysql_fetch_assoc($funkcja)){
	if (($pokaz['numergg'] == $loginek) && ($pokaz['num_c2'] == $wynik)){
	if ($ranga1 == "sadmin") $ranga = 1;
	if ($ranga1 == "admin") $ranga = 2;
	if ($ranga1 == "mod") $ranga = 3;
	if ($ranga1 == "vip") $ranga = 4;
	if ($pokaz['ranga'] == $ranga) die('Ten uzytkownik juz ma taka range');
	return 1;
	
	}
	}
  }
 
 
 #######
 
 
###########super admin zmiana rangi#######
function zmiana_ranga($funkcja, $wyslane){
global $numergg, $numer_admina;
$ranga = explode(" ", $wyslane);
$ranga1 = $ranga[1];
$uzytkownik = $ranga[2];
$wynik = num_czat(numer());
if ($uzytkownik == "KoKs") die ('Nie zmieniaj rangi glownemu adminowi');
while ($pokaz = mysql_fetch_assoc($funkcja)){

if ($pokaz['uzytk_online'] == $uzytkownik){
$uzytkownik_istnieje = $uzytkownik;
$loginek = $pokaz['numergg'];
}

}
if (empty($uzytkownik_istnieje)){
die('Brak uzytkownika w liscie online');
}

if (czy_ranga(rangi_baza(), $loginek, $wynik, $ranga1) != 1){
if ($ranga1 == "user") die('Ten uzytkownik juz ma taka range');
$zapytanie3 ="INSERT INTO rangi (numergg, num_c2) VALUES ('$loginek', '$wynik')";
$admin3 = mysql_query($zapytanie3);

}

if ($ranga1 == "admin"){
$zapytanie ="UPDATE rangi SET ranga ='2', kolor='ff0000' WHERE numergg='$loginek' AND num_c2='$wynik'";
$admin = mysql_query($zapytanie);

if ($admin){
echo "Nadales/as prawa administratora dla uzytkownika " . $uzytkownik_istnieje;
$wiadomosc2 = 'nadal/a prawa Administratora uzytkownikowi ' . $uzytkownik_istnieje;
	rozmowa(nazwa_nicku(), $wiadomosc2);

} else echo "Nadanie praw nieudane";
}

else if ($ranga1 == "sadmin"){
if ($numergg != $numer_admina) die ('Nie masz uprawnien do tej komendy');
$zapytanie ="UPDATE rangi SET ranga ='1', kolor='ff0000' WHERE numergg='$loginek' AND num_c2='$wynik'";
$sadmin = mysql_query($zapytanie);

if ($sadmin){
echo "Nadales/as prawa Super administratora dla uzytkownika " . $uzytkownik_istnieje;
$wiadomosc2 = 'nadal/a prawa Super Administratora uzytkownikowi ' . $uzytkownik_istnieje;
	rozmowa(nazwa_nicku(), $wiadomosc2);

} else echo "Nadanie praw nieudane";
}

###########
else if ($ranga1 == "mod"){
$zapytanie ="UPDATE rangi SET ranga ='3', kolor='008000' WHERE numergg='$loginek' AND num_c2='$wynik'";
$mod = mysql_query($zapytanie);

if ($mod){
echo "Nadales/as prawa moderatora dla uzytkownika " . $uzytkownik_istnieje;
$wiadomosc2 = 'nadal/a prawa Moderatora uzytkownikowi ' . $uzytkownik_istnieje;
	rozmowa(nazwa_nicku(), $wiadomosc2);

} else echo "Nadanie praw nieudane";
}
############
else if ($ranga1 == "vip"){
$zapytanie ="UPDATE rangi SET ranga ='4', kolor='ff6633' WHERE numergg='$loginek' AND num_c2='$wynik'";
$vip = mysql_query($zapytanie);

if ($vip){
echo "Nadales/as prawa vip dla uzytkownika " . $uzytkownik_istnieje;
$wiadomosc2 = 'nadal/a prawa Vip uzytkownikowi ' . $uzytkownik_istnieje;
	rozmowa(nazwa_nicku(), $wiadomosc2);

} else echo "Nadanie praw nieudane";
}
###############
else if ($ranga1 == "user"){
$zapytanie ="DELETE FROM `rangi` WHERE `numergg`='$loginek' AND `num_c2`='$wynik'";
$user = mysql_query($zapytanie);

if ($user){
echo "Nadales/as prawa user dla uzytkownika " . $uzytkownik_istnieje;
$wiadomosc2 = 'zmniejszyl/a range do user uzytkownikowi ' . $uzytkownik_istnieje;
	rozmowa(nazwa_nicku(), $wiadomosc2);

} else echo "Nadanie praw nieudane";
}
else die('Nieprawidlowa nazwa rangi');
}


###################

########zmiana koloru
function kolor($wyslane){
global $numergg;

$kolor = explode(" ", $wyslane);
$odcien = $kolor[1];

if ($odcien == "zielony"){
$zapytanie ="UPDATE rangi SET kolor='008000' WHERE numergg='$numergg'";
$zielony = mysql_query($zapytanie);

if ($zielony){
echo "Ustawiles kolor pisania: zielony";

} else echo "Ustawienie koloru nieudane";
}
###########
else if ($odcien == "pomaranczowy"){
$zapytanie ="UPDATE rangi SET kolor='ff6633' WHERE numergg='$numergg'";
$pomarancz = mysql_query($zapytanie);

if ($pomarancz){
echo "Ustawiles kolor pisania: pomaranczowy";

} else echo "Ustawienie koloru nieudane";
}
##################
###########
else if ($odcien == "czarny"){
$zapytanie ="UPDATE rangi SET kolor='000000' WHERE numergg='$numergg'";
$czarny = mysql_query($zapytanie);

if ($czarny){
echo "Ustawiles kolor pisania: czarny";

} else echo "Ustawienie koloru nieudane";
}
##################
###########
else if ($odcien == "rozowy"){
$zapytanie ="UPDATE rangi SET kolor='ff00ff' WHERE numergg='$numergg'";
$rozowy = mysql_query($zapytanie);

if ($rozowy){
echo "Ustawiles kolor pisania: rozowy";

} else echo "Ustawienie koloru nieudane";
}
##################
###########
else if ($odcien == "niebieski"){
$zapytanie ="UPDATE rangi SET kolor='3399ff' WHERE numergg='$numergg'";
$niebieski = mysql_query($zapytanie);

if ($niebieski){
echo "Ustawiles kolor pisania: niebieski";

} else echo "Ustawienie koloru nieudane";
}
##################
###########
else if ($odcien == "czerwony"){
$zapytanie ="UPDATE rangi SET kolor='ff0000' WHERE numergg='$numergg'";
$czerwony = mysql_query($zapytanie);

if ($czerwony){
echo "Ustawiles kolor pisania: czerwony";

} else echo "Ustawienie koloru nieudane";
}
##################
###########
else die('Nieprawidlowa nazwa koloru');
}


###########koniec zmiany koloru

#######wiadomosc globalna
function wiad_globalna($funkcja, $wyslane){

global $numergg, $numer_bota, $login_bota, $haslo_bota;
$rozdzielenie = explode(" ", $wyslane);
		$wiadomosc = strstr($wyslane, $rozdzielenie[1]);


$M = new MessageBuilder();
$result2 = $funkcja;
while ($pokaz = mysql_fetch_assoc($result2)){// otrzymanie w wyniku tablicy
	
	if ($pokaz['numergg'] == $numergg) {//usuniecie z tablicy wlasnego numeru gg
	unset ( $pokaz['numergg'] );
}
	$klucz[] = $pokaz['numergg'];
	$M->setRecipients($klucz);
	}
	$M->addBBcode('[b][i][color=008000]Wiadomosc administracji: ' . $wiadomosc . '[/color][/i][/b]');
	$P = new PushConnection($numer_bota, $login_bota, $haslo_bota);	
	$P->push($M); // wys³anie wiadomoœci do odbiorców
	$M->clear();
	echo "Wiadomosc globalna zostala wyslana";
} 

####koniec wiadomosci globalnej
##############wyswietlenie numeru admina
function kto_admin($funkcja){
$pokaz = mysql_fetch_assoc($funkcja);
$numer_adm = $pokaz['admin'];

if (!empty($numer_adm)){
 return $numer_adm;
 }
 else return 0;
}
##################
#########rejestracja na stronie
function rejestracja($funkcja, $wyslane){
global $numergg;
$admin = kto_admin(temat_sql());

if ($numergg != $admin) die('Nie jestes wlascicielem tego pokoju...');

	$uzytkownik = explode(" ", $wyslane);
	$login = $uzytkownik[1];
	$haslo = $uzytkownik[2];
	$haslo = md5($haslo);
$wynik = num_czat(numer());
$pokaz = mysql_fetch_assoc($funkcja);
$czy_jest = $pokaz['admin'];

if(!empty($czy_jest)) die('Juz jestes zarejestrowany/a');

$zapytanie ="INSERT INTO konta (login, haslo, nr_czatu, admin) VALUES ('$login', '$haslo', '$wynik', '$numergg')";
$wykonaj = mysql_query($zapytanie);

if($wykonaj){
die('Rejestracja powiodla sie, zapamietaj swoje haslo, poniewaz zostalo zaszyfrowane i nie bedzie mozliwe odzyskanie go. W razie zapomnienia mozna wygenerowac nowe');
}
else die('Blad, rejestracja nie powiodla sie');
}
###################

 ########usuniecie kanalu
function usun_kanal($funkcja1, $funkcja2, $funkcja3, $wyslane){
 
$result1 = $funkcja1;
$result2 = $funkcja2;
$result3 = $funkcja3;

$rozgrupowanie = explode(" ", $wyslane);
$numer = $rozgrupowanie[1];

if (!is_numeric($numer)){
die('Numer kanalu wpisany niepoprawnie');
} 
 if (empty($numer)){
die('Wszystkie dane musza zostac wypelnione');
}

while ($pokaz = mysql_fetch_assoc($result1)){
if ($numer == $pokaz['num_c']){
	$wartosc = 1;
	}	
}
if (empty($wartosc)){
die('Numer kanalu do usuniecia nie istnieje');
}
else {
    $zapytanie1 ="DELETE FROM `numery_czat` WHERE `num_c`='$numer'";
	$usun1 = mysql_query($zapytanie1);
	$zapytanie2 ="DELETE FROM `rangi` WHERE `num_c2`='$numer'";
	$usun2 = mysql_query($zapytanie2);
	if ($usun1 & $usun2){
	echo 'Usunieto kanal i rangi. ';
	}
	else die ('Nie udalo sie usunac kanalu');
}

while ($pokaz2 = mysql_fetch_assoc($result2)){

if ($pokaz2['num_c'] == $numer){
    $zapytanie3 ="DELETE FROM `uzytkownicy_online` WHERE `num_c`='$numer'";
	$usun3 = mysql_query($zapytanie3);
}
}

while ($pokaz3 = mysql_fetch_assoc($result3)){
if ($pokaz3['nr_czatu'] == $numer){
	$zapytanie3 ="DELETE FROM `konta` WHERE `nr_czatu`='$numer'";
	$usun3 = mysql_query($zapytanie3);
}
}

}
 ####################koniec usuniecia kanalu


?>