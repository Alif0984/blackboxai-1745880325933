<?php
// Sample data for parking slots, revenue, and violators
$parking_slots = [
    ['id' => 1, 'status' => 'kosong'],
    ['id' => 2, 'status' => 'terisi'],
    ['id' => 3, 'status' => 'kosong'],
    ['id' => 4, 'status' => 'terisi'],
    ['id' => 5, 'status' => 'kosong'],
    ['id' => 6, 'status' => 'terisi'],
    ['id' => 7, 'status' => 'kosong'],
    ['id' => 8, 'status' => 'kosong'],
    ['id' => 9, 'status' => 'terisi'],
];

$revenue = [
    ['day' => '16 Mar', 'amount' => 50000],
    ['day' => '17 Mar', 'amount' => 75000],
    ['day' => '18 Mar', 'amount' => 60000],
    ['day' => '19 Mar', 'amount' => 80000],
    ['day' => '20 Mar', 'amount' => 90000],
];

$violators = [
    ['plat' => 'B 1234 XYZ', 'waktu' => '20 Mar', 'aksi' => 'Blokir'],
    ['plat' => 'B 5678 ABC', 'waktu' => '19 Mar', 'aksi' => 'Blokir'],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin - SIPAKU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet" />
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
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
    </header>

    <main class="max-w-6xl mx-auto space-y-8">
        <!-- Peta Slot Parkir -->
        <section class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Peta Slot Parkir</h2>
            <div class="grid grid-cols-5 gap-4">
                <?php foreach ($parking_slots as $slot): ?>
                    <div class="h-16 flex items-center justify-center rounded text-white font-semibold
                        <?= $slot['status'] === 'kosong' ? 'bg-green-500' : 'bg-red-500' ?>">
                        Slot <?= $slot['id'] ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Grafik Pendapatan -->
        <section class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Grafik Pendapatan</h2>
            <div class="flex items-end space-x-4 h-40">
                <?php
                $max_amount = max(array_column($revenue, 'amount'));
                foreach ($revenue as $day_data):
                    $height = ($day_data['amount'] / $max_amount) * 100;
                ?>
                    <div class="flex flex-col items-center">
                        <div class="bg-blue-700 w-8 rounded-t" style="height: <?= $height ?>%"></div>
                        <span class="text-sm mt-2"><?= htmlspecialchars($day_data['day']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Tabel Pelanggar -->
        <section class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Tabel Pelanggar</h2>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border border-gray-300">Plat</th>
                        <th class="py-2 px-4 border border-gray-300">Waktu</th>
                        <th class="py-2 px-4 border border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($violators as $v): ?>
                        <tr>
                            <td class="py-2 px-4 border border-gray-300"><?= htmlspecialchars($v['plat']) ?></td>
                            <td class="py-2 px-4 border border-gray-300"><?= htmlspecialchars($v['waktu']) ?></td>
                            <td class="py-2 px-4 border border-gray-300"><?= htmlspecialchars($v['aksi']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <script>
        feather.replace()
    </script>
</body>
</html>
