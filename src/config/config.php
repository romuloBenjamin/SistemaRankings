<?php
class Config
{
    var $template;
    var $dirs;
    var $db;
    public function __construct($params)
    {
        $this->listas = new stdClass();
        $this->template = new stdClass();
        $this->dirs = new stdClass();
        $this->set_directories($params);
        $this->init();
    }

    public function set_directories($params)
    {
        $project = "module-rankings";
        $xplodes = explode($project, $params)[1];
        ($xplodes == "") ? $this->dirs->path = "./src/" : $this->dirs->path = "../../../";
        $this->dirs->project = $project;
        return $this->dirs;
    }

    public function set_conexoes($mode)
    {
        require $this->dirs->path . "modules/conexoes/main.php";
        $main = new Main($mode);
        $this->db = $main->db;
        return $this->db;
    }

    public function load_init()
    {
        if ($this->listas->init->sessions == true) session_start();
        if ($this->listas->init->conexao->status == true) {
            $mode = $this->listas->init->conexao->mode;
            $this->set_conexoes($mode);
        }
    }

    public function load_init_config()
    {
        $url = $this->dirs->path . "assets/jsons/init-json.json";
        $this->listas->init = json_decode(file_get_contents($url));
        $this->load_init();
    }

    public function loud_builder()
    {
        require $this->dirs->path . "config/pageBuilder.php";
        return $this->template = new PageBuilder($this->dirs);
    }

    public function init()
    {
        $this->load_init_config();
        if ($this->dirs->path == "./src/") $this->loud_builder();
        //$this->visualizar();
    }

    public function visualizar()
    {
        var_dump("not implemented");
    }
}
