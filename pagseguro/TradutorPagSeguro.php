<?php
/**
 * TradutorPagSeguro.php
 * @author Eduardo Vicenzi Kuhn <eduardo_vk@hotmail.com>
 */

function traduzirStatus($status) {
    if ($status == 1) {
        return "Aguardando pagamento";
    } else if ($status == 2) {
        return "Em análise";
    } else if ($status == 3) {
        return "Paga";
    } else if ($status == 4) {
        return "Disponível";
    } else if ($status == 5) {
        return "Em disputa";
    } else if ($status == 6) {
        return "Devolvida";
    } else if ($status == 7) {
        return "Cancelada";
    } else if ($status == 8) {
        return "Debitado";
    } else if ($status == 9) {
        return "Retenção temporária";
    }
}

function traduzirMetodoPagamento($codigo) {
    if ($codigo == 1) {
        return "Cartão de Crédito";
    } else if ($codigo == 2) {
        return "Boleto";
    } else if ($codigo == 3) {
        return "Débito online (TEF)";
    } else if ($codigo == 4) {
        return "Saldo PagSeguro";
    } else if ($codigo == 5) {
        return "Oi Paggo";
    } else if ($codigo == 7) {
        return "Depósito em conta";
    } else if ($codigo == 50) {
        return "Dinheiro";
    } else if ($codigo == 51) {
        return "Cheque";
    }
}

function traduzirBandeiraPagamento($codigo) {
    $met['101'] = 'Cartão de crédito Visa';
    $met['102'] = 'Cartão de crédito MasterCard';
    $met['103'] = 'Cartão de crédito American Express';
    $met['104'] = 'Cartão de crédito Diners';
    $met['105'] = 'Cartão de crédito Hipercard';
    $met['106'] = 'Cartão de crédito Aura';
    $met['107'] = 'Cartão de crédito Elo';
    $met['108'] = 'Cartão de crédito PLENOCard';
    $met['109'] = 'Cartão de crédito PersonalCard';
    $met['110'] = 'Cartão de crédito JCB';
    $met['111'] = 'Cartão de crédito Discover';
    $met['112'] = 'Cartão de crédito BrasilCard';
    $met['113'] = 'Cartão de crédito FORTBRASIL';
    $met['114'] = 'Cartão de crédito CARDBAN';
    $met['115'] = 'Cartão de crédito VALECARD';
    $met['116'] = 'Cartão de crédito Cabal';
    $met['117'] = 'Cartão de crédito Mais!';
    $met['118'] = 'Cartão de crédito Avista';
    $met['119'] = 'Cartão de crédito GRANDCARD';
    $met['120'] = 'Cartão de crédito Sorocred';
    $met['122'] = 'Cartão de crédito Up Policard';
    $met['123'] = 'Cartão de crédito Banese Card';
    $met['201'] = 'Boleto Bradesco';
    $met['202'] = 'Boleto Santander';
    $met['301'] = 'Débito online Bradesco';
    $met['302'] = 'Débito online Itaú';
    $met['303'] = 'Débito online Unibanco';
    $met['304'] = 'Débito online Banco do Brasil';
    $met['305'] = 'Débito online Banco Real';
    $met['306'] = 'Débito online Banrisul';
    $met['307'] = 'Débito online HSBC';
    $met['401'] = 'Saldo PagSeguro';
    $met['501'] = 'Oi Paggo ';
    $met['701'] = 'Depósito em conta - Banco do Brasil';
    return $met[(string) $codigo];
}
