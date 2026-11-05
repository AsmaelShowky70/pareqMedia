<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'نظام إدارة الوكالة') | بريق للتسويق الإلكتروني</title>

    <!-- PWA & Mobile Web App Meta Tags (iPhone & Android) -->
    @include('partials.pwa-meta')

    <!-- Google Fonts: Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS with Custom Pariq Brand Theme -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                    },
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
                            glow: 'rgba(245, 158, 11, 0.25)',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #0B0314;
            color: #F3F4F6;
            -webkit-tap-highlight-color: transparent;
        }
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #120522;
        }
        ::-webkit-scrollbar-thumb {
            background: #3C176D;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #F59E0B;
        }
        .gold-gradient-text {
            background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 50%, #D97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .purple-gradient {
            background: linear-gradient(135deg, #220D3D 0%, #18082B 100%);
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-brand-dark antialiased" 
      x-data="pariqApp()" 
      x-init="initApp()">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar Backdrop for mobile -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false" 
             class="fixed inset-0 z-40 bg-black/70 backdrop-blur-sm lg:hidden" 
             style="display: none;"></div>

        <!-- Sidebar Navigation -->
        <aside :class="sidebarOpen ? 'translate-x-0' : 'translate-x-full lg:translate-x-0'"
               class="fixed inset-y-0 right-0 z-50 w-72 bg-brand-purple border-l border-brand-border flex flex-col transition-transform duration-300 ease-in-out lg:static lg:translate-x-0">
            
            <!-- Logo Header -->
            <div class="p-5 border-b border-brand-border flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="بريق" class="h-12 w-auto object-contain filter drop-shadow">
                    <div>
                        <div class="text-xl font-black tracking-wide gold-gradient-text">وكالة بريق</div>
                        <div class="text-[11px] text-brand-gold/70 font-medium">مفتاح نجاحك في التسويق</div>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white p-1">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <!-- Current User Badge Summary -->
            <div class="p-4 mx-4 mt-4 rounded-xl bg-brand-card/70 border border-brand-border/60">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-brand-amber to-brand-yellow text-brand-dark font-black flex items-center justify-center text-base shadow">
                        {{ mb_substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-brand-gold font-medium truncate">{{ Auth::user()->job_title ?? Auth::user()->department_name_arabic }}</div>
                    </div>
                </div>
                <div class="mt-2.5 pt-2 border-t border-brand-border/40 flex items-center justify-between text-xs text-gray-400">
                    <span>الصلاحية:</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ Auth::user()->isAdmin() ? 'bg-amber-500/20 text-amber-300' : (Auth::user()->isContentCreator() ? 'bg-blue-500/20 text-blue-300' : 'bg-purple-500/20 text-purple-300') }}">
                        {{ Auth::user()->role_name_arabic }}
                    </span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-4 space-y-1.5 overflow-y-auto">
                <div class="px-3 pb-2 text-[11px] font-bold text-gray-400 uppercase tracking-wider">القائمة الرئيسية</div>

                <!-- 1. Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('dashboard') ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow-md font-bold' : 'text-gray-300 hover:bg-brand-hover hover:text-white' }}">
                    <i class="fa-solid fa-gauge-high w-5 text-center text-base"></i>
                    <span>{{ Auth::user()->isEmployee() ? 'لوحة مهامي اليومية' : (Auth::user()->isContentCreator() ? 'لوحة إدارة فريقي' : 'لوحة التحكم الرئيسية') }}</span>
                </a>

                <!-- 2. For Employees: My Portfolio -->
                @if(Auth::user()->isEmployee())
                <a href="{{ route('my-portfolio') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('my-portfolio') ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow-md font-bold' : 'text-gray-300 hover:bg-brand-hover hover:text-white' }}">
                    <i class="fa-solid fa-briefcase w-5 text-center text-base text-brand-gold"></i>
                    <span>سابقة أعمالي (Portfolio)</span>
                </a>
                @endif

                <!-- 3. Tasks -->
                <a href="{{ route('tasks.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('tasks.*') ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow-md font-bold' : 'text-gray-300 hover:bg-brand-hover hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-list-check w-5 text-center text-base"></i>
                        <span>{{ Auth::user()->isEmployee() ? 'المهام المسندة لي' : 'المهام وسير العمل' }}</span>
                    </div>
                    @php
                        $pendingTasksCount = Auth::user()->isEmployee() 
                            ? \App\Models\Task::where('assigned_to', Auth::id())->whereIn('status', ['not_started', 'in_progress'])->count()
                            : (Auth::user()->isContentCreator()
                                ? \App\Models\Task::where(function($q) {
                                    $q->whereHas('project', function($pq) { $pq->where('content_creator_id', Auth::id()); })
                                      ->orWhere('created_by', Auth::id());
                                  })->whereIn('status', ['not_started', 'in_progress'])->count()
                                : \App\Models\Task::whereIn('status', ['not_started', 'in_progress'])->count());
                    @endphp
                    @if($pendingTasksCount > 0)
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ request()->routeIs('tasks.*') ? 'bg-brand-dark text-brand-gold' : 'bg-brand-yellow/20 text-brand-gold' }}">
                            {{ $pendingTasksCount }}
                        </span>
                    @endif
                </a>

                <!-- 4. Projects (Content Creator & Admin only) -->
                @if(!Auth::user()->isEmployee())
                <a href="{{ route('projects.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('projects.*') ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow-md font-bold' : 'text-gray-300 hover:bg-brand-hover hover:text-white' }}">
                    <i class="fa-solid fa-folder-tree w-5 text-center text-base"></i>
                    <span>{{ Auth::user()->isContentCreator() ? 'مشاريعي المكلف بها' : 'المشروعات الكبرى' }}</span>
                </a>

                <!-- 5. Clients CRM -->
                <a href="{{ route('clients.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('clients.*') ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow-md font-bold' : 'text-gray-300 hover:bg-brand-hover hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-users w-5 text-center text-base"></i>
                        <span>إدارة العملاء (CRM)</span>
                    </div>
                </a>

                <!-- 6. Content Calendar & Monthly Publishing Plans (Admin & Content Creators only) -->
                <a href="{{ route('content-plans.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('content-plans.*') ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow-md font-bold' : 'text-gray-300 hover:bg-brand-hover hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-calendar-days w-5 text-center text-base {{ request()->routeIs('content-plans.*') ? '!text-brand-dark' : 'text-brand-gold' }}"></i>
                        <span>جدول وخطة النشر للعملاء</span>
                    </div>
                    <span class="text-[10px] {{ request()->routeIs('content-plans.*') ? 'bg-brand-dark/20 text-brand-dark' : 'bg-purple-500/20 text-purple-300 border border-purple-500/30' }} font-bold px-1.5 py-0.5 rounded">شهري</span>
                </a>
                @endif

                <!-- 6. Cashier & Detailed Accounting (Admin & Accounting only) -->
                @if(Auth::user()->isAdmin() || Auth::user()->department === 'accounting')
                <div class="pt-3 px-3 pb-1 text-[11px] font-bold text-gray-400 uppercase tracking-wider">المالية والحسابات العامة</div>

                <a href="{{ route('accounting.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm transition-all border border-brand-border/60 {{ request()->routeIs('accounting.*') ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow-md font-bold' : 'text-gray-300 hover:bg-brand-hover hover:text-white' }}">
                    <i class="fa-solid fa-scale-balanced w-5 text-center text-base text-brand-gold {{ request()->routeIs('accounting.*') ? '!text-brand-dark' : '' }}"></i>
                    <span>نظام الحسابات المتكامل</span>
                </a>

                <a href="{{ route('cashier.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-sm transition-all border border-brand-yellow/30 {{ request()->routeIs('cashier.*') ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow-md font-bold' : 'bg-brand-yellow/10 text-brand-gold hover:bg-brand-yellow/20' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-cash-register w-5 text-center text-base text-brand-gold {{ request()->routeIs('cashier.*') ? '!text-brand-dark' : '' }}"></i>
                        <span>كاشير وفواتير الوكالة</span>
                    </div>
                    <span class="text-[10px] bg-brand-yellow text-brand-dark font-black px-1.5 py-0.5 rounded shadow-sm">سريع</span>
                </a>
                @endif

                <!-- 7. CMS (Admin only) -->
                @if(Auth::user()->isAdmin())
                <div class="pt-3 px-3 pb-1 text-[11px] font-bold text-gray-400 uppercase tracking-wider">الإدارة والموقع</div>

                <a href="{{ route('cms.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('cms.*') ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow-md font-bold' : 'text-gray-300 hover:bg-brand-hover hover:text-white' }}">
                    <i class="fa-solid fa-sliders w-5 text-center text-base"></i>
                    <span>إدارة الموقع ومعرض الأعمال</span>
                </a>

                <a href="{{ route('users.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('users.*') ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow-md font-bold' : 'text-gray-300 hover:bg-brand-hover hover:text-white' }}">
                    <i class="fa-solid fa-user-shield w-5 text-center text-base"></i>
                    <span>فريق العمل وصناع المحتوى</span>
                </a>
                @endif

                <!-- Notifications Page Link -->
                <a href="{{ route('notifications.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('notifications.*') ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow-md font-bold' : 'text-gray-300 hover:bg-brand-hover hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-bell w-5 text-center text-base"></i>
                        <span>مركز الإشعارات</span>
                    </div>
                    <span x-show="unreadCount > 0" x-text="unreadCount" class="px-2 py-0.5 rounded-full text-xs font-black bg-rose-500 text-white"></span>
                </a>

                <div class="pt-4 border-t border-brand-border/60">
                    <a href="{{ route('home') }}" target="_blank"
                       class="flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-sm text-gray-300 hover:bg-brand-hover hover:text-brand-gold transition-all">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-globe w-5 text-center text-base"></i>
                            <span>عرض الموقع الخارجي</span>
                        </div>
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs text-gray-400"></i>
                    </a>
                </div>
            </nav>

            <!-- Bottom Logout Bar -->
            <div class="p-4 border-t border-brand-border bg-brand-dark/40">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 text-xs font-bold text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-xl border border-red-500/20 transition-colors">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>تسجيل الخروج</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <!-- Topbar Navigation -->
            <header class="bg-brand-purple/80 backdrop-blur-md border-b border-brand-border z-30 flex items-center justify-between px-4 lg:px-8 py-3.5">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-gray-400 hover:text-white rounded-lg hover:bg-brand-hover">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <div>
                        <h1 class="text-lg lg:text-xl font-bold text-white flex items-center gap-2.5">
                            @yield('page_title', 'لوحة إدارة الوكالة')
                        </h1>
                        <p class="text-xs text-gray-400 hidden sm:block">@yield('page_subtitle', 'نظام إدارة مشروعات ومهام شركة بريق للتسويق الإلكتروني')</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 sm:gap-3">
                    
                    <!-- PWA Quick Install Button (Mobile Only) -->
                    <button type="button" 
                            onclick="executePwaInstall()" 
                            class="inline-flex md:hidden items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-500/10 hover:bg-amber-500/20 text-brand-gold text-xs font-bold border border-brand-yellow/30 transition shadow" 
                            title="تثبيت منصة بريق كتطبيق على هاتفك">
                        <i class="fa-solid fa-mobile-screen-button text-brand-yellow"></i>
                        <span>تثبيت التطبيق</span>
                    </button>

                    <!-- Web Push Notification Enable Button -->
                    <button @click="requestNotificationPermission()" 
                            x-show="notificationPermission !== 'granted'" 
                            type="button" 
                            class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-brand-card hover:bg-brand-hover text-brand-gold text-xs font-bold border border-brand-yellow/30 transition shadow" 
                            title="تفعيل الإشعارات على الهاتف واللابتوب">
                        <i class="fa-solid fa-bell-ring animate-pulse text-brand-yellow"></i>
                        <span>تفعيل الإشعارات</span>
                    </button>

                    <!-- Notifications Dropdown -->
                    <div class="relative" x-data="{ notifOpen: false }">
                        <button @click="notifOpen = !notifOpen" 
                                class="relative p-2 rounded-xl bg-brand-card hover:bg-brand-hover text-gray-300 hover:text-white border border-brand-border transition">
                            <i class="fa-solid fa-bell text-base"></i>
                            <span x-show="unreadCount > 0" 
                                  x-text="unreadCount" 
                                  class="absolute -top-1 -right-1 px-1.5 py-0.5 text-[10px] font-black rounded-full bg-rose-500 text-white animate-bounce"></span>
                        </button>

                        <!-- Dropdown Panel -->
                        <div x-show="notifOpen" 
                             @click.away="notifOpen = false" 
                             x-transition 
                             class="absolute left-0 sm:left-auto sm:right-0 mt-2 w-80 sm:w-96 bg-brand-card border border-brand-border rounded-2xl shadow-2xl z-50 overflow-hidden" 
                             style="display: none;">
                            <div class="p-3.5 border-b border-brand-border flex items-center justify-between bg-brand-purple/60">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-bell text-brand-gold text-sm"></i>
                                    <span class="text-xs font-bold text-white">إشعارات النظام</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-brand-yellow/20 text-brand-gold" x-text="unreadCount + ' جديدة'"></span>
                                </div>
                                <form method="POST" action="{{ route('notifications.read-all') }}">
                                    @csrf
                                    <button type="submit" class="text-[11px] text-gray-400 hover:text-brand-gold transition">تحديد الكل كمقروء</button>
                                </form>
                            </div>

                            <div class="max-h-80 overflow-y-auto divide-y divide-brand-border/40">
                                <template x-for="item in notifications" :key="item.id">
                                    <a :href="item.action_url" class="block p-3 hover:bg-brand-hover transition" :class="item.is_read ? 'opacity-70' : 'bg-brand-purple/30'">
                                        <div class="flex items-start gap-3">
                                            <div class="w-7 h-7 rounded-lg bg-brand-yellow/20 text-brand-gold flex items-center justify-center text-xs shrink-0 mt-0.5">
                                                <i :class="'fa-solid fa-' + (item.icon || 'bell')"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="text-xs font-bold text-white truncate" x-text="item.title"></div>
                                                <div class="text-[11px] text-gray-300 mt-0.5 line-clamp-2" x-text="item.message"></div>
                                                <div class="text-[9px] text-gray-400 mt-1" x-text="item.time_ago"></div>
                                            </div>
                                        </div>
                                    </a>
                                </template>
                                <div x-show="notifications.length === 0" class="p-6 text-center text-gray-400 text-xs">
                                    لا توجد إشعارات جديدة حالياً.
                                </div>
                            </div>

                            <div class="p-2.5 border-t border-brand-border bg-brand-purple/40 text-center">
                                <a href="{{ route('notifications.index') }}" class="text-xs font-bold text-brand-gold hover:underline">عرض كافة الإشعارات</a>
                            </div>
                        </div>
                    </div>

                    @if(!Auth::user()->isEmployee())
                    <!-- Quick Cashier Shortcut -->
                    <a href="{{ route('cashier.index') }}" class="hidden sm:inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg bg-brand-yellow text-brand-dark font-black text-xs hover:bg-brand-gold transition shadow-md">
                        <i class="fa-solid fa-cash-register"></i>
                        <span>كاشير</span>
                    </a>
                    @endif

                    <!-- User Pill -->
                    <div class="flex items-center gap-3 pl-2 pr-3 py-1.5 rounded-full bg-brand-card border border-brand-border">
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-brand-amber to-brand-yellow text-brand-dark font-black flex items-center justify-center text-xs">
                            {{ mb_substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="hidden md:block text-right">
                            <div class="text-xs font-bold text-white">{{ Auth::user()->name }}</div>
                            <div class="text-[10px] text-brand-gold font-medium">{{ Auth::user()->job_title }}</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Alerts Banner -->
            <div class="px-4 lg:px-8 pt-4">
                @if(session('success'))
                <div class="p-4 mb-4 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 flex items-center justify-between text-sm shadow">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-emerald-400 text-lg"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
                </div>
                @endif

                @if(session('error'))
                <div class="p-4 mb-4 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-300 flex items-center justify-between text-sm shadow">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-rose-400 text-lg"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
                </div>
                @endif

                @if($errors->any())
                <div class="p-4 mb-4 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-sm shadow">
                    <div class="flex items-center gap-3 font-bold mb-1">
                        <i class="fa-solid fa-triangle-exclamation text-rose-400"></i>
                        <span>يرجى مراجعة الأخطاء التالية:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Page Content Body -->
            <main class="flex-1 overflow-y-auto px-4 lg:px-8 pb-10">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- PWA & Push Notifications Client Script -->
    <script>
        function pariqApp() {
            return {
                sidebarOpen: false,
                unreadCount: {{ Auth::user()->unreadNotificationsCount() }},
                notifications: [],
                notificationPermission: (typeof Notification !== 'undefined') ? Notification.permission : 'default',

                initApp() {
                    // 1. Register PWA Service Worker
                    if ('serviceWorker' in navigator) {
                        navigator.serviceWorker.register('/sw.js')
                            .then(reg => {
                                console.log('Pariq PWA ServiceWorker Registered successfully');
                            })
                            .catch(err => {
                                console.log('PWA ServiceWorker registration failed: ', err);
                            });
                    }

                    // 2. Fetch notifications initial feed
                    this.fetchNotifications();

                    // 3. Periodic Polling for real-time notifications (every 15s)
                    setInterval(() => {
                        this.fetchNotifications();
                    }, 15000);
                },

                fetchNotifications() {
                    fetch('/api/notifications/unread-feed')
                        .then(res => res.json())
                        .then(data => {
                            const prevCount = this.unreadCount;
                            this.unreadCount = data.count;
                            this.notifications = data.notifications;

                            // If new notification arrived
                            if (data.count > prevCount && prevCount >= 0) {
                                this.playNotificationSound();
                                if (data.notifications.length > 0) {
                                    const latest = data.notifications[0];
                                    this.showBrowserNotification(latest.title, latest.message, latest.action_url);
                                }
                            }
                        })
                        .catch(err => console.log('Notification feed error', err));
                },

                requestNotificationPermission() {
                    if (!('Notification' in window)) {
                        alert('متصفحك لا يدعم نظام إشعارات سطح المكتب.');
                        return;
                    }
                    Notification.requestPermission().then(permission => {
                        this.notificationPermission = permission;
                        if (permission === 'granted') {
                            new Notification('وكالة بريق للتسويق', {
                                body: 'تم تفعيل الإشعارات الفورية بنجاح على هذا الجهاز!',
                                icon: '/images/logo.png'
                            });
                        }
                    });
                },

                showBrowserNotification(title, message, url) {
                    if (typeof Notification !== 'undefined' && Notification.permission === 'granted') {
                        const notif = new Notification(title, {
                            body: message,
                            icon: '/images/logo.png',
                            data: { url: url }
                        });
                        notif.onclick = function() {
                            window.focus();
                            if (url && url !== '#') {
                                window.location.href = url;
                            }
                        };
                    }
                },

                playNotificationSound() {
                    try {
                        const ctx = new (window.AudioContext || window.webkitAudioContext)();
                        const osc = ctx.createOscillator();
                        const gain = ctx.createGain();
                        osc.connect(gain);
                        gain.connect(ctx.destination);
                        osc.frequency.setValueAtTime(587.33, ctx.currentTime); // D5
                        osc.frequency.setValueAtTime(880, ctx.currentTime + 0.1); // A5
                        gain.gain.setValueAtTime(0.1, ctx.currentTime);
                        gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.3);
                        osc.start();
                        osc.stop(ctx.currentTime + 0.3);
                    } catch(e) {}
                }
            }
        }
    </script>

    @stack('scripts')
    @include('partials.pwa-prompts')
</body>
</html>
