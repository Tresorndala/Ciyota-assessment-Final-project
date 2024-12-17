<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body class="bg-cover bg-center bg-no-repeat" style="background-image: url('../images/logo.png');">
    <!-- Header with Logo centered at the top -->
    <header class="absolute top-0 left-0 right-0 p-4 text-center">
        <img src="../images/logo.png" alt="school logo" class="w-12 mx-auto">
    </header>

    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96">
            <h3 class="text-2xl text-center font-semibold mb-6">Log In</h3>

            <form action="../action/login-action.php" method="post" id="loginForm">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required>
                </div>

                <div class="mb-4">
                    <button type="submit" id="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition duration-200">Login</button>
                </div>

                <div class="text-center mt-4">
                    <h6><em>Don't have an account? <a href="../Signup/register.php" class="text-green-500">Signup here</a></em></h6>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/login.js"></script>
</body>

</html>
