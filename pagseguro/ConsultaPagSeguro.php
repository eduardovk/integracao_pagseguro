<?php
/**
 * ConsultaPagSeguro.php
 * @author Eduardo Vicenzi Kuhn <eduardo_vk@hotmail.com>
 */

include_once("ConfigPagSeguro.php");
include_once("TradutorPagSeguro.php");

// Caso referencia true, consulta por cod de referencia (deifindo pelo dev)
// Caso false, consulta pro codigo de transacao (definido pelo PagSeguro)
function consultarTransacao($codigo, $referencia = false) {
    $email = ConfigPagSeguro::$email;
    $token = ConfigPagSeguro::$token;
    $sandbox = ConfigPagSeguro::$sandbox ? '.sandbox' : '';

    if ($referencia) {
        $url = 'https://ws' . $sandbox . '.pagseguro.uol.com.br/v2/transactions?email=' . $email . '&token=' . $token . '&reference=' . $codigo;
    } else {
        $url = 'https://ws' . $sandbox . '.pagseguro.uol.com.br/v3/transactions/' . $codigo . '?email=' . $email . '&token=' . $token;
    }

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    //Executa a requisicao e recebe a resposta na variavel resposta
    $resposta = curl_exec($curl);

    if ($resposta == "Unauthorized") {
        echo "Erro de Autenticação";
        exit;
    }

    curl_close($curl);

    //Converte a resposta de XML para Objeto
    $obj_resposta = simplexml_load_string($resposta);

    if ($referencia && $obj_resposta->resultsInThisPage == 0) {
        return false;
    }
    if (count($obj_resposta->error) < 1) {
        if ($referencia) { // Se consultado via cod de referencia, separa por transactions
            $transactions = $obj_resposta->transactions;
            return $transactions->transaction;
        }
    }

    // Retorna o objeto resposta da consulta
    return $obj_resposta;
}

function consultarNotificacao($cod_notificacao) {
    $email = ConfigPagSeguro::$email;
    $token = ConfigPagSeguro::$token;
    $sandbox = ConfigPagSeguro::$sandbox ? '.sandbox' : '';

    // URL utilizada para consulta de notificacoes
    $url = 'https://ws' . $sandbox . '.pagseguro.uol.com.br/v3/transactions/notifications/' . $cod_notificacao . '?email=' . $email . '&token=' . $token;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    //Executa a requisicao e recebe a resposta na variavel resposta
    $resposta = curl_exec($curl);

    if ($resposta == 'Unauthorized') {
        echo 'Erro de Autenticação';
        exit;
    }

    curl_close($curl);

    //Converte a resposta de XML para Objeto
    $obj_resposta = simplexml_load_string($resposta);

    // Retorna o objeto resposta da consulta
    return $obj_resposta;
}
