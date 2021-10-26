<?php

    namespace Hcode;

     class Model{

        private $values=[];

        public function __call($name, $args)
        {
            $method = substr($name,0,3);//verifica os 3 primeiros digitos do nome
            $fieldname = substr($name,3,strlen($name));

            switch  ($method){
                case "get":
                    $this->values[$fieldname];
                    break;
                case "set":
                    $this->value[$fieldname] = $args[0];
                    break;
            }
        }

        public function setData($data = array()){
            foreach ($data as $key => $value) {
                $this->{"set".$key}($value);            
            }
        }

        function getValues(){
            return $this->values;
        }
    }