<?php
class Ticket_Manager {
    public static function generate_ticket($event_id, $user_id) {
        $ticket_id = uniqid();
        $qr_code = QR_Code_Generator::generate($ticket_id);

        update_post_meta($event_id, '_ticket_' . $user_id, [
            'ticket_id' => $ticket_id,
            'qr_code' => $qr_code,
        ]);

        return $qr_code;
    }
}
