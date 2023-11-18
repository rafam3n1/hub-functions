<?php
/**
 * Plugin Name: Hub Functions
 * Description: Custom functions for the Hub.
 * Author: rafam3n
 * Author URI: https://tornevirtual.com.br/
 * Version: 1.0
 */

// Evita acesso direto ao arquivo.
if (!defined('ABSPATH')) {
    exit;
}

// Inclui o arquivo OAuth.
require_once plugin_dir_path(__FILE__) . 'includes/oauth.php';


function hub_oauth_redirect_endpoint() {
    add_rewrite_rule('^oauth_callback/?', 'index.php?hub_oauth_callback=1', 'top');
}
add_action('init', 'hub_oauth_redirect_endpoint');

function hub_query_vars($vars) {
    $vars[] = 'hub_oauth_callback';
    return $vars;
}
add_filter('query_vars', 'hub_query_vars');

function hub_parse_request($wp) {
    if (array_key_exists('hub_oauth_callback', $wp->query_vars)) {
        // Aqui você lida com a resposta do OAuth.
        // Por exemplo, você pode capturar o código de autorização e trocá-lo por um token de acesso.
        hub_handle_oauth_response();
        exit;
    }
}
add_action('parse_request', 'hub_parse_request');

function hub_handle_oauth_response() {
    // Obtenha o código de autorização do URL.
    $code = $_GET['code'] ?? '';

    // Aqui você adicionaria o código para trocar o código por um token de acesso
    // e lidar com a lógica de autenticação/criação de usuário.

    // Redirecionar para uma página específica após o processamento.
    wp_redirect(home_url());
    exit;
}
