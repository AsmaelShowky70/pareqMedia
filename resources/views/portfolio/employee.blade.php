@extends('layouts.app')

@section('title', 'سابقة أعمالي وإنجازاتي')
@section('page_title', 'معرض أعمالي وسجل إنجازاتي')
@section('page_subtitle', 'سجل المشروعات والمهام التي أنجزتها واعتمدتها وكالة بريق للتسويق')

@section('content')
<div class="space-y-6 pt-2">

    <!-- Top Portfolio Profile Card -->
    <div class="bg-gradient-to-r from-brand-card via-brand-purple to-brand-card border border-brand-border rounded-2xl p-6 shadow-xl relative overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-amber to-brand-yellow text-brand-dark font-black flex items-center justify-center text-2xl shadow-lg">
                    {{ mb_substr($user->name, 0, 1) }}
                </div>
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-black text-white">{{ $user->name }}</h2>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                            <i class="fa-solid fa-badge-check ml-1"></i>موظف معتمد
                        </span>
                    </div>
                    <p class="text-xs text-brand-gold font-bold">{{ $user->job_title ?? $user->department_name_arabic }}</p>
                    <p class="text-[11px] text-gray-400">عضو فريق عمل وكالة بريق للتسويق الإلكتروني</p>
                </div>
            </div>

            <!-- Stats Counts -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <div class="px-4 py-3 rounded-xl bg-brand-purple/80 border border-brand-border text-center">
                    <div class="text-[11px] text-gray-400">إجمالي الأعمال المنجزة</div>
                    <div class="text-2xl font-black text-white mt-0.5">{{ $totalCompleted }}</div>
                </div>
                <div class="px-4 py-3 rounded-xl bg-brand-purple/80 border border-brand-border text-center">
                    <div class="text-[11px] text-gray-400">فيديوهات وريلز</div>
                    <div class="text-2xl font-black text-indigo-400 mt-0.5">{{ $videoCount }}</div>
                </div>
                <div class="px-4 py-3 rounded-xl bg-brand-purple/80 border border-brand-border text-center">
                    <div class="text-[11px] text-gray-400">تصميمات وهوية</div>
                    <div class="text-2xl font-black text-amber-400 mt-0.5">{{ $designCount }}</div>
                </div>
                <div class="px-4 py-3 rounded-xl bg-brand-purple/80 border border-brand-border text-center">
                    <div class="text-[11px] text-gray-400">عملاء وشركاء</div>
                    <div class="text-2xl font-black text-emerald-400 mt-0.5">{{ $clientsCount }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Works Grid -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-folder-open text-brand-gold"></i>
                <span>الأعمال المعتمدة والمسلمة ({{ $completedTasks->total() }})</span>
            </h3>
            <span class="text-xs text-gray-400">يتم توثيق كل عمل برابط التسليم وتاريخ الاعتماد</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($completedTasks as $task)
            <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 hover:border-brand-yellow/50 transition flex flex-col justify-between space-y-4 group">
                <div class="space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-purple-500/15 text-purple-300 border border-purple-500/30">
                            {{ $task->department_arabic }}
                        </span>
                        <span class="text-[11px] text-gray-400">
                            {{ $task->completed_at ? $task->completed_at->format('Y-m-d') : ($task->delivery_deadline ? $task->delivery_deadline->format('Y-m-d') : 'مكتمل') }}
                        </span>
                    </div>

                    <div>
                        <h4 class="text-base font-bold text-white group-hover:text-brand-gold transition">{{ $task->title }}</h4>
                        @if($task->client)
                        <div class="text-xs text-brand-gold font-bold mt-1 flex items-center gap-1">
                            <i class="fa-solid fa-tag text-[10px]"></i>
                            <span>{{ $task->client->name }}</span>
                            @if($task->client->brand_name)
                            <span class="text-gray-400">({{ $task->client->brand_name }})</span>
                            @endif
                        </div>
                        @endif
                    </div>

                    @if($task->notes)
                    <div class="p-3 rounded-xl bg-brand-purple/50 border border-brand-border/40 text-xs text-gray-300">
                        {{ Str::limit($task->notes, 120) }}
                    </div>
                    @endif
                </div>

                <!-- Footer with Delivery Link -->
                <div class="pt-3 border-t border-brand-border/60 flex items-center justify-between">
                    <div class="flex items-center gap-1.5 text-[11px] text-emerald-400 font-bold">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>معتمد ومكتمل</span>
                    </div>

                    @if($task->delivery_link)
                    <a href="{{ $task->delivery_link }}" target="_blank" 
                       class="px-3.5 py-1.5 rounded-xl bg-brand-yellow/20 hover:bg-brand-yellow text-brand-gold hover:text-brand-dark font-black text-xs transition flex items-center gap-1.5">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        <span>معاينة العمل</span>
                    </a>
                    @else
                    <span class="text-xs text-gray-500">لا يوجد رابط</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-3 p-12 text-center text-gray-400 bg-brand-card/50 border border-brand-border rounded-2xl space-y-2">
                <i class="fa-solid fa-folder-open text-3xl text-gray-500"></i>
                <div class="text-sm font-bold text-white">لم تسلم أية أعمال بعد</div>
                <div class="text-xs text-gray-400">بمجرد إنجازك للمهام وتسليم روابطها، ستظهر في معرض أعمالك هنا تلقائياً.</div>
            </div>
            @endforelse
        </div>

        <div class="pt-2">
            {{ $completedTasks->links() }}
        </div>
    </div>

</div>
@endsection

