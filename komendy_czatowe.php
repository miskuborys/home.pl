<?php


#####regulamin
if ($malelitery == "/regulamin" || $malelitery == "/reg" || $malelitery == "regulamin" || $malelitery == "reg"){
include('regulamin.php');
$M->reply();
		die();
		}
####koniec regulaminu

//komendy czatowe
include('funkcje_komendy.php');
#################

//wiadomosci prywatne
if (substr($malelitery,0,6) == "/priv " || substr($malelitery,0,3) == "/p "){

priv(nazwa_nicku(), $wyslane);

die();
}

##########koniec wiadomosci prywatnych

####pomoc#########

if ($malelitery == "/pomoc" || $malelitery == "/help" || $malelitery == "pomoc" || $malelitery == "help"){
$M->addText('Pomoc:' . "\r\n" . 'Aby opuscic czat, wpisz koniec' . "\r\n\r\n" . 'Uzytkownicy aktualnie zalogowani, wpisz /online' . "\r\n\r\n" . 'Nasz regulamin - wpisz /regulamin' . "\r\n\r\n" . 'Aby wyslac wiadomosc prywatna wpisz /priv nick wiadomosc np. /priv Karolina czesc co tam slychac' . "\r\n\r\n" . 'Obsluga czatu, wpisz /obsluga' . "\r\n\r\n" . 'Jaki temat rozmowy?, wpisz /temat' . "\r\n\r\n" . 'Tworzenie nowego kanalu, /register nazwa numer' . "\r\n\r\n");

if (rangi(rangi_sql()) == "sadmin" || rangi(rangi_sql()) == "admin" || rangi(rangi_sql()) == "mod" || rangi(rangi_sql()) == "vip" || rangi(rangi_sql()) == "hadmin"){
$M->addText('Zmiana nicka, wpisz /nick nowy_nick np. /nick Karolina2' . "\r\n\r\n" . 'Zmiana koloru, wpisz /kolor odcien np. /kolor zielony. Dostepne odcienie: zielony, pomaranczowy, czarny, rozowy, niebieski, czerwony' . "\r\n\r\n" . 'Zmiana tematu rozmowy, wpisz /temat tresc' . "\r\n\r\n");
}
if (rangi(rangi_sql()) == "sadmin" | rangi(rangi_sql()) == "admin" | rangi(rangi_sql()) == "mod" || rangi(rangi_sql()) == "hadmin"){
$M->addText('Aby wyprosic nieaktywne osoby (10 minut bez pisania), wpisz /nieaktywni' . "\r\n\r\n" . 'Aby wyprosic kogos z czatu, wpisz /kick nick powod np. /kick Stefan zle zachowanie' . "\r\n\r\n");
}
if (rangi(rangi_sql()) == "sadmin" | rangi(rangi_sql()) == "admin" || rangi(rangi_sql()) == "hadmin"){
$M->addText('Aby zmienic komus nick, wpisz /zmien nick nowy_nick np. /zmien Stefan Mariusz' . "\r\n\r\n" . 'Aby zbanowac uzytkownika, wpisz /ban czas( do wyboru np. 1, dzien, tydzien, miesiac, rok) nick powod np. /ban 5 anka zle zachowanie(liczba oznacza ilosc minut), dla odbanowania /unban nick' . "\r\n\r\n");
}
if (rangi(rangi_sql()) == "sadmin" || rangi(rangi_sql()) == "hadmin"){
$M->addText('Aby zmienic range uzytkownikowi, wpisz /ranga nazwa_rangi nick np. /ranga admin Maciej, dostepne rangi: admin, mod, vip, user' . "\r\n\r\n");
}
if (rangi(rangi_sql()) == "hadmin"){
$M->addText('Aby usunac kanal, wpisz /usun numer, np. /usun 100' . "\r\n\r\n");
}

	 $M->addText('Autor czatu - Wpisz /autor');
		
		
		$M->reply();
		die();
}
#################koniec pomocy###########3

#############obsluga

if ($malelitery == "/obsluga" || $malelitery == "obsluga" || $malelitery == "obsługa" || $malelitery == "/obsługa"){
obsluga(login());
die();
}
##############koniec komendy obsluga

////////////////////
########online

if ($malelitery == "/online" || $malelitery == "/users" || $malelitery == "/u" || $malelitery == "online" || $malelitery == "users"){

online(nazwa_nicku());
die();
}
#############################
////////o autorze///// nie usuwac!!!!!!!!!
if ($malelitery == "/autor" || $malelitery == "autor" || $malelitery == "ver" || $malelitery == "/ver"){

$M->addText('Czat zaprogramowal' . "\r\n\r\n" . 'KoKs'. "\r\n\r\n" . 'gg: 53125117' .  "\r\n\r\n" . 'Czat autora: gg 53125117' . "\r\n\r\n" . 'Znalazles/as blad na czacie? Napisz do mnie, a postaram sie poprawic');
		$M->reply();
		die();
}
#############

########jaki jest temat
if ($malelitery == "/temat" || $malelitery == "temat"){

$M->addText(czy_temat(temat_sql()));
		$M->reply();
		die();
}
#########

########rejestracja kanalu
if (substr($malelitery,0,10) == "/register "){

zarejestrowanie(zalozenie_kanalu(), $wyslane);

die();
}

########



?>
