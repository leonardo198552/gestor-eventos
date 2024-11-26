<?php
class Blockchain_Integration {
    public static function register_ticket($ticket_id, $event_data) {
        // Código para interagir com API de blockchain.
        $response = wp_remote_post('https://blockchain-api.example.com/register', [
            'body' => json_encode([
                'ticket_id' => $ticket_id,
                'event' => $event_data,
            ]),
        ]);
        return json_decode(wp_remote_retrieve_body($response));
    }
}
