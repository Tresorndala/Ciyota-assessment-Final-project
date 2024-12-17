document.getElementById('loginForm').addEventListener('submit', async function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    try {
        const response = await fetch('../action/login-action.php', {
            method: 'POST',
            body: formData,
        });

        const data = await response.json();

        if (data.success) {
            alert(data.message); // Display success message
            window.location.href = '../view/class_view.php'; // Redirect to desired page
        } else {
            document.getElementById('passwordError').textContent = data.message;
        }
    } catch (error) {
        console.error('Error:', error);
    }
});
