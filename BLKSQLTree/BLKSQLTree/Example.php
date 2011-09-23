<?php
include_once dirname(__FILE__).'/Zone/class.finalzone.php';

$cnn=Sql::getConnection("mysql",  array("Server" => "127.0.0.1","User" => "root","Password" => "","Database" => "blk_tree"));

$data= FinalZone::getRootZone($cnn);

$data->getZone("A");
$data->getZone("B");
$t=$data->getZone("C");
$t->getZone("CA");
$t->getZone("E");
$tt=$t->getZone("CB");
$t->getZone("CC");
$d=$data->getZone("D");



$o=$d->getAttribute("att1");
$o->set("valatt1");
echo $o->get();

?>
