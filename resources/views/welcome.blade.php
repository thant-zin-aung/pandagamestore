<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PandaGameStore — Game Top-Ups, Skins & Gift Cards Marketplace</title>
    <meta name="description" content="PandaGameStore — instant game top-ups, skins, accounts & gift cards (iTunes, Xbox, Steam, PSN, Google Play). Secure payments, 24/7 delivery, best prices in Asia.">
    <meta name="theme-color" content="#0b0a14">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Professional pairing: Space Grotesk (display) + Inter (body) --}}
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Space Grotesk"', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        ink:     '#0b0a14',   /* deep near-black with violet tint */
                        coal:    '#12101e',
                        slate2:  '#1a1828',
                        line:    '#262338',
                        violet1: '#8b5cf6',   /* primary violet */
                        violet2: '#a78bfa',   /* light violet */
                        violet3: '#6d4ddb',   /* deep violet */
                        plum:    '#1d1633',
                        muted:   '#8b87a3',
                        ice:     '#ece9f7',
                    }
                }
            }
        }
    </script>

    <style>
        :root{
            --ink:#0b0a14; --coal:#12101e; --slate:#1a1828; --line:#262338;
            --violet1:#8b5cf6; --violet2:#a78bfa; --violet3:#6d4ddb; --plum:#1d1633;
            --muted:#8b87a3; --ice:#ece9f7;
        }
        *{ -webkit-tap-highlight-color:transparent; }
        html,body{ background:var(--ink); }
        body{
            font-family:'Inter',sans-serif; color:var(--ice);
            font-feature-settings: "ss01","cv11";
            background:
                radial-gradient(900px 600px at 85% -10%, rgba(139,92,246,0.18), transparent 60%),
                radial-gradient(700px 500px at -10% 20%, rgba(109,77,219,0.14), transparent 65%),
                var(--ink);
            overflow-x:hidden;
        }
        .font-display{ font-family:'Space Grotesk',sans-serif; letter-spacing:-0.01em; }

        /* Subtle dot grid */
        .dot-grid::before{
            content:''; position:fixed; inset:0; pointer-events:none; z-index:0; opacity:.45;
            background-image: radial-gradient(rgba(139,92,246,0.10) 1px, transparent 1px);
            background-size: 28px 28px;
            mask-image: radial-gradient(circle at 50% 30%, #000 0%, transparent 70%);
        }

        /* Cards */
        .card{
            background:linear-gradient(180deg, rgba(26,24,40,0.85), rgba(18,16,30,0.85));
            border:1px solid var(--line); border-radius:12px;
            backdrop-filter: blur(8px);
        }
        .card-hover{ transition:transform .25s ease, border-color .25s ease, box-shadow .25s ease; }
        .card-hover:hover{
            transform:translateY(-2px);
            border-color:rgba(139,92,246,0.5);
            box-shadow:0 12px 36px -16px rgba(139,92,246,0.45);
        }

        /* Buttons */
        .btn{
            display:inline-flex; align-items:center; gap:.5rem; justify-content:center;
            padding:.7rem 1.1rem; border-radius:9px; font-weight:600; font-size:.875rem;
            transition:all .2s ease; border:1px solid transparent; white-space:nowrap;
            font-family:'Inter',sans-serif;
        }
        .btn-primary{
            background:linear-gradient(135deg, var(--violet1), var(--violet3));
            color:#fff; box-shadow:0 8px 24px -10px rgba(139,92,246,0.6);
        }
        .btn-primary:hover{ filter:brightness(1.08); transform:translateY(-1px); }
        .btn-ghost{
            background:rgba(255,255,255,0.03); border-color:var(--line); color:var(--ice);
        }
        .btn-ghost:hover{ border-color:var(--violet1); color:var(--violet2); }
        .btn-sm{ padding:.45rem .8rem; font-size:.75rem; }

        /* Chip */
        .chip{
            display:inline-flex; align-items:center; gap:.35rem;
            padding:.22rem .55rem; border-radius:999px; font-size:.7rem; font-weight:600;
            background:rgba(139,92,246,0.12); color:var(--violet2);
            border:1px solid rgba(139,92,246,0.3);
        }
        .chip-soft{ background:rgba(255,255,255,0.04); color:var(--muted); border-color:var(--line); }

        /* Section eyebrow */
        .eyebrow{
            display:inline-flex; align-items:center; gap:.55rem;
            color:var(--violet2); font-family:'Space Grotesk',sans-serif;
            font-size:.7rem; letter-spacing:.22em; text-transform:uppercase; font-weight:600;
        }
        .eyebrow::before{ content:''; width:22px; height:1px; background:var(--violet1); }

        /* Panda logo ring */
        .panda-ring{
            background:radial-gradient(circle at 30% 30%, #2a1f4a 0%, #160e2a 60%, #0b0a14 100%);
            box-shadow: inset 0 0 0 1px rgba(139,92,246,0.45);
        }

        /* Marquee */
        .ticker{ overflow:hidden; }
        .ticker-track{
            display:flex; gap:3rem; white-space:nowrap; width:max-content;
            animation: marquee 45s linear infinite;
        }
        @keyframes marquee{ from{transform:translateX(0)} to{transform:translateX(-50%)} }

        .orb{ position:absolute; border-radius:50%; filter:blur(70px); pointer-events:none; }

        /* Game tile */
        .game-tile{
            position:relative; overflow:hidden; border-radius:12px;
            aspect-ratio: 3/4; border:1px solid var(--line);
            background:linear-gradient(180deg, #1a1530, #12101e);
            transition:transform .3s ease, border-color .3s ease;
        }
        .game-tile:hover{ transform:translateY(-3px); border-color:rgba(139,92,246,0.55); }
        .game-tile .badge{ position:absolute; top:10px; left:10px; z-index:3; }
        .game-tile .meta{
            position:absolute; bottom:0; left:0; right:0; z-index:3; padding:.85rem;
            background:linear-gradient(180deg, transparent, rgba(11,10,20,0.95));
        }
        .game-tile .art{ position:absolute; inset:0; display:grid; place-items:center; }

        /* Gift card */
        .gift{
            position:relative; padding:1.1rem; border-radius:12px;
            border:1px solid var(--line); overflow:hidden;
            background:linear-gradient(135deg, #1a1530, #12101e);
            transition:transform .25s, border-color .25s;
            min-height:148px; display:flex; flex-direction:column; justify-content:space-between;
        }
        .gift::before{
            content:''; position:absolute; top:-50%; right:-30%; width:220px; height:220px;
            background:var(--violet1); opacity:.12; filter:blur(50px); border-radius:50%;
        }
        .gift:hover{ transform:translateY(-3px); border-color:rgba(139,92,246,0.55); }
        .gift .logo{
            width:42px; height:42px; border-radius:10px; display:grid; place-items:center;
            background:rgba(255,255,255,0.05); border:1px solid var(--line); color:#fff;
        }

        /* Drawer */
        .overlay{
            position:fixed; inset:0; background:rgba(11,10,20,0.78); backdrop-filter:blur(6px);
            z-index:80; opacity:0; pointer-events:none; transition:opacity .25s;
        }
        .overlay.open{ opacity:1; pointer-events:auto; }
        .drawer{
            position:fixed; top:0; bottom:0; width:min(420px,92vw); z-index:90;
            background:linear-gradient(180deg, #12101e, #0b0a14);
            border-left:1px solid var(--line);
            transform:translateX(100%); transition:transform .3s ease;
            display:flex; flex-direction:column;
        }
        .drawer.left{ left:0; right:auto; border-left:0; border-right:1px solid var(--line); transform:translateX(-100%); }
        .drawer.right{ right:0; }
        .drawer.open{ transform:translateX(0); }

        /* Toast */
        .toast{
            position:fixed; bottom:24px; left:50%; transform:translateX(-50%) translateY(120%);
            z-index:120; transition:transform .35s ease; min-width:280px;
        }
        .toast.show{ transform:translateX(-50%) translateY(0); }

        /* Stars */
        .star{ color:#c4b5fd; letter-spacing:1px; }

        .pulse::after{
            content:''; position:absolute; inset:-4px; border-radius:50%;
            border:2px solid rgba(139,92,246,0.5); animation:pulseRing 2.2s ease-out infinite;
        }
        @keyframes pulseRing{ 0%{transform:scale(.9); opacity:1} 100%{transform:scale(1.6); opacity:0} }

        .reveal{ opacity:0; transform:translateY(12px); transition:all .55s ease; }
        .reveal.in{ opacity:1; transform:none; }

        /* Tidy scrollbars in drawer */
        .drawer ::-webkit-scrollbar{ width:6px } .drawer ::-webkit-scrollbar-thumb{ background:var(--line); border-radius:3px }
    </style>
</head>

<body class="dot-grid">

{{-- ============== TICKER ============== --}}
<div class="relative z-50 border-b border-line bg-coal/85 backdrop-blur">
    <div class="ticker py-2">
        <div class="ticker-track text-[11px] font-display tracking-[0.18em] text-muted uppercase">
            @php
                $tickerItems = [
                    'Welcome to PandaGameStore — Asia’s trusted game marketplace',
                    'Flash Sale · 15% off MLBB Diamonds — ends tonight',
                    'Buy any 3 gift cards · get 10% cashback',
                    'Instant delivery on Genshin, Honkai & ZZZ top-ups',
                    'Escrow-protected payments on every order',
                    'Trusted by 250,000+ gamers worldwide',
                ];
                $loop = array_merge($tickerItems, $tickerItems);
            @endphp
            @foreach($loop as $t)<span>{{ $t }}</span>@endforeach
        </div>
    </div>
</div>

{{-- ============== NAVBAR ============== --}}
<nav class="sticky top-0 z-40 backdrop-blur-xl bg-ink/85 border-b border-line">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-[68px] gap-4">
            <div class="flex items-center gap-3">
                <button id="mobileMenuBtn" class="lg:hidden p-2 text-muted hover:text-violet2 transition">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>

                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl panda-ring grid place-items-center">
                        <svg viewBox="0 0 64 64" class="w-6 h-6" fill="none">
                            <circle cx="32" cy="34" r="20" fill="#ece9f7"/>
                            <ellipse cx="16" cy="20" rx="8" ry="9" fill="#0b0a14"/>
                            <ellipse cx="48" cy="20" rx="8" ry="9" fill="#0b0a14"/>
                            <ellipse cx="22" cy="34" rx="5" ry="6" fill="#0b0a14"/>
                            <ellipse cx="42" cy="34" rx="5" ry="6" fill="#0b0a14"/>
                            <circle cx="22" cy="34" r="1.8" fill="#a78bfa"/>
                            <circle cx="42" cy="34" r="1.8" fill="#a78bfa"/>
                            <ellipse cx="32" cy="43" rx="2.8" ry="2" fill="#0b0a14"/>
                            <path d="M28 47c2 2 6 2 8 0" stroke="#0b0a14" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="leading-tight hidden sm:block">
                        <div class="font-display font-bold text-[17px] tracking-tight">
                            PandaGame<span class="text-violet2">Store</span>
                        </div>
                        <div class="text-[10px] text-muted tracking-[0.18em] uppercase">Game Items · Top-ups · Gift Cards</div>
                    </div>
                </a>
            </div>

            {{-- Search (desktop) --}}
            <div class="hidden md:flex flex-1 max-w-md">
                <div class="relative w-full">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted"></i>
                    <input type="text" placeholder="Search games, top-ups, gift cards…"
                        class="w-full bg-coal border border-line text-sm pl-9 pr-3 py-2.5 rounded-lg placeholder-muted focus:outline-none focus:border-violet1 transition">
                </div>
            </div>

            {{-- Nav links --}}
            <div class="hidden xl:flex items-center gap-6 text-[13px] font-medium tracking-wide">
                <a href="#games" class="text-ice/80 hover:text-violet2 transition">Games</a>
                <a href="#topups" class="text-ice/80 hover:text-violet2 transition">Top-ups</a>
                <a href="#giftcards" class="text-ice/80 hover:text-violet2 transition">Gift Cards</a>
                <a href="#how" class="text-ice/80 hover:text-violet2 transition">How it works</a>
                <a href="#reviews" class="text-ice/80 hover:text-violet2 transition">Reviews</a>
            </div>

            <div class="flex items-center gap-1.5 sm:gap-2">
                <button id="searchBtn" class="md:hidden p-2 text-muted hover:text-violet2 transition">
                    <i data-lucide="search" class="w-5 h-5"></i>
                </button>
                <button class="relative p-2 text-muted hover:text-violet2 transition hidden sm:inline-flex">
                    <i data-lucide="heart" class="w-5 h-5"></i>
                </button>
                <button id="cartBtn" class="relative p-2 text-muted hover:text-violet2 transition">
                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                    <span id="cartCount" class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] px-1 bg-violet1 text-white text-[10px] font-bold rounded-full grid place-items-center">0</span>
                </button>
                <a href="{{ url('/login') }}" class="hidden sm:inline-flex btn btn-ghost btn-sm">
                    <i data-lucide="user-round" class="w-3.5 h-3.5"></i> Sign In
                </a>
                <a href="{{ url('/register') }}" class="hidden lg:inline-flex btn btn-primary btn-sm">Join Free</a>
            </div>
        </div>
    </div>
</nav>

{{-- ============== HERO ============== --}}
<section class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 sm:pt-16 pb-8">
    <div class="orb bg-violet1" style="width:360px;height:360px;top:-40px;right:-40px;opacity:.35;"></div>
    <div class="orb bg-violet3" style="width:280px;height:280px;bottom:-60px;left:15%;opacity:.25;"></div>

    <div class="grid lg:grid-cols-12 gap-10 items-center relative">
        <div class="lg:col-span-7 reveal">
            <div class="eyebrow mb-4">Asia’s Trusted Game Marketplace</div>
            <h1 class="font-display font-bold text-[36px] sm:text-5xl lg:text-[58px] leading-[1.05] tracking-tight">
                Power up your game.<br>
                <span class="bg-gradient-to-r from-violet2 to-violet1 bg-clip-text text-transparent">Top-ups, skins &amp; gift cards</span><br>
                delivered in seconds.
            </h1>
            <p class="mt-5 text-muted max-w-xl text-[15px] leading-relaxed">
                Diamonds, UC, Genesis Crystals and more — alongside iTunes, Xbox, Steam, PSN
                and Google Play gift cards. Secure checkout, 24/7 support, and the best prices in the region.
            </p>

            <div class="mt-7 flex flex-wrap gap-3">
                <a href="#games" class="btn btn-primary">
                    <i data-lucide="zap" class="w-4 h-4"></i> Shop Top-ups
                </a>
                <a href="#giftcards" class="btn btn-ghost">
                    <i data-lucide="gift" class="w-4 h-4"></i> Browse Gift Cards
                </a>
            </div>

            <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-3">
                @php
                    $stats = [
                        ['250K+', 'Happy Gamers'],
                        ['1.2M+', 'Orders Delivered'],
                        ['4.9 / 5', 'Average Rating'],
                        ['< 60s', 'Avg. Delivery'],
                    ];
                @endphp
                @foreach($stats as [$v,$l])
                <div class="card p-3.5">
                    <div class="font-display text-xl text-ice">{{ $v }}</div>
                    <div class="text-[11px] text-muted uppercase tracking-[0.14em] mt-0.5">{{ $l }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Featured Deal --}}
        <div class="lg:col-span-5 reveal">
            <div class="card p-6 relative overflow-hidden">
                <div class="orb bg-violet1" style="width:240px;height:240px;top:-100px;right:-80px;opacity:.25;"></div>
                <div class="flex items-center justify-between mb-5 relative z-10">
                    <span class="chip"><i data-lucide="flame" class="w-3 h-3"></i> Flash Deal</span>
                    <span class="text-[10px] text-muted font-display tracking-[0.2em] uppercase">Ends In</span>
                </div>
                <div class="flex items-center gap-4 mb-5 relative z-10">
                    <div class="w-14 h-14 rounded-xl bg-plum grid place-items-center border border-violet1/40">
                        <i data-lucide="gem" class="w-7 h-7 text-violet2"></i>
                    </div>
                    <div>
                        <div class="font-display text-lg">1,000 MLBB Diamonds</div>
                        <div class="text-xs text-muted mt-0.5">Mobile Legends: Bang Bang</div>
                    </div>
                </div>
                <div class="flex items-end gap-3 mb-5 relative z-10">
                    <div class="font-display text-3xl text-ice">$17.49</div>
                    <div class="text-muted line-through text-sm mb-1">$20.99</div>
                    <span class="chip ml-auto">−15%</span>
                </div>
                <div class="grid grid-cols-4 gap-2 mb-5 relative z-10" id="countdown">
                    @foreach(['Days'=>'cd-d', 'Hours'=>'cd-h', 'Min'=>'cd-m', 'Sec'=>'cd-s'] as $label=>$id)
                    <div class="bg-coal border border-line rounded-lg p-2 text-center">
                        <div id="{{ $id }}" class="font-display text-lg text-ice">00</div>
                        <div class="text-[10px] text-muted uppercase tracking-[0.14em]">{{ $label }}</div>
                    </div>
                    @endforeach
                </div>
                <button class="btn btn-primary w-full relative z-10 add-to-cart" data-name="MLBB 1000 Diamonds" data-price="17.49">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i> Add to Cart — $17.49
                </button>
                <div class="mt-3 flex items-center justify-center gap-4 text-[11px] text-muted relative z-10">
                    <span class="flex items-center gap-1"><i data-lucide="shield-check" class="w-3 h-3 text-violet2"></i> Secure</span>
                    <span class="flex items-center gap-1"><i data-lucide="zap" class="w-3 h-3 text-violet2"></i> Instant</span>
                    <span class="flex items-center gap-1"><i data-lucide="refresh-ccw" class="w-3 h-3 text-violet2"></i> Refundable</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============== CATEGORY STRIP ============== --}}
<section class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
    @php
        $cats = [
            ['Mobile Games','smartphone'],
            ['PC Games','monitor'],
            ['Console','gamepad-2'],
            ['Gift Cards','gift'],
            ['Accounts','user-round'],
            ['Subscriptions','crown'],
        ];
    @endphp
    <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
        @foreach($cats as [$name,$icon])
        <a href="#games" class="card card-hover p-4 text-center group">
            <div class="w-10 h-10 mx-auto rounded-lg grid place-items-center mb-2 bg-plum border border-line">
                <i data-lucide="{{ $icon }}" class="w-5 h-5 text-violet2"></i>
            </div>
            <div class="text-[12px] font-medium text-ice/85 group-hover:text-violet2 transition">{{ $name }}</div>
        </a>
        @endforeach
    </div>
</section>

{{-- ============== TRENDING GAMES ============== --}}
<section id="games" class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-20">
    <div class="flex items-end justify-between mb-6">
        <div>
            <div class="eyebrow mb-2">Trending Now</div>
            <h2 class="font-display font-bold text-2xl sm:text-3xl tracking-tight">Popular Game Top-ups</h2>
        </div>
        <a href="#" class="hidden sm:inline-flex btn btn-ghost btn-sm">View all <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i></a>
    </div>

    @php
        $games = [
            ['Mobile Legends','MOBA · Mobile','from $1.49','Hot','gamepad-2'],
            ['PUBG Mobile','Battle Royale','from $0.99','−10%','target'],
            ['Genshin Impact','RPG · Open World','from $4.99','New','sparkles'],
            ['Free Fire','Battle Royale','from $0.79','Hot','flame'],
            ['Valorant','FPS · PC','from $4.99','−5%','crosshair'],
            ['Honkai: Star Rail','Turn-based RPG','from $4.99','New','star'],
            ['Call of Duty Mobile','FPS · Mobile','from $1.99','Hot','swords'],
            ['Roblox','Sandbox','from $4.99','Top','blocks'],
            ['Clash of Clans','Strategy','from $0.99','−15%','shield'],
            ['Zenless Zone Zero','Action RPG','from $4.99','New','zap'],
        ];
    @endphp
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
        @foreach($games as [$name,$cat,$price,$tag,$icon])
        <div class="game-tile group">
            <div class="art" style="background:radial-gradient(circle at 50% 30%, #2a1f4a, #12101e 75%);">
                <div class="w-20 h-20 rounded-2xl grid place-items-center bg-plum border border-violet1/30">
                    <i data-lucide="{{ $icon }}" class="w-9 h-9 text-violet2"></i>
                </div>
            </div>
            <span class="badge chip">{{ $tag }}</span>
            <div class="meta">
                <div class="font-display text-sm sm:text-base font-semibold leading-tight">{{ $name }}</div>
                <div class="text-[11px] text-muted mt-0.5">{{ $cat }}</div>
                <div class="mt-2 flex items-center justify-between">
                    <span class="text-violet2 text-xs font-semibold">{{ $price }}</span>
                    <button class="w-7 h-7 rounded-lg bg-violet1/15 hover:bg-violet1 hover:text-white text-violet2 grid place-items-center transition add-to-cart"
                        data-name="{{ $name }} Top-up" data-price="4.99">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ============== TOP-UP DENOMINATIONS ============== --}}
<section id="topups" class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-20">
    <div class="flex items-end justify-between mb-6 gap-4 flex-wrap">
        <div>
            <div class="eyebrow mb-2">Quick Top-up</div>
            <h2 class="font-display font-bold text-2xl sm:text-3xl tracking-tight">MLBB Diamond Packages</h2>
        </div>
        <select class="bg-coal border border-line rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-violet1">
            <option>Mobile Legends</option>
            <option>PUBG Mobile</option>
            <option>Genshin Impact</option>
            <option>Free Fire</option>
            <option>Valorant</option>
        </select>
    </div>

    @php
        $packs = [
            ['86 Diamonds', '$1.49', '$1.69', false],
            ['172 Diamonds', '$2.99', '$3.39', false],
            ['257 Diamonds', '$4.49', null, false],
            ['344 + 11 Bonus', '$5.99', '$6.59', true],
            ['706 + 35 Bonus', '$11.99', null, false],
            ['1412 + 141 Bonus', '$23.99', '$26.99', true],
            ['2195 + 274 Bonus', '$36.99', null, false],
            ['3688 + 553 Bonus', '$61.99', '$69.99', true],
        ];
    @endphp
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
        @foreach($packs as [$name,$price,$old,$hot])
        <div class="card card-hover p-4 relative">
            @if($hot)<span class="chip absolute top-3 right-3"><i data-lucide="flame" class="w-3 h-3"></i> Best Value</span>@endif
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-plum grid place-items-center border border-violet1/30">
                    <i data-lucide="gem" class="w-5 h-5 text-violet2"></i>
                </div>
                <div class="text-sm font-semibold leading-tight">{{ $name }}</div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="font-display text-xl text-ice">{{ $price }}</span>
                @if($old)<span class="text-xs text-muted line-through">{{ $old }}</span>@endif
            </div>
            <button class="mt-3 w-full btn btn-ghost btn-sm add-to-cart" data-name="MLBB {{ $name }}" data-price="{{ trim($price,'$') }}">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Add to Cart
            </button>
        </div>
        @endforeach
    </div>
</section>

{{-- ============== GIFT CARDS ============== --}}
<section id="giftcards" class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-20">
    <div class="flex items-end justify-between mb-6 gap-4 flex-wrap">
        <div>
            <div class="eyebrow mb-2">Gift Cards</div>
            <h2 class="font-display font-bold text-2xl sm:text-3xl tracking-tight">Digital Gift Cards — Instant Codes</h2>
            <p class="text-muted text-sm mt-2 max-w-2xl">Buy and redeem in seconds. Multiple regions and denominations supported.</p>
        </div>
        <a href="#" class="hidden sm:inline-flex btn btn-ghost btn-sm">All brands <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i></a>
    </div>

    @php
        $giftcards = [
            ['iTunes', 'apple', 'Apple App Store & iTunes', '$10 – $500'],
            ['Xbox', 'gamepad-2', 'Xbox Live & Game Pass', '$10 – $200'],
            ['Steam', 'monitor', 'PC Games Wallet', '$5 – $500'],
            ['PlayStation', 'gamepad', 'PSN Wallet · All Regions', '$10 – $250'],
            ['Google Play', 'play', 'Apps, Games & In-app', '$10 – $200'],
            ['Amazon', 'shopping-bag', 'Amazon Shopping', '$10 – $500'],
            ['Netflix', 'film', 'Streaming Subscription', '$15 – $100'],
            ['Spotify', 'music', 'Music Premium', '$10 – $60'],
        ];
    @endphp
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
        @foreach($giftcards as [$brand,$icon,$desc,$range])
        <a href="#" class="gift">
            <div class="flex items-center gap-3 relative z-10">
                <div class="logo text-violet2">
                    <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
                </div>
                <div>
                    <div class="font-display text-base font-semibold">{{ $brand }}</div>
                    <div class="text-[11px] text-muted">{{ $desc }}</div>
                </div>
            </div>
            <div class="relative z-10 flex items-center justify-between mt-4">
                <span class="text-xs text-violet2 font-semibold">{{ $range }}</span>
                <span class="text-[11px] text-muted flex items-center gap-1">
                    <i data-lucide="zap" class="w-3 h-3"></i> Instant
                </span>
            </div>
        </a>
        @endforeach
    </div>
</section>

{{-- ============== HOW IT WORKS ============== --}}
<section id="how" class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-24">
    <div class="text-center mb-10">
        <div class="eyebrow justify-center mb-3" style="display:inline-flex;">How It Works</div>
        <h2 class="font-display font-bold text-2xl sm:text-3xl tracking-tight">Three steps. Sixty seconds. Done.</h2>
    </div>

    <div class="grid md:grid-cols-3 gap-4 sm:gap-6">
        @php
            $steps = [
                ['01','Pick your game','Browse 200+ titles or search for your favorite. Choose the top-up or gift card you need.','search'],
                ['02','Enter your ID & pay','Provide your in-game ID and check out securely with cards, wallets, or crypto.','credit-card'],
                ['03','Receive in seconds','Top-ups land in your account automatically. Gift codes arrive in your email instantly.','zap'],
            ];
        @endphp
        @foreach($steps as [$n,$t,$d,$i])
        <div class="card p-6 relative card-hover">
            <div class="absolute top-4 right-4 font-display text-violet1/20 text-5xl font-bold">{{ $n }}</div>
            <div class="w-12 h-12 rounded-xl bg-plum border border-violet1/30 grid place-items-center text-violet2 mb-4">
                <i data-lucide="{{ $i }}" class="w-5 h-5"></i>
            </div>
            <div class="font-display font-semibold text-lg">{{ $t }}</div>
            <p class="text-sm text-muted mt-2 leading-relaxed">{{ $d }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ============== TRUST / PAYMENTS ============== --}}
<section class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <div class="card p-6 sm:p-8">
        <div class="grid md:grid-cols-4 gap-6 items-center text-center md:text-left">
            <div class="md:col-span-2">
                <div class="eyebrow mb-2">Trusted & Secure</div>
                <div class="font-display font-bold text-xl">Bank-grade payments, escrow-protected delivery</div>
                <p class="text-sm text-muted mt-2">SSL encryption, PCI-DSS compliant gateways, and a money-back guarantee on every order.</p>
            </div>
            <div class="md:col-span-2 flex flex-wrap gap-2 justify-center md:justify-end">
                @foreach(['Visa','Mastercard','Amex','PayPal','GCash','Crypto','Bank','Apple Pay'] as $p)
                <div class="px-3.5 py-2 rounded-lg bg-coal border border-line text-xs font-medium text-ice/80">{{ $p }}</div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============== REVIEWS ============== --}}
<section id="reviews" class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-20">
    <div class="flex items-end justify-between mb-6 gap-4 flex-wrap">
        <div>
            <div class="eyebrow mb-2">What Gamers Say</div>
            <h2 class="font-display font-bold text-2xl sm:text-3xl tracking-tight">Loved by 250,000+ players</h2>
        </div>
        <div class="flex items-center gap-2 text-sm text-muted">
            <span class="star">★★★★★</span>
            <span class="font-display text-ice">4.9 / 5</span>
            <span>· 12,400 reviews</span>
        </div>
    </div>

    @php
        $reviews = [
            ['Alex C.','MLBB Player','Diamonds arrived in 10 seconds. Cheapest price I’ve found. Will use again.'],
            ['Mira S.','PUBG Mobile','Bought UC for the squad — flawless. Support replied in under a minute.'],
            ['Daniel R.','Genshin Impact','Got my Steam gift card code instantly via email. Smooth and secure.'],
        ];
    @endphp
    <div class="grid md:grid-cols-3 gap-4">
        @foreach($reviews as [$name,$tag,$text])
        <div class="card p-5 card-hover">
            <div class="star mb-3">★★★★★</div>
            <p class="text-sm text-ice/90 leading-relaxed">“{{ $text }}”</p>
            <div class="mt-4 flex items-center gap-3 pt-4 border-t border-line">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-violet1 to-violet3 grid place-items-center text-white font-semibold text-sm">
                    {{ substr($name,0,1) }}
                </div>
                <div>
                    <div class="text-sm font-semibold">{{ $name }}</div>
                    <div class="text-[11px] text-muted">{{ $tag }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ============== CTA ============== --}}
<section class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-20">
    <div class="card p-8 sm:p-12 relative overflow-hidden text-center">
        <div class="orb bg-violet1" style="width:260px;height:260px;top:-80px;left:-60px;opacity:.3;"></div>
        <div class="orb bg-violet3" style="width:260px;height:260px;bottom:-80px;right:-60px;opacity:.25;"></div>
        <div class="relative z-10">
            <div class="eyebrow justify-center mb-3" style="display:inline-flex;">Join the Panda Pack</div>
            <h2 class="font-display font-bold text-3xl sm:text-4xl max-w-2xl mx-auto leading-tight tracking-tight">
                Get <span class="text-violet2">5% off</span> your first order &amp; weekly exclusive deals.
            </h2>
            <form class="mt-6 max-w-md mx-auto flex flex-col sm:flex-row gap-2">
                <input type="email" required placeholder="your@email.com"
                    class="flex-1 bg-coal border border-line rounded-lg px-4 py-3 text-sm placeholder-muted focus:outline-none focus:border-violet1">
                <button type="submit" class="btn btn-primary">
                    <i data-lucide="send" class="w-4 h-4"></i> Subscribe
                </button>
            </form>
            <p class="text-[11px] text-muted mt-3">No spam. Unsubscribe anytime.</p>
        </div>
    </div>
</section>

{{-- ============== FOOTER ============== --}}
<footer class="relative z-10 mt-20 border-t border-line bg-coal/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-8">
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl panda-ring grid place-items-center">
                        <svg viewBox="0 0 64 64" class="w-6 h-6" fill="none">
                            <circle cx="32" cy="34" r="20" fill="#ece9f7"/>
                            <ellipse cx="16" cy="20" rx="8" ry="9" fill="#0b0a14"/>
                            <ellipse cx="48" cy="20" rx="8" ry="9" fill="#0b0a14"/>
                            <ellipse cx="22" cy="34" rx="5" ry="6" fill="#0b0a14"/>
                            <ellipse cx="42" cy="34" rx="5" ry="6" fill="#0b0a14"/>
                            <circle cx="22" cy="34" r="1.8" fill="#a78bfa"/>
                            <circle cx="42" cy="34" r="1.8" fill="#a78bfa"/>
                            <ellipse cx="32" cy="43" rx="2.8" ry="2" fill="#0b0a14"/>
                        </svg>
                    </div>
                    <div class="font-display font-bold text-lg tracking-tight">PandaGame<span class="text-violet2">Store</span></div>
                </div>
                <p class="text-sm text-muted leading-relaxed max-w-xs">
                    Asia’s favorite marketplace for game top-ups, skins, accounts, and digital gift cards.
                    Built for gamers, trusted by 250,000+.
                </p>
                <div class="mt-5 flex items-center gap-2">
                    @foreach(['facebook','instagram','twitter','youtube','twitch'] as $s)
                    <a href="#" class="w-9 h-9 rounded-lg bg-coal border border-line grid place-items-center text-muted hover:text-violet2 hover:border-violet1 transition">
                        <i data-lucide="{{ $s }}" class="w-4 h-4"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            @php
                $cols = [
                    'Shop' => ['Mobile Games','PC Games','Console','Gift Cards','Subscriptions'],
                    'Company' => ['About Us','Careers','Press','Affiliate','Blog'],
                    'Support' => ['Help Center','Contact','Refund Policy','Terms of Use','Privacy Policy'],
                ];
            @endphp
            @foreach($cols as $title=>$links)
            <div>
                <div class="font-display text-sm font-semibold text-ice mb-4">{{ $title }}</div>
                <ul class="space-y-2.5 text-sm text-muted">
                    @foreach($links as $l)
                    <li><a href="#" class="hover:text-violet2 transition">{{ $l }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>

        <div class="mt-10 pt-6 border-t border-line flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="text-xs text-muted">© {{ date('Y') }} PandaGameStore. All rights reserved.</div>
            <div class="flex items-center gap-4 text-xs text-muted">
                <span class="flex items-center gap-1"><i data-lucide="shield-check" class="w-3.5 h-3.5 text-violet2"></i> SSL Secured</span>
                <span class="flex items-center gap-1"><i data-lucide="badge-check" class="w-3.5 h-3.5 text-violet2"></i> Verified Merchant</span>
                <span class="flex items-center gap-1"><i data-lucide="globe" class="w-3.5 h-3.5 text-violet2"></i> English</span>
            </div>
        </div>
    </div>
</footer>

{{-- ============== CART DRAWER ============== --}}
<div id="overlay" class="overlay"></div>
<aside id="cartDrawer" class="drawer right">
    <div class="p-4 border-b border-line flex items-center justify-between">
        <div class="font-display font-semibold flex items-center gap-2">
            <i data-lucide="shopping-cart" class="w-5 h-5 text-violet2"></i> Your Cart
        </div>
        <button class="closeDrawer p-2 text-muted hover:text-violet2"><i data-lucide="x" class="w-5 h-5"></i></button>
    </div>
    <div id="cartItems" class="flex-1 overflow-y-auto p-4 space-y-3">
        <div class="text-center text-muted text-sm py-10" id="cartEmpty">
            <i data-lucide="shopping-bag" class="w-10 h-10 mx-auto mb-3 text-muted/40"></i>
            Your cart is empty.
        </div>
    </div>
    <div class="p-4 border-t border-line">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm text-muted">Subtotal</span>
            <span id="cartTotal" class="font-display text-lg text-ice">$0.00</span>
        </div>
        <a href="{{ url('/checkout') }}" class="btn btn-primary w-full">
            <i data-lucide="lock" class="w-4 h-4"></i> Secure Checkout
        </a>
    </div>
</aside>

{{-- ============== MOBILE MENU ============== --}}
<aside id="mobileMenu" class="drawer left">
    <div class="p-4 border-b border-line flex items-center justify-between">
        <div class="font-display font-semibold">PandaGame<span class="text-violet2">Store</span></div>
        <button class="closeDrawer p-2 text-muted hover:text-violet2"><i data-lucide="x" class="w-5 h-5"></i></button>
    </div>
    <div class="p-4 space-y-1">
        @foreach([['Home','/','home'],['Games','#games','gamepad-2'],['Top-ups','#topups','zap'],['Gift Cards','#giftcards','gift'],['Reviews','#reviews','star'],['Support','/support','headset']] as [$l,$u,$i])
        <a href="{{ $u }}" class="flex items-center gap-3 px-3 py-3 rounded-lg text-sm text-ice/80 hover:text-violet2 hover:bg-violet1/5 transition">
            <i data-lucide="{{ $i }}" class="w-4 h-4"></i> {{ $l }}
        </a>
        @endforeach
        <div class="pt-4 mt-4 border-t border-line space-y-2">
            <a href="{{ url('/login') }}" class="btn btn-ghost w-full"><i data-lucide="log-in" class="w-4 h-4"></i> Sign In</a>
            <a href="{{ url('/register') }}" class="btn btn-primary w-full">Join Free</a>
        </div>
    </div>
</aside>

{{-- ============== FLOATING CHAT ============== --}}
<button class="fixed bottom-5 right-5 z-50 w-14 h-14 rounded-full bg-gradient-to-br from-violet1 to-violet3 text-white grid place-items-center shadow-xl shadow-violet1/30 pulse"
    title="Chat with Panda Support">
    <i data-lucide="message-circle" class="w-6 h-6"></i>
</button>

{{-- ============== TOAST ============== --}}
<div id="toast" class="toast card p-4 flex items-center gap-3">
    <i data-lucide="check-circle-2" class="w-5 h-5 text-violet2"></i>
    <span id="toastText" class="text-sm">Added to cart</span>
</div>

<script>
    lucide.createIcons();

    // Reveal on scroll
    const io = new IntersectionObserver((entries)=>{
        entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('in'); io.unobserve(e.target);} });
    },{threshold:.15});
    document.querySelectorAll('.reveal').forEach(el=>io.observe(el));

    // Drawers
    const overlay = document.getElementById('overlay');
    const cartDrawer = document.getElementById('cartDrawer');
    const mobileMenu = document.getElementById('mobileMenu');
    const openDrawer = (el)=>{ el.classList.add('open'); overlay.classList.add('open'); document.body.style.overflow='hidden'; };
    const closeAll = ()=>{ cartDrawer.classList.remove('open'); mobileMenu.classList.remove('open'); overlay.classList.remove('open'); document.body.style.overflow=''; };
    document.getElementById('cartBtn')?.addEventListener('click', ()=>openDrawer(cartDrawer));
    document.getElementById('mobileMenuBtn')?.addEventListener('click', ()=>openDrawer(mobileMenu));
    overlay.addEventListener('click', closeAll);
    document.querySelectorAll('.closeDrawer').forEach(b=>b.addEventListener('click', closeAll));

    // Toast
    const toast = document.getElementById('toast');
    const toastText = document.getElementById('toastText');
    let toastT;
    const showToast = (msg)=>{ toastText.textContent = msg; toast.classList.add('show'); clearTimeout(toastT); toastT=setTimeout(()=>toast.classList.remove('show'),2200); };

    // Cart
    const cart = [];
    const cartItemsEl = document.getElementById('cartItems');
    const cartEmpty = document.getElementById('cartEmpty');
    const cartCount = document.getElementById('cartCount');
    const cartTotal = document.getElementById('cartTotal');

    function renderCart(){
        cartCount.textContent = cart.reduce((a,c)=>a+c.qty,0);
        cartTotal.textContent = '$' + cart.reduce((a,c)=>a + c.price*c.qty,0).toFixed(2);
        if(cart.length===0){ cartItemsEl.innerHTML=''; cartItemsEl.appendChild(cartEmpty); return; }
        cartItemsEl.innerHTML = cart.map((it,i)=>`
            <div class="card p-3 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-plum grid place-items-center text-violet2 border border-line">
                    <i data-lucide="gem" class="w-5 h-5"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-semibold truncate">${it.name}</div>
                    <div class="text-xs text-muted">$${it.price.toFixed(2)} × ${it.qty}</div>
                </div>
                <button data-i="${i}" class="rm p-1.5 text-muted hover:text-violet2"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>`).join('');
        lucide.createIcons();
        cartItemsEl.querySelectorAll('.rm').forEach(b=>b.addEventListener('click',()=>{
            cart.splice(+b.dataset.i,1); renderCart();
        }));
    }

    document.querySelectorAll('.add-to-cart').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const name = btn.dataset.name; const price = parseFloat(btn.dataset.price) || 0;
            const found = cart.find(c=>c.name===name);
            if(found) found.qty++; else cart.push({name, price, qty:1});
            renderCart(); showToast(`${name} added to cart`);
        });
    });

    // Countdown
    const target = new Date(); target.setDate(target.getDate()+1); target.setHours(target.getHours()+6);
    const pad = (n)=>String(n).padStart(2,'0');
    const tick = ()=>{
        const diff = Math.max(0, target - new Date());
        const d = Math.floor(diff/86400000);
        const h = Math.floor(diff/3600000)%24;
        const m = Math.floor(diff/60000)%60;
        const s = Math.floor(diff/1000)%60;
        document.getElementById('cd-d').textContent = pad(d);
        document.getElementById('cd-h').textContent = pad(h);
        document.getElementById('cd-m').textContent = pad(m);
        document.getElementById('cd-s').textContent = pad(s);
    };
    tick(); setInterval(tick,1000);
</script>
</body>
</html>
