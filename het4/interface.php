<?php
    interface ITemplateA{
        public function getHTML($template);
    }
    interface ITemplateB{
        public function setVariable($name, $var);
    }

    class Template implements ITemplateA,ITemplateB{
        private $vars = array();
        public function getHTML($template){
            foreach ($this->vars as $name=>$value){
                $template = $name." ".$value;
            }
            return $template;
        }
        public function setVariable($name, $var){
            $this->vars[$name] = $var;
        }
    }


    $tomb = new Template();
    $tomb->setVariable("index", "tartalom");
    echo $tomb->getHTML(" ")."<br>"
?>
