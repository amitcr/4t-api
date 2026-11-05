<?php
define('PROJECT_ROOT', realpath(__DIR__ . '/../')); 
define('MYTEMPERAMENT_PLUGIN_DIR', realpath(__DIR__ . '/../wp-content/plugins/wp-temperament-assessment/')); 
define('WPAFFCOUPON_PLUGIN_DIR', realpath(__DIR__ . '/../wp-content/plugins/wp-affiliates-coupons/')); 

// Try composer autoload first (recommended). Fallback to simple PSR-4 loader.
$composer = __DIR__ . '/vendor/autoload.php';
if (file_exists($composer)) {
    require_once $composer;
} else {
    spl_autoload_register(function ($class) {
        $prefix = 'App\\';
        $base_dir = __DIR__ . '/app/';
        if (strpos($class, $prefix) !== 0) return;
        $relative = substr($class, strlen($prefix));
        $file = $base_dir . str_replace('\\', '/', $relative) . '.php';
        if (file_exists($file)) require $file;
    });
}

// Swallow deprecations raised inside third-party vendor code (e.g. tecnickcom/tcpdf 6.11+
// raises E_USER_DEPRECATED on every PDF) so they never leak into JSON responses or
// CLI output. Deprecations from our own code still surface.
set_error_handler(static function (int $errno, string $errstr, string $errfile = ''): bool {
    return str_contains(str_replace('\\', '/', $errfile), '/vendor/');
}, E_DEPRECATED | E_USER_DEPRECATED);

// optional .env loader (simple)
if (file_exists(__DIR__ . '/.env')) {
    foreach (file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (trim($line) === '' || $line[0] === '#') continue;
        [$k, $v] = array_map('trim', explode('=', $line, 2) + [null, null]);
        if ($k !== null && getenv($k) === false) putenv("$k=$v");
    }
}

