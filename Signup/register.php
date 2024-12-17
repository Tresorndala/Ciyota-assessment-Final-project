<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Link to External CSS file -->
    <link rel="stylesheet" href="../css/register.css">
</head>

<body class="bg-gray-100">

    <!-- Centered container -->
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full sm:w-96 max-w-md">
            <!-- Header Section (Logo) -->
            <div class="text-center mb-4">
                <h4 class="italic"><i>CIYOTA Secondary School</i></h4>
                <img src="../images/logo.png" alt="school logo" class="w-16 h-16 mx-auto mb-2">
            </div>

            <h3 class="text-center text-2xl font-semibold text-green-800 mb-4">Sign up</h3>
            <!-- Form -->
            <form action="../action/register-action.php" method="post" id="registerForm">
                <div class="mb-4">
                    <label for="fname" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="fname" id="fname" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Enter your first name" required>
                    <span id="fnameError" class="text-red-500 text-xs"></span>
                </div>
                <div class="mb-4">
                    <label for="lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="lname" id="lname" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Enter your last name" required>
                    <span id="lnameError" class="text-red-500 text-xs"></span>
                </div>
                <div class="mb-4">
                    <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                    <input type="tel" name="contact" id="contact" class="w-full p-3 border border-gray-300 rounded-md" placeholder="0509534568" required>
                    <span id="cError" class="text-red-500 text-xs"></span>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-md" placeholder="name@example.com" required>
                    <span id="emailError" class="text-red-500 text-xs"></span>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Enter a password" required>
                    <span id="passwordError" class="text-red-500 text-xs"></span>
                </div>
                <div class="mb-6">
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Confirm your password" required>
                    <span id="confirmMessage" class="text-red-500 text-xs"></span>
                </div>
                <button type="submit" id="register" class="w-full py-3 bg-green-800 text-white font-semibold rounded-md hover:bg-green-900 transition duration-300">Sign up</button>
            </form>
            <div class="text-center mt-4">
                <p><em>Already have an account? <a href="../login/login.php" class="text-green-500 hover:underline">Login here</a></em></p>
            </div>
        </div>
    </div>

    <!-- Link to JavaScript file -->
    <script src="../js/register.js"></script>

</body>

</html>

