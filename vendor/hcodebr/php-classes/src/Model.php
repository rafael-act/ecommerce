<?php

    namespace Hcode;

     class Model{

        private $values=[];

        public function __call($name, $args)
        {
            $method = substr($name,0,3);//verifica os 3 primeiros digitos do nome
            $fieldName = substr($name,3,strlen($name));

            switch  ($method){
                case "get":
                    return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : NULL;
                    break;
                case "set":
                    $this->values[$fieldName] = $args[0];
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