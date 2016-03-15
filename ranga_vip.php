<?php


if (rangi(rangi_sql()) == "vip"){

########zmiana nicka
if (substr($malelitery,0,6) == "/nick "){
zmiana_nicka($wyslane);
die();
}

########koniec zmiany nicka

#######zmiana koloru
if (substr($malelitery,0,7) == "/kolor "){
kolor($wyslane);
die();
}
###########koniec zmiany koloru

###zmiana tematu rozmowy
if (substr($malelitery,0,7) == "/temat "){

temat(temat_sql(), $wyslane);
die();
}
#####koniec zmiany tematu

}

?>