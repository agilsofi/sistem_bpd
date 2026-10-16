<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

$users = User::all(['id_user', 'username', 'role', 'status', 'id_guru', 'id_siswa']);
foreach ($users as $u) {
    echo "ID: {$u->id_user} | Username: {$u->username} | Role: {$u->role} | Status: {$u->status} | id_guru: {$u->id_guru} | id_siswa: {$u->id_siswa}\n";
}
echo "\nPassword hashes (first 20 chars):\n";
foreach ($users as $u) {
    $hash = $u->password;
    echo "{$u->username}: " . substr($hash, 0, 20) . "... (" . strlen($hash) . " chars)\n";
}
