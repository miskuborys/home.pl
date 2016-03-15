<?php

require_once('pliki/MessageBuilder.php');
  require_once('pliki/PushConnection.php');
  if ($_SERVER['REMOTE_ADDR']!='91.197.15.34') die('czat gg 58434972, aby dolaczyc wpisz start');
	include('pliki/logowanie.php');
	
	
	
	$M = new MessageBuilder();
	  $wyslane = strip_tags($HTTP_RAW_POST_DATA);
mb_strtolower($wyslane,"UTF-8");
	$numergg = $_GET['from'];
	$login = str_replace(" ", "_", $wyslane);
	$malelitery = mb_strtolower($wyslane,"UTF-8");
	
	
	$polaczenie = mysql_connect($host_mysql, $dbuser, $haslo_mysql) or die("Brak poณฑczenia: " . mysql_error());
$baza = mysql_select_db($nazwa_bazy ,$polaczenie) or exit("Nie wybrano bazy, bณฑd: " . mysql_error());
	
	include('pliki/funkcje.php');
	
		//antyspam
spamowanie(spam_numer());
//koniec antyspam
	
	
	###########logi
	$wynik = num_czat(numer());
$zapytanie8 = "INSERT INTO log (numer, tresc, data, data2, kanal) VALUES ('$numergg', '$wyslane', NOW(), CURDATE(), '$wynik')";
			        
mysql_query($zapytanie8);
$nick = login3($numergg, login());
if (login2($numergg, login()) == 1){

$zapytanie15 = "UPDATE log SET login ='$nick' WHERE numer=". $numergg;
mysql_query($zapytanie15);

$czas=date('Y-m-d H:i:s');

$zapytanie16 = "UPDATE uzytkownicy_online SET data3 = '".$czas."' WHERE numergg=". $numergg;
mysql_query($zapytanie16);
}

###############koniec logow
	
	
	####zablokowanie wstepu zbanowanym	
	zbanowani(user_zbanowany());


	########koniec blokady	
	
	
	if (numer2(numer())==0){
	

	
	#####
	$sql = "SELECT num_c, nazwa_c FROM numery_czat WHERE id";
	$result = mysql_query($sql);
	while ($pokaz = mysql_fetch_assoc($result)){
	$num_czat = $pokaz['num_c'];
	$nazwa_czat = $pokaz['nazwa_c'];
	
	
	if(isset($num_czat)){
	if ($num_czat == $malelitery){
	
	$numer_prawidlowy = $num_czat;
	$nazwa_prawidlowa = $nazwa_czat;
	}
	
	}
	
	
	
	}
	if (isset($numer_prawidlowy)){
	
	#####
	
	
	
	 if (dodanie_numeru($numergg, $czas, $numer_prawidlowy) == 1){
	if (dodanie_numeru1(login2($numergg, login()))==1){
	echo "Podaj swoj nick np. Agnieszka";
	
	 die();
	 }
	
		
	
	}
	}
	else echo "Bledny numer, wybierz inny np. z ponizszej listy";
	
	
		
	
	}
	### osoba jest w online, dodanie do bazy####
	
	else if (numer2(numer())==1 & login3($numergg, login())==1){
 
 
 if (dodanie_nicku($login) == 1){
 echo "Dolaczyles/as do czatu, a twoj nick: " . $login . " zostal dodany do naszej glownej bazy.\r\n Aby wyjsc z czatu napisz koniec\r\nAby zobaczyc inne funkcje czatu, napisz pomoc";
 
 }
 else echo "dodanie nie powiodlo sie";
	$wiadomosc2 = 'zarejestrowal/a sie i dolaczyl/a na czat';
	rozmowa(nazwa_nicku(), $wiadomosc2);
  die();
 
 }
	
	else if (login3($numergg, login()) != 1 & numer2(numer($numergg))==1){
	 //rozmowa czatowa
 
	if ($malelitery == "/wyjscie" || $malelitery == "/q" || $malelitery == "/quit" || $malelitery == "/exit" || $malelitery == "wyjscie" || $malelitery == "q" || $malelitery == "quit" || $malelitery == "exit" || $malelitery == "koniec" || $malelitery == "/koniec" || $malelitery == "/stop" || $malelitery == "stop" || $malelitery == "wyjลcie" || $malelitery == "/wyjลcie"){
		wyjscie();
		die();
}
 
		//komendy czatowe
		include('pliki/komendy_czatowe.php');
		#################
		//ustalenie rang
		include('pliki/rangi/funkcje_rangi.php');
		include('pliki/rangi/ranga_admin.php');
		include('pliki/rangi/ranga_mod.php');
		include('pliki/rangi/ranga_vip.php');
		####################
 
 
 rozmowa2(nazwa_nicku(), $wyslane);
 //koniec rozmow
	
	die();
	}
	
	
	
	
	if (($malelitery == $numer_prawidlowy)){
	
	$temat = czy_temat(temat_sql());
	echo $nick . " Witamy ponownie na czacie: " . $nazwa_prawidlowa . "\r\n
	" . $temat . " \r\n\r\nAby zobaczyc pomoc wpisz pomoc, aby wyjsc wpisz koniec";
  
	$wiadomosc2 = 'dolaczyl/la na czat';
	rozmowa(nazwa_nicku(), $wiadomosc2);
	 die();
	
	}
	else 
	echo "\r\n\r\n Lista 10 poczatkowych kanalow/pokoi czatowych:\r\n";
	pierwsze(zalozenie_kanalu());
	
	echo "Cala lista kanalow dostepna jest na stronie kanal.czat-gg.pl\r\n\r\n Zapraszamy takze na czat glowny gg 5037777 oraz forum Pomoc-Gracza.pl";
	
	
	



?>