<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Link to External CSS file for custom styles -->
    <link rel="stylesheet" href="../css/index.css">
</head>

<body class="bg-gray-100">

    <!-- Sidebar Section -->
    <div class="fixed top-0 left-0 h-full w-72 bg-green-800 text-white p-6 text-center">
        <div class="sch">
            <h4 class="italic text-4xl mt-40"><i>Ciyota Secondary School</i></h4>
            <img src="images/logo.png" alt="School Logo" class="w-32 h-32 mx-auto mt-5">
        </div>
        <h5 class="mt-10 italic text-lg">Student Assessment Portal</h5>
    </div>

    <!-- Main Content Section -->
    <div class="ml-72 p-8 flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
            <h4 class="text-center text-2xl font-semibold text-green-800 mb-4">
                <em><b>Welcome, Our Ciyota Teacher!</b></em>
            </h4>
            <p class="text-center text-lg text-gray-600 mb-6">
                <em>Please log in or sign up to proceed.</em>
            </p>
            <div class="flex justify-center gap-6">
                <a href="login/login.php">
                    <button class="w-48 h-12 bg-green-800 text-white font-semibold rounded-lg hover:bg-green-900 transition duration-300">
                        Log In
                    </button>
                </a>
                <a href="signup/register.php">
                    <button class="w-48 h-12 bg-green-800 text-white font-semibold rounded-lg hover:bg-green-900 transition duration-300">
                        Sign Up
                    </button>
                </a>
            </div>
        </div>
    </div>

</body>

</html>
