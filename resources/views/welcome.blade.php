<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Project Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <img src="http://uts_api.test:90/storage/images/logo.png" class="w-20 h-20 mx-auto mb-6">
        <h1 class="text-4xl font-bold text-gray-800">Selamat Datang di Website</h1>
        <h1 class="text-4xl font-bold mb-6 text-gray-800">Project Management Sederhana</h1>
        <p class="text-lg mb-8 text-gray-600">Kelola proyek Anda dengan lebih mudah dan terorganisir.</p>
        <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition duration-300">
            Login
        </a>
    </div>
</body>
</html>
