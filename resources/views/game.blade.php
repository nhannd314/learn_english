<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🏁 Racing Quiz Game</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Itim&display=swap"
          rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html, body {
            height: 100%;
            background: #0f0f1a;
            font-family: 'Inter', sans-serif;
            color: #fff;
            overflow-x: hidden
        }

        .game {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            max-width: 820px;
            margin: 0 auto;
            padding: 16px;
            gap: 12px
        }

        /* ════ START SCREEN ════ */
        #start-screen {
            position: fixed;
            inset: 0;
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(ellipse at 50% 60%, #1a1040 0%, #08081a 70%);
            overflow: hidden;
        }

        #start-screen.hidden {
            display: none
        }

        #start-canvas {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: .3;
            pointer-events: none
        }

        .start-particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            animation: pfloat linear infinite
        }

        @keyframes pfloat {
            0% {
                transform: translateY(0) scale(1);
                opacity: .7
            }
            100% {
                transform: translateY(-100vh) scale(.2);
                opacity: 0
            }
        }

        .start-box {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 36px 52px;
            max-width: 500px;
            width: 90%
        }

        .start-logo {
            font-family: 'Itim', sans-serif;
            font-size: 16px;
            letter-spacing: .22em;
            text-transform: uppercase;
            color: #ff9f1c;
            opacity: .55;
            margin-bottom: 6px
        }

        .start-title {
            font-family: 'Itim', sans-serif;
            font-size: clamp(46px, 10vw, 78px);
            line-height: 1;
            background: linear-gradient(135deg, #ff6b35, #ff9f1c, #ffe066);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 0 28px rgba(255, 150, 30, .35));
            margin-bottom: 4px;
        }

        .start-subtitle {
            font-size: 14px;
            opacity: .48;
            margin-bottom: 32px;
            letter-spacing: .04em
        }

        .start-cars {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 22px;
            margin-bottom: 32px;
            height: 56px
        }

        .start-car {
            animation: sidle .75s ease-in-out infinite alternate;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, .5))
        }

        .start-car:nth-child(2) {
            animation-delay: .37s
        }

        @keyframes sidle {
            from {
                transform: translateY(0)
            }
            to {
                transform: translateY(-7px)
            }
        }

        .btn-start {
            font-family: 'Itim', sans-serif;
            font-size: 26px;
            letter-spacing: .06em;
            padding: 15px 62px;
            border-radius: 60px;
            cursor: pointer;
            border: none;
            background: linear-gradient(135deg, #ff6b35, #ff9f1c);
            color: #fff;
            animation: pglow 1.9s ease-in-out infinite;
            transition: transform .14s;
            position: relative;
            overflow: hidden;
        }

        .btn-start::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .18), transparent);
            border-radius: inherit
        }

        .btn-start:hover {
            transform: scale(1.07)
        }

        .btn-start:active {
            transform: scale(.95)
        }

        @keyframes pglow {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(255, 150, 30, .5)
            }
            50% {
                box-shadow: 0 0 0 20px rgba(255, 150, 30, 0)
            }
        }

        .start-hint {
            font-size: 11px;
            opacity: .3;
            margin-top: 14px;
            letter-spacing: .04em
        }

        /* ════ COUNTDOWN ════ */
        #countdown-screen {
            position: fixed;
            inset: 0;
            z-index: 190;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(8, 8, 26, .92);
            pointer-events: none;
        }

        #countdown-screen.hidden {
            display: none
        }

        .countdown-num {
            font-family: 'Itim', sans-serif;
            font-size: clamp(100px, 25vw, 150px);
            line-height: 1;
            background: linear-gradient(135deg, #ff6b35, #ffe066);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 0 40px rgba(255, 150, 30, .55));
            animation: cnpop .92s cubic-bezier(.34, 1.56, .64, 1) both;
        }

        @keyframes cnpop {
            0% {
                transform: scale(2.8);
                opacity: 0
            }
            40% {
                transform: scale(.93);
                opacity: 1
            }
            70% {
                transform: scale(1.05)
            }
            100% {
                transform: scale(1);
                opacity: 1
            }
        }

        .countdown-go {
            font-family: 'Itim', sans-serif;
            font-size: clamp(80px, 20vw, 120px);
            color: #4ade80;
            filter: drop-shadow(0 0 30px rgba(74, 222, 128, .6));
            animation: gogoanim .75s cubic-bezier(.34, 1.56, .64, 1) both;
        }

        @keyframes gogoanim {
            0% {
                transform: scale(0) rotate(-12deg);
                opacity: 0
            }
            60% {
                transform: scale(1.15) rotate(2deg)
            }
            100% {
                transform: scale(1) rotate(0);
                opacity: 1
            }
        }

        /* ════ SCOREBOARD ════ */
        .scoreboard {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, .055);
            border: 1px solid rgba(255, 255, 255, .09);
            border-radius: 16px;
            padding: 12px 20px;
        }

        .team-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px
        }

        .team-name {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            opacity: .55
        }

        .team-score {
            font-family: 'Itim', sans-serif;
            font-size: 42px;
            line-height: 1
        }

        .team-score.a {
            color: #ff6b35
        }

        .team-score.b {
            color: #00b4d8
        }

        .vs-badge {
            font-family: 'Itim', sans-serif;
            font-size: 22px;
            opacity: .28
        }

        /* ════ TRACK ════ */
        .track-wrap {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, .11);
            box-shadow: 0 8px 32px rgba(0, 0, 0, .6);
        }

        .sky {
            height: 36px;
            background: linear-gradient(180deg, #050d1a 0%, #0a2035 100%);
            overflow: hidden;
            position: relative
        }

        .star {
            position: absolute;
            border-radius: 50%;
            background: #fff;
            animation: twinkle 2s infinite alternate
        }

        @keyframes twinkle {
            from {
                opacity: .12
            }
            to {
                opacity: .88
            }
        }

        .road {
            position: relative;
            height: 130px;
            overflow: hidden;
            background: #242424
        }

        #road-canvas {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none
        }

        .shoulder-top, .shoulder-bot {
            position: absolute;
            left: 0;
            right: 0;
            height: 5px;
            background: #d97228;
            z-index: 2
        }

        .shoulder-top {
            top: 0
        }

        .shoulder-bot {
            bottom: 0
        }

        .finish {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 26px;
            z-index: 10;
            background: repeating-linear-gradient(180deg, #fff 0, #fff 13px, #111 13px, #111 26px);
            opacity: .88;
        }

        .finish::before {
            content: '🏁';
            position: absolute;
            top: -22px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 20px
        }

        .car-track {
            position: absolute;
            left: 0;
            right: 26px;
            height: 50%;
            display: flex;
            align-items: center;
        }

        .car-track.a {
            top: 0
        }

        .car-track.b {
            bottom: 0
        }

        .car-wrap {
            position: absolute;
            left: 0;
            display: flex;
            align-items: center;
            transition: left .5s cubic-bezier(.34, 1.4, .64, 1);
            will-change: left;
            z-index: 5
        }

        .car-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center
        }

        .car-svg {
            width: 72px;
            height: 36px;
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, .65));
            animation: ibounce .75s ease-in-out infinite alternate
        }

        .car-svg.turbo {
            animation: tshake .07s linear infinite
        }

        @keyframes ibounce {
            from {
                transform: translateY(0)
            }
            to {
                transform: translateY(-3px)
            }
        }

        @keyframes tshake {
            0% {
                transform: translateY(0) rotate(-.5deg)
            }
            25% {
                transform: translateY(-2px) rotate(.5deg)
            }
            75% {
                transform: translateY(-3px) rotate(-.3deg)
            }
            100% {
                transform: translateY(-1px) rotate(.3deg)
            }
        }

        .dust {
            position: absolute;
            pointer-events: none;
            z-index: 4
        }

        .dust-p {
            position: absolute;
            border-radius: 50%;
            background: rgba(180, 150, 100, .5);
            animation: dflyout .65s ease-out forwards
        }

        @keyframes dflyout {
            0% {
                transform: translate(0, 0) scale(1);
                opacity: .8
            }
            100% {
                transform: translate(-32px, -12px) scale(3);
                opacity: 0
            }
        }

        .speed-lines {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 3;
            overflow: hidden;
            opacity: 0;
            transition: opacity .15s
        }

        .speed-lines.active {
            opacity: 1
        }

        .speed-line {
            position: absolute;
            height: 1px;
            background: linear-gradient(90deg, rgba(255, 255, 255, .38), transparent);
            animation: sline .22s linear infinite
        }

        @keyframes sline {
            from {
                transform: translateX(100%)
            }
            to {
                transform: translateX(-200%)
            }
        }

        /* ════ PROGRESS ════ */
        .progress-wrap {
            background: rgba(255, 255, 255, .04);
            border: 1px solid rgba(255, 255, 255, .065);
            border-radius: 12px;
            padding: 10px 16px;
            display: flex;
            flex-direction: column;
            gap: 6px
        }

        .prog-row {
            display: flex;
            align-items: center;
            gap: 10px
        }

        .prog-label {
            font-size: 11px;
            font-weight: 700;
            width: 52px;
            opacity: .6
        }

        .prog-bar {
            flex: 1;
            height: 10px;
            background: rgba(255, 255, 255, .065);
            border-radius: 99px;
            overflow: hidden
        }

        .prog-fill {
            height: 100%;
            border-radius: 99px;
            transition: width .5s cubic-bezier(.34, 1.4, .64, 1);
            position: relative
        }

        .prog-fill::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent 60%, rgba(255, 255, 255, .26));
            animation: shimmer 1.6s infinite
        }

        @keyframes shimmer {
            from {
                transform: translateX(-100%)
            }
            to {
                transform: translateX(100%)
            }
        }

        .prog-fill.a {
            background: linear-gradient(90deg, #ff6b35, #ff9f1c)
        }

        .prog-fill.b {
            background: linear-gradient(90deg, #00b4d8, #48cae4)
        }

        .prog-val {
            font-size: 12px;
            font-weight: 700;
            min-width: 36px;
            text-align: right;
            opacity: .65
        }

        /* ════ BUTTONS ════ */
        .controls {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap
        }

        .btn {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 900;
            padding: 10px 24px;
            border-radius: 12px;
            cursor: pointer;
            border: none;
            transition: transform .1s, box-shadow .1s;
            letter-spacing: .02em
        }

        .btn:hover {
            transform: translateY(-2px)
        }

        .btn:active {
            transform: scale(.93)
        }

        .btn-a {
            background: linear-gradient(135deg, #ff6b35, #ff9f1c);
            color: #fff;
            box-shadow: 0 4px 14px rgba(255, 107, 53, .32)
        }

        .btn-b {
            background: linear-gradient(135deg, #00b4d8, #0077b6);
            color: #fff;
            box-shadow: 0 4px 14px rgba(0, 180, 216, .32)
        }

        .btn-next {
            background: rgba(255, 255, 255, .08);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, .16);
            box-shadow: 0 4px 10px rgba(0, 0, 0, .28)
        }

        .btn-next:hover {
            background: rgba(255, 255, 255, .14)
        }

        .btn:disabled {
            opacity: .28;
            cursor: not-allowed;
            transform: none;
            box-shadow: none
        }

        /* ════ QUESTION ════ */
        .question-card {
            background: rgba(255, 255, 255, .05);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 16px;
            padding: 18px 22px;
            position: relative;
            overflow: hidden
        }

        .question-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #ff6b35, #00b4d8)
        }

        .q-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px
        }

        .q-num {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            background: rgba(255, 255, 255, .08);
            padding: 3px 10px;
            border-radius: 99px;
            opacity: .62
        }

        .q-type-badge {
            font-size: 10px;
            padding: 3px 9px;
            border-radius: 99px;
            font-weight: 700
        }

        .q-type-badge.has-img {
            background: rgba(99, 179, 237, .17);
            color: #63b3ed
        }

        .q-type-badge.has-audio {
            background: rgba(104, 211, 145, .17);
            color: #68d391
        }

        .q-type-badge.text-only {
            background: rgba(255, 255, 255, .07);
            color: rgba(255, 255, 255, .38)
        }

        .q-media {
            margin-bottom: 12px;
            text-align: center;
        }

        .q-media img {
            max-height: 220px;
            object-fit: cover;
            border-radius: 10px;
            display: block;
            margin: 0 auto;
        }

        .q-audio-box {
            background: rgba(255, 255, 255, .04);
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 10px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 5px;
        }

        .q-audio-icon {
            font-size: 22px
        }

        .q-audio-label {
            font-size: 13px;
            opacity: .6;
            flex: 1
        }

        .q-text {
            font-size: 19px;
            font-weight: 700;
            line-height: 1.55;
            color: #fff
        }

        .q-hint {
            font-size: 15px;
            opacity: .42;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid rgba(255, 255, 255, .07)
        }

        /* ════ WINNER ════ */
        .winner-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .88);
            z-index: 180;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadein .4s ease
        }

        @keyframes fadein {
            from {
                opacity: 0
            }
            to {
                opacity: 1
            }
        }

        .winner-box {
            background: #12121e;
            border-radius: 24px;
            padding: 40px 48px;
            text-align: center;
            border: 2px solid;
            position: relative;
            overflow: hidden;
            animation: wpop .45s cubic-bezier(.34, 1.56, .64, 1);
            max-width: 400px;
            width: 90%
        }

        @keyframes wpop {
            from {
                transform: scale(.35);
                opacity: 0
            }
            to {
                transform: scale(1);
                opacity: 1
            }
        }

        .winner-box.a {
            border-color: #ff6b35;
            box-shadow: 0 0 70px rgba(255, 107, 53, .22)
        }

        .winner-box.b {
            border-color: #00b4d8;
            box-shadow: 0 0 70px rgba(0, 180, 216, .22)
        }

        .confetti-strip {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: repeating-linear-gradient(90deg, #ff6b35, #ff9f1c, #ffe066, #00b4d8, #48cae4, #ff6b35)
        }

        .winner-trophy {
            font-size: 64px;
            margin-bottom: 8px;
            animation: tbounce .65s ease-in-out infinite alternate
        }

        @keyframes tbounce {
            from {
                transform: scale(1) rotate(-3deg)
            }
            to {
                transform: scale(1.1) rotate(3deg)
            }
        }

        .winner-title {
            font-family: 'Itim', sans-serif;
            font-size: 36px;
            margin-bottom: 4px
        }

        .winner-title.a {
            color: #ff6b35
        }

        .winner-title.b {
            color: #00b4d8
        }

        .winner-sub {
            font-size: 14px;
            opacity: .48;
            margin-bottom: 20px
        }

        .btn-reset {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 900;
            padding: 10px 28px;
            border-radius: 12px;
            cursor: pointer;
            background: rgba(255, 255, 255, .09);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, .17);
            transition: transform .1s
        }

        .btn-reset:hover {
            transform: scale(1.04);
            background: rgba(255, 255, 255, .17)
        }

        /* Float toast */
        .float-toast {
            position: fixed;
            font-family: 'Itim', sans-serif;
            font-size: 28px;
            pointer-events: none;
            z-index: 50;
            animation: fup .85s ease-out forwards
        }

        @keyframes fup {
            0% {
                transform: translateY(0) scale(1);
                opacity: 1
            }
            100% {
                transform: translateY(-80px) scale(1.5);
                opacity: 0
            }
        }
    </style>
</head>
<body>

<!-- START SCREEN -->
<div id="start-screen">
    <canvas id="start-canvas"></canvas>
    <div class="start-box">
        <div class="start-logo">🏁 Quiz Racing</div>
        <div class="start-title">ĐƯỜNG ĐUA<br>TRÍ TUỆ</div>
        <div class="start-subtitle">Trả lời câu hỏi · Chiến thắng về đích!</div>
        <div class="start-cars">
            <svg class="start-car" width="88" height="44" viewBox="0 0 120 52" fill="none">
                <ellipse cx="60" cy="47" rx="46" ry="4" fill="rgba(0,0,0,.5)"/>
                <circle cx="28" cy="40" r="9" fill="#222"/>
                <circle cx="28" cy="40" r="5" fill="#555"/>
                <circle cx="88" cy="40" r="9" fill="#222"/>
                <circle cx="88" cy="40" r="5" fill="#555"/>
                <circle cx="26" cy="38" r="2" fill="rgba(255,255,255,.3)"/>
                <circle cx="86" cy="38" r="2" fill="rgba(255,255,255,.3)"/>
                <rect x="10" y="20" width="100" height="22" rx="6" fill="#e85d04"/>
                <rect x="10" y="20" width="100" height="10" rx="6" fill="#ff7043"/>
                <rect x="30" y="8" width="56" height="16" rx="6" fill="#cc4a00"/>
                <rect x="34" y="10" width="22" height="12" rx="4" fill="#90e0f5" opacity=".85"/>
                <rect x="60" y="10" width="22" height="12" rx="4" fill="#90e0f5" opacity=".85"/>
                <ellipse cx="112" cy="28" rx="5" ry="4" fill="#ffe066"/>
                <ellipse cx="112" cy="28" rx="3" ry="2.5" fill="#fff"/>
                <rect x="9" y="25" width="4" height="8" rx="2" fill="#ff1744"/>
                <rect x="10" y="28" width="100" height="3" rx="1.5" fill="rgba(255,255,255,.25)"/>
                <text x="60" y="35" text-anchor="middle" font-family="Itim,sans-serif" font-size="11" fill="#fff">A
                </text>
            </svg>
            <svg class="start-car" width="88" height="44" viewBox="0 0 120 52" fill="none">
                <ellipse cx="60" cy="47" rx="46" ry="4" fill="rgba(0,0,0,.5)"/>
                <circle cx="28" cy="40" r="9" fill="#222"/>
                <circle cx="28" cy="40" r="5" fill="#444"/>
                <circle cx="88" cy="40" r="9" fill="#222"/>
                <circle cx="88" cy="40" r="5" fill="#444"/>
                <circle cx="26" cy="38" r="2" fill="rgba(255,255,255,.3)"/>
                <circle cx="86" cy="38" r="2" fill="rgba(255,255,255,.3)"/>
                <rect x="10" y="20" width="100" height="22" rx="6" fill="#0077b6"/>
                <rect x="10" y="20" width="100" height="10" rx="6" fill="#0096c7"/>
                <rect x="30" y="8" width="56" height="16" rx="6" fill="#005f8a"/>
                <rect x="34" y="10" width="22" height="12" rx="4" fill="#90e0f5" opacity=".85"/>
                <rect x="60" y="10" width="22" height="12" rx="4" fill="#90e0f5" opacity=".85"/>
                <ellipse cx="112" cy="28" rx="5" ry="4" fill="#ffe066"/>
                <ellipse cx="112" cy="28" rx="3" ry="2.5" fill="#fff"/>
                <rect x="9" y="25" width="4" height="8" rx="2" fill="#ff1744"/>
                <rect x="10" y="28" width="100" height="3" rx="1.5" fill="rgba(255,255,255,.25)"/>
                <text x="60" y="35" text-anchor="middle" font-family="Itim,sans-serif" font-size="11" fill="#fff">B
                </text>
            </svg>
        </div>
        <button class="btn-start" onclick="startCountdown()">🚦 BẮT ĐẦU</button>
        <p class="start-hint">Bấm xe hoặc nút +1 để tiến</p>
    </div>
</div>

<!-- COUNTDOWN -->
<div id="countdown-screen" class="hidden">
    <div id="countdown-el" class="countdown-num">3</div>
</div>

<!-- GAME -->
<div class="game" id="app">
    <div class="scoreboard">
        <div class="team-info"><span class="team-name">🚗 Đội A</span><span class="team-score a" id="score-a">0</span>
        </div>
        <span class="vs-badge">VS</span>
        <div class="team-info"><span class="team-name">🚙 Đội B</span><span class="team-score b" id="score-b">0</span>
        </div>
    </div>

    <div class="track-wrap">
        <div class="sky" id="sky"></div>
        <div class="road" id="road">
            <canvas id="road-canvas"></canvas>
            <div class="shoulder-top"></div>
            <div class="shoulder-bot"></div>
            <div class="speed-lines" id="speed-a" style="top:0;height:50%"></div>
            <div class="speed-lines" id="speed-b" style="bottom:0;height:50%"></div>
            <div class="car-track a">
                <div class="car-wrap" id="car-wrap-a" style="left:0">
                    <div class="dust" id="dust-a"></div>
                    <button class="car-btn" onclick="advance('a')" title="+1 Đội A">
                        <svg class="car-svg" id="car-svg-a" viewBox="0 0 120 52" fill="none">
                            <ellipse cx="60" cy="46" rx="46" ry="5" fill="rgba(0,0,0,.4)"/>
                            <circle cx="28" cy="40" r="9" fill="#222"/>
                            <circle cx="28" cy="40" r="5" fill="#555"/>
                            <circle cx="88" cy="40" r="9" fill="#222"/>
                            <circle cx="88" cy="40" r="5" fill="#555"/>
                            <circle cx="26" cy="38" r="2" fill="rgba(255,255,255,.3)"/>
                            <circle cx="86" cy="38" r="2" fill="rgba(255,255,255,.3)"/>
                            <rect x="10" y="20" width="100" height="22" rx="6" fill="#e85d04"/>
                            <rect x="10" y="20" width="100" height="10" rx="6" fill="#ff7043"/>
                            <rect x="30" y="8" width="56" height="16" rx="6" fill="#cc4a00"/>
                            <rect x="34" y="10" width="22" height="12" rx="4" fill="#90e0f5" opacity=".85"/>
                            <rect x="60" y="10" width="22" height="12" rx="4" fill="#90e0f5" opacity=".85"/>
                            <rect x="35" y="11" width="8" height="4" rx="2" fill="rgba(255,255,255,.5)"/>
                            <ellipse cx="112" cy="28" rx="5" ry="4" fill="#ffe066"/>
                            <ellipse cx="112" cy="28" rx="3" ry="2.5" fill="#fff"/>
                            <rect x="9" y="25" width="4" height="8" rx="2" fill="#ff1744"/>
                            <rect x="10" y="28" width="100" height="3" rx="1.5" fill="rgba(255,255,255,.25)"/>
                            <text x="58" y="35" text-anchor="middle" font-family="Itim,sans-serif" font-size="11"
                                  fill="#fff">A
                            </text>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="car-track b">
                <div class="car-wrap" id="car-wrap-b" style="left:0">
                    <div class="dust" id="dust-b"></div>
                    <button class="car-btn" onclick="advance('b')" title="+1 Đội B">
                        <svg class="car-svg" id="car-svg-b" viewBox="0 0 120 52" fill="none">
                            <ellipse cx="60" cy="46" rx="46" ry="5" fill="rgba(0,0,0,.4)"/>
                            <circle cx="28" cy="40" r="9" fill="#222"/>
                            <circle cx="28" cy="40" r="5" fill="#444"/>
                            <circle cx="88" cy="40" r="9" fill="#222"/>
                            <circle cx="88" cy="40" r="5" fill="#444"/>
                            <circle cx="26" cy="38" r="2" fill="rgba(255,255,255,.3)"/>
                            <circle cx="86" cy="38" r="2" fill="rgba(255,255,255,.3)"/>
                            <rect x="10" y="20" width="100" height="22" rx="6" fill="#0077b6"/>
                            <rect x="10" y="20" width="100" height="10" rx="6" fill="#0096c7"/>
                            <rect x="30" y="8" width="56" height="16" rx="6" fill="#005f8a"/>
                            <rect x="34" y="10" width="22" height="12" rx="4" fill="#90e0f5" opacity=".85"/>
                            <rect x="60" y="10" width="22" height="12" rx="4" fill="#90e0f5" opacity=".85"/>
                            <rect x="35" y="11" width="8" height="4" rx="2" fill="rgba(255,255,255,.5)"/>
                            <ellipse cx="112" cy="28" rx="5" ry="4" fill="#ffe066"/>
                            <ellipse cx="112" cy="28" rx="3" ry="2.5" fill="#fff"/>
                            <rect x="9" y="25" width="4" height="8" rx="2" fill="#ff1744"/>
                            <rect x="10" y="28" width="100" height="3" rx="1.5" fill="rgba(255,255,255,.25)"/>
                            <text x="58" y="35" text-anchor="middle" font-family="Itim,sans-serif" font-size="11"
                                  fill="#fff">B
                            </text>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="finish"></div>
        </div>
    </div>

    <div class="progress-wrap">
        <div class="prog-row">
            <span class="prog-label">🚗 Đội A</span>
            <div class="prog-bar">
                <div class="prog-fill a" id="prog-a" style="width:0%"></div>
            </div>
            <span class="prog-val" id="pval-a">0/{{ $game->questions->count() }}</span>
        </div>
        <div class="prog-row">
            <span class="prog-label">🚙 Đội B</span>
            <div class="prog-bar">
                <div class="prog-fill b" id="prog-b" style="width:0%"></div>
            </div>
            <span class="prog-val" id="pval-b">0/{{ $game->questions->count() }}</span>
        </div>
    </div>

    <div class="controls">
        <button class="btn btn-a" id="btn-a" onclick="advance('a')">🚗 +1 Đội A</button>
        <button class="btn btn-next" id="btn-next" onclick="nextQuestion()">▶ Câu tiếp theo</button>
        <button class="btn btn-b" id="btn-b" onclick="advance('b')">🚙 +1 Đội B</button>
    </div>

    <div class="question-card" id="question-card"></div>
</div>

<script>
    // ── DATA ─────────────────────────────────────────
    const QUESTIONS = @json($game->questions);
    const TOTAL = QUESTIONS.length;
    let state = {posA: 0, posB: 0, qIdx: 0, gameOver: false, started: false};

    // ── CANVAS ROAD ───────────────────────────────────
    const canvas = document.getElementById('road-canvas');
    const ctx = canvas.getContext('2d');
    let roadOffset = 0, roadTargetSpeed = 2, roadCurrentSpeed = 2;
    const DL = 32, GL = 22, DC = DL + GL;

    function resizeCanvas() {
        canvas.width = canvas.offsetWidth * devicePixelRatio;
        canvas.height = canvas.offsetHeight * devicePixelRatio;
        ctx.scale(devicePixelRatio, devicePixelRatio);
    }

    function drawRoad() {
        const W = canvas.offsetWidth, H = canvas.offsetHeight;
        ctx.clearRect(0, 0, W, H);
        ctx.fillStyle = 'rgba(0,0,0,0.12)';
        ctx.fillRect(0, 0, W, H / 2);
        ctx.strokeStyle = 'rgba(255,255,255,0.032)';
        ctx.lineWidth = 1;
        const gp = roadOffset % 14;
        for (let x = -gp; x < W + 14; x += 14) {
            ctx.beginPath();
            ctx.moveTo(x, 0);
            ctx.lineTo(x, H);
            ctx.stroke();
        }
        const dp = roadOffset % DC;
        ctx.save();
        ctx.translate(-dp, 0);
        ctx.strokeStyle = 'rgba(255,255,255,0.38)';
        ctx.lineWidth = 3;
        ctx.setLineDash([DL, GL]);
        ctx.lineDashOffset = 0;
        ctx.beginPath();
        ctx.moveTo(0, H / 2);
        ctx.lineTo(W + DC, H / 2);
        ctx.stroke();
        ctx.setLineDash([]);
        ctx.restore();
    }

    function roadLoop() {
        roadCurrentSpeed += (roadTargetSpeed - roadCurrentSpeed) * 0.08;
        roadOffset = (roadOffset + roadCurrentSpeed) % 999999;
        drawRoad();
        requestAnimationFrame(roadLoop);
    }

    function setRoadSpeed(fast) {
        roadTargetSpeed = fast ? 14 : 2;
    }

    // ── START SCREEN CANVAS ───────────────────────────
    const sc = document.getElementById('start-canvas');
    const sctx = sc.getContext('2d');
    let sOff = 0, startAnimId = null;

    function drawStart() {
        sc.width = sc.offsetWidth;
        sc.height = sc.offsetHeight;
        const W = sc.width, H = sc.height;
        sctx.clearRect(0, 0, W, H);
        sctx.fillStyle = '#232323';
        sctx.fillRect(0, H * .38, W, H * .24);
        sctx.fillStyle = '#c96820';
        sctx.fillRect(0, H * .38, W, 4);
        sctx.fillRect(0, H * .62 - 4, W, 4);
        const dp = sOff % DC;
        sctx.save();
        sctx.translate(-dp, 0);
        sctx.strokeStyle = 'rgba(255,255,255,.45)';
        sctx.lineWidth = 2;
        sctx.setLineDash([DL, GL]);
        sctx.beginPath();
        sctx.moveTo(0, H * .5);
        sctx.lineTo(W + DC, H * .5);
        sctx.stroke();
        sctx.setLineDash([]);
        sctx.restore();
        sOff = (sOff + 2.5) % 999999;
        startAnimId = requestAnimationFrame(drawStart);
    }

    function stopStartAnim() {
        if (startAnimId) {
            cancelAnimationFrame(startAnimId);
            startAnimId = null;
        }
    }

    // ── WEB AUDIO ────────────────────────────────────
    let ac = null;

    function getAC() {
        if (!ac) ac = new (window.AudioContext || window.webkitAudioContext)();
        if (ac.state === 'suspended') ac.resume();
        return ac;
    }

    // CROWD AMBIENT — multi-layer filtered noise (like stadium crowd)
    let crowdNodes = null;

    function startCrowd() {
        if (crowdNodes) return;
        const audio = new Audio('{{ asset("files/race.mp3") }}'); // 👈 đường dẫn file của bạn
        audio.loop = true;
        audio.volume = 0.4;
        audio.play();
        crowdNodes = {src: audio, master: null, lfo: null};
    }

    function stopCrowd() {
        if (!crowdNodes) return;
        crowdNodes.src.pause();
        crowdNodes.src.currentTime = 0;
        crowdNodes = null;
    }

    function fadeCrowdDown() {
        if (!crowdNodes?.master) return;
        console.log('fadeCrowdDown');
        crowdNodes.master.gain.cancelScheduledValues(ac.currentTime);
        crowdNodes.master.gain.setTargetAtTime(0.0001, ac.currentTime, 0.3);
    }

    function fadeCrowdUp() {
        if (!crowdNodes?.master) return;
        console.log('fadeCrowdUp');
        crowdNodes.master.gain.cancelScheduledValues(ac.currentTime);
        crowdNodes.master.gain.setTargetAtTime(0.4, ac.currentTime, 0.5);
    }

    // CROWD CHEER BURST (on score)
    function playCrowdBurst() {
        const a = getAC();
        const sr = a.sampleRate, dur = 0.8;
        const buf = a.createBuffer(2, sr * dur, sr);
        for (let ch = 0; ch < 2; ch++) {
            const d = buf.getChannelData(ch);
            for (let i = 0; i < d.length; i++) d[i] = Math.random() * 2 - 1;
        }
        const src = a.createBufferSource();
        src.buffer = buf;
        // two BP layers + HP for excitement
        const bp = a.createBiquadFilter();
        bp.type = 'bandpass';
        bp.frequency.value = 900;
        bp.Q.value = .85;
        const bp2 = a.createBiquadFilter();
        bp2.type = 'bandpass';
        bp2.frequency.value = 1800;
        bp2.Q.value = 1.2;
        const g = a.createGain();
        g.gain.setValueAtTime(0, a.currentTime);
        g.gain.linearRampToValueAtTime(.35, a.currentTime + .06);
        g.gain.exponentialRampToValueAtTime(.001, a.currentTime + .8);
        src.connect(bp);
        src.connect(bp2);
        bp.connect(g);
        bp2.connect(g);
        g.connect(a.destination);
        src.start();
    }

    // HORN/WHISTLE on score — replaces ugly sawtooth engine
    function playScoreHorn(team) {
        const a = getAC();
        // Punchy air horn: multi-osc chord swoop
        const freqs = team === 'a' ? [440, 554, 659] : [370, 466, 587];
        freqs.forEach((f, i) => {
            const osc = a.createOscillator(), g = a.createGain();
            osc.type = 'square';
            osc.frequency.setValueAtTime(f * 1.4, a.currentTime);
            osc.frequency.exponentialRampToValueAtTime(f, a.currentTime + 0.12);
            g.gain.setValueAtTime(0, a.currentTime);
            g.gain.linearRampToValueAtTime(.1 - i * .02, a.currentTime + .04);
            g.gain.exponentialRampToValueAtTime(.001, a.currentTime + .35);
            // Slight detune per voice
            const dist = a.createWaveShaper();
            const c = new Float32Array(64);
            for (let j = 0; j < 64; j++) {
                const x = j / 32 - 1;
                c[j] = x < 0 ? -Math.pow(-x, .7) : Math.pow(x, .7);
            }
            dist.curve = c;
            osc.connect(dist);
            dist.connect(g);
            g.connect(a.destination);
            osc.start();
            osc.stop(a.currentTime + .4);
        });
        // Sub thump
        const sub = a.createOscillator(), sg = a.createGain();
        sub.type = 'sine';
        sub.frequency.setValueAtTime(90, a.currentTime);
        sub.frequency.exponentialRampToValueAtTime(55, a.currentTime + .15);
        sg.gain.setValueAtTime(.18, a.currentTime);
        sg.gain.exponentialRampToValueAtTime(.001, a.currentTime + .22);
        sub.connect(sg);
        sg.connect(a.destination);
        sub.start();
        sub.stop(a.currentTime + .25);
    }

    // COUNTDOWN BEEPS
    function playBeep(freq, dur = .14) {
        const a = getAC();
        const osc = a.createOscillator(), g = a.createGain();
        osc.type = 'sine';
        osc.frequency.value = freq;
        g.gain.setValueAtTime(.28, a.currentTime);
        g.gain.exponentialRampToValueAtTime(.001, a.currentTime + dur);
        osc.connect(g);
        g.connect(a.destination);
        osc.start();
        osc.stop(a.currentTime + dur + .04);
    }

    function playGo() {
        const a = getAC();
        [523, 659, 784, 1047].forEach((f, i) => {
            const osc = a.createOscillator(), g = a.createGain();
            osc.type = 'triangle';
            osc.frequency.value = f;
            const t = a.currentTime + i * .05;
            g.gain.setValueAtTime(.18, t);
            g.gain.exponentialRampToValueAtTime(.001, t + .45);
            osc.connect(g);
            g.connect(a.destination);
            osc.start(t);
            osc.stop(t + .5);
        });
    }

    // NEXT QUESTION DING
    function playDing() {
        const a = getAC();
        [880, 1108].forEach((f, i) => {
            const osc = a.createOscillator(), g = a.createGain();
            osc.type = 'sine';
            osc.frequency.value = f;
            g.gain.setValueAtTime(.12, a.currentTime + i * .08);
            g.gain.exponentialRampToValueAtTime(.001, a.currentTime + i * .08 + .38);
            osc.connect(g);
            g.connect(a.destination);
            osc.start(a.currentTime + i * .08);
            osc.stop(a.currentTime + i * .08 + .42);
        });
    }

    // WIN FANFARE
    function playFanfare() {
        const a = getAC();
        const mel = [523, 523, 523, 659, 784, 784, 784, 1047];
        const ts = [0, .12, .24, .36, .5, .62, .74, .9];
        mel.forEach((f, i) => {
            const osc = a.createOscillator(), g = a.createGain();
            osc.type = 'triangle';
            osc.frequency.value = f;
            const t = a.currentTime + ts[i];
            g.gain.setValueAtTime(.2, t);
            g.gain.exponentialRampToValueAtTime(.001, t + .25);
            osc.connect(g);
            g.connect(a.destination);
            osc.start(t);
            osc.stop(t + .3);
        });
        setTimeout(playCrowdBurst, 200);
        setTimeout(playCrowdBurst, 500);
        setTimeout(playCrowdBurst, 850);
    }

    // ── COUNTDOWN ────────────────────────────────────
    function startCountdown() {
        getAC(); // unlock audio context on user gesture
        document.getElementById('start-screen').classList.add('hidden');
        stopStartAnim();
        const cs = document.getElementById('countdown-screen');
        const el = document.getElementById('countdown-el');
        cs.classList.remove('hidden');
        let count = 3;

        function tick() {
            el.className = 'countdown-num';
            el.textContent = count;
            void el.offsetWidth; // reflow restart animation
            el.className = 'countdown-num';
            playBeep(count === 1 ? 880 : 440);
            if (count > 1) {
                count--;
                setTimeout(tick, 900);
            } else {
                setTimeout(() => {
                    el.className = 'countdown-go';
                    el.textContent = 'GO!';
                    void el.offsetWidth;
                    el.className = 'countdown-go';
                    playGo();
                    setTimeout(() => {
                        cs.classList.add('hidden');
                        launchGame();
                    }, 750);
                }, 900);
            }
        }

        tick();
    }

    function launchGame() {
        state.started = true;
        startCrowd();
        setRoadSpeed(false);
        renderQuestion();
        updateProgress();
    }

    // ── STARS ────────────────────────────────────────
    const sky = document.getElementById('sky');
    for (let i = 0; i < 18; i++) {
        const s = document.createElement('div');
        s.className = 'star';
        s.style.cssText = `width:${1 + Math.random() * 2}px;height:${1 + Math.random() * 2}px;left:${Math.random() * 98}%;top:${4 + Math.random() * 70}%;animation-delay:${Math.random() * 2}s;animation-duration:${1.5 + Math.random() * 2}s`;
        sky.appendChild(s);
    }

    // ── SPEED LINES ──────────────────────────────────
    function buildSpeedLines(el) {
        for (let i = 0; i < 6; i++) {
            const l = document.createElement('div');
            l.className = 'speed-line';
            l.style.cssText = `top:${10 + i * 14}%;width:${60 + Math.random() * 30}%;animation-delay:${Math.random() * .25}s;animation-duration:${.14 + Math.random() * .13}s`;
            el.appendChild(l);
        }
    }

    buildSpeedLines(document.getElementById('speed-a'));
    buildSpeedLines(document.getElementById('speed-b'));

    // ── START PARTICLES ──────────────────────────────
    for (let i = 0; i < 16; i++) {
        const p = document.createElement('div');
        p.className = 'start-particle';
        const sz = 3 + Math.random() * 5, hue = Math.random() < .5 ? 20 : 200;
        p.style.cssText = `width:${sz}px;height:${sz}px;background:hsl(${hue},80%,65%);left:${Math.random() * 100}%;top:${75 + Math.random() * 25}%;animation-duration:${4 + Math.random() * 5}s;animation-delay:${Math.random() * 4}s`;
        document.getElementById('start-screen').appendChild(p);
    }

    // ── DUST ─────────────────────────────────────────
    function spawnDust(team) {
        const c = document.getElementById('dust-' + team);
        c.innerHTML = '';
        for (let i = 0; i < 5; i++) {
            const p = document.createElement('div');
            p.className = 'dust-p';
            p.style.cssText = `left:${-4 - Math.random() * 8}px;top:${8 + Math.random() * 16}px;animation-delay:${i * .05}s;width:${4 + Math.random() * 6}px;height:${4 + Math.random() * 6}px`;
            c.appendChild(p);
            setTimeout(() => p.remove(), 700);
        }
    }

    // ── CAR POS ──────────────────────────────────────
    function getCarLeft(pos) {
        const tw = document.getElementById('road').offsetWidth - 26 - 80;
        return Math.min(pos / TOTAL * tw, tw);
    }

    function updateCarPos(team) {
        document.getElementById('car-wrap-' + team).style.left = getCarLeft(team === 'a' ? state.posA : state.posB) + 'px';
    }

    // ── ADVANCE ──────────────────────────────────────
    function advance(team) {
        if (state.gameOver || !state.started) return;
        if ((team === 'a' ? state.posA : state.posB) >= TOTAL) return;
        if (team === 'a') state.posA = Math.min(state.posA + 1, TOTAL);
        else state.posB = Math.min(state.posB + 1, TOTAL);

        const svg = document.getElementById('car-svg-' + team);
        svg.classList.add('turbo');
        setTimeout(() => svg.classList.remove('turbo'), 500);
        const sl = document.getElementById('speed-' + team);
        sl.classList.add('active');
        setTimeout(() => sl.classList.remove('active'), 500);
        setRoadSpeed(true);
        setTimeout(() => setRoadSpeed(false), 650);
        spawnDust(team);
        showToast(team);
        playScoreHorn(team);
        setTimeout(() => playCrowdBurst(), 80);
        updateCarPos(team);
        updateProgress();

        if (state.posA >= TOTAL || state.posB >= TOTAL) {
            state.gameOver = true;
            stopCrowd();
            setTimeout(() => {
                playFanfare();
                showWinner();
            }, 700);
        }
    }

    // ── TOAST ────────────────────────────────────────
    function showToast(team) {
        const btn = document.getElementById('btn-' + team);
        const r = btn.getBoundingClientRect();
        const t = document.createElement('div');
        t.className = 'float-toast';
        t.textContent = '+1';
        t.style.cssText = `left:${r.left + r.width / 2 - 20}px;top:${r.top - 10}px;color:${team === 'a' ? '#ff6b35' : '#00b4d8'}`;
        document.body.appendChild(t);
        setTimeout(() => t.remove(), 950);
    }

    // ── PROGRESS ─────────────────────────────────────
    function updateProgress() {
        document.getElementById('prog-a').style.width = (state.posA / TOTAL * 100) + '%';
        document.getElementById('prog-b').style.width = (state.posB / TOTAL * 100) + '%';
        document.getElementById('pval-a').textContent = state.posA + '/{{ $game->questions->count() }}';
        document.getElementById('pval-b').textContent = state.posB + '/{{ $game->questions->count() }}';
        document.getElementById('score-a').textContent = state.posA;
        document.getElementById('score-b').textContent = state.posB;
    }

    // ── QUESTION ─────────────────────────────────────
    function renderQuestion() {
        const q = QUESTIONS[state.qIdx % QUESTIONS.length];
        let lbl = 'Câu hỏi', cls = 'text-only';
        if (q.image_url && q.audio_url) {
            lbl = '🖼️ 🔊 Hình + Âm';
            cls = 'has-img';
        } else if (q.image_url) {
            lbl = '🖼️ Có hình ảnh';
            cls = 'has-img';
        } else if (q.audio_url) {
            lbl = '🔊 Có âm thanh';
            cls = 'has-audio';
        }
        let media = '';
        if (q.image_url) media += `<div class="q-media"><img src="{{ asset('storage/') }}/${q.image_url}" alt="" loading="lazy"/></div>`;
        if (q.audio_url) media += `<div class="q-audio-box"><span class="q-audio-icon">🎵</span><span class="q-audio-label">Nghe đoạn âm thanh</span><audio controls src="{{ asset('storage/') }}/${q.audio_url}" preload="none" style="flex:2;min-width:0"></audio></div>`;
        document.getElementById('question-card').innerHTML = `
        <div class="q-meta">
          <span class="q-num">Câu ${state.qIdx + 1} / ${QUESTIONS.length}</span>
          <span class="q-type-badge ${cls}">${lbl}</span>
        </div>${media}
        <div class="q-text">${q.question}</div>
        <div class="q-hint">${q.hint}</div>`;

        // Gắn event cho audio player trong câu hỏi
        const audioEl = document.getElementById('question-card').querySelector('audio');
        if (audioEl) {
            audioEl.addEventListener('play',  fadeCrowdDown);
            audioEl.addEventListener('pause', fadeCrowdUp);
            audioEl.addEventListener('ended', fadeCrowdUp);
        }
    }

    // ── NEXT Q ───────────────────────────────────────
    function nextQuestion() {
        if (state.gameOver || !state.started) return;
        state.qIdx++;
        renderQuestion();
        playDing();
        setRoadSpeed(true);
        setTimeout(() => setRoadSpeed(false), 450);
    }

    // ── WINNER ───────────────────────────────────────
    function showWinner() {
        const w = state.posA >= TOTAL ? 'a' : 'b';
        const ov = document.createElement('div');
        ov.className = 'winner-overlay';
        ov.innerHTML = `<div class="winner-box ${w}"><div class="confetti-strip"></div><div class="winner-trophy">🏆</div><div class="winner-title ${w}">${w === 'a' ? '🚗 Đội A' : '🚙 Đội B'}</div><p class="winner-sub">Về đích sau ${state.qIdx + 1} câu hỏi!</p><button class="btn-reset" onclick="resetGame()">🔄 Chơi lại</button></div>`;
        document.body.appendChild(ov);
    }

    // ── RESET ────────────────────────────────────────
    function resetGame() {
        state = {posA: 0, posB: 0, qIdx: 0, gameOver: false, started: false};
        document.querySelector('.winner-overlay')?.remove();
        stopCrowd();
        updateProgress();
        updateCarPos('a');
        updateCarPos('b');
        setRoadSpeed(false);
        renderQuestion();
        sOff = 0;
        document.getElementById('start-screen').classList.remove('hidden');
        drawStart();
    }

    // ── INIT ─────────────────────────────────────────
    window.addEventListener('resize', () => {
        resizeCanvas();
        updateCarPos('a');
        updateCarPos('b');
    });
    resizeCanvas();
    roadLoop();
    renderQuestion();
    updateProgress();
    drawStart();
</script>
</body>
</html>
