<?php

class GuardMiddleware extends Middleware {
    private $rolRequerido;

    public function __construct($rol = null) {
        $this->rolRequerido = $rol;
    }

    public function run($request, $response) {
        if(!$request->user) {
            header("WWW-Authenticate: Bearer realm='Access to the API'");
            return $response->json(['error' => 'No autorizado'], 401);
        }

        if($this->rolRequerido && !in_array($this->rolRequerido, $request->user->roles)) {
            return $response->json(['error' => 'No tiene permisos suficientes'], 403);
        }
    }
}