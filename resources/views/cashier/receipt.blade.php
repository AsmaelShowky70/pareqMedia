<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إيصال استلام نقدية رقم {{ $payment->receipt_number }} | وكالة بريق</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f8fafc; color: #1e293b; }
        @media print {
            .no-print { display: none !important; }
            body { background: #fff !important; padding: 0 !important; }
            .receipt-container { box-shadow: none !important; border: 1px solid #cbd5e1 !important; }
        }
    </style>
</head>
<body class="min-h-screen py-8 px-4 flex flex-col items-center justify-center">

    <!-- Top Action Buttons Bar -->
    <div class="w-full max-w-2xl mb-4 flex items-center justify-between no-print">
        <a href="{{ route('cashier.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-600 hover:text-gray-900 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-200">
            <i class="fa-solid fa-arrow-right"></i>
            <span>العودة للكاشير</span>
        </a>

        <div class="flex items-center gap-2">
            @if($payment->client && $payment->client->phone)
            @php
                $cleanPhone = preg_replace('/[^0-9]/', '', $payment->client->phone);
                $shareText = urlencode("مرحباً {$payment->client->name}، مرفق لحضرتك إيصال استلام دفعة من شركة بريق للتسويق الإلكتروني برقم {$payment->receipt_number} بمبلغ " . number_format($payment->amount) . " ج.م.\n\nطريقة الدفع: {$payment->payment_method_arabic}\nتاريخ المعاملة: {$payment->created_at->format('Y-m-d')}\n\nنشكركم لاختياركم وكالة بريق!");
            @endphp
            <a href="https://wa.me/{{ $cleanPhone }}?text={{ $shareText }}" target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                <span>مشاركة الإيصال على واتساب</span>
            </a>
            @endif

            <button onclick="window.print()" 
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-900 font-black text-xs shadow-md transition">
                <i class="fa-solid fa-print"></i>
                <span>طباعة الإيصال (PDF)</span>
            </button>
        </div>
    </div>

    <!-- Official Printable Receipt Container -->
    <div class="receipt-container w-full max-w-2xl bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-slate-200 relative overflow-hidden">
        
        <!-- Header Branding Bar -->
        <div class="flex items-center justify-between pb-6 border-b-2 border-slate-100">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="بريق" class="h-16 w-auto object-contain">
                <div>
                    <h1 class="text-2xl font-black text-purple-950">بريق للتسويق الإلكتروني</h1>
                    <p class="text-xs text-amber-600 font-bold">مفتاح نجاحك في التسويق</p>
                    <p class="text-[11px] text-slate-500 mt-0.5">تصوير • مونتاج • تصاميم • إعلانات ممولة • براندينج</p>
                </div>
            </div>

            <div class="text-left">
                <div class="inline-block px-3 py-1 bg-purple-50 text-purple-900 font-bold text-xs rounded-full border border-purple-200 mb-1">
                    إيصال قبض رسمي
                </div>
                <div class="text-xs text-slate-500">رقم الإيصال:</div>
                <div class="text-base font-black text-amber-600 font-mono">{{ $payment->receipt_number }}</div>
            </div>
        </div>

        <!-- Receipt Meta Details -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 py-5 border-b border-slate-100 text-xs">
            <div>
                <span class="text-slate-400 block">التاريخ والوقت:</span>
                <span class="font-bold text-slate-800">{{ $payment->created_at->format('Y-m-d') }}</span>
                <span class="text-[10px] text-slate-400 block">{{ $payment->created_at->format('h:i A') }}</span>
            </div>
            <div>
                <span class="text-slate-400 block">الموظف (الكاشير):</span>
                <span class="font-bold text-slate-800">{{ $payment->cashier->name ?? 'إدارة الحسابات' }}</span>
            </div>
            <div>
                <span class="text-slate-400 block">طريقة الدفع:</span>
                <span class="font-bold text-purple-900 bg-purple-100/70 px-2 py-0.5 rounded text-[11px]">
                    {{ $payment->payment_method_arabic }}
                </span>
            </div>
            <div>
                <span class="text-slate-400 block">نوع الدفعة:</span>
                <span class="font-bold text-slate-800">{{ $payment->payment_type_arabic }}</span>
            </div>
        </div>

        <!-- Received From (Client Card) -->
        <div class="py-5 border-b border-slate-100">
            <span class="text-xs text-slate-400 block mb-1 font-bold">استلمنا من السيد / السادة:</span>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <div>
                    <h3 class="text-base font-black text-slate-900">{{ $payment->client->name ?? 'عميل كريم' }}</h3>
                    @if($payment->client && $payment->client->brand_name)
                    <div class="text-xs text-amber-600 font-bold">البراند: {{ $payment->client->brand_name }}</div>
                    @endif
                </div>
                <div class="text-xs text-slate-600 sm:text-left">
                    <div>الدولة: <span class="font-bold text-slate-800">{{ $payment->client->country ?? 'مصر' }}</span></div>
                    <div>الهاتف: <span class="font-bold text-slate-800">{{ $payment->client->phone ?? '-' }}</span></div>
                </div>
            </div>
        </div>

        <!-- Payment Amount Box -->
        <div class="py-6 border-b border-slate-100 text-center bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl my-4 p-5 border border-amber-200/60">
            <div class="text-xs font-bold text-amber-800 mb-1">المبلغ المحصل نقداً / تحويلاً:</div>
            <div class="text-4xl font-black text-purple-950 font-mono tracking-tight">
                {{ number_format($payment->amount, 2) }} <span class="text-lg font-bold text-amber-600">جنيه مصري</span>
            </div>
            @if($payment->transaction_reference)
            <div class="mt-2 text-xs text-slate-600">
                رقم المعاملة / كود التحويل: <span class="font-mono font-bold text-slate-800">{{ $payment->transaction_reference }}</span>
            </div>
            @endif
        </div>

        <!-- Notes / For / Project -->
        <div class="py-4 space-y-2 text-xs text-slate-700">
            <div>
                <span class="font-bold text-slate-900">وذلك عن بيان: </span>
                <span class="text-slate-700">{{ $payment->notes ?? 'سداد خدمات تسويق إلكتروني وإنتاج مرئي من وكالة بريق' }}</span>
            </div>
            @if($payment->project)
            <div>
                <span class="font-bold text-slate-900">المشروع التابع: </span>
                <span class="text-purple-900 font-semibold">{{ $payment->project->title }}</span>
            </div>
            @endif
        </div>

        <!-- Footer / Signature & Stamp -->
        <div class="pt-8 mt-6 border-t-2 border-slate-100 flex items-end justify-between text-xs text-slate-500">
            <div class="text-right space-y-1">
                <div class="font-bold text-slate-800">شركة بريق للتسويق الإلكتروني</div>
                <div>الموقع الإلكتروني: <a href="https://www.pariqagency.com" class="text-amber-600 underline">pariqagency.com</a></div>
                <div>خدمة العملاء: +201062330838</div>
            </div>

            <div class="text-center">
                <div class="w-32 h-16 border-b border-dashed border-slate-400 flex items-center justify-center text-[10px] text-slate-400 mb-1">
                    [ الختم والتوقيع المعتمد ]
                </div>
                <div class="font-bold text-slate-700">توقيع المستلم</div>
            </div>
        </div>

    </div>

</body>
</html>
