document.getElementById('registerForm').addEventListener('submit', async function (event) {
    event.preventDefault();

    if (validateForm()) {
        const formData = new FormData(this);

        try {
            const response = await fetch('../action/register-action.php', {
                method: 'POST',
                body: formData,
            });

            const data = await response.json();

            if (data.success) {
                alert("Registration successful!");
                window.location.href = '../login/login.php';
            } else {
                alert("Registration failed: " + data.message);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
});

function validateForm() {
    const fname = document.getElementById('fname').value.trim();
    const lname = document.getElementById('lname').value.trim();
    const contact = document.getElementById('contact').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    let isValid = true;

    if (!/^[A-Za-z]{2,}$/.test(fname)) {
        document.getElementById('fnameError').textContent = "First name must contain at least 2 letters and only alphabets.";
        isValid = false;
    } else {
        document.getElementById('fnameError').textContent = "";
    }

    if (!/^[A-Za-z]{2,}$/.test(lname)) {
        document.getElementById('lnameError').textContent = "Last name must contain at least 2 letters and only alphabets.";
        isValid = false;
    } else {
        document.getElementById('lnameError').textContent = "";
    }

    if (!/^[0-9 ()+-]{10,}$/.test(contact)) {
        document.getElementById('cError').textContent = "Invalid contact number.";
        isValid = false;
    } else {
        document.getElementById('cError').textContent = "";
    }

    if (!/^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$/.test(email)) {
        document.getElementById('emailError').textContent = "Invalid email address.";
        isValid = false;
    } else {
        document.getElementById('emailError').textContent = "";
    }

    if (password.length < 8) {
        document.getElementById('passwordError').textContent = "Password must be at least 8 characters.";
        isValid = false;
    } else {
        document.getElementById('passwordError').textContent = "";
    }

    if (password !== confirmPassword) {
        document.getElementById('confirmMessage').textContent = "Passwords do not match.";
        isValid = false;
    } else {
        document.getElementById('confirmMessage').textContent = "";
    }

    return isValid;
}
