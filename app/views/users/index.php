
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Module</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* =========================
           LIGHT THEME
        ========================== */
        :root {
            --background: #f1f5f9;
            --card: #ffffff;
            --header: #0f172a;
            --header-blue: #1e3a8a;
            --text: #1e293b;
            --muted: #64748b;
            --border: #e2e8f0;
            --table-header: #f8fafc;
            --hover: #f1f5f9;
            --badge-background: #dbeafe;
            --badge-text: #1d4ed8;
            --username: #2563eb;
            --shadow: rgba(15, 23, 42, 0.08);
        }

        /* =========================
           DARK THEME
        ========================== */
        body.dark {
            --background: #020617;
            --card: #0f172a;
            --header: #020617;
            --header-blue: #172554;
            --text: #f8fafc;
            --muted: #94a3b8;
            --border: #334155;
            --table-header: #1e293b;
            --hover: #1e293b;
            --badge-background: #1e3a8a;
            --badge-text: #bfdbfe;
            --username: #60a5fa;
            --shadow: rgba(0, 0, 0, 0.3);
        }

        /* =========================
           BODY
        ========================== */
        body {
            font-family: Arial, sans-serif;
            background: var(--background);
            color: var(--text);
            min-height: 100vh;
            padding: 40px 20px;
            transition: 0.3s ease;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        /* =========================
           HEADER
        ========================== */
        .page-header {
            position: relative;
            background: linear-gradient(
                135deg,
                var(--header),
                var(--header-blue)
            );
            color: white;
            padding: 32px;
            border-radius: 18px;
            margin-bottom: 25px;
            box-shadow: 0 10px 25px var(--shadow);
        }

        .page-header h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #cbd5e1;
            font-size: 14px;
        }

        /* =========================
           DARK MODE BUTTON
        ========================== */
        .theme-button {
            position: absolute;
            right: 25px;
            top: 25px;

            display: flex;
            align-items: center;
            gap: 8px;

            border: 1px solid rgba(255, 255, 255, 0.25);
            background: rgba(255, 255, 255, 0.12);
            color: white;

            padding: 10px 15px;
            border-radius: 10px;

            cursor: pointer;
            font-size: 13px;

            transition: 0.2s ease;
        }

        .theme-button:hover {
            background: rgba(255, 255, 255, 0.22);
            transform: translateY(-1px);
        }

        /* =========================
           SUMMARY CARD
        ========================== */
        .summary {
            display: flex;
            justify-content: space-between;
            align-items: center;

            background: var(--card);
            padding: 22px 25px;

            border-radius: 15px;
            margin-bottom: 20px;

            box-shadow: 0 5px 15px var(--shadow);

            transition: 0.3s ease;
        }

        .summary-title {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 5px;
        }

        .user-count {
            color: var(--username);
            font-size: 26px;
            font-weight: bold;
        }

        .summary-label {
            color: var(--muted);
            font-size: 13px;
        }

        /* =========================
           TABLE CARD
        ========================== */
        .table-card {
            background: var(--card);
            padding: 10px;

            border-radius: 18px;

            box-shadow: 0 8px 25px var(--shadow);

            overflow-x: auto;

            transition: 0.3s ease;
        }

        table {
            width: 100%;
            min-width: 750px;
            border-collapse: collapse;
        }

        /* =========================
           TABLE HEADER
        ========================== */
        thead {
            background: var(--table-header);
        }

        th {
            padding: 16px;

            text-align: left;

            color: var(--muted);

            font-size: 12px;
            font-weight: bold;

            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* =========================
           TABLE DATA
        ========================== */
        td {
            padding: 17px 16px;

            border-bottom: 1px solid var(--border);

            color: var(--text);

            font-size: 14px;
        }

        tbody tr {
            transition: 0.2s ease;
        }

        tbody tr:hover {
            background: var(--hover);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* =========================
           ID BADGE
        ========================== */
        .id-badge {
            display: inline-block;

            padding: 5px 10px;

            background: var(--badge-background);
            color: var(--badge-text);

            border-radius: 20px;

            font-size: 12px;
            font-weight: bold;
        }

        /* =========================
           USERNAME
        ========================== */
        .username {
            color: var(--username);
            font-weight: bold;
        }

        /* =========================
           EMPTY STATE
        ========================== */
        .empty {
            text-align: center;
            padding: 50px 20px;
            color: var(--muted);
        }

        .empty-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .empty strong {
            display: block;
            color: var(--text);
            margin-bottom: 5px;
        }

        /* =========================
           MOBILE
        ========================== */
        @media (max-width: 600px) {

            body {
                padding: 20px 10px;
            }

            .page-header {
                padding: 25px 20px;
            }

            .page-header h1 {
                font-size: 24px;
                padding-right: 70px;
            }

            .theme-button {
                right: 15px;
                top: 15px;
                padding: 8px 10px;
            }

            .summary {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- =========================
         PAGE HEADER
    ========================== -->
    <div class="page-header">

        <h1>User Management</h1>

        <p>
            Manage and view registered users in the system.
        </p>

        <!-- Theme Button -->
        <button class="theme-button" id="themeButton">
            <span id="themeIcon">☾</span>
            <span id="themeText">Dark Mode</span>
        </button>

    </div>


    <!-- =========================
         USER SUMMARY
    ========================== -->
    <div class="summary">

        <div>
            <div class="summary-title">
                Registered Users
            </div>

            <div class="user-count">
                <?= !empty($users) ? count($users) : 0 ?>
            </div>
        </div>

        <div class="summary-label">
            Total User Records
        </div>

    </div>


    <!-- =========================
         USER TABLE
    ========================== -->
    <div class="table-card">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Username</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($users)) : ?>

                    <?php foreach ($users as $user) : ?>

                        <tr>

                            <td>
                                <span class="id-badge">
                                    #<?= htmlspecialchars(
                                        $user->id ?? $user['id']
                                    ) ?>
                                </span>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $user->firstname ?? $user['firstname']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $user->lastname ?? $user['lastname']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $user->email ?? $user['email']
                                ) ?>
                            </td>

                            <td>
                                <span class="username">
                                    @<?= htmlspecialchars(
                                        $user->username ?? $user['username']
                                    ) ?>
                                </span>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else : ?>

                    <tr>

                        <td colspan="5" class="empty">

                            <div class="empty-icon">
                                👤
                            </div>

                            <strong>
                                No Users Found
                            </strong>

                            <span>
                                There are currently no registered users.
                            </span>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<!-- =========================
     DARK / LIGHT MODE SCRIPT
========================== -->
<script>

    const body = document.body;
    const themeButton = document.getElementById("themeButton");
    const themeIcon = document.getElementById("themeIcon");
    const themeText = document.getElementById("themeText");


    function updateThemeButton() {

        if (body.classList.contains("dark")) {

            themeIcon.textContent = "☀";
            themeText.textContent = "White Mode";

        } else {

            themeIcon.textContent = "☾";
            themeText.textContent = "Dark Mode";

        }

    }


    themeButton.addEventListener("click", function () {

        body.classList.toggle("dark");

        if (body.classList.contains("dark")) {

            localStorage.setItem("theme", "dark");

        } else {

            localStorage.setItem("theme", "light");

        }

        updateThemeButton();

    });


    /* Load saved theme */
    const savedTheme = localStorage.getItem("theme");

    if (savedTheme === "dark") {
        body.classList.add("dark");
    }

    updateThemeButton();

</script>

</body>
</html>

