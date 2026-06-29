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
                        ink:     '#0b0a14',
                        coal:    '#12101e',
                        slate2:  '#1a1828',
                        line:    '#262338',
                        violet1: '#8b5cf6',
                        violet2: '#a78bfa',
                        violet3: '#6d4ddb',
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
            background:
                radial-gradient(900px 600px at 85% -10%, rgba(139,92,246,0.18), transparent 60%),
                radial-gradient(700px 500px at -10% 20%, rgba(109,77,219,0.14), transparent 65%),
                var(--ink);
            background-attachment: fixed;
        }
        h1,h2,h3,h4{ font-family:'Space Grotesk',sans-serif; letter-spacing:-0.01em; }
        .card-surface{
            background: linear-gradient(180deg, rgba(26,24,40,0.9), rgba(18,16,30,0.9));
            border:1px solid var(--line); border-radius:1rem;
        }
        .violet-glow{ box-shadow: 0 10px 40px -10px rgba(139,92,246,0.45); }
        .chip{
            display:inline-flex; align-items:center; gap:.375rem;
            padding:.25rem .625rem; border-radius:9999px;
            background:rgba(139,92,246,.12); color:var(--violet2);
            border:1px solid rgba(139,92,246,.25);
            font-size:.65rem; font-weight:600; letter-spacing:.02em; text-transform:uppercase;
        }
        @media(min-width:768px){
            .chip{ font-size:.7rem; padding:.3rem .75rem; }
        }
        .slide{ opacity:0; transition:opacity .7s; pointer-events:none; }
        .slide.active{ opacity:1; pointer-events:auto; }
    </style>
</head>
<body>

@php
    $slides = [
        ['tag'=>'Mega Sale','title'=>'Up to 40% OFF on Mobile Legends Diamonds','sub'=>'Top-up faster. Climb higher. Limited time only.','cta'=>'Top Up Now','img'=>'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=1600&q=80','accent'=>'from-violet-600/70 to-fuchsia-600/40'],
        ['tag'=>'Weekend Deal','title'=>'Free Fire Diamonds — Buy 1000, Get 150 Bonus','sub'=>'Stock up before the next Booyah season drops.','cta'=>'Grab Bonus','img'=>'https://images.unsplash.com/photo-1538481199705-c710c4e965fc?auto=format&fit=crop&w=1600&q=80','accent'=>'from-indigo-600/70 to-violet-500/40'],
        ['tag'=>'Gift Cards','title'=>'Steam Wallet & PSN Cards — Instant Delivery','sub'=>'Codes delivered to your inbox in under 60 seconds.','cta'=>'Browse Cards','img'=>'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=1600&q=80','accent'=>'from-purple-700/70 to-violet-500/40'],
    ];

    $games = [
        ['name'=>'Mobile Legends','cat'=>'MOBA · Top-Up','price'=>'$0.99','img'=>'https://images.unsplash.com/photo-1614680376573-df3480f0c6ff?auto=format&fit=crop&w=600&q=80','hot'=>true],
        ['name'=>'PUBG Mobile','cat'=>'Battle Royale · UC','price'=>'$1.49','img'=>'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?auto=format&fit=crop&w=600&q=80','hot'=>true],
        ['name'=>'Free Fire','cat'=>'Battle Royale · Diamonds','price'=>'$0.79','img'=>'https://images.unsplash.com/photo-1493711662062-fa541adb3fc8?auto=format&fit=crop&w=600&q=80','hot'=>false],
        ['name'=>'Genshin Impact','cat'=>'RPG · Genesis Crystals','price'=>'$1.99','img'=>'https://images.unsplash.com/photo-1612287230202-1ff1d85d1bdf?auto=format&fit=crop&w=600&q=80','hot'=>true],
        ['name'=>'Valorant','cat'=>'FPS · VP Points','price'=>'$4.99','img'=>'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=600&q=80','hot'=>false],
        ['name'=>'Call of Duty Mobile','cat'=>'FPS · CP','price'=>'$1.99','img'=>'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?auto=format&fit=crop&w=600&q=80','hot'=>false],
        ['name'=>'Honor of Kings','cat'=>'MOBA · Tokens','price'=>'$1.29','img'=>'https://images.unsplash.com/photo-1538481199705-c710c4e965fc?auto=format&fit=crop&w=600&q=80','hot'=>false],
        ['name'=>'Roblox','cat'=>'Sandbox · Robux','price'=>'$4.99','img'=>'https://images.unsplash.com/photo-1614294148960-9aa740632a87?auto=format&fit=crop&w=600&q=80','hot'=>false],
    ];

    $giftCards = [
        ['name'=>'Steam Wallet','price'=>'from $10','color'=>'from-[#1b2838] to-[#2a475e]'],
        ['name'=>'PlayStation Network','price'=>'from $10','color'=>'from-[#003791] to-[#0070d1]'],
        ['name'=>'Xbox Live','price'=>'from $15','color'=>'from-[#107c10] to-[#0e6a0e]'],
        ['name'=>'iTunes / App Store','price'=>'from $10','color'=>'from-[#1d1d1f] to-[#3a3a3c]'],
        ['name'=>'Google Play','price'=>'from $10','color'=>'from-[#34a853] to-[#fbbc04]'],
        ['name'=>'Netflix','price'=>'from $15','color'=>'from-[#831010] to-[#e50914]'],
        ['name'=>'Spotify','price'=>'from $10','color'=>'from-[#1db954] to-[#0d8a3f]'],
        ['name'=>'Amazon','price'=>'from $25','color'=>'from-[#232f3e] to-[#ff9900]'],
    ];

    $categories = [
        ['name'=>'Top-Ups','icon'=>'zap'],
        ['name'=>'Gift Cards','icon'=>'gift'],
        ['name'=>'Game Accounts','icon'=>'gamepad-2'],
        ['name'=>'Skins & Items','icon'=>'sparkles'],
        ['name'=>'Subscriptions','icon'=>'credit-card'],
        ['name'=>'Bestsellers','icon'=>'trophy'],
    ];

    $reviews = [
        ['name'=>'Aung K.','text'=>"Got my ML diamonds in 30 seconds. Best price I've seen in Yangon.",'stars'=>5],
        ['name'=>'Mei L.','text'=>'Steam wallet code arrived instantly. Will be back for sure.','stars'=>5],
        ['name'=>'Ravi P.','text'=>'Support replied in under a minute when I mistyped my ID. Solid service.','stars'=>5],
    ];
@endphp

{{-- ===== Header ===== --}}
<header class="sticky top-0 z-40 backdrop-blur-xl bg-ink/70 border-b border-line">
    <div class="max-w-7xl mx-auto px-3 md:px-4 h-14 md:h-16 flex items-center gap-2 md:gap-4">
        <a href="#" class="flex items-center gap-1.5 md:gap-2 shrink-0">
            <div class="w-8 h-8 md:w-9 md:h-9 rounded-lg md:rounded-xl bg-gradient-to-br from-violet-500 to-violet-700 grid place-items-center violet-glow">
                <i data-lucide="gamepad-2" class="w-4 h-4 md:w-5 md:h-5 text-white"></i>
            </div>
            <span class="font-display font-bold text-base md:text-lg tracking-tight">Panda<span class="text-violet-400">GameStore</span></span>
        </a>

        <nav class="hidden lg:flex items-center gap-6 ml-6 text-sm text-ice/80">
            <a href="#games" class="hover:text-violet-300 transition">Games</a>
            <a href="#giftcards" class="hover:text-violet-300 transition">Gift Cards</a>
            <a href="#deals" class="hover:text-violet-300 transition">Deals</a>
            <a href="#support" class="hover:text-violet-300 transition">Support</a>
        </nav>

        <div class="flex-1 max-w-md hidden md:flex items-center gap-2 ml-4 px-3 h-10 rounded-xl bg-coal border border-line focus-within:border-violet-500/60 transition">
            <i data-lucide="search" class="w-4 h-4 text-muted"></i>
            <input placeholder="Search games, gift cards, skins…" class="bg-transparent outline-none text-sm w-full placeholder:text-muted">
        </div>

        <div class="ml-auto flex items-center gap-1.5 md:gap-2">
            <button class="hidden sm:inline-flex h-9 md:h-10 px-3 md:px-4 rounded-lg md:rounded-xl border border-line hover:border-violet-500/60 text-xs md:text-sm font-medium items-center gap-2 transition">Sign In</button>
            <button class="h-9 md:h-10 px-3 md:px-4 rounded-lg md:rounded-xl bg-gradient-to-br from-violet-500 to-violet-700 hover:from-violet-400 hover:to-violet-600 text-white text-xs md:text-sm font-semibold inline-flex items-center gap-1.5 md:gap-2 violet-glow transition">
                <i data-lucide="shopping-cart" class="w-3.5 h-3.5 md:w-4 md:h-4"></i> Cart
            </button>
            <button class="lg:hidden h-9 w-9 md:h-10 md:w-10 grid place-items-center rounded-lg md:rounded-xl border border-line">
                <i data-lucide="menu" class="w-4 h-4 md:w-5 md:h-5"></i>
            </button>
        </div>
    </div>
</header>

{{-- ===== Hero Slider ===== --}}
<section class="max-w-7xl mx-auto px-3 md:px-4 pt-4 md:pt-6">
    <div id="hero-slider" class="relative overflow-hidden rounded-xl md:rounded-2xl border border-line aspect-[16/9] md:aspect-[21/9] lg:aspect-[21/8]">
        @foreach($slides as $i => $s)
            <div class="slide absolute inset-0 {{ $i===0 ? 'active' : '' }}" data-index="{{ $i }}">
                <img src="{{ $s['img'] }}" alt="{{ $s['title'] }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r {{ $s['accent'] }}"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/40 to-transparent"></div>
                <div class="absolute inset-0 flex items-end md:items-center">
                    <div class="p-4 md:p-10 lg:p-12 max-w-2xl">
                        <span class="chip text-[9px] md:text-[11px] py-1 px-2 md:py-1 md:px-2.5"><i data-lucide="flame" class="w-2.5 h-2.5 md:w-3 md:h-3"></i> {{ $s['tag'] }}</span>
                        <h2 class="mt-2 md:mt-3 font-display text-xl md:text-3xl lg:text-5xl font-bold leading-tight">{{ $s['title'] }}</h2>
                        <p class="mt-1.5 md:mt-2 text-xs md:text-base text-ice/80">{{ $s['sub'] }}</p>
                        <button class="mt-3 md:mt-5 h-9 md:h-11 px-4 md:px-6 rounded-lg md:rounded-xl bg-white text-ink font-semibold text-xs md:text-sm inline-flex items-center gap-2 hover:bg-violet-100 transition">
                            {{ $s['cta'] }} <i data-lucide="arrow-right" class="w-3.5 h-3.5 md:w-4 md:h-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        <button id="slide-prev" class="absolute left-2 md:left-3 top-1/2 -translate-y-1/2 w-8 h-8 md:w-10 md:h-10 grid place-items-center rounded-full bg-black/40 backdrop-blur border border-white/10 hover:bg-black/60">
            <i data-lucide="chevron-left" class="w-4 h-4 md:w-5 md:h-5"></i>
        </button>
        <button id="slide-next" class="absolute right-2 md:right-3 top-1/2 -translate-y-1/2 w-8 h-8 md:w-10 md:h-10 grid place-items-center rounded-full bg-black/40 backdrop-blur border border-white/10 hover:bg-black/60">
            <i data-lucide="chevron-right" class="w-4 h-4 md:w-5 md:h-5"></i>
        </button>

        <div id="slide-dots" class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
            @foreach($slides as $i => $s)
                <button data-dot="{{ $i }}" class="h-1.5 rounded-full transition-all {{ $i===0 ? 'w-8 bg-violet-400' : 'w-2 bg-white/40' }}"></button>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== Categories ===== --}}
<section class="max-w-7xl mx-auto px-3 md:px-4 mt-6 md:mt-8">
    <div class="grid grid-cols-3 md:grid-cols-6 gap-2 md:gap-3">
        @foreach($categories as $c)
            <a href="#games" class="card-surface p-2.5 md:p-4 flex flex-col items-center gap-1.5 md:gap-2 hover:border-violet-500/60 hover:-translate-y-0.5 transition">
                <div class="w-8 h-8 md:w-10 md:h-10 grid place-items-center rounded-lg bg-violet-500/10 border border-violet-500/20">
                    <i data-lucide="{{ $c['icon'] }}" class="w-4 h-4 md:w-5 md:h-5 text-violet-300"></i>
                </div>
                <span class="text-[10px] md:text-xs font-medium text-center leading-tight">{{ $c['name'] }}</span>
            </a>
        @endforeach
    </div>
</section>

{{-- ===== Games ===== --}}
<section id="games" class="max-w-7xl mx-auto px-3 md:px-4 mt-10 md:mt-14">
    <div class="flex items-end justify-between mb-3 md:mb-5">
        <div>
            <div class="flex items-center gap-1.5 md:gap-2 text-violet-300">
                <i data-lucide="gamepad-2" class="w-3.5 h-3.5 md:w-4 md:h-4"></i>
                <span class="text-[10px] md:text-xs font-bold uppercase tracking-wider">Popular Now</span>
            </div>
            <h3 class="mt-1 font-display text-lg md:text-2xl lg:text-3xl font-bold">Top Up Your Favorite Games</h3>
        </div>
        <a href="#" class="text-xs md:text-sm text-violet-300 hover:text-violet-200 inline-flex items-center gap-1">View all <i data-lucide="arrow-right" class="w-3.5 h-3.5 md:w-4 md:h-4"></i></a>
    </div>
    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2 md:gap-3">
        @foreach($games as $g)
            <a href="#" class="group card-surface overflow-hidden hover:border-violet-500/60 hover:-translate-y-1 transition relative">
                <div class="relative aspect-[3/2] md:aspect-[4/3] overflow-hidden">
                    <img src="{{ $g['img'] }}" alt="{{ $g['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-coal via-transparent to-transparent"></div>
                    @if($g['hot'])
                        <span class="absolute top-1.5 left-1.5 chip text-[9px] md:text-[10px] py-0.5 px-1 md:px-1.5" style="background:rgba(239,68,68,.2);color:#fca5a5;border-color:rgba(239,68,68,.3)">
                            <i data-lucide="flame" class="w-2 h-2 md:w-2.5 md:h-2.5"></i> Hot
                        </span>
                    @endif
                </div>
                <div class="p-2 md:p-3">
                    <h4 class="font-display font-semibold text-[11px] md:text-sm leading-tight truncate">{{ $g['name'] }}</h4>
                    <p class="mt-0.5 text-[9px] md:text-[11px] text-muted truncate">{{ $g['cat'] }}</p>
                    <div class="mt-1.5 md:mt-2 flex items-center justify-between">
                        <span class="text-[10px] md:text-xs"><span class="text-muted">from</span> <span class="font-semibold text-violet-300">{{ $g['price'] }}</span></span>
                        <span class="text-[9px] md:text-[10px] h-6 md:h-7 px-1.5 md:px-2 grid place-items-center rounded-lg bg-violet-500/15 text-violet-200 border border-violet-500/30 group-hover:bg-violet-500 group-hover:text-white transition">Top Up</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>

{{-- ===== Gift Cards ===== --}}
<section id="giftcards" class="max-w-7xl mx-auto px-3 md:px-4 mt-12 md:mt-16">
    <div class="flex items-end justify-between mb-3 md:mb-5">
        <div>
            <div class="flex items-center gap-1.5 md:gap-2 text-violet-300">
                <i data-lucide="gift" class="w-3.5 h-3.5 md:w-4 md:h-4"></i>
                <span class="text-[10px] md:text-xs font-bold uppercase tracking-wider">Instant Delivery</span>
            </div>
            <h3 class="mt-1 font-display text-lg md:text-2xl lg:text-3xl font-bold">Gift Cards & Vouchers</h3>
        </div>
        <a href="#" class="text-xs md:text-sm text-violet-300 hover:text-violet-200 inline-flex items-center gap-1">View all <i data-lucide="arrow-right" class="w-3.5 h-3.5 md:w-4 md:h-4"></i></a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4">
        @foreach($giftCards as $c)
            <a href="#" class="group relative rounded-xl md:rounded-2xl overflow-hidden border border-line hover:border-violet-500/60 hover:-translate-y-1 transition">
                <div class="aspect-[16/10] bg-gradient-to-br {{ $c['color'] }} relative">
                    <div class="absolute inset-0 p-3 md:p-4 flex flex-col justify-between">
                        <i data-lucide="credit-card" class="w-5 h-5 md:w-6 md:h-6 text-white/80"></i>
                        <div>
                            <div class="text-white font-display font-bold text-sm md:text-lg leading-tight">{{ $c['name'] }}</div>
                            <div class="text-white/70 text-[10px] md:text-xs mt-0.5">Digital Code</div>
                        </div>
                    </div>
                </div>
                <div class="p-2.5 md:p-3 bg-coal flex items-center justify-between">
                    <span class="text-xs md:text-sm font-semibold text-violet-300">{{ $c['price'] }}</span>
                    <span class="text-[10px] md:text-xs text-muted inline-flex items-center gap-1"><i data-lucide="clock" class="w-2.5 h-2.5 md:w-3 md:h-3"></i> Instant</span>
                </div>
            </a>
        @endforeach
    </div>
</section>

{{-- ===== Flash Deal ===== --}}
<section id="deals" class="max-w-7xl mx-auto px-3 md:px-4 mt-12 md:mt-16">
    <div class="card-surface p-4 md:p-8 relative overflow-hidden">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-violet-600/20 blur-3xl"></div>
        <div class="relative flex flex-col md:flex-row md:items-center gap-4 md:gap-6 justify-between">
            <div>
                <span class="chip text-[9px] md:text-[11px] py-1 px-2 md:py-1 md:px-2.5"><i data-lucide="tag" class="w-2.5 h-2.5 md:w-3 md:h-3"></i> Flash Deal</span>
                <h3 class="mt-2 md:mt-3 font-display text-lg md:text-2xl lg:text-3xl font-bold">Save 25% on every top-up this weekend</h3>
                <p class="mt-1 text-xs md:text-sm text-muted">Use code <span class="font-mono text-violet-300">PANDA25</span> at checkout. Ends Sunday midnight.</p>
            </div>
            <div class="flex items-center gap-2 md:gap-3">
                @foreach(['12'=>'Hours','08'=>'Min','45'=>'Sec'] as $n => $lbl)
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-lg md:rounded-xl bg-ink border border-line grid place-items-center">
                        <span class="font-display text-xl md:text-2xl font-bold">{{ $n }}</span>
                        <span class="text-[8px] md:text-[10px] text-muted uppercase">{{ $lbl }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ===== How it works ===== --}}
<section class="max-w-7xl mx-auto px-3 md:px-4 mt-12 md:mt-16">
    <div class="mb-3 md:mb-5">
        <div class="flex items-center gap-1.5 md:gap-2 text-violet-300">
            <i data-lucide="sparkles" class="w-3.5 h-3.5 md:w-4 md:h-4"></i>
            <span class="text-[10px] md:text-xs font-bold uppercase tracking-wider">How it works</span>
        </div>
        <h3 class="mt-1 font-display text-lg md:text-2xl lg:text-3xl font-bold">Three steps. Sixty seconds.</h3>
    </div>
    <div class="grid md:grid-cols-3 gap-3 md:gap-4">
        @foreach([
            ['icon'=>'search','title'=>'Pick your game','text'=>'Browse hundreds of titles and gift cards.'],
            ['icon'=>'credit-card','title'=>'Pay securely','text'=>'Cards, wallets, crypto — all encrypted end-to-end.'],
            ['icon'=>'zap','title'=>'Instant delivery','text'=>'Codes and top-ups land in under 60 seconds.'],
        ] as $i => $step)
            <div class="card-surface p-4 md:p-6">
                <div class="flex items-center justify-between">
                    <div class="w-9 h-9 md:w-11 md:h-11 rounded-lg md:rounded-xl bg-violet-500/15 border border-violet-500/30 grid place-items-center">
                        <i data-lucide="{{ $step['icon'] }}" class="w-4 h-4 md:w-5 md:h-5 text-violet-300"></i>
                    </div>
                    <span class="font-display text-3xl md:text-4xl font-bold text-line">0{{ $i+1 }}</span>
                </div>
                <h4 class="mt-3 md:mt-4 font-display font-bold text-base md:text-lg">{{ $step['title'] }}</h4>
                <p class="mt-1 text-xs md:text-sm text-muted">{{ $step['text'] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- ===== Trust ===== --}}
<section class="max-w-7xl mx-auto px-3 md:px-4 mt-12 md:mt-16">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3">
        @foreach([
            ['icon'=>'shield-check','title'=>'Secure Payments','text'=>'PCI-DSS encrypted checkout'],
            ['icon'=>'zap','title'=>'Instant Delivery','text'=>'Codes in under 60 seconds'],
            ['icon'=>'headphones','title'=>'24/7 Support','text'=>'Real humans, any timezone'],
            ['icon'=>'users','title'=>'500K+ Gamers','text'=>'Trusted across Asia'],
        ] as $it)
            <div class="card-surface p-3 md:p-5 flex items-start gap-2 md:gap-3">
                <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg bg-violet-500/10 border border-violet-500/20 grid place-items-center shrink-0">
                    <i data-lucide="{{ $it['icon'] }}" class="w-4 h-4 md:w-5 md:h-5 text-violet-300"></i>
                </div>
                <div>
                    <div class="font-semibold text-xs md:text-sm">{{ $it['title'] }}</div>
                    <div class="text-[10px] md:text-xs text-muted">{{ $it['text'] }}</div>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- ===== Reviews ===== --}}
<section class="max-w-7xl mx-auto px-3 md:px-4 mt-12 md:mt-16">
    <div class="mb-3 md:mb-5">
        <div class="flex items-center gap-1.5 md:gap-2 text-violet-300">
            <i data-lucide="star" class="w-3.5 h-3.5 md:w-4 md:h-4"></i>
            <span class="text-[10px] md:text-xs font-bold uppercase tracking-wider">Real Reviews</span>
        </div>
        <h3 class="mt-1 font-display text-lg md:text-2xl lg:text-3xl font-bold">What gamers say about us</h3>
    </div>
    <div class="grid md:grid-cols-3 gap-3 md:gap-4">
        @foreach($reviews as $r)
            <div class="card-surface p-4 md:p-6">
                <div class="flex items-center gap-1 text-yellow-400">
                    @for($i=0; $i<$r['stars']; $i++)
                        <i data-lucide="star" class="w-3.5 h-3.5 md:w-4 md:h-4 fill-current"></i>
                    @endfor
                </div>
                <p class="mt-2 md:mt-3 text-xs md:text-sm text-ice/90 leading-relaxed">"{{ $r['text'] }}"</p>
                <div class="mt-3 md:mt-4 flex items-center gap-2 md:gap-3">
                    <div class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-gradient-to-br from-violet-500 to-violet-700 grid place-items-center text-xs md:text-sm font-bold">{{ substr($r['name'],0,1) }}</div>
                    <div>
                        <div class="text-xs md:text-sm font-semibold">{{ $r['name'] }}</div>
                        <div class="text-[10px] md:text-xs text-muted">Verified buyer</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- ===== Newsletter ===== --}}
<section class="max-w-7xl mx-auto px-3 md:px-4 mt-12 md:mt-16">
    <div class="relative overflow-hidden rounded-xl md:rounded-2xl border border-line p-5 md:p-12 bg-gradient-to-br from-plum to-coal">
        <div class="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-violet-600/30 blur-3xl"></div>
        <div class="relative max-w-2xl">
            <span class="chip text-[9px] md:text-[11px] py-1 px-2 md:py-1 md:px-2.5"><i data-lucide="gift" class="w-2.5 h-2.5 md:w-3 md:h-3"></i> Members get more</span>
            <h3 class="mt-2 md:mt-3 font-display text-lg md:text-2xl lg:text-3xl font-bold">Get drop alerts and member-only discounts</h3>
            <p class="mt-1.5 md:mt-2 text-xs md:text-sm text-ice/70">Join 60,000+ gamers. One email a week — no spam, just deals.</p>
            <form class="mt-3 md:mt-5 flex flex-col sm:flex-row gap-2 w-full sm:max-w-md" onsubmit="event.preventDefault()">
                <input type="email" placeholder="your@email.com" style="height:52px" class="flex-1 min-w-0 px-4 md:px-5 rounded-xl bg-ink border border-line outline-none focus:border-violet-500/60 text-sm md:text-base">
                <button class="shrink-0 px-6 md:px-8 rounded-xl bg-gradient-to-br from-violet-500 to-violet-700 hover:from-violet-400 hover:to-violet-600 text-white text-sm md:text-base font-semibold violet-glow transition" style="height:52px">Subscribe</button>
            </form>
        </div>
    </div>
</section>

{{-- ===== Footer ===== --}}
<footer id="support" class="mt-12 md:mt-20 border-t border-line">
    <div class="max-w-7xl mx-auto px-3 md:px-4 py-8 md:py-12 grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
        <div class="col-span-2 md:col-span-1">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-violet-500 to-violet-700 grid place-items-center">
                    <i data-lucide="gamepad-2" class="w-4 h-4 text-white"></i>
                </div>
                <span class="font-display font-bold">PandaGameStore</span>
            </div>
            <p class="mt-3 text-xs md:text-sm text-muted">Asia's trusted marketplace for game top-ups, skins and gift cards.</p>
        </div>
        @foreach([
            ['h'=>'Shop','l'=>['Top-Ups','Gift Cards','Game Accounts','Skins']],
            ['h'=>'Help','l'=>['Support Center','Delivery','Refunds','Contact']],
            ['h'=>'Company','l'=>['About','Careers','Affiliates','Terms']],
        ] as $col)
            <div>
                <h5 class="font-display font-semibold text-xs md:text-sm">{{ $col['h'] }}</h5>
                <ul class="mt-2 md:mt-3 space-y-1.5 md:space-y-2 text-xs md:text-sm text-muted">
                    @foreach($col['l'] as $x)
                        <li><a href="#" class="hover:text-violet-300 transition">{{ $x }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
    <div class="border-t border-line py-4 md:py-5 text-center text-[10px] md:text-xs text-muted">
        © {{ date('Y') }} PandaGameStore. All rights reserved.
    </div>
</footer>

<script>
    lucide.createIcons();

    // Hero slider
    (function(){
        const slides = document.querySelectorAll('#hero-slider .slide');
        const dots = document.querySelectorAll('#slide-dots [data-dot]');
        let idx = 0;
        function go(n){
            idx = (n + slides.length) % slides.length;
            slides.forEach((el,i)=> el.classList.toggle('active', i===idx));
            dots.forEach((d,i)=>{
                d.className = 'h-1.5 rounded-full transition-all ' + (i===idx ? 'w-8 bg-violet-400' : 'w-2 bg-white/40');
            });
        }
        document.getElementById('slide-prev').addEventListener('click', ()=> go(idx-1));
        document.getElementById('slide-next').addEventListener('click', ()=> go(idx+1));
        dots.forEach((d,i)=> d.addEventListener('click', ()=> go(i)));
        setInterval(()=> go(idx+1), 5000);
    })();
</script>

</body>
</html>
