<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ResetForProduction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-for-production {--force : Force the operation to run in production}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'تفريغ قاعدة البيانات من كافة البيانات التجريبية وتهيئتها نظيفة تماماً للعميل مع الحسابات الأساسية والخزائن';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! $this->option('force') && ! $this->confirm('هل أنت متأكد من تفريغ كافة البيانات التجريبية وتجهيز قاعدة بيانات إنتاجية نظيفة للعميل؟')) {
            $this->info('تم إلغاء العملية.');
            return 0;
        }

        $this->warn('جاري إعادة ضبط الجداول وتنفيذ المهاجرات بالكامل...');
        Artisan::call('migrate:fresh', ['--force' => true]);
        $this->info(Artisan::output());

        $this->warn('جاري زرع البيانات المرجعية النظيفة (حسابات الإدارة، الخزائن، بنود الإكسيل الـ 17، خدمات الموقع)...');
        Artisan::call('db:seed', [
            '--class' => 'ProductionInitialSeeder',
            '--force' => true,
        ]);
        $this->info(Artisan::output());

        $this->newLine();
        $this->info('================================================================');
        $this->info('  تم تجهيز وتفريغ قاعدة البيانات بنجاح للنشر والإنتاج الفعلي!  ');
        $this->info('================================================================');
        $this->line('• الحساب الرئيسي: admin@pariqagency.com / كلمة المرور: password');
        $this->line('• بنود الحسابات: 17 بنداً مطابقاً تماماً لجدول الإكسيل المعتمد للوكالة');
        $this->line('• الخزائن المالية: انستاباي، فودافون كاش، بنك CIB، الخزينة النقدية');
        $this->line('• العملاء والمشاريع والمهام والفواتير: فارغة تماماً وجاهزة لإدخال العميل');

        return 0;
    }
}
