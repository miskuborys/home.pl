<?php
function regulamin($funkcja){
$pokaz = mysql_fetch_assoc($funkcja);
$regulamin = $pokaz['regulamin'];
if (empty($regulamin)){
$reg = "Regulamin nie jest jeszcze ustalony przez administratora kanalu";
return $reg;
}
else return $regulamin;
}

$M->addText("Uwaga!!! Regulamin kanalu tworzy jego administrator, jesli nie zgadzasz sie z jego warunkami, to przejdz na inny kanal!!\r\n\r\nREGULAMIN\r\n
");
$M->addText(regulamin(temat_sql()));


?>