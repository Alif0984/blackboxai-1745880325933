<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Notifikasi SMS - SIPAKU</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F0F0F0;
            display: flex;
            justify-content: center;
            padding: 2rem;
        }
        .notification {
            background: white;
            width: 320px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 1.5rem;
        }
        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }
        .logo img {
            height: 40px;
        }
        .content {
            font-family: monospace;
            white-space: pre-line;
            font-size: 1rem;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="notification">
        <div class="logo">
            <img src="logo.png" alt="Logo Kampus" />
        </div>
        <div class="content">
[SIPAKU]  
Parkir selesai!  
Plat: B 1234 XYZ  
Durasi: 2 jam  
Biaya: Rp4.000  
Saldo: Rp46.000  
        </div>
    </div>
</body>
</html>
