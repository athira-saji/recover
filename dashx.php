<?php include 'session_check.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Dashboard</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .navbar {
            background-color: #34495e;
            padding: 20px;
            color: white;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .navbar .menu {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }
        .menu a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            transition: color 0.3s ease-in-out;
        }
        .menu a:hover {
            color: #f1c40f;
        }
        .container {
            width: 80%;
            margin: 40px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
        }
        .card {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
            width: 280px;
            text-align: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
        }
        .card h3 {
            color: #2980b9;
            font-size: 20px;
            margin-bottom: 15px;
        }
        .card p a {
            display: inline-block;
            padding: 10px 20px;
            background: #2980b9;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: background 0.3s ease-in-out;
        }
        .card p a:hover {
            background: #3498db;
        }
        .welcome {
            font-size: 28px;
            color: #2980b9;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        .profile-info {
            background: #ffffff;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-info p {
            font-size: 18px;
            color: #333;
            margin: 10px 0;
        }

        .profile-info strong {
            color: #2c3e50;
        }

    </style>
</head>
<body>
    <div class="navbar">Healthcare Recommendation Dashboard
        <div class="menu">
            <a href="profile-settings.php">Profile Settings</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <h1 class="welcome">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <div class="profile-info">
        <p><strong>Your Email:</strong> <?php echo $_SESSION['email']; ?></p>
        <p><strong>Your Age:</strong> <?php echo $_SESSION['age']; ?></p>
    </div>
    
    <div class="container">
    <div class="card">
            <h3>Symptom Checker</h3>
            <p><a href="symptom.html">Analyze</a></p>
        </div>
        <div class="card">
            <h3>Find Nearest Hospital</h3>
            <p><a href="finddoc.html">Locate</a></p>
        </div>
        <div class="card">
            <h3>Health Calculator</h3>
            <p><a href="health-calculator.html">Check now</a></p>
        </div>
    </div>
    
    <div class="container">   
        <div class="card">
            <h3>Medicine Lookup</h3>
            <p><a href="medicine.html">Search</a></p>
        </div>
        <div class="card">
            <h3>Healthcare Blogs</h3>
            <p><a href="blog2.html">Read More</a></p>
        </div>
        <div class="card">
            <h3>Give Feedback</h3>
            <p><a href="feed.html">Share Your Thoughts</a></p>
        </div>
    </div>
   
    
</body>
</html>

