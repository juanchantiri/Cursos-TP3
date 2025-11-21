<?php
require_once __DIR__ . '/jwt.php';

class JWTMiddleware extends Middleware {
    public function run($request, $response) {
        // 1. INTENTAR OBTENER LA CABECERA (LOGICA ROBUSTA)
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

        // Si $_SERVER falla, intentamos con apache_request_headers() (común en XAMPP)
        if (!$authHeader && function_exists('apache_request_headers')) {
            $headers = apache_request_headers();
            if (isset($headers['Authorization'])) {
                $authHeader = $headers['Authorization'];
            }
        }

        // 2. SI NO HAY CABECERA, NO HACEMOS NADA
        // Dejamos que el request siga. Si la ruta es protegida, 
        // el GuardMiddleware fallará después. Si es pública, pasará.
        if (!$authHeader) {
            return;
        }

        // 3. VALIDAR FORMATO "Bearer <token>"
        $authHeaderParts = explode(' ', $authHeader);
        if(count($authHeaderParts) != 2 || $authHeaderParts[0] != 'Bearer') {
            return;
        }

        // 4. VALIDAR EL TOKEN
        $jwt = $authHeaderParts[1];
        $res = validateJWT($jwt);

        if ($res != null) {
            // ¡Éxito! Guardamos el usuario en el request
            $request->user = $res;
        }
    }
}