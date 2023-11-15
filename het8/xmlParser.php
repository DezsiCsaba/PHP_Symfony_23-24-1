<?php

$parser_object = xml_parser_create('UTF-8');
xml_parser_set_option($parser_object, XML_OPTION_TARGET_ENCODING, 'UTF-8');
xml_set_element_handler($parser_object, 'startElement', 'endElement');
xml_set_character_data_handler($parser_object, 'contentHandler');

//#region parser_object funcs
function startElement($parser_object, $elementName, $attribute){
    echo '<br> <ul>';
    echo '&lt'.$elementName;
    foreach ($attribute as $key=>$value){
        echo $key .': '.$value;
    }
    echo '&gt';
}

function endElement($parser_object, $elementName){
    echo '&lt/'.$elementName.'&gt';
    echo '<br> </ul>';
}

function contentHandler($parser_object, $data){
    if (trim($data) != ''){
        echo "<font color='blue'> $data </font>";
    }
}
//#endregion

$file = fopen('emberek.xml', 'rb');
while ($data = fread($file, 8000)){
    if (!xml_parse($parser_object, $data, feof($file))){
        die(sprintf(
            "<br> [ERROR] XML hiba: %s a %d sorban, %d oszlopban",
            xml_error_string(xml_get_error_code($parser_object)),
            xml_get_current_line_number($parser_object),
            xml_get_current_column_number($parser_object)
        ));
    }
}
xml_parser_free($parser_object);
fclose($file);

?>