<?php
/**
 * PagSeguro.php
 * @author Eduardo Vicenzi Kuhn <eduardo_vk@hotmail.com>
 */

include_once("ConfigPagSeguro.php");
include_once("TradutorPagSeguro.php");

// Recebe um objeto VendaPagSeguro como argumento
function criarQuery($vendaPagSeguro) {
    $query = [];
    $items = $vendaPagSeguro->items;
    for ($i = 0; $i < sizeof($items); $i++) {
        $query["itemId" . ($i + 1)] = $items[$i]->itemId;
        $query["itemDescription" . ($i + 1)] = $items[$i]->itemDescription;
        $query["itemAmount" . ($i + 1)] = $items[$i]->itemAmount;
        $query["itemQuantity" . ($i + 1)] = $items[$i]->itemQuantity;
    }
    $query["reference"] = $vendaPagSeguro->reference;
    $query["senderName"] = $vendaPagSeguro->senderName;
    $query["CPF"] = $vendaPagSeguro->CPF;
    $query["senderEmail"] = $vendaPagSeguro->senderEmail;
    $query["currency"] = $vendaPagSeguro->currency;

    $query["email"] = ConfigPagSeguro::$email;
    $query["token"] = ConfigPagSeguro::$token;
    $query["redirectURL"] = ConfigPagSeguro::$redirectURL;
    $query["notificationURL"] = ConfigPagSeguro::$notificationURL;

    // Retorna uma query http para ser utilizada com curl posteriormente
    return http_build_query($query);
}

// Recebe um objeto VendaPagSeguro como argumento
// Caso irParaCheckout == true, ao receber a resposta do PagSeguro
// a pagina eh redirecionada automaticamente para a pagina de checkout
// Caso contrario, eh devolvido um objeto-resposta
function executarVenda($vendaPagSeguro, $irParaCheckout = false) {
    // Cria uma query http a partir do objeto VendaPagSeguro
    $query = criarQuery($vendaPagSeguro);

    if (ConfigPagSeguro::$sandbox) {
        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout';
    } else {
        $url = 'https://ws.pagseguro.uol.com.br/v2/checkout?email=' . ConfigPagSeguro::$email . '&token=' . ConfigPagSeguro::$token;
    }
//Configura a requisicao para a API do PagSeguro
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($curl, CURLOPT_HEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=UTF-8'));
    curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
//Executa a requisicao e recebe a resposta na variavel resposta
    $resposta = curl_exec($curl);

    if ($resposta == "Unauthorized") {
        if ($irParaCheckout) {
            echo "Erro de Autenticação";
            exit;
        }
        return false;
    }

    curl_close($curl);

    //Converte a resposta de XML para Objeto
    $obj_resposta = simplexml_load_string($resposta);

    if (count($obj_resposta->error) > 0) {
        if ($irParaCheckout) {
            echo "Dados inválidos";
            exit;
        }
        // Retorna o objeto resposta da consulta
        return $obj_resposta;
    } else {
        if ($irParaCheckout) {
            irParaCheckout($obj_resposta->code);
        }
        // Retorna o objeto resposta da consulta
        return $obj_resposta;
    }
}

// Recebe o codigo da transacao como argumento e encainha para pagina de checkou
function irParaCheckout($code) {
    $sandbox = ConfigPagSeguro::$sandbox ? 'sandbox.' : '';
    header('Location: https://' . $sandbox . 'pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $code);
}

// Classe que representa uma venda, com objetos ItemPagSeguro e dados do comprador
class VendaPagSeguro {

    public $items = [];
    public $reference;
    public $senderName;
    public $CPF;
    public $senderEmail;
    public $currency;

    function __construct($itens, $codReferencia, $nomeCliente, $cpfCliente, $emailCliente, $moeda) {
        $this->items = $itens;
        $this->reference = $codReferencia;
        $this->senderName = $nomeCliente;
        $this->CPF = $cpfCliente;
        $this->senderEmail = $emailCliente;
        $this->currency = $moeda;
    }

}

// Classe que representa os itens do carrinho, com seus respectivos dados
class ItemPagSeguro {

    public $itemId;
    public $itemDescription;
    public $itemAmount;
    public $itemQuantity;

    function __construct($idItem, $descricaoItem, $valorItem, $qtdItem) {
        $this->itemId = $idItem;
        $this->itemDescription = $descricaoItem;
        $this->itemAmount = $valorItem;
        $this->itemQuantity = $qtdItem;
    }

}

?>
