<?php
require 'db.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = trim($_POST['nim'] ?? '');
    $no_hp = trim($_POST['no_hp'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $jenis_kendaraan = $_POST['jenis_kendaraan'] ?? '';
    $sim_file = $_FILES['sim_file'] ?? null;

    // Basic validation
    if (!$nim) {
        $errors[] = 'NIM wajib diisi.';
    }
    if (!$no_hp) {
        $errors[] = 'No HP wajib diisi.';
    }
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email tidak valid.';
    }
    if (!in_array($jenis_kendaraan, ['Motor', 'Mobil'])) {
        $errors[] = 'Jenis Kendaraan tidak valid.';
    }
    if (!$sim_file || $sim_file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'File SIM wajib diunggah.';
    }

    if (empty($errors)) {
        // Handle file upload
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $sim_filename = uniqid() . '-' . basename($sim_file['name']);
        $sim_filepath = $upload_dir . $sim_filename;
        if (move_uploaded_file($sim_file['tmp_name'], $sim_filepath)) {
            // Save to database
            $stmt = $pdo->prepare("INSERT INTO users (nim, no_hp, email, jenis_kendaraan, sim_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nim, $no_hp, $email, $jenis_kendaraan, $sim_filepath]);
            $success = 'Registrasi berhasil.';
        } else {
            $errors[] = 'Gagal mengunggah file SIM.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrasi Parkir - SIPAKU</title>
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
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
        <header class="flex items-center mb-6">
            <img src="logo.png" alt="Logo Kampus" class="h-10 w-10 mr-3" />
            <h1 class="text-2xl font-bold text-gray-800">REGISTRASI PARKIR</h1>
        </header>

        <?php if ($success): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if ($errors): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="nim" class="block text-gray-700 font-semibold mb-1">NIM</label>
                <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($_POST['nim'] ?? '') ?>" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required />
            </div>
            <div>
                <label for="no_hp" class="block text-gray-700 font-semibold mb-1">No HP</label>
                <input type="tel" id="no_hp" name="no_hp" value="<?= htmlspecialchars($_POST['no_hp'] ?? '') ?>" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required />
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required />
            </div>
            <div>
                <label for="jenis_kendaraan" class="block text-gray-700 font-semibold mb-1">Jenis Kendaraan</label>
                <select id="jenis_kendaraan" name="jenis_kendaraan" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="">-- Pilih --</option>
                    <option value="Motor" <?= (($_POST['jenis_kendaraan'] ?? '') === 'Motor') ? 'selected' : '' ?>>Motor</option>
                    <option value="Mobil" <?= (($_POST['jenis_kendaraan'] ?? '') === 'Mobil') ? 'selected' : '' ?>>Mobil</option>
                </select>
            </div>
            <div>
                <label for="sim_file" class="block text-gray-700 font-semibold mb-1">Upload SIM</label>
                <input type="file" id="sim_file" name="sim_file" accept=".jpg,.jpeg,.png,.pdf" class="w-full" required />
            </div>
            <p class="text-xs text-gray-500">Pastikan data sesuai dengan SIM yang diunggah.</p>
            <div class="flex justify-between mt-4">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded transition">DAFTAR</button>
                <button type="reset" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-6 py-2 rounded transition">BATAL</button>
            </div>
        </form>
    </div>
    <script>
        feather.replace()
    </script>
</body>
</html>
