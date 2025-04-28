<?php
// For demonstration, hardcoded status and data
$status = $_GET['status'] ?? 'masuk'; // 'masuk' or 'keluar'
$license_plate = 'B 1234 XYZ';
$parking_fee = 4000;
$duration = '2 jam';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Proses Parkir - SIPAKU</title>
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
<body class="min-h-screen flex items-center justify-center p-6
    <?= $status === 'masuk' ? 'bg-green-500' : 'bg-blue-600' ?> text-white">

    <div class="text-center max-w-md w-full">
        <?php if ($status === 'masuk'): ?>
            <i data-feather="log-in" class="w-20 h-20 mx-auto mb-4"></i>
            <h1 class="text-4xl font-bold mb-2">SELAMAT DATANG</h1>
            <p class="text-2xl font-semibold">Plat nomor <strong><?= htmlspecialchars($license_plate) ?></strong></p>
        <?php else: ?>
            <i data-feather="log-out" class="w-20 h-20 mx-auto mb-4"></i>
            <h1 class="text-4xl font-bold mb-2">TERIMA KASIH</h1>
            <p class="text-2xl font-semibold mb-4">Plat nomor <strong><?= htmlspecialchars($license_plate) ?></strong></p>
            <p>Durasi parkir: <strong><?= htmlspecialchars($duration) ?></strong></p>
            <p>Biaya parkir: <strong>Rp<?= number_format($parking_fee, 0, ',', '.') ?></strong></p>
        <?php endif; ?>
    </div>

    <script>
        feather.replace()
    </script>
</body>
</html>
