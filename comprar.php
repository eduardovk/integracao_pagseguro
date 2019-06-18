<?php
/**
 * comprar.php
 * @author Eduardo Vicenzi Kuhn <eduardo_vk@hotmail.com>
 */

include("pagseguro/PagSeguro.php");

// Aqui seriam recebidos os ids dos produtos via POST
// e coletado o resto dos dados no db
// Simplificacao
$item1 = new ItemPagSeguro("519873", "Pen Drive 32GB", '50.00', 2);
$item2 = new ItemPagSeguro("465987", "Mouse USB", '14.90', 1);
$item3 = new ItemPagSeguro("796823", "Teclado USB", '28.50', 1);

// Neste exemplo eh criado um cod de referencia aleatorio
// o cod de referencia nao eh responsabilidade da api pagseguro
$codReferencia = 239871598;

// Eh gerada uma nova venda com os dados capturados anteriormente
$venda = new VendaPagSeguro([$item1, $item2, $item3], $codReferencia, "Fulano da Silva", "01234567891", "fulano@email.com", "BRL");

// Eh feita uma requisicao ao PagSeguro utilizando o objeto venda
$obj_resposta = executarVenda($venda);

if (count($obj_resposta->error) > 0) {
    echo "Dados Inválidos!";
    exit;
} else {
    // Aqui poderiamos salvar detalhes da transacao no db,
    // Como por exemplo $obj_resposta->code (codigo da transacao)
    //
    // Encaminha para checkout utilizando o codigo da transacao
    // devolvido pela API do PagSeguro
    irParaCheckout($obj_resposta->code);
}



