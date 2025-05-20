<?php include 'session_check.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            text-align: center;
            margin: 50px;
        }
        .container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 420px;
            margin: auto;
        }
        h2 {
            color: #333;
            margin-bottom: 15px;
        }
        label {
            display: block;
            text-align: left;
            font-weight: bold;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 15px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .change-password {
            margin-top: 20px;
        }
        .change-password a {
            display: inline-block;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            margin-top: 10px;
        }
        .change-password a:hover {
            text-decoration: underline;
        }
        .delete-profile {
            margin-top: 20px; /* Adds space above the link */
        }

        .delete-profile a {
            text-decoration: none; /* Removes default underline */
            color: red;
            font-weight: bold;
        }

        .delete-profile a:hover {
            text-decoration: underline; /* Underlines text on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Profile Settings</h2>
        <form action="update-profile.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="" readonly>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="" required>

            <button type="submit">Save Changes</button>
        </form>
        
        <div class="change-password">
            <a href="change-password.html">Change Password</a>
        </div>
        <div class="delete-profile">
            <a href="#" id="deleteProfileLink">Delete Profile</a>
        </div>
    </div>
    
    <script>
        // Fetch user details and populate the form
        fetch('fetch-user.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('username').value = data.username;
                document.getElementById('name').value = data.name;
                document.getElementById('email').value = data.email;
                document.getElementById('age').value = data.age;
            })
            .catch(error => console.error('Error fetching user data:', error));

            document.querySelector("#deleteProfileLink").addEventListener("click", function (e) {
                e.preventDefault(); // Prevent default link behavior

                if (confirm("Are you sure you want to delete your profile? This action cannot be undone.")) {
                    fetch("delete-account.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: "delete=true"
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        if (data.success) {
                            window.location.href = "index.html"; // Redirect to login after deletion
                        }
                    })
                    .catch(error => console.error("Error:", error));
                }
            });
    </script>
</body>
</html>
