<?php


# Arquivo mestre que controla todas as requisições enviadas ao .htaccess
# E redireciona aos caminhos correspondentes

# Inicia o sistema de sessões que armazena dados entre páginas de uma mesma sessão
session_start();

# Carrega o composer autoload com todas as dependências
require "../vendor/autoload.php";

# Define uma constante com o caminho base do projeto
define('BASE_URL', '/SistemaClubeWeb');

// Configuração do "Dispatcher" (Despachante) de rotas
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    // Aqui você define suas rotas:
    $r->get('/jogadores', 'JogadorController@listar');
    $r->get('/jogadores/novo', 'JogadorController@novo');
    $r->get('/jogadores/{id}/editar', 'JogadorController@editar');
    $r->get('/jogadores/{id}', 'JogadorController@buscar');
    $r->post('/jogadores/cadastrar', 'JogadorController@cadastrar');
    $r->post('/jogadores/{id}/remover', 'JogadorController@remover');
    $r->get('/tecnicos/novo', 'TecnicoController@novo');
    $r->get('/tecnicos/{id}/editar', 'TecnicoController@editar');
    $r->post('/tecnicos/cadastrar', 'TecnicoController@cadastrar');
    $r->post('/tecnicos/{id}/remover', 'TecnicoController@remover');
    $r->get('/login', 'TecnicoController@loginForm');
    $r->post('/login', 'TecnicoController@autenticar');
    $r->get('/logout', 'TecnicoController@logout');
});

// Pega apenas o caminho da URL (ex: de "/projeto/clientes?id=1" extrai apenas "/projeto/clientes")
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

// Limpa o caminho base para que o roteador entenda a rota idependente da pasta onde o projeto está.
$basePath = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
$uri = substr($uri, strlen($basePath)) ?: '/';

// Pega o método da requisição (GET, POST, etc.)
$method = $_SERVER['REQUEST_METHOD'];

// Tenta "casar" a URL digitada com as rotas definidas acima
$route = $dispatcher->dispatch($method, $uri);

// --- DECISÃO DO QUE FAZER ---
switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // Se a rota não existir no $dispatcher
        http_response_code(404);
        echo "Rota não encontrada";
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // Se a rota existe, mas foi acessada com o method errado (ex: POST em uma rota GET)
        http_response_code(405);
        echo "Método não permitido";
        break;

    case FastRoute\Dispatcher::FOUND:
        // ROTA ENCONTRADA!
        // $route[1] contém 'ClienteController@listar'
        // $route[2] contém os parâmetros (ex: ['id' => '10'])
        [$controllerClass, $action] = explode('@', $route[1]);
        $params = $route[2];
        // Monta o nome completo da classe (Namespace) e instancia o Controller
        $controllerNamespace = "controller\\{$controllerClass}";
        $controller = new $controllerNamespace();
        $controller->$action($params);
        break;
}