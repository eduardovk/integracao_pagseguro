<?php
/**
 * notificacao.php
 * @author Eduardo Vicenzi Kuhn <eduardo_vk@hotmail.com>
 */

include_once("pagseguro/ConsultaPagSeguro.php");

// Recebe do PagSeguro o cod da Notificacao (variavel nao fitlrada para simplficar exemplo)
$notificationCode = $_POST["notificationCode"];
// Faz a consutla ao PagSeguro com o cod recebido e aguarda um objeto-resposta
$dadosNotificacao = consultarNotificacao($notificationCode);

// A partir do objeto-resposta, eh possivel salvar o novo status da transacao em db
// Neste exemplo, os dados da notificacao sao salvos em um txt para simplificar
$text = "Código de Referência: " . $dadosNotificacao->reference;
$text .= "\nCódigo da Transação: " . $dadosNotificacao->code;
$text .= "\nData: " . $dadosNotificacao->date;
$text .= "\nStatus: " . traduzirStatus($dadosNotificacao->status);
$arquivo = fopen("ultima_notificacao.txt", "w") or die("Unable to open file!");
fwrite($arquivo, $text);
fclose($arquivo);

