<?php 
namespace Hcode;

use Rain\Tpl;

class  Page{
    private $tpl;
    private $options=[];
    private $defaults = [//opções padrão
        "data"=>[]
    ];

    public function __construct($opts = array(), $tpl_dir = "/ecommerce/views/")//caminho alterado para ser utilizado local diferente da aula
    {
        $this->options=array_merge($this->defaults, $opts);//merge das opções dos arrais
        $config = array(
            "tpl_dir" => $_SERVER["DOCUMENT_ROOT"] . $tpl_dir,
            "cache_dir"=>$_SERVER["DOCUMENT_ROOT"]."/views-cache/",
            "debug"=>false
        );

        Tpl::configure($config);

        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);

        $this->tpl->draw("header");
    }

    private function setData($data = array()){
        foreach ($data as $key => $value) {
            $this->tpl->assign($key,$value);
        }
    }

    public function setTpl($name, $data=array(), $returnHtml=false){
      $this->setData($data);

      $this->tpl->draw($name,$returnHtml);
    }

    public function __destruct()
    {
       $this->tpl->draw("footer"); 
    }
}
?>