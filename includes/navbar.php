<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar with Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<nav class="bg-gray-800 text-white p-4" style="background-color: #1e1e1f !important; ">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="/" class="flex items-center">
                <img src="./images/paste_logo.png" alt="Logo" class="mr-2" style="width: 50px !important; height: auto;"> 
            </a>
        </div>

        <div class="hidden md:flex grow justify-center" style="gap: 40px;">
    <b>
        <a href="index.php" class="hover:text-gray-300" style="margin-right: 20px !important;">Create Paste</a>
        <a href="recent.php" class="hover:text-gray-300" style="margin-right: 20px !important;">Recent Page</a>
        <a href="top.php" class="hover:text-gray-300" style="margin-right: 20px !important;">Top Paste</a>
        <a href="top.php" class="hover:text-gray-300" style="margin-right: 20px !important;">Paste Events</a>
    </b>
</div>


        <div class="flex items-center">
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <a href="../user/dashboard" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hidden md:block">Dashboard</a>
            <?php else: ?>
                <a href="../user/login.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hidden md:block">Login</a>
                <span class="mx-2 hidden md:block">or</span>
                <a href="../user/register.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hidden md:block">Register</a>
                <button class="mobile-menu-button md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            <?php endif; ?>
        </div>
    </div>

    <div class="mobile-menu hidden md:hidden p-4 text-center">
    <a href="../create.php" class="block hover:text-gray-300 mb-2">Create Paste</a>
    <a href="../recent.php" class="block hover:text-gray-300 mb-2">Recent Page</a>
    <a href="../top.php" class="block hover:text-gray-300 mb-4">Top Paste</a>
    <a href="../top.php" class="hover:text-gray-300" style="margin-right: 20px !important;">Paste Events</a>
    <?php if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
        <div class="flex justify-center space-x-2">
            <a href="../user/login.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login</a>
            <span class="text-white">or</span>
            <a href="../user/register.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Register</a>
        </div>
    <?php endif; ?>
</div>

</nav>

<script>
    document.querySelector('.mobile-menu-button').addEventListener('click', function() {
        document.querySelector('.mobile-menu').classList.toggle('hidden');
    });
</script>
<script src="https://unpkg.com/@tailwindcss"></script>

</body>
</html>
