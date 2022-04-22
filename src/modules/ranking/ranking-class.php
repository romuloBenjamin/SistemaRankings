<?php 
class Ranking
{
    var $build;
    var $mode;
    var $entry;

    public function __construct($params1 = null)
    {
        //Mode Operation of this class: dev & prod
        $this->mode = 'dev';
        //Get Entry Data
        if($params1 != null) $this->entry = $params1;
        //Build Variables
        $this->build = array();
    }

    public function init()
    {
        return $this->visualizar();
    }

    public function visualizar()
    {
        if($this->mode == 'dev') echo json_encode($this);
        if($this->mode == 'prod') var_dump($this);
    }
}
