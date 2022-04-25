export class SetRequestToFetchData {
    responser;
    postData;
    method;
    entry;
    mode;
    url;
    constructor(params1 = undefined, params2 = "GET") {
        if(params1 === undefined || params1 === null) this.destruct()
        this.entry = params1
        this.url = params1.url
        //Methods => GET & POST
        this.method = params2
        this.postData = null
        //Modes => dev & prod
        this.mode = 'prod'
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

    //Get Data to Post Resquet || Get Data Samples
    getPullMethod() {
        const pullMethod = {}
        //Add Method GET & POST
        pullMethod.method = this.method
        //Add Body to Send
        if(this.method === "POST") {
            pullMethod.body = JSON.stringify(this.entry)
        }
        return pullMethod
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
            //Set Pull Method
            var pullMethod = this.getPullMethod()
            //Set Fetch Data
            const ifetch = await fetch(request, pullMethod)            
            //Get Dados From Core in Modes Dev & Prod and Set dados data
            if(this.mode === 'dev') dados.dados = await ifetch.text()
            if(this.mode === 'prod') dados.dados = await ifetch.json()            
            dados.status = 1
            dados.text = "Dados obtidos com Sucesso!"
            //If Null Result Change Status to 3
            if(dados.dados === "" || dados.dados === null) this.getDados_status3(dados)
            //Send Back responser Content
            this.responser = dados
        } catch (error) {
            dados.status = 0
            dados.text = "Desculpe, ocorreu um problema ao obter dados!"
            //Send Back responser Content (Error)
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
        //View Dados Retornados
        return this.visualizar()
    }

    async visualizar() {
        return this.responser
    }
}