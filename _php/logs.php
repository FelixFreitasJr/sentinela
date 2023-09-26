<?php

// Defina a variável $logFile com o caminho para o arquivo de log desejado
$logFile = __DIR__ . '../_logs/app.log';

function logMessage($message, $logLevel, $username = null) {
    global $logFile;
    $formattedMessage = "[" . date('Y-m-d H:i:s') . "] [$logLevel]";
    if ($username) {
        $formattedMessage .= " [Usuário: $username]";
    }
    $formattedMessage .= ": $message\n";
    file_put_contents($logFile, $formattedMessage, FILE_APPEND);
}

?>