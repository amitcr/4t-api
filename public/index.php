<?php
declare(strict_types=1);

// Errors are logged, never printed by default: a notice printed in front of the
// JSON breaks every API client. Display is switched on for localhost only, below,
// once bootstrap.php has read APP_ENV from api/.env.
ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

// always JSON
header('Content-Type: application/json; charset=utf-8');

// bootstrap (autoload, env)
require_once __DIR__ . '/../bootstrap.php';

ini_set('display_errors', getenv('APP_ENV') === 'local' ? '1' : '0');

use Dotenv\Dotenv;
use App\Core\Router;
use App\Core\Request;
use App\Core\DB;
use App\Core\Mail\Mail;

// Load .env (only once)
$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->safeLoad();

DB::init();
Mail::init();
// build Request (if you have your Request class, Router will accept it)
$request = class_exists(\App\Core\Request::class) ? new \App\Core\Request() : null;

// init router (Router accepts Request|null)
$router = new Router($request);

// load routes (single file or multiple grouped files)
require_once __DIR__ . '/../app/routes.php';

// dispatch - router will echo/exit
$router->dispatch();
