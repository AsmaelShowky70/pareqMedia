@extends('layouts.app')

@section('title', 'مركز إشعارات النظام')
@section('page_title', 'مركز إشعارات وتنبيهات المنصة')
@section('page_subtitle', 'سجل فوري بكافة الأنشطة والمهام والتسليمات والمدفوعات على منصة وكالة بريق')

@section('content')
<div class="space-y-6 pt-2">

    <!-- Top Action Bar -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-4 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-brand-yellow/20 text-brand-gold flex items-center justify-center text-lg">
                <i class="fa-solid fa-bell"></i>
            </div>
            <div>
                <h3 class="text-xs font-bold text-white">إشعارات الحساب المباشرة</h3>
                <p class="text-[11px] text-gray-400">إجمالي الإشعارات: {{ $notifications->total() }} إشعار</p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <form method="POST" action="{{ route('notifications.read-all') }}">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-xl bg-brand-purple hover:bg-brand-hover text-brand-gold text-xs font-bold border border-brand-border transition flex items-center gap-1.5">
                    <i class="fa-solid fa-check-double"></i>
                    <span>تحديد الكل كمقروء</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl overflow-hidden shadow-lg divide-y divide-brand-border/40">
        @forelse($notifications as $notif)
        <div class="p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-brand-hover/40 transition {{ $notif->is_read ? 'opacity-70' : 'bg-brand-purple/30' }}">
            
            <div class="flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-brand-yellow/15 text-brand-gold flex items-center justify-center text-base shrink-0 mt-0.5">
                    <i class="fa-solid fa-{{ $notif->icon ?? 'bell' }}"></i>
                </div>
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h4 class="text-sm font-bold text-white">{{ $notif->title }}</h4>
                        @if(!$notif->is_read)
                        <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-300 leading-relaxed">{{ $notif->message }}</p>
                    <span class="text-[10px] text-gray-400 block pt-0.5">{{ $notif->created_at->diffForHumans() }} ({{ $notif->created_at->format('Y-m-d H:i') }})</span>
                </div>
            </div>

            <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
                @if($notif->action_url)
                <a href="{{ $notif->action_url }}" class="px-3.5 py-1.5 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black text-xs transition">
                    عرض التفاصيل
                </a>
                @endif

                @if(!$notif->is_read)
                <form method="POST" action="{{ route('notifications.read', $notif->id) }}">
                    @csrf
                    <button type="submit" class="p-2 rounded-xl bg-brand-purple hover:bg-brand-hover text-gray-300 hover:text-white text-xs" title="تحديد كمقروء">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </form>
                @endif
            </div>

        </div>
        @empty
        <div class="p-12 text-center text-gray-400 text-xs">
            <i class="fa-solid fa-bell-slash text-2xl text-gray-500 mb-2 block"></i>
            لا توجد إشعارات مسجلة حتى الآن.
        </div>
        @endforelse
    </div>

    <div class="pt-2">
        {{ $notifications->links() }}
    </div>

</div>
@endsection

