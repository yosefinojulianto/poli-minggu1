<?php
include_once("koneksi.php");

$username = '';
$password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) > 0) {
        $registrationMessage = "Username sudah digunakan. Silakan coba username lain.";
    } else {
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if (mysqli_query($mysqli, $query)) {
            $registrationMessage = "Registrasi berhasil. Silakan login.";
            // header("Location: login.php");
        } else {
            $registrationMessage = "Registrasi gagal. Silakan coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poliklinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    body {
        background-image: url('img/bg.jpg');
        background-size: cover;
        background-position: center;
        height: 100vh;
        margin: 0;
        display: flex;
        flex-direction: column;
        animation: fadeIn 1s ease-in-out;
    }

    .navbar {
        margin-bottom: 0;
    }

    .text-center {
        color: white;
        display: flex;
        align-items: center;
        justify-items: center;
        margin: 20px;
    }

    .container {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }

    .form-container {
        width: 400px;
        background: linear-gradient(#212121, #212121) padding-box,
                    linear-gradient(145deg, transparent 35%,#e81cff, #40c9ff) border-box;
        border: 2px solid transparent;
        padding: 32px 24px;
        font-size: 14px;
        font-family: inherit;
        color: white;
        display: flex;
        flex-direction: column;
        gap: 20px;
        box-sizing: border-box;
        border-radius: 16px;
        background-size: 200% 100%;
        animation: gradient 5s ease infinite;
    }


    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .form-container button:active {
        scale: 0.95;
    }

    .form-container .form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-container .form-group {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .form-container .form-group label {
        display: block;
        margin-bottom: 5px;
        color: white;
        font-weight: 600;
        font-size: 12px;
    }

    .form-container .form-group input,
    .form-container .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border-radius: 8px;
        color: #fff;
        font-family: inherit;
        background-color: transparent;
        border: 1px solid #414141;
    }

    .form-container .form-group input::placeholder {
        opacity: 0.5;
    }

    .form-container .form-group input:focus,
    .form-container .form-group textarea:focus {
        outline: none;
        border-color: #e81cff;
    }

    .form-container .form-submit-btn {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        align-self: flex-start;
        font-family: inherit;
        color: #717171;
        font-weight: 600;
        width: 40%;
        background: #313131;
        border: 1px solid #414141;
        padding: 12px 16px;
        font-size: inherit;
        gap: 8px;
        margin-top: 8px;
        cursor: pointer;
        border-radius: 6px;
    }

    .form-container .form-submit-btn:hover {
        background-color: #fff;
        border-color: #fff;
    }

    @media (max-width: 768px) {
        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 70%;
            margin-right: 0;
            margin-left: 15% ;
        }

        .form-submit-btn {
            width: 100%;
        }

        .form-group label {
            font-size: 12px;
        }

        .form-group input,
        .form-group textarea {
            font-size: 12px;
        }
    }
    </style>
</head>
<body>
   
    <!-- Main Content -->
    <main role="main" class="container">
        <div class="text-center">
            <h1>Register</h1>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-container">
                    <form class="form" method="POST" action="register.php">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input required="" name="username" id="username" type="text" value="<?php echo $username ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input required="" name="password" id="password" type="password" value="<?php echo $password ?>">
                        </div>
                        <div class="form-group">
                            <label for="role">Choose a role:</label>
                            <select name="role" id="role">
                                <option value="dokter">Dokter</option>
                                <option value="pasien">Admin</option>
                            </select>
                        </div>
                        <p>Already have an account? <a href="login.php">Login</a></p>
                        <button type="submit" class="form-submit-btn" name="register">Register</button>
                    </form>
                    <?php
                    if (isset($registrationMessage)) {
                        if (strpos($registrationMessage, 'berhasil') !== false) {
                            echo '<div class="alert alert-success" role="alert">' . $registrationMessage . '</div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">' . $registrationMessage . '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <!-- /Main Content -->
    
</body>
</html>