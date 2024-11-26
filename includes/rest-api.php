<?php
class Event_API {
    public static function register_routes() {
        register_rest_route('gestor-eventos/v1', '/validate-ticket', [
            'methods' => 'POST',
            'callback' => [__CLASS__, 'validate_ticket'],
        ]);
    }

    public static function validate_ticket($request) {
        $ticket_id = $request->get_param('ticket_id');
        $event_id = $request->get_param('event_id');

        $tickets = get_post_meta($event_id, '_ticket_' . $ticket_id, true);
        return $tickets ? ['valid' => true] : ['valid' => false];
    }
}
add_action('rest_api_init', [Event_API::class, 'register_routes']);
