<?php
/**
 * ConfigPagSeguro.php
 * @author Eduardo Vicenzi Kuhn <eduardo_vk@hotmail.com>
 */

// Estas configuracoes devem estar de acordo com o que esta
// configurado na conta PagSeguro / SandboxPagSeguro
class ConfigPagSeguro {

    public static $sandbox = true; // Caso true, executa no ambiente de testes. Caso false, executa no ambiente real
    public static $email = ""; // E-mail do Vendedor/Loja
    public static $token = ""; // Token do Vendedor/Loja
    public static $redirectURL = ""; // URL para onde o PagSeguro ira encaminhar apos terminar a compra
    public static $notificationURL = ""; // URL para a qual o PagSeguro ira enviar notificacoes via POST

}

?>