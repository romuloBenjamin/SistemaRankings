//Imports
import { SetRequestToFetchData as GetRequest } from "../class/setRequestFetchData.js";
//Vars Notas Defaults
const notaEntrega = 5
const notaCliente = 5
const dados = {origin: null, value: null}

//Get Elements in "on Change" & "Keyup"
let inputEntrega = document.getElementById("pontuacaoEntrega")
let inputCliente = document.getElementById("pontuacaoCliente")
let inputRomaneio = document.getElementById("nRomaneio")

//Get Elements in "on Click"
let buttonAddNotaCliente = document.getElementById("addNotaCliente")

//Get Elements to display Score
let imputMotoristaNome = document.getElementById("nomeMotorista")
let viewScoreEntrega = document.getElementById("scoreEntrega")
let viewScoreCliente = document.getElementById("scoreCliente")
let viewMediaScore = document.getElementById("scoreMedia")

//View Score Motorista - NULLS
const UpdateViewScoreNULL = () => {
    if(dados.origin === "entrega") viewScoreEntrega.innerHTML = notaEntrega.toString().padStart(2, '0');
    if(dados.origin === "cliente") viewScoreEntrega.innerHTML = notaCliente.toString().padStart(2, '0');
    //Reset Romanios
    dados.romaneio = null
    //Reset Value & Origin
    dados.value = null
    dados.origin = null
    return dados
}

//Set Score Motorista
const setScore = () => {
    //Se Null
    if(dados.value === null) return false
    //The Score
    dados.score = {entrega: notaEntrega, cliente: notaCliente}
    //Pontuação de Entrega
    if(dados.origin === "entrega") viewScore_entrega()
    //Pontuação de Clientes
    if(dados.origin === "cliente") viewScore_cliente()
}

//View Score Motorista (Entrega)
const viewScore_entrega = () => {
    if(dados.value > 5)  { 
        dados.value = 5
        inputEntrega.value = 5
    }
    if(dados.value < 0) { 
        dados.value = 0 
        inputEntrega.value = 0
    }
    dados.score.entrega = dados.score.entrega - dados.value
    viewScoreEntrega.innerHTML  = dados.score.entrega.toString().padStart(2, '0')
    return dados
}

//View Score Motorista (Cliente)
const viewScore_cliente = () => {
    if(dados.value > 5)  { 
        dados.value = 5
        inputCliente.value = 5
    }
    if(dados.value < 0) { 
        dados.value = 0 
        inputCliente.value = 0
    }
    dados.score.cliente = dados.value
    viewScoreCliente.innerHTML  = dados.score.cliente.toString().padStart(2, '0')
    return dados
}

//View Score Motorista
const UpdateViewScore = (event) => {
    if(dados.origin && dados.value === null) return false;
    if(event.target.value === "") UpdateViewScoreNULL();
    if(event.target.value) {
        dados.origin = event.target.id.replace("pontuacao", "").toLowerCase()
        dados.value = event.target.value
    }
    setScore()
}

//View Notas Clientes
const ViewNotaCliente = () => {
    let viewLNC = document.getElementById("linhaNotaCliente")
    viewLNC.classList.toggle("d-none")
    //Add Cliente Button    
    buttonAddNotaCliente.classList.toggle("d-flex")
    buttonAddNotaCliente.classList.toggle("d-none")  
}

//View Modal Message
const pushModalMessage = (message) => {
    let modalOverLay = document.getElementById("overLayMessage")
    if(message?.status === 0) modalOverLay.classList.toggle("d-none");
    if(message?.status === 3) (modalOverLay.classList.contains("d-none")) ? "" : modalOverLay.classList.add("d-none");
    //Cleam Motorista Name if Exists
    imputMotoristaNome.value = "";
    //Remove Hidden Motorista ID & Por ID
    let imputMotoristaNome_pai = imputMotoristaNome.parentElement;
    (imputMotoristaNome_pai.dataset.hasOwnProperty("motoristaId")) ? delete imputMotoristaNome_pai.dataset.motoristaId : "";
    (imputMotoristaNome_pai.dataset.hasOwnProperty("porId")) ? delete imputMotoristaNome_pai.dataset.porId : "";
}

//Push Data to Fields to View Infos
const pushDataToFields = (dados) => {
    //If var 'dados' is undefined
    if(dados === undefined) pushModalMessage(dados = {status: 0, text: "Erro ao identificar Dados Retornados"})
    //Add Motorista to Field "Nome do Motorista"
    imputMotoristaNome.value = dados.motorista[1]
    //Create Hidden Motorista ID & Por ID
    let imputMotoristaNome_pai = imputMotoristaNome.parentElement;
    imputMotoristaNome_pai.dataset.motoristaId = dados.motorista[0]
    imputMotoristaNome_pai.dataset.porId = dados.por[0]
}

//To Rankings
const toRanking = async () => {
    //URL to Fetch Request of data
    dados.url = "./src/scripts/ranking/core/ranking-core.php"
    //Fetch data from Url
    var query = new GetRequest(dados, "POST");
    var execute = await query.init()
    //Execute In Status (1) => Sucesso!
    if(execute?.status === 1) pushDataToFields(execute?.dados)
    //Execute In Status (0) => ERROS
    if(execute?.status === 0) pushModalMessage(execute)
    //Execute In Status (3) => NULOS
    if(execute?.status === 3) pushModalMessage(execute)
}

//Get Dados To Ranking
const getDadosToRank = async () => {
    const romaneio = inputRomaneio.value;
    //Reset Property Romaneio
    if(romaneio === "") UpdateViewScoreNULL()
    //Add Property Romaneio
    if(romaneio != "") {
        dados.romaneio = romaneio
        await toRanking()
    }
}

//Events Change & Keyboard
"change,keyup".split(",").forEach(data => inputEntrega.addEventListener(data, UpdateViewScore));
"change,keyup".split(",").forEach(data => inputCliente.addEventListener(data, UpdateViewScore));
"change,keyup".split(",").forEach(data => inputRomaneio.addEventListener(data, getDadosToRank));
//Events Click
"click".split(",").forEach(data => buttonAddNotaCliente.addEventListener(data, ViewNotaCliente))