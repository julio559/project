<?php
// Função para tratar a rota e executar a ação correspondente
function route($request_uri) {
    $routes = [
        '/' => 'home',
        '/about' => 'about',
        '/contact' => 'contact',
        '/products' => 'products',
    ];

    // Remove barras inicial e final do URI
    $request_uri = trim($request_uri, '/');

    // Verifica se a rota existe
    if (array_key_exists($request_uri, $routes)) {
        // Obtém o nome da função correspondente à rota
        $function_name = $routes[$request_uri];
        
        // Verifica se a função existe
        if (function_exists($function_name)) {
            // Chama a função correspondente
            call_user_func($function_name);
        } else {
            echo "Função não encontrada para a rota: $request_uri";
        }
    } else {
        echo "Rota não encontrada: $request_uri";
    }
}

// Funções para as páginas correspondentes
function home() {
    echo "Página inicial";
}

function about() {
    echo "Sobre nós";
}

function contact() {
    echo "Entre em contato conosco";
}

function products() {
    echo "Nossos produtos";
}

// Obtém o URI da solicitação
$request_uri = $_SERVER['REQUEST_URI'];

// Roteia a solicitação
route($request_uri);
?>
