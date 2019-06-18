<?php

include("pagseguro/PagSeguro.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Simulação de Compra PagSeguro</title>
        <meta charset="UTF-8">
        <meta name="author" content="Eduardo Vicenzi Kuhn">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
        <div>

            <table>
                <tr><th colspan="2">Cesta de Compras</th></tr>
                <tr><td>Nome: </td><td>Fulano da Silva</td></tr>
                <tr><td>CPF: </td><td>01234567891</td></tr>
                <tr><td>E-mail: </td><td>fulano@email.com</td></tr>
                <tr><td colspan="2">
                        Item: Pen Drive 32GB<br>
                        Quantidade: 2<br>
                        Valor: 50.00
                    </td></tr>
                <tr><td colspan="2">
                        Item: Mouse USB<br>
                        Quantidade: 1<br>
                        Valor: 14.90
                    </td></tr>
                <tr><td colspan="2">
                        Item: Teclado USB<br>
                        Quantidade: 1<br>
                        Valor: 28.50
                    </td></tr>
                <tr><td colspan="2"><b>Total: 143.40</b></td></tr>
            </table>
            <a href="comprar.php?"><img src="pagseguro/pagseguro.gif"></a>
        </div>
    </body>
</html>