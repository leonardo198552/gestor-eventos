<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! current_user_can( 'edit_posts' ) ) {
    wp_die( __( 'Você não tem permissão para acessar esta página.' ) );
}

// Processa a criação do evento
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $event_title = sanitize_text_field($_POST['event-title']);
    $event_date = sanitize_text_field($_POST['event-date']);
    $event_description = sanitize_textarea_field($_POST['event-description']);

    // Cria o evento - Aqui você deve usar a lógica para salvar o evento no banco de dados ou em post meta
    $event_id = wp_insert_post([
        'post_title'   => $event_title,
        'post_content' => $event_description,
        'post_status'  => 'publish',
        'post_type'    => 'event', // Supondo que você tenha um tipo de post 'event'
        'meta_input'   => [
            'event_date' => $event_date,
        ],
    ]);

    // Verifica se o evento foi criado com sucesso
    if ($event_id) {
        // Aqui você pode gerar o ticket_id. Dependendo da sua lógica, você pode usar o post ID do evento ou uma função para gerar um ticket específico
        $ticket_id = 'ticket_' . $event_id; // Exemplo de geração do ticket_id

        // Exibe o QR Code
        gestor_eventos_display_qr_code($ticket_id);
    }
}

?>

<h1>Criar Novo Evento</h1>
<form method="post" action="">
    <label for="event-title">Título do Evento:</label>
    <input type="text" id="event-title" name="event-title" required>

    <label for="event-date">Data do Evento:</label>
    <input type="date" id="event-date" name="event-date" required>

    <label for="event-description">Descrição:</label>
    <textarea id="event-description" name="event-description" required></textarea>

    <button type="submit">Criar Evento</button>
</form>
