<?php

// Configure secure session cookie settings before starting the session
session_set_cookie_params([
    "lifetime" => 0,
    "path" => "/",
    "secure" => false, // Set to true when using HTTPS
    "httponly" => true,
    "samesite" => "Strict"
]);

session_start();

// Handle login
if (isset($_POST["login"])) {

    $username = trim($_POST["username"] ?? "");

    if ($username === "") {
        $message = "Username is required.";
    } else {

        // Regenerate session ID after authentication
        session_regenerate_id(true);

        $_SESSION["authenticated"] = true;
        $_SESSION["username"] = $username;

        // Secure HttpOnly cookie
        setcookie("secure_user", $username, [
            "expires" => time() + 3600,
            "path" => "/",
            "secure" => false, // Set to true when using HTTPS
            "httponly" => true,
            "samesite" => "Strict"
        ]);

        // Intentionally insecure cookie for comparison
        setcookie("insecure_user", $username, [
            "expires" => time() + 3600,
            "path" => "/",
            "secure" => false,
            "httponly" => false,
            "samesite" => "Lax"
        ]);

        $message = "Login successful. Session ID was regenerated.";
    }
}

// Logout
if (isset($_POST["logout"])) {

    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            "",
            time() - 42000,
            $params["path"],
            $params["domain"] ?? "",
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();

    $message = "Logged out successfully.";
}

$is_authenticated = $_SESSION["authenticated"] ?? false;
$username = $_SESSION["username"] ?? "Not authenticated";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session & Cookie Security</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #f4f4f4;
        }

        .box {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .safe {
            color: green;
            font-weight: bold;
        }

        .warning {
            color: #b00020;
            font-weight: bold;
        }

        code {
            background: #eee;
            padding: 3px 6px;
        }

        input, button {
            padding: 8px;
            margin: 5px;
        }
    </style>
</head>

<body>

<h1>Session & Cookie Security</h1>

<div class="box">

    <h2>Authentication</h2>

    <?php if (isset($message)): ?>
        <p><strong><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></strong></p>
    <?php endif; ?>

    <?php if (!$is_authenticated): ?>

        <form method="POST">

            <label>
                Username:
                <input type="text" name="username" required>
            </label>

            <button type="submit" name="login">
                Login
            </button>

        </form>

    <?php else: ?>

        <p>
            Logged in as:
            <strong><?= htmlspecialchars($username, ENT_QUOTES, "UTF-8") ?></strong>
        </p>

        <form method="POST">
            <button type="submit" name="logout">
                Logout
            </button>
        </form>

    <?php endif; ?>

</div>

<div class="box">

    <h2>Session Security</h2>

    <p>
        Authentication status:
        <strong>
            <?= $is_authenticated ? "Authenticated" : "Not authenticated" ?>
        </strong>
    </p>

    <p>
        Session ID:
        <code><?= htmlspecialchars(session_id(), ENT_QUOTES, "UTF-8") ?></code>
    </p>

    <p class="safe">
        ✓ Session ID is regenerated after login using
        session_regenerate_id(true)
    </p>

</div>

<div class="box">

    <h2>Cookie Security</h2>

    <p class="safe">
        ✓ secure_user: HttpOnly + SameSite=Strict
    </p>

    <p class="warning">
        ⚠ insecure_user: HttpOnly disabled + SameSite=Lax
    </p>

    <h3>JavaScript Cookie Test</h3>

    <p>
        JavaScript reads:
    </p>

    <code id="cookie-output">Checking document.cookie...</code>

    <p>
        The <strong>secure_user</strong> cookie should not appear above
        because it has the <strong>HttpOnly</strong> flag.
    </p>

</div>

<script>

    const cookieOutput = document.getElementById("cookie-output");

    if (document.cookie) {
        cookieOutput.textContent = document.cookie;
    } else {
        cookieOutput.textContent =
            "No JavaScript-accessible cookies found.";
    }

</script>

</body>
</html>