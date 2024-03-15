<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-7C5BE8zIiydD2v7+4c+oYVdI1DScsMOtScTg6dru83uRzLRpA4RMMfr2WZSmAfL5iYU2Pq6kZ9dhh1FdAKL6lA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <title>Admin Area</title>
</head>

<body>
    <section>
        <form method="POST" action="fungsi/proses_login.php">
            <div class="admin">
                <div class="admin-content">
                    <h2 class="admin-content-header">Login Admin</h2>

                    <div class="form">
                        <input type="text" class="form-input" name="login" placeholder="Username">
                        <input type="password" class="form-input" name="password" placeholder="Password">

                        <!-- Login button added here -->
                        <button type="submit" class="form-button">Login</button>
                    </div>
                </div>
            </div>
            <a href="../index.php" style="color: white;">
                            <button type="button">Main Web</button>
                        </a>
        </form>
    </section>
</body>

</html>
