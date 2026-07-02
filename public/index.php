<?php


# Arquivo mestre que controla todas as requisições enviadas ao .htaccess
# E redireciona aos caminhos correspondentes

# Inicia o sistema de sessões que armazena dados entre páginas de uma mesma sessão
session_start();

# Carrega o composer autoload com todas as dependências
require "../vendor/autoload.php";

# Define uma constante com o caminho base do projeto
define('BASE_URL', '');

// Configuração do "Dispatcher" (Despachante) de rotas
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    // Rota raiz - redireciona para menu ou login
    $r->get('/', 'TecnicoController@menu');
    
    // Aqui você define suas rotas:
    // Jogadores
    $r->get('/jogadores', 'JogadorController@listar');
    $r->get('/jogadores/novo', 'JogadorController@novo');
    $r->get('/jogadores/{id}/editar', 'JogadorController@editar');
    $r->get('/jogadores/{id}', 'JogadorController@buscar');
    $r->post('/jogadores/cadastrar', 'JogadorController@cadastrar');
    $r->post('/jogadores/{id}/remover', 'JogadorController@remover');
    // Escalação
    $r->get('/escalacoes', 'EscalacaoController@listar');
    $r->get('/escalacoes/novo', 'EscalacaoController@novo');
    $r->get('/escalacoes/{id}/editar', 'EscalacaoController@editar');
    $r->get('/escalacoes/{id}', 'EscalacaoController@buscar');
    $r->post('/escalacoes/cadastrar', 'EscalacaoController@cadastrar');
    $r->post('/escalacoes/{id}/remover', 'EscalacaoController@remover');
    // Estatistica
    $r->get('/estatisticas', 'EstatisticasController@listar');
    $r->get('/estatisticas/novo', 'EstatisticasController@novo');
    $r->get('/estatisticas/{id}/editar', 'EstatisticasController@editar');
    $r->get('/estatisticas/{id}', 'EstatisticasController@buscar');
    $r->post('/estatisticas/cadastrar', 'EstatisticasController@cadastrar');
    $r->post('/estatisticas/{id}/remover', 'EstatisticasController@remover');
    // Treino
    $r->get('/treinos', 'TreinoController@listar');
    $r->get('/treinos/novo', 'TreinoController@novo');
    $r->get('/treinos/{id}/editar', 'TreinoController@editar');
    $r->get('/treinos/{id}', 'TreinoController@buscar');
    $r->post('/treinos/cadastrar', 'TreinoController@cadastrar');
    $r->post('/treinos/{id}/remover', 'TreinoController@remover');
    // Tecnico
    $r->get('/tecnicos/novo', 'TecnicoController@novo');
    $r->get('/tecnicos/{id}/editar', 'TecnicoController@editar');
    $r->post('/tecnicos/cadastrar', 'TecnicoController@cadastrar');
    $r->post('/tecnicos/{id}/remover', 'TecnicoController@remover');
    // Login
    $r->get('/login', 'TecnicoController@loginForm');
    $r->post('/login', 'TecnicoController@autenticar');
    $r->get('/logout', 'TecnicoController@logout');
    // Menu
    $r->get('/menu', 'TecnicoController@menu');
});

// Pega apenas o caminho da URL (ex: de "/projeto/clientes?id=1" extrai apenas "/projeto/clientes")
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

// Limpa o caminho base para que o roteador entenda a rota independente do ambiente
// Em XAMPP: /SistemaClubeWeb/public/... → /...
// Em Render/Produção: /public/... → /...
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);  // /SistemaClubeWeb/public ou /public
$basePath = rtrim(dirname($scriptDir), '/');    // /SistemaClubeWeb ou vazio
if (!empty($basePath) && strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}
$uri = $uri ?: '/';

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
        [$controllerClass, $action] = explode('@', $route[1]);
        $params = $route[2];
        $controllerNamespace = "controller\\{$controllerClass}";
        $controller = new $controllerNamespace();
        if (!empty($params)) {
            $controller->$action($params);
        } else {
            $controller->$action();
        }
        break;
}