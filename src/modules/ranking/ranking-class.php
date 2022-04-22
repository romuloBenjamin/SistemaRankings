<?php 
class Ranking
{
    var $result;
    var $build;
    var $entry;
    var $mode;
    var $sql;

    public function __construct($params1 = null)
    {
        //Mode Operation of this class: dev & prod
        $this->mode = 'dev';
        //Get Entry Data
        if($params1 != null) $this->entry = $params1;
        //SQL Datas
        $this->sql = new stdClass();
        //Build Variables
        $this->build = array();
    }
    //SQL Rankings Pontos
    public function sql_find_motorista_by_romaneio()
    {
        //Data
        $data = "rom_romaneio = '".$this->entry->romaneio."'";
        //SQL Select
        $this->sql->pontos = "SELECT * FROM intrav2_romaneios WHERE $data";
        return;
    }

    //Execute Query
    public function execute_query($sql)
    {
        $execute = new Main("webold");
        $execute->sql = $sql;
        return $execute->conexao_query();
    }

    //Initialise Data
    public function init()
    {
        //Set SQL Data
        $this->sql_find_motorista_by_romaneio();
        //Execute Query
        $this->result = $this->execute_query($this->sql->pontos);
        //Visualizar Dados
        return $this->visualizar();
    }

    //Visualizar Data
    public function visualizar()
    {
        if($this->mode == 'dev') echo json_encode($this);
        if($this->mode == 'prod') var_dump($this);
    }
}
