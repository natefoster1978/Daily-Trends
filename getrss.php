<?php
//get parametro url
$q=$_GET["q"];

//feeds
if($q=="El Pais") {
  $xml=("http://ep00.epimg.net/rss/elpais/portada.xml");
} elseif($q=="El Mundo") {
  $xml=("https://e00-elmundo.uecdn.es/elmundo/rss/espana.xml");
}

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get elementos "<channel>"
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')
->item(0)->childNodes->item(0)->nodeValue;

//output elementos "<channel>"
echo("<p><a href='" . $channel_link
  . "'>" . $channel_title . "</a>");
echo("<br>");
echo($channel_desc . "</p>");

//get y output "<item>" elementos
$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<=2; $i++) {
  $item_title=$x->item($i)->getElementsByTagName('title')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$x->item($i)->getElementsByTagName('description')
  ->item(0)->childNodes->item(0)->nodeValue;
  echo ("<p><a href='" . $item_link
  . "'>" . $item_title . "</a>");
  echo ("<br>");
  echo ($item_desc . "</p>");
  $img = $x->item($i)->getElementsByTagName('enclosure');
  //echo "<img src=\"" . $img[0]->getAttribute('url') . "\">";
}
?> 