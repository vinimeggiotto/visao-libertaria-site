<?php

/**
 * Roteador do servidor embutido do PHP no Docker.
 * Document root = raiz do projeto (igual XAMPP/produção), não public/.
 */
$uri = urldecode((string) (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/'));

if ($uri === '/favicon.ico') {
    $favicon = $_SERVER['DOCUMENT_ROOT'] . '/public/assets/favicon.ico';
    if (is_file($favicon)) {
        header('Content-Type: image/vnd.microsoft.icon');
        header('Content-Length: ' . (string) filesize($favicon));
        readfile($favicon);

        return true;
    }
}

if ($uri !== '/' && ! str_contains($uri, '..')) {
    $file = $_SERVER['DOCUMENT_ROOT'] . $uri;

    if (is_file($file)) {
        return false;
    }
}

require $_SERVER['DOCUMENT_ROOT'] . '/index.php';
