<?php
/*
Plugin Name: Gestor Completo de Eventos
Plugin URI: https://instagram.com/leonardojunioandrade
Description: Plugin para gestão completa de eventos com QR Codes e integração com blockchain.
Version: 1.0
Author: Leonardo Junio Andrade
Author URI: https://instagram.com/leonardojunioandrade
License: GPL2
*/

// Evitar acesso direto.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Definir constantes do plugin.
define( 'GESTOR_EVENTOS_VERSION', '1.0' );
define( 'GESTOR_EVENTOS_PATH', plugin_dir_path( __FILE__ ) );
define( 'GESTOR_EVENTOS_URL', plugin_dir_url( __FILE__ ) );

define( 'GESTOR_EVENTOS_ASSETS', GESTOR_EVENTOS_URL . 'assets/' );

// Registrar autoload de classes.
function gestor_eventos_autoload() {
    include_once GESTOR_EVENTOS_PATH . 'includes/class-event-manager.php';
    include_once GESTOR_EVENTOS_PATH . 'includes/class-ticket-manager.php';
    include_once GESTOR_EVENTOS_PATH . 'includes/class-blockchain-integration.php';
    include_once GESTOR_EVENTOS_PATH . 'includes/qr-code-generator.php';
    include_once GESTOR_EVENTOS_PATH . 'includes/rest-api.php';
}
add_action( 'plugins_loaded', 'gestor_eventos_autoload' );

// Ativar o plugin.
function gestor_eventos_activate() {
    // Registrar tipos de posts customizados para eventos.
    Event_Manager::register_post_type();
    // Regenerar permalinks.
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'gestor_eventos_activate' );

// Desativar o plugin.
function gestor_eventos_deactivate() {
    // Remover permalinks de tipos de post customizados.
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'gestor_eventos_deactivate' );

// Registrar scripts e estilos.
function gestor_eventos_enqueue_assets() {
    wp_enqueue_style( 'gestor-eventos-styles', GESTOR_EVENTOS_ASSETS . 'css/styles.css', [], GESTOR_EVENTOS_VERSION );
    wp_enqueue_script( 'gestor-eventos-scripts', GESTOR_EVENTOS_ASSETS . 'js/scripts.js', [ 'jquery' ], GESTOR_EVENTOS_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'gestor_eventos_enqueue_assets' );

// === Adicionar Shortcodes ===

// Shortcode para a página de criação de eventos.
function gestor_eventos_creation_shortcode() {
    ob_start();
    include GESTOR_EVENTOS_PATH . 'templates/event-creation.php';
    return ob_get_clean();
}
add_shortcode('gestor_event_creation', 'gestor_eventos_creation_shortcode');

// Shortcode para a visualização de ingressos.
function gestor_ticket_view_shortcode() {
    ob_start();
    include GESTOR_EVENTOS_PATH . 'templates/ticket-view.php';
    return ob_get_clean();
}
add_shortcode('gestor_ticket_view', 'gestor_ticket_view_shortcode');