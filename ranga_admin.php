<?php


if (rangi(rangi_sql()) == "admin" || rangi(rangi_sql()) == "sadmin" || rangi(rangi_sql()) == "hadmin"){

#######zmiana koloru
if (substr($malelitery,0,7) == "/kolor "){
kolor($wyslane);
die();
}
###########koniec zmiany koloru

########zmiana nicka
if (substr($malelitery,0,6) == "/nick "){
zmiana_nicka($wyslane);
die();
}

########koniec zmiany nicka



#######zwykly kick bez opcji +1##
if (substr($malelitery,0,6) == "/kick "){

kick2(nazwa_nicku(), $wyslane);
die();
}

#### koniec kicka bez opcji +1


#########kickowanie nieaktywnych

if ($wyslane == "/nieaktywni"){
nieaktywni(nazwa_nicku()); 
die();
}
###############koniec kickowania nieaktywnych

##########banowanie#########

if (substr($malelitery,0,5) == "/ban "){

ban(login(), $wyslane);
die();
}
#############koniec banowania

#######unban
if (substr($malelitery,0,7) == "/unban "){

unban(user_zbanowany(), $wyslane);
die();
}

########koniec unbana


#######zmiana nicku innej osobie
if (substr($malelitery,0,7) == "/zmien "){

zmien_nick(nazwa_nicku(), $wyslane);
die();
}

############koniec zmiany nicku



###zmiana tematu rozmowy
if (substr($malelitery,0,7) == "/temat "){

temat(temat_sql(), $wyslane);
die();
}
#####koniec zmiany tematu


}
#############komendy super admina zmiana rangi
if (rangi(rangi_sql()) == "sadmin" || rangi(rangi_sql()) == "hadmin"){

if (substr($malelitery,0,7) == "/ranga "){
zmiana_ranga(nazwa_nicku(), $wyslane);


die();

}


#####################koniec zmiany rangi
###########rejestracja na stronie
if (substr($wyslane,0,13) == "/rejestracja "){
rejestracja(konta_adminow(), $wyslane);

		die();
}

##################



}
if (rangi(rangi_sql()) == "hadmin"){
######wiadomosc globalna
if (substr($malelitery,0,8) == "/global "){
wiad_globalna(globalna(), $wyslane);
##########koniec wiadomosci globalnej

die();

}

##########zmiana opisu
if (substr($malelitery,0,6) == "/opis "){

zmiana_opis($wyslane);
die();
}


##############koniec zmiany opisu


###########usuniecie kanalu

if (substr($malelitery,0,6) == "/usun "){

usun_kanal(zalozenie_kanalu(), globalna(), konta_adminow2(), $wyslane);

die();
}

######koniec usuniecia kanalu


}

###################koniec komend superadmina
?>