<?php 
class Ranking
{
    var $build;
    var $mode;
    var $entry;

    public function __construct()
    {
        //Mode Operation of this class: dev & prod
        $this->mode = 'dev';
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
