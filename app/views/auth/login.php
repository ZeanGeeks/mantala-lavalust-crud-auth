
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Product Management</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: #dcecff;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 40px 35px;
            background: #dcecff;
            border-radius: 25px;
            box-shadow:
                12px 12px 25px rgba(80, 120, 170, 0.25),
                -12px -12px 25px rgba(255, 255, 255, 0.8);
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 32px;
            font-weight: bold;
            color: #1769aa;
            box-shadow:
                inset 5px 5px 10px rgba(100, 140, 190, 0.2),
                inset -5px -5px 10px rgba(255, 255, 255, 0.8);
        }

        h1 {
            text-align: center;
            color: #145da0;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #24527a;
            font-weight: bold;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            border: none;
            outline: none;
            border-radius: 15px;
            background: #dcecff;
            color: #1e3a5f;
            font-size: 15px;
            box-shadow:
                inset 5px 5px 10px rgba(100, 140, 190, 0.22),
                inset -5px -5px 10px rgba(255, 255, 255, 0.8);
        }

        input:focus {
            box-shadow:
                inset 3px 3px 7px rgba(100, 140, 190, 0.25),
                inset -3px -3px 7px rgba(255, 255, 255, 0.8),
                0 0 0 3px rgba(37, 117, 190, 0.15);
        }

        .login-button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 15px;
            background: #1976d2;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow:
                6px 6px 12px rgba(70, 110, 160, 0.3),
                -5px -5px 10px rgba(255, 255, 255, 0.7);
            transition: 0.2s;
        }

        .login-button:hover {
            background: #1565c0;
            transform: translateY(-2px);
        }

        .login-button:active {
            transform: translateY(1px);
            box-shadow:
                inset 4px 4px 8px rgba(0, 0, 0, 0.15),
                inset -4px -4px 8px rgba(255, 255, 255, 0.15);
        }

        .error {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 12px;
            background: #ffe4e6;
            color: #be123c;
            text-align: center;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #64748b;
            font-size: 12px;
        }

        @media (max-width: 480px) {
            body {
                padding: 15px;
            }

            .login-card {
                padding: 30px 22px;
            }

            .logo {
                width: 70px;
                height: 70px;
                font-size: 28px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="logo">
        P
    </div>

    <h1>Welcome Back</h1>

    <p class="subtitle">
        Login to manage your products
    </p>

    <?php if (isset($error)): ?>
        <div class="error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <!-- Login now submits directly to /login -->
    <form action="/login" method="POST">

        <div class="form-group">
            <label for="username">Username</label>

            <input
                type="text"
                id="username"
                name="username"
                placeholder="Enter your username"
                required
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                required
            >
        </div>

        <button type="submit" class="login-button">
            Login
        </button>

    </form>

    <div class="footer">
        Product Management System
    </div>

</div>

</body>
</html>
