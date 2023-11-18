<?php
// Evita acesso direto ao arquivo.
if (!defined('ABSPATH')) {
    exit;
}

// Função para iniciar o processo de autenticação OAuth.
function hub_initiate_oauth() {
    // URL do servidor OAuth do grupobright.com
    $authorization_url = 'https://grupobright.com/oauth/authorize';

    // ID do cliente e segredo do cliente (obtidos ao registrar o aplicativo no grupobright.com)
    $client_id = 'YOUR_CLIENT_ID';
    $client_secret = 'YOUR_CLIENT_SECRET';

    // URL de redirecionamento após a autenticação (deve ser uma URL do seu site)
    $redirect_uri = 'https://tornevirtual.com.br/oauth_callback';

    // Construir a URL de autorização
    $auth_url = $authorization_url . '?response_type=code&client_id=' . urlencode($client_id) . '&redirect_uri=' . urlencode($redirect_uri) . '&scope=basic';

    // Redirecionar para a URL de autorização
    wp_redirect($auth_url);
    exit;
}

// Adiciona a ação para iniciar o OAuth quando necessário.
// Por exemplo, você pode adicionar um gancho para um botão específico ou uma ação específica.
add_action('init', 'hub_initiate_oauth');
