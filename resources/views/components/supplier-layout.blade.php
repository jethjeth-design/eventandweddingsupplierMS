<!DOCTYPE html>
<html lang="en">
<head>
    <title>Supplier Dashboard</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>

    <div class="min-h-screen bg-gray-100">
        {{ $slot }}
    </div>

</body>
</html>