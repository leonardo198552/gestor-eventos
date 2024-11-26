<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Simula dados do ingresso para exibição
$ticket_id = $_GET['ticket_id'] ?? 'N/A';
$event_title = get_the_title( $_GET['event_id'] ?? 0 );
$qr_code = QR_Code_Generator::generate( $ticket_id );
?>

<h1>Ingresso</h1>
<p><strong>Evento:</strong> <?php echo esc_html( $event_title ); ?></p>
<p><strong>ID do Ingresso:</strong> <?php echo esc_html( $ticket_id ); ?></p>
<img src="<?php echo esc_url( $qr_code ); ?>" alt="QR Code do Ingresso">
