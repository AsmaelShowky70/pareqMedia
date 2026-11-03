<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ContentPlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContentPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@pariqagency.com')->first() ?? User::where('role', 'admin')->first();
        $sara = User::where('email', 'sara.creator@pariqagency.com')->first();
        $omar = User::where('email', 'omar.creator@pariqagency.com')->first();

        if (! $sara) {
            $sara = User::create([
                'name' => 'سارة الشريف',
                'email' => 'sara.creator@pariqagency.com',
                'password' => bcrypt('password'),
                'phone' => '+201022334455',
                'role' => User::ROLE_CONTENT_CREATOR,
                'department' => 'design',
                'job_title' => 'مديرة صناع المحتوى (Content Creator Lead)',
                'daily_quota' => 'إدارة خطط المحتوى وتوزيع المهام',
                'is_active' => true,
            ]);
        }

        if (! $omar) {
            $omar = User::create([
                'name' => 'عمر الناصر',
                'email' => 'omar.creator@pariqagency.com',
                'password' => bcrypt('password'),
                'phone' => '+201033445566',
                'role' => User::ROLE_CONTENT_CREATOR,
                'department' => 'video',
                'job_title' => 'صانع محتوى أول (Senior Content Creator)',
                'daily_quota' => 'إعداد السكريبتات ومتابعة ريلز السوشيال ميديا',
                'is_active' => true,
            ]);
        }

        // Try downloading latest CSV from Google Sheet, fallback to internal dataset if offline
        $csvUrl = 'https://docs.google.com/spreadsheets/d/1sKpBSC44ZoforsPATQr1bZ5dqgGTQ1aQ3ibs3lsD3Wc/export?format=csv&gid=177300749';
        $csvContent = @file_get_contents($csvUrl);

        $clientMap = [];
        $creators = [$sara->id, $omar->id];

        if ($csvContent) {
            $lines = explode("\n", $csvContent);
            $header = str_getcsv(array_shift($lines));

            $creatorIndex = 0;
            $count = 0;

            foreach ($lines as $line) {
                if (empty(trim($line))) {
                    continue;
                }
                $row = str_getcsv($line);
                if (count($row) < 3) {
                    continue;
                }

                $title = trim($row[0] ?? '');
                $sheetStatus = trim($row[1] ?? 'مكتملة');
                $clientName = trim($row[2] ?? '');
                $publishDateRaw = trim($row[3] ?? '');
                $deliveryDeadlineRaw = trim($row[4] ?? '');
                $contentUrl = trim($row[5] ?? '');
                $notes = trim($row[6] ?? '');

                if (empty($title) || empty($clientName)) {
                    continue;
                }

                // Normalize client name
                $cleanClient = preg_replace('/\s+/', ' ', $clientName);
                if (empty($cleanClient)) {
                    continue;
                }

                // Create or find client
                if (! isset($clientMap[$cleanClient])) {
                    $creatorForThisClient = $creators[$creatorIndex % 2];
                    $creatorIndex++;

                    $client = Client::firstOrCreate(
                        ['name' => $cleanClient],
                        [
                            'brand_name' => $cleanClient,
                            'phone' => '+2010'.rand(10000000, 99999999),
                            'country' => 'مصر',
                            'service_package' => 'باقة إدارة السوشيال ميديا والتسويق الشهري',
                            'monthly_retainer' => 15000.00,
                            'status' => 'active',
                            'notes' => 'عميل وكالة بريق من خطة النشر الشهرية',
                        ]
                    );
                    $clientMap[$cleanClient] = [
                        'id' => $client->id,
                        'creator_id' => $creatorForThisClient,
                    ];
                }

                $clientId = $clientMap[$cleanClient]['id'];
                $assignedCreatorId = $clientMap[$cleanClient]['creator_id'];

                // Parse Publish Date
                $publishDate = $this->parseDateString($publishDateRaw);
                if (! $publishDate) {
                    $publishDate = Carbon::today()->addDays(rand(1, 20));
                }

                // Parse Delivery Deadline
                $deliveryDeadline = $this->parseDateString($deliveryDeadlineRaw);

                // Detect Content Type
                $type = 'post';
                if (str_contains($title, 'ريل') || str_contains($title, 'استعراض') || str_contains($title, 'فيديو')) {
                    $type = 'reel';
                } elseif (str_contains($title, 'كاروسيل')) {
                    $type = 'carousel';
                } elseif (str_contains($title, 'ستوري')) {
                    $type = 'story';
                }

                // Map Sheet Status to our System
                $publishingStatus = 'scheduled';
                $productionStatus = 'ready_to_publish';
                $isPublished = false;
                $publishedAt = null;

                if ($sheetStatus === 'مكتملة') {
                    // Check if date is past: if past, marked as published. If future, ready_to_publish and scheduled!
                    if ($publishDate->isPast() || $publishDate->isToday()) {
                        $publishingStatus = 'published';
                        $productionStatus = 'ready_to_publish';
                        $isPublished = true;
                        $publishedAt = $publishDate->copy()->setTime(18, 0);
                    } else {
                        // Future date: Finished by editor but waiting for publishing date!
                        $publishingStatus = 'scheduled';
                        $productionStatus = 'ready_to_publish';
                        $isPublished = false;
                    }
                } elseif ($sheetStatus === 'مؤجل') {
                    $publishingStatus = 'postponed';
                    $productionStatus = 'ready_to_publish';
                } elseif ($sheetStatus === 'ملغية') {
                    $publishingStatus = 'cancelled';
                    $productionStatus = 'idea';
                } elseif ($sheetStatus === 'لم تبداء') {
                    $publishingStatus = 'scheduled';
                    $productionStatus = 'in_production';
                }

                ContentPlan::create([
                    'client_id' => $clientId,
                    'content_creator_id' => $assignedCreatorId,
                    'created_by' => $admin ? $admin->id : $assignedCreatorId,
                    'title' => $title,
                    'content_type' => $type,
                    'platforms' => ['instagram', 'facebook', 'tiktok'],
                    'publish_date' => $publishDate->format('Y-m-d'),
                    'publish_time' => '18:00',
                    'client_delivery_deadline' => $deliveryDeadline ? $deliveryDeadline->format('Y-m-d') : null,
                    'content_url' => ! empty($contentUrl) ? $contentUrl : null,
                    'caption' => "🎯 {$title}\n\nنقدم لكم في براند {$cleanClient} أفضل جودة وأقوى تجربة.\nشاركنا رأيك في التعليقات!\n\n#بريق #تسويق #محتوى_إبداعي",
                    'production_status' => $productionStatus,
                    'publishing_status' => $publishingStatus,
                    'is_published' => $isPublished,
                    'published_at' => $publishedAt,
                    'notes' => ! empty($notes) ? $notes : null,
                ]);

                $count++;
            }

            echo "Successfully seeded {$count} content plan records from Google Sheet!\n";
        }
    }

    /**
     * Helper to parse dates from various formats in the sheet
     */
    private function parseDateString(?string $raw): ?Carbon
    {
        if (empty($raw)) {
            return null;
        }

        // Clean out arabic morning/evening text e.g. "0:00:00 ص "
        $clean = preg_replace('/[^\d\/ \-:]/', '', $raw);
        $clean = trim($clean);

        // Try Y/m/d e.g. 2026/06/08
        if (preg_match('/(\d{4})\/(\d{1,2})\/(\d{1,2})/', $clean, $m)) {
            try {
                return Carbon::createFromDate((int) $m[1], (int) $m[2], (int) $m[3]);
            } catch (\Exception $e) {
            }
        }

        // Try d/m/Y
        if (preg_match('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', $clean, $m)) {
            try {
                return Carbon::createFromDate((int) $m[3], (int) $m[2], (int) $m[1]);
            } catch (\Exception $e) {
            }
        }

        try {
            return Carbon::parse($clean);
        } catch (\Exception $e) {
            return null;
        }
    }
}
