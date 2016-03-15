<?php


if (rangi(rangi_sql()) == "mod"){

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

############kickowanie

if (substr($malelitery,0,7) == "/kick2 "){

kick(nazwa_nicku(), $wyslane);
die();
}
###########koniec kickowania

#######zwykly kick bez opcji +1##
if (substr($malelitery,0,6) == "/kick "){

kick2(nazwa_nicku(), $wyslane);
die();
}

#### koniec kicka bez opcji +1


#########kickowanie nieaktywnych

if ($malelitery == "/nieaktywni"){
nieaktywni(nazwa_nicku()); 
die();
}
###############koniec kickowania nieaktywnych

###zmiana tematu rozmowy
if (substr($malelitery,0,7) == "/temat "){

temat(temat_sql(), $wyslane);
die();
}
#####koniec zmiany tematu





}



?>