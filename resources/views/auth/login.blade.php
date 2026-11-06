<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول | نظام وكالة بريق للتسويق الإلكتروني</title>
    @include('partials.pwa-meta')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { cairo: ['Cairo', 'sans-serif'] },
                    colors: {
                        brand: {
                            dark: '#0B0314',
                            purple: '#18082B',
                            card: '#220D3D',
                            hover: '#2E1253',
                            border: '#3C176D',
                            yellow: '#F59E0B',
                            amber: '#FF9F0A',
                            gold: '#FBBF24',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #0B0314; color: #F3F4F6; }
        .gold-gradient-text {
            background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 50%, #D97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden bg-brand-dark">

    <!-- Ambient glowing backgrounds -->
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-brand-border/40 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-brand-yellow/15 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Brand Logo Header -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center group">
                <img src="{{ asset('images/logo.png') }}" alt="بريق" class="h-20 w-auto object-contain filter drop-shadow-lg mb-3 group-hover:scale-105 transition-transform duration-300">
                <h1 class="text-3xl font-black gold-gradient-text">بريق للتسويق الإلكتروني</h1>
                <p class="text-sm text-brand-gold/80 mt-1 font-semibold">مفتاح نجاحك في التسويق</p>
            </a>
            <div class="mt-4 inline-block px-4 py-1 rounded-full bg-brand-card/80 border border-brand-border/70 text-xs text-gray-300">
                <i class="fa-solid fa-lock text-brand-gold ml-1.5"></i>
                بوابة دخول آمنة وخاصة لكل مستخدم
            </div>
        </div>

        <!-- Login Card -->
        <div class="bg-brand-card/90 backdrop-blur-xl border border-brand-border rounded-2xl p-6 sm:p-8 shadow-2xl">
            
            @if(session('info'))
            <div class="p-3 mb-5 rounded-xl bg-blue-500/15 border border-blue-500/30 text-blue-300 text-xs flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-blue-400"></i>
                <span>{{ session('info') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="p-3 mb-5 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation text-rose-400"></i>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1.5">البريد الإلكتروني</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                               class="w-full pr-10 pl-4 py-3 bg-brand-purple/70 border border-brand-border rounded-xl text-white placeholder-gray-500 text-sm focus:outline-none focus:border-brand-gold focus:ring-1 focus:ring-brand-gold transition"
                               placeholder="yourname@pariqagency.com">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1.5">كلمة المرور</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </div>
                        <input type="password" name="password" required 
                               class="w-full pr-10 pl-4 py-3 bg-brand-purple/70 border border-brand-border rounded-xl text-white placeholder-gray-500 text-sm focus:outline-none focus:border-brand-gold focus:ring-1 focus:ring-brand-gold transition"
                               placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 text-gray-300 cursor-pointer">
                        <input type="checkbox" name="remember" checked class="rounded bg-brand-purple border-brand-border text-brand-gold focus:ring-0">
                        <span>تذكر دخولي</span>
                    </label>
                </div>

                <button type="submit" 
                        class="w-full py-3.5 px-4 rounded-xl font-black text-sm bg-gradient-to-l from-brand-amber via-brand-yellow to-brand-gold text-brand-dark hover:brightness-110 active:scale-[0.99] transition-all shadow-lg flex items-center justify-center gap-2 mt-4">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>تسجيل الدخول</span>
                </button>
            </form>

            <!-- Back to website -->
            <div class="mt-6 pt-5 border-t border-brand-border/60 text-center">
                <a href="{{ route('home') }}" class="text-xs text-gray-400 hover:text-brand-gold transition inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-right"></i>
                    <span>العودة إلى موقع بريق ومعرض الأعمال</span>
                </a>
            </div>

        </div>

    </div>

    @include('partials.pwa-prompts')
</body>
</html>
