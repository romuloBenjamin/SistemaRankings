<?php //require $this->dirs->path."modules/ranking/ranking-class.php"; ?>
<!-- Container Rankings -->
<div class="rankings-main">
    <h1>Cadastrar Rankings</h1>
    <!-- Container Formulario Rankings -->
    <div class="container-rankings">
        <form action="javascript: void(0);" id="formulario-rankings" class="formulario-rankings" method="post"> 
            <!-- Inner Container Formulario Rankings-->
            <div class="d-grid">
                <!-- Dados de Identificação -->
                <hr>               
                <div class="rowDadosIdentificacao"> 
                    <div class="input-group">
                        <small class="input-group-text">Data de Cadastro:</small>
                        <input type="date" class="form-control" name="dataCadastro" id="dataCadastro" value="<?=date('Y-m-d');?>">
                    </div>
                    <div class="input-group">
                        <small class="input-group-text">Nº Romanio:</small>
                        <input type="number" class="form-control" name="nRomaneio" id="nRomaneio" placeholder="Infome o Romaneio">
                    </div>
                    <div class="input-group">
                        <small class="input-group-text">Nome do Motorista:</small>
                        <input type="text" class="form-control" name="nomeMotorista" id="nomeMotorista" placeholder="Motorista deste Romaneio">
                    </div>
                    <!-- View Rankings -->
                    <div class="viewRankings">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item">05</li>
                            <li class="list-group-item">05</li>
                            <li class="list-group-item">[]</li>
                        </ul>
                    </div>
                    <!-- View Rankings -->
                </div>
                <hr>
                <!-- Dados de Identificação -->
                
                <!-- Nota Retorno de Entregas -->
                <div class="rowNotaEntrega">
                    <div class="d-grid justify-content-between">
                        <div class="linhaNotaEntrega">
                            <small>Nota da Entrega:</small>
                            <input type="number" name="pontuacaoEntrega" id="pontuacaoEntrega" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Nota Retorno de Entregas -->
                
                <!-- Nota Serviço Entrega (Cliente) -->
                <div class="rowNotaCliente">
                    <div class="d-grid justify-content-between">
                        <button><i class="fa-solid fa-circle-plus"></i> Cadastrar nota do cliente</button>
                        <div class="d-none linhaNotaCliente">
                            <small>Nota do Cliente:</small>
                            <input type="number" name="pontuacaoCliente" id="pontuacaoCliente" class="form-control">
                        </div>
                    </div>
                </div>
                <!-- Nota Serviço Entrega (Cliente) -->
            </div>
            <!-- Inner Container Formulario Rankings-->
        </form>
    </div>
    <!-- Container Formulario Rankings -->
</div>
<!-- Container Rankings -->