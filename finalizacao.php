<?php

include("pagseguro/ConsultaPagSeguro.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Compra Concluída</title>
        <meta charset="UTF-8">
        <meta name="author" content="Eduardo Vicenzi Kuhn">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
        <div>

            <?php
            $id_transaction = $_GET['id_transaction'];
            $obj_resposta = consultarTransacao($id_transaction);
            if (!$obj_resposta) {
                echo "Erro ao consultar transacao";
            } else {
                echo '<table><tr><th colspan="2">Detalhes da Compra<th></tr>';
                echo "<tr><td>Data: </td><td>" . $obj_resposta->date . "</td></tr>";
                echo "<tr><td>Status: </td><td><b>" . traduzirStatus($obj_resposta->status) . "</b></td></tr>";
                echo "<tr><td>Cód. Referencia: </td><td>" . $obj_resposta->reference . "</td></tr>";
                echo "<tr><td>Última Atualização: </td><td>" . $obj_resposta->lastEventDate . "</td></tr>";
                echo "<tr><td>Método de Pagamento: </td><td>" . traduzirMetodoPagamento($obj_resposta->paymentMethod->type) . "</td></tr>";
                $items = $obj_resposta->items->item;
                foreach ($items as $item) {
                    echo '<tr><td colspan="2">Item: ' . $item->description;
                    echo "<br>Quantidade: " . $item->quantity;
                    echo "<br>Valor: " . $item->amount . "</td></tr>";
                }
                echo '<tr><td colspan="2"><b>Total: ' . $obj_resposta->grossAmount . '</b></td></tr>';
                echo "</table>";
            }
            ?>

        </div>
    </body>
</html>