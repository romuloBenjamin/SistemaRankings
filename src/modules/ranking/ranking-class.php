<?php 
class Ranking
{
    var $result;
    var $loops;
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
    //Rankings Patterns
    public function get_patterns_ranking()
    {
        $this->patterns = new stdClass();
        $this->patterns->romaneio = array("data", "hora", "por", "motorista");
        return $this->patterns;
    }
    //SQL Rankings Pontos
    public function sql_find_motorista_by_romaneio()
    {
        //Data
        $data = "rom_romaneio = '".$this->entry->romaneio."' ORDER BY rom_data_cadastro DESC";
        //SQL Select
        $this->sql->pontos = "SELECT rom_data_cadastro, rom_cadastrado_por, rom_motorista FROM intrav2_romaneios WHERE $data";
        return;
    }

    //Execute Query
    public function execute_query($sql)
    {
        $execute = new Main("intra");
        $execute->sql = $sql;
        return $execute->conexao_query();
    }

    //Ranking Loopdata
    public function ranking_loopdata()
    {
        $this->build["inner"] = array();
        while($itens = $this->result->fetch_array()) {
            foreach ($itens as $tags => $content) {
                if(!is_int($tags)) {
                    if($tags == "rom_data_cadastro") {
                        $dataHora = explode(" ", $content);
                        $this->build["inner"]["data"] = $dataHora[0];
                        $this->build["inner"]["hora"] = $dataHora[1];
                    }else{
                        $this->build["inner"][$tags] = $content;
                    }
                }
            }
            $this->loops = array_combine($this->patterns->romaneio, $this->build["inner"]);
        }
        $this->build = array();
        return $this->loops;
    }

    //Initialise Data
    public function init()
    {
        //Get Patterns
        $this->get_patterns_ranking();
        //Set SQL Data
        $this->sql_find_motorista_by_romaneio();
        //Execute Query
        $this->result = $this->execute_query($this->sql->pontos);
        //Get Loopdata
        $this->ranking_loopdata();
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
