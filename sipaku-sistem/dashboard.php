<?php
require 'db.php';

// For demonstration, hardcoded user data and transactions
// In real app, fetch from database based on logged-in user
$parking_status = 'SEDANG PARKIR'; // or 'TIDAK ADA PARKIR'
$parking_status_color = $parking_status === 'SEDANG PARKIR' ? 'text-green-600' : 'text-gray-500';
$vehicle_icon = $parking_status === 'SEDANG PARKIR' ? 'truck' : 'truck'; // Feather icon, can be motorbike or car icon if available
$license_plate = 'B 1234 XYZ';
$e_wallet_balance = 50000;
$e_wallet_max = 100000;
$transactions = [
    ['date' => '20 Mar', 'plate' => 'B 1234 XYZ', 'amount' => 4000],
    ['date' => '19 Mar', 'plate' => 'B 5678 ABC', 'amount' => 5000],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Pengguna - SIPAKU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Inter&display=swap" rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1 {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <header class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Pengguna</h1>
    </header>

    <main class="max-w-4xl mx-auto space-y-8">
        <!-- Kartu Status -->
        <section class="bg-white rounded-lg shadow p-6 flex items-center space-x-4">
            <i data-feather="truck" class="w-12 h-12 <?= $parking_status_color ?>"></i>
            <div>
                <p class="text-xl font-semibold <?= $parking_status_color ?>"><?= $parking_status ?></p>
                <p class="text-gray-700 font-mono mt-1">Plat nomor: <strong><?= htmlspecialchars($license_plate) ?></strong></p>
            </div>
        </section>

        <!-- Saldo E-Wallet -->
        <section class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Saldo E-Wallet</h2>
            <div class="w-full bg-gray-300 rounded-full h-6 mb-2">
                <div class="bg-blue-700 h-6 rounded-full" style="width: <?= ($e_wallet_balance / $e_wallet_max) * 100 ?>%"></div>
            </div>
            <p class="text-gray-800 font-semibold mb-4">Rp<?= number_format($e_wallet_balance, 0, ',', '.') ?></p>
            <button class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-2 rounded transition">ISI SALDO</button>
        </section>

        <!-- Riwayat Transaksi -->
        <section class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Riwayat Transaksi</h2>
            <ul class="space-y-2 font-mono text-gray-700">
                <?php foreach ($transactions as $tx): ?>
                    <li><?= htmlspecialchars($tx['date']) ?> | <?= htmlspecialchars($tx['plate']) ?> | Rp<?= number_format($tx['amount'], 0, ',', '.') ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

    <script>
        feather.replace()
    </script>
</body>
</html>
