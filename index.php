<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = !empty($_POST['test_message']) ? trim($_POST['test_message']) : '';

    if ($message) {
        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO submissions (message, submitted_at) VALUES (?, NOW())");
        $stmt->execute([$message]);

        // Flash message
        $_SESSION['flash_message'] = "Thanks! Your test message was saved: \"" . htmlspecialchars($message) . "\" 🎉";
        $_SESSION['flash_type'] = 'success';

        // reward popup
        $_SESSION['reward_unlocked'] = true;
    } else {
        $_SESSION['flash_message'] = "Please enter a test message.";
        $_SESSION['flash_type'] = 'error';
    }

    header("Location: index.php");
    exit;
}

// Fetch submissions
$stmt = $pdo->query("SELECT message, submitted_at FROM submissions ORDER BY submitted_at DESC");
$submissions = $stmt->fetchAll();

$submission_count = count($submissions);

// Latest for big display button
$latest_submission = $submissions[0] ?? null;
$button_text = $latest_submission
    ? htmlspecialchars($latest_submission['message'])
    : 'Your test message will appear here';

// Build table
$submissions_output = '';
if (empty($submissions)) {
    $submissions_output = '<p>No submissions yet. Be the first!</p>';
} else {
    $submissions_output .= '<table>';
    $submissions_output .= '<tr><th>Test Message</th><th>Submitted At</th></tr>';
    foreach ($submissions as $s) {
        $submissions_output .= '<tr>';
        $submissions_output .= '<td>' . htmlspecialchars($s['message']) . '</td>';
        $submissions_output .= '<td><small>' . htmlspecialchars($s['submitted_at']) . '</small></td>';
        $submissions_output .= '</tr>';
    }
    $submissions_output .= '</table>';
}

// Flash and reward
$flash_message = $_SESSION['flash_message'] ?? null;
$flash_type = $_SESSION['flash_type'] ?? 'success';
unset($_SESSION['flash_message'], $_SESSION['flash_type']);

$show_reward = !empty($_SESSION['reward_unlocked']);
unset($_SESSION['reward_unlocked']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP, JS, HTML, CSS Sandbox</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="page-title">
        <h1>PHP, JS, HTML, CSS, SQL and API Sandbox</h1>
        <button class="title-button">Hello World</button>
    </div>
    
    <div class="content-wrapper">
        <p style="background:#f0f8f0; padding:15px; border-radius:10px; font-weight:bold; text-align:center;">
            This is a safe PHP/MySQL learning project. No personal data is collected.
        </p>

        <?php if ($flash_message): ?>
            <div class="flash-message <?= htmlspecialchars($flash_type) ?>">
                <?= $flash_message ?>
            </div>
        <?php endif; ?>

        <div class="content-txt">
            <h3>Test Form</h3>
            <p>
                Hello, welcome to my practice page!<br>
                My name is Elijah G. and I am a passionate developer with expierense across full stacks.<br>
                I enjoy outdoors, biking and the beach. Thanks for visiting my site! For employers seeking code samples please email me at the email I have provided.<br>
                I wish you the best and thanks again for checking out my sandbox! Have a great rest of your day!
            </p>
        </div>

        <form action="index.php" method="POST">
            <label for="test_message">Test Message:</label><br><br>
            <input type="text" id="test_message" name="test_message" placeholder="Type anything here" required style="width:100%; max-width:400px; padding:10px;">
            <br><br>

            <input type="submit" value="Submit Test">
            <input type="reset" value="Clear">
        </form><br>

        <button class="display-button">
            <?= $button_text ?>
        </button><br><br>

        <p>
            <a href="https://google.com" target="_blank" class="google-button">
                CLICK ME TO VISIT GOOGLE
            </a>
        </p><br><br>

        <div class="read-db">
            <div class="table-count">
                <h3>Submitted Messages (<?= $submission_count ?> total)</h3>
            </div>
            <div class="table-sub"> 
                <?= $submissions_output ?>
            </div>
        </div>

        <?php if ($show_reward): ?>
            <div id="submit-popup">
                <img src="images/popup.png" alt="Success Reward!">
                <p><?= $flash_message ?? "Reward Unlocked! 🎉" ?></p>
            </div>
        <?php endif; ?>
    </div>

    <script src="app.js"></script>
</body>
</html>