<?php
// Chave de API do Pushbullet
define('PUSHBULLET_API_KEY', 'SUA_API_KEY'); 
define('PUSHBULLET_API_URL', 'https://api.pushbullet.com/v2/pushes'); 

$data = array(
    'type' => 'note',
    'title' => 'PC Ligado',
    'body' => 'Seu PC foi ligado.'
);

$headers = array(
    'Access-Token: ' . PUSHBULLET_API_KEY,
    'Content-Type: application/json'
);

$ch = curl_init(PUSHBULLET_API_URL);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

if (!$response) {
    die('Erro ao enviar notificação.');
}

echo 'Notificação enviada com sucesso.';
?>
