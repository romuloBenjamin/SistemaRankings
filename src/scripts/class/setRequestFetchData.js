export class SetRequestToFetchData {
    responser;
    entry;
    mode;
    url;
    constructor(params1 = undefined) {
        if(params1 === undefined || params1 === null) this.destruct()
        this.entry = params1
        this.url = params1.url
        //Modes => dev ou prod
        this.mode = 'dev'
        this.responser = {}
    }

    destruct() {
        this.entry = undefined
        return;
    }
    //Set Request
    setRequest() {
        return new Request(this.url)
    }

    //Get dados to Status 3
    getDados_status3(dados) {
        dados.status = 3
        dados.text = "Dados Vazios ou Nulos"
        delete dados.dados;
        return dados
    }

    //Get Dados Via Fetch
    async getDados(request) {
        const dados_fetched = {};
        const response = null;
        const dados = {}
        try {
            const ifetch = await fetch(request)
            //Get Dados From Core in Modes Dev & Prod and Set dados data
            if(this.mode === 'dev') dados.dados = await ifetch.text()
            if(this.mode === 'prod') dados.dados = await ifetch.json()
            dados.status = 1
            dados.text = "Dados obtidos com Sucesso!"            
            if(dados.dados === "" || dados.dados === null) this.getDados_status3(dados)
            this.responser = dados
        } catch (error) {
            dados.status = 0
            dados.text = "Desculpe, ocorreu um problema ao obter dados!"
            this.responser = dados
        }
        return;
    }

    //Init
    async init() {        
        //Get Request
        let request = this.setRequest()
        //Get Fetch
        await this.getDados(request)
        return this.visualizar()
    }

    async visualizar() {
        return this.responser
    }
}