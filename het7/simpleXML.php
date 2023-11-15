<?php
$note = <<<XML
<note>
    <people>
        <fname>Jani</fname>
        <lname>McDonald</lname>
        <profession>teacher</profession>
    </people>
</note>
XML;

$xml = new SimpleXMLElement($note);
print_r($xml);

$xml->saveXML('mentett.xml');
//$xml->asXML('mentett.xml')



$xmlstr = <<<XML
<movie>
</movie>
XML;
$movies=new SimpleXMLElement($xmlstr);
$movies->addChild('Actors');
$movies->Actors->addChild('actorName', 'Brad Pitt');
$movies->Actors->actorName->addAttribute('nemzetiseg','amerikai');
$movies->asXML('filmek.xml');

$xmlData = simplexml_load_file('mentett.xml');
foreach ($xmlData->children() as $ember){
    echo '<br>'.$ember->fname.' ';
    echo $ember->lname.' - ';
    echo $ember->profession.'<br>';
}
$rsult = $xmlData->xpath('/note/people/fname');
print_r($rsult);
?>