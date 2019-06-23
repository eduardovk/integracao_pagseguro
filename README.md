# Biblioteca de Integração com PagSeguro

A biblioteca desenvolvida neste projeto é composta de quatro arquivos essenciais:

####  - ConfigPagSeguro.php
    Nesta classe ficam armazenadas as constantes relativas à conexão com a API do pagseguro, como credenciais.
#### - PagSeguro.php
    Implementa as classes ItemPagSeguro e VendaPagSeguro
#### - ConsultaPagSeguro.php
    Disponibiliza métodos para consulta de transações e notificações do PagSeguro
#### - TradutorPagSeguro.php
    Disponibiliza métodos para traduzir códigos utilizados pela API do PagSeguro
    
# De uma forma resumida, a venda acontece em 4 etapas:
1.  item = new `ItemPagSeguro`(dados do item)
2.  venda = new `VendaPagSeguro`([item1, item2, item3], dados do cliente)
3.  resposta = `executarVenda`(venda)
4.  `irParaCheckout`(resposta->codigo)

# Realizando uma Venda
Ao fazer uma venda, deve-se criar um objeto ItemPagSeguro para cada produto do carrinho de compras
```sh
$item1 = new ItemPagSeguro(id_do_item, descricao, valor, quantidade)
```
Após, criar um objeto VendaPagSeguro, que irá receber um array com os itens criados anteriormente e um codigo de referencia definido pelo vendedor, juntamente com dados do cliente
```sh
$venda = new VendaPagSeguro(array_de_itens, codigo_de_referencia, nome_cliente, cpf_cliente, email_cliente, moeda)
```
Executar o metódo executarVenda, passando a venda recem criada como argumento, que irá retornar um objeto-resposta
```sh
$objeto_resposta = executarVenda($venda)
```
A partir deste objeto-resposta é possível conferir se houve algum erro na requisição ($objeto_resposta->error), ou salvar o codigo da transação (`$objeto_resposta->code`)
Caso não haja erros, utilizar a função irParaCheckout(codigo_da_transacao) para direcionar o cliente para a página do PagSeguro, onde irá prosseguir com o pagamento
```sh
irParaCheckout($objeto_resposta->code)
```
## Considerações
Os exemplos implementados neste repositório não implementam questões de segurança que não são responsabilidade da biblioteca, como por exemplo tratamento de strings
Os exemplos apresentam uma versão simulada de uma loja online, cuja aplicação fica por parte do vendedor

Eduardo Vicenzi Kuhn
2019
