<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة وإيصال رسمي رقم {{ $payment->receipt_number }} | وكالة بريق</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- HTML2PDF library for pristine client-side PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f8fafc; color: #1e293b; }
        @media print {
            .no-print { display: none !important; }
            body { background: #fff !important; padding: 0 !important; }
            .receipt-container { box-shadow: none !important; border: 1px solid #cbd5e1 !important; margin: 0 auto; }
        }
        .stamp-circle {
            transform: rotate(-12deg);
        }
    </style>
</head>
<body class="min-h-screen py-8 px-4 flex flex-col items-center justify-center">

    @php
        $cleanPhone = '';
        if ($payment->client && $payment->client->phone) {
            $cleanPhone = preg_replace('/[^0-9]/', '', $payment->client->phone);
            if (str_starts_with($cleanPhone, '01') && strlen($cleanPhone) === 11) {
                $cleanPhone = '2' . $cleanPhone;
            }
        }
        $publicReceiptUrl = route('public.receipt', $payment->receipt_number);
    @endphp

    <!-- Top Action Buttons Bar -->
    <div class="w-full max-w-2xl mb-4 flex flex-wrap items-center justify-between gap-2 no-print">
        @if(auth()->check())
        <a href="{{ route('cashier.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-700 hover:text-gray-900 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-200 transition">
            <i class="fa-solid fa-arrow-right"></i>
            <span>العودة للكاشير</span>
        </a>
        @else
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-bold text-purple-900 hover:text-amber-600 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-200 transition">
            <i class="fa-solid fa-home"></i>
            <span>الموقع الرئيسي لوكالة بريق</span>
        </a>
        @endif

        <div class="flex flex-wrap items-center gap-2">
            <!-- 1. WhatsApp Share with PDF File -->
            <button id="btn-share-pdf" onclick="shareInvoicePDF()" 
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                <span id="btn-share-text">إرسال الفاتورة PDF للعميل</span>
            </button>

            <!-- 2. Direct PDF Download -->
            <button id="btn-download-pdf" onclick="downloadInvoicePDF()" 
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-l from-amber-500 to-amber-400 hover:brightness-105 text-slate-900 font-black text-xs shadow-md transition">
                <i class="fa-solid fa-file-pdf text-red-700 text-sm"></i>
                <span id="btn-download-text">تحميل ملف الفاتورة (PDF)</span>
            </button>

            <!-- 3. Standard Print -->
            <button onclick="window.print()" 
                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs border border-slate-300 transition" title="طباعة الورقية">
                <i class="fa-solid fa-print"></i>
                <span>طباعة</span>
            </button>
        </div>
    </div>

    <!-- Official Printable Receipt Container -->
    <div id="receipt-printable-area" class="receipt-container w-full max-w-2xl bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-slate-200 relative overflow-hidden">
        
        <!-- Subtle Watermark -->
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none select-none">
            <span class="text-8xl font-black text-slate-900 transform -rotate-45">PARIQ MEDIA</span>
        </div>

        <!-- Header Branding Bar -->
        <div class="flex items-center justify-between pb-6 border-b-2 border-slate-100 relative z-10">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="بريق" class="h-16 w-auto object-contain">
                <div>
                    <h1 class="text-2xl font-black text-purple-950">بريق للتسويق الإلكتروني</h1>
                    <p class="text-xs text-amber-600 font-bold">مفتاح نجاحك في التسويق والإنتاج الإبداعي</p>
                    <p class="text-[11px] text-slate-500 mt-0.5">تصوير • مونتاج • تصاميم • إعلانات ممولة • براندينج</p>
                </div>
            </div>

            <div class="text-left">
                <div class="inline-block px-3 py-1 bg-purple-50 text-purple-900 font-bold text-xs rounded-full border border-purple-200 mb-1">
                    فاتورة وسند قبض رسمي
                </div>
                <div class="text-xs text-slate-500">رقم الفاتورة / الإيصال:</div>
                <div class="text-base font-black text-amber-600 font-mono">{{ $payment->receipt_number }}</div>
            </div>
        </div>

        <!-- Receipt Meta Details -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 py-5 border-b border-slate-100 text-xs relative z-10">
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
        <div class="py-5 border-b border-slate-100 relative z-10">
            <span class="text-xs text-slate-400 block mb-1 font-bold">بيانات العميل / الطرف المستفيد:</span>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <div>
                    <h3 class="text-base font-black text-slate-900">{{ $payment->client->name ?? 'عميل كريم' }}</h3>
                    @if($payment->client && $payment->client->brand_name)
                    <div class="text-xs text-amber-600 font-bold">البراند / النشاط: {{ $payment->client->brand_name }}</div>
                    @endif
                </div>
                <div class="text-xs text-slate-600 sm:text-left">
                    <div>الدولة: <span class="font-bold text-slate-800">{{ $payment->client->country ?? 'مصر' }}</span></div>
                    <div>الهاتف: <span class="font-bold text-slate-800">{{ $payment->client->phone ?? '-' }}</span></div>
                </div>
            </div>
        </div>

        <!-- Payment Amount Box -->
        <div class="py-6 border-b border-slate-100 text-center bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl my-4 p-5 border border-amber-200/60 relative z-10">
            <div class="text-xs font-bold text-amber-800 mb-1">المبلغ الإجمالي المسدد والمثبت بالفاتورة:</div>
            <div class="text-4xl font-black text-purple-950 font-mono tracking-tight">
                {{ number_format($payment->amount, 2) }} <span class="text-lg font-bold text-amber-600">جنيه مصري</span>
            </div>
            @if($payment->transaction_reference)
            <div class="mt-2 text-xs text-slate-600">
                رقم المعاملة / كود التحويل البنكي: <span class="font-mono font-bold text-slate-800">{{ $payment->transaction_reference }}</span>
            </div>
            @endif
        </div>

        <!-- Notes / For / Project -->
        <div class="py-4 space-y-2 text-xs text-slate-700 relative z-10">
            <div>
                <span class="font-bold text-slate-900">بيان الخدمات المقدمة: </span>
                <span class="text-slate-700">{{ $payment->notes ?? 'سداد مستحقات خدمات تسويق إلكتروني وإنتاج مرئي من وكالة بريق' }}</span>
            </div>
            @if($payment->project)
            <div>
                <span class="font-bold text-slate-900">المشروع التابع: </span>
                <span class="text-purple-900 font-semibold">{{ $payment->project->title }}</span>
            </div>
            @endif
            @if($payment->invoice)
            <div>
                <span class="font-bold text-slate-900">مرجع الفاتورة المعتمدة: </span>
                <span class="text-amber-700 font-mono font-bold">#{{ $payment->invoice->invoice_number }}</span>
            </div>
            @endif
        </div>

        <!-- Footer / Signature & Certified Stamp -->
        <div class="pt-8 mt-6 border-t-2 border-slate-100 flex items-end justify-between text-xs text-slate-500 relative z-10">
            <div class="text-right space-y-1">
                <div class="font-bold text-slate-800">شركة بريق للتسويق الإلكتروني (Pariq Media Agency)</div>
                <div>الموقع الإلكتروني: <a href="https://plum-starling-777345.hostingersite.com" class="text-amber-600 underline font-semibold">pariqagency.com</a></div>
                <div>خدمة العملاء والدعم الفني: +201062330838</div>
                <div class="text-[10px] text-slate-400">وثيقة إلكترونية معتمدة صادرة من نظام الحسابات المركزي لوكالة بريق.</div>
            </div>

            <div class="text-center relative">
                <!-- Certified Stamp Graphic -->
                <div class="stamp-circle inline-flex flex-col items-center justify-center w-24 h-24 rounded-full border-2 border-emerald-600 bg-emerald-50/60 p-2 text-center shadow-inner">
                    <i class="fa-solid fa-stamp text-emerald-600 text-base mb-0.5"></i>
                    <span class="text-[9px] font-black text-emerald-800 leading-tight">معتمد ومدفوع</span>
                    <span class="text-[8px] font-bold text-emerald-700 font-mono">PAID</span>
                    <span class="text-[7px] text-slate-500">PARIQ AGENCY</span>
                </div>
                <div class="font-bold text-slate-700 text-[11px] mt-1">توقيع الإدارة المالية</div>
            </div>
        </div>

    </div>

    <!-- SCRIPT: HTML2PDF & Native WhatsApp PDF Sharing -->
    <script>
        function getPdfOptions() {
            return {
                margin: [8, 8, 8, 8],
                filename: 'فاتورة_بريق_{{ $payment->receipt_number }}.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, useCORS: true, letterRendering: true, logging: false },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
        }

        // 1. Download PDF to device
        function downloadInvoicePDF() {
            const btn = document.getElementById('btn-download-pdf');
            const textEl = document.getElementById('btn-download-text');
            const originalText = textEl.innerHTML;

            textEl.innerHTML = '<i class="fa-solid fa-spinner fa-spin ml-1"></i> جارٍ إنشاء PDF...';
            btn.disabled = true;

            const element = document.getElementById('receipt-printable-area');
            html2pdf().set(getPdfOptions()).from(element).save().then(() => {
                textEl.innerHTML = '<i class="fa-solid fa-circle-check text-emerald-700 ml-1"></i> تم التحميل بنجاح';
                setTimeout(() => {
                    textEl.innerHTML = originalText;
                    btn.disabled = false;
                }, 2500);
            }).catch(err => {
                console.error(err);
                textEl.innerHTML = originalText;
                btn.disabled = false;
                window.print();
            });
        }

        // 2. Share PDF File with Client (Web Share API with file attachment + WhatsApp fallback)
        async function shareInvoicePDF() {
            const btn = document.getElementById('btn-share-pdf');
            const textEl = document.getElementById('btn-share-text');
            const originalText = textEl.innerHTML;

            textEl.innerHTML = '<i class="fa-solid fa-spinner fa-spin ml-1"></i> جارٍ تجهيز ملف PDF...';
            btn.disabled = true;

            const element = document.getElementById('receipt-printable-area');
            const filename = 'فاتورة_بريق_{{ $payment->receipt_number }}.pdf';
            const opt = getPdfOptions();

            const clientPhone = '{{ $cleanPhone }}';
            const clientName = '{{ addslashes($payment->client?->name ?? "عميلنا العزيز") }}';
            const receiptNo = '{{ $payment->receipt_number }}';
            const amount = '{{ number_format($payment->amount) }}';
            const publicUrl = '{{ $publicReceiptUrl }}';

            const shareMessage = `مرحباً ${clientName}،\nمرفق لحضرتك ملف الفاتورة الرسمية بصيغة (PDF) وإيصال سداد الدفعة من وكالة بريق للتسويق الإلكتروني برقم ${receiptNo} بمبلغ ${amount} ج.م.\n\n📄 يمكنك أيضاً فتح وتحميل الفاتورة مباشرة من الرابط التالي:\n${publicUrl}\n\nنشكركم دائماً على ثقتكم الغالية بوكالة بريق!`;

            try {
                // Generate the actual PDF Blob in memory
                const worker = html2pdf().set(opt).from(element);
                const pdfBlob = await worker.output('blob');
                const pdfFile = new File([pdfBlob], filename, { type: 'application/pdf' });

                // Check if device supports sharing real files (Mobile Android Chrome / iOS Safari / Tablets)
                if (navigator.canShare && navigator.canShare({ files: [pdfFile] })) {
                    textEl.innerHTML = originalText;
                    btn.disabled = false;
                    await navigator.share({
                        files: [pdfFile],
                        title: `فاتورة رسمية رقم ${receiptNo} - وكالة بريق`,
                        text: shareMessage
                    });
                    return;
                }

                // Desktop / Unsupported Fallback:
                // Auto-download the PDF to computer/laptop so the admin has the file ready:
                const downloadUrl = URL.createObjectURL(pdfBlob);
                const a = document.createElement('a');
                a.href = downloadUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(downloadUrl);

                // Open WhatsApp with client phone and direct verification/download link
                const waUrl = clientPhone 
                    ? `https://wa.me/${clientPhone}?text=${encodeURIComponent(shareMessage)}`
                    : `https://wa.me/?text=${encodeURIComponent(shareMessage)}`;

                textEl.innerHTML = '<i class="fa-solid fa-circle-check text-emerald-300 ml-1"></i> تم تنزيل PDF وفتح واتساب!';
                setTimeout(() => {
                    textEl.innerHTML = originalText;
                    btn.disabled = false;
                }, 4000);

                window.open(waUrl, '_blank');

            } catch (err) {
                console.error('Sharing failed:', err);
                textEl.innerHTML = originalText;
                btn.disabled = false;
                // Fallback to direct WhatsApp link
                const waUrl = clientPhone 
                    ? `https://wa.me/${clientPhone}?text=${encodeURIComponent(shareMessage)}`
                    : `https://wa.me/?text=${encodeURIComponent(shareMessage)}`;
                window.open(waUrl, '_blank');
            }
        }
    </script>

</body>
</html>
