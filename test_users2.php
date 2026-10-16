<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Raw DB query:\n";
$users = DB::table('users')->get();
foreach ($users as $u) {
    echo "User: {$u->username} | Password length: " . strlen($u->password) . " | First chars: " . substr($u->password, 0, 30) . "\n";
}
