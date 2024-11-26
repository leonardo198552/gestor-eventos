<?php
class QR_Code_Generator {
    public static function generate($data) {
        $url = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode($data);
        return $url;
    }
}
