<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Client;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Invoice;
use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;
use App\Models\Inventory;
use App\Models\Work;
use Carbon\Carbon;

use App\Models\Employee;

use Faker\Factory as Faker;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
           
            RolesTableSeeder::class,

        ]);

        $faker = Faker::create('ar_SA');
        // Admin user
        User::create([
            'name' => 'مدير النظام',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'visit_count' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Employee users
        foreach ([
            ['name' => 'أحمد محمد', 'email' => 'ahmed@example.com'],
            ['name' => 'فاطمة علي', 'email' => 'fatima@example.com'],
            ['name' => 'سارة خالد', 'email' => 'sara@example.com'],
        ] as $employee) {
            User::create([
                'name' => $employee['name'],
                'email' => $employee['email'],
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'visit_count' => $faker->numberBetween(0, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }








          $categories = [
            ['name' => 'العناية بالشعر', 'description' => 'خدمات تصفيف وقص الشعر'],
            ['name' => 'العناية بالبشرة', 'description' => 'خدمات تنظيف وترطيب البشرة'],
            ['name' => 'المكياج', 'description' => 'خدمات المكياج للمناسبات'],
            ['name' => 'العناية بالأظافر', 'description' => 'خدمات العناية بالأيدي والأقدام'],
        ];

        foreach ($categories as $category) {
            ServiceCategory::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }










         $categories = ServiceCategory::pluck('id')->toArray();

        $services = [
            [
                'name' => 'قص الشعر',
                'description' => 'قص شعر احترافي حسب الطلب',
                'price' => 50.00,
                'duration' => 30,
                'category_id' => $categories[0],
                'status' => 'active',
                'image' => 'website/img/services/1.jpg',
                'availability' => 'always',
                'target_audience' => 'النساء والرجال',
                'requirements' => 'لا يتطلب موعد مسبق',
                'featured' => true,
            ],
            [
                'name' => 'تنظيف البشرة العميق',
                'description' => 'تنظيف عميق للبشرة مع ترطيب',
                'price' => 100.00,
                'duration' => 60,
                'category_id' => $categories[1],
                'status' => 'active',
                'image' => 'website/img/services/2.jpg',
                'availability' => 'always',
                'target_audience' => 'النساء',
                'requirements' => 'يتطلب اختبار حساسية',
                'featured' => false,
            ],
            [
                'name' => 'مكياج العروس',
                'description' => 'مكياج احترافي للمناسبات الخاصة',
                'price' => 200.00,
                'duration' => 90,
                'category_id' => $categories[2],
                'status' => 'active',
                'image' => 'website/img/services/3.jpg',
                'availability' => 'on_demand',
                'target_audience' => 'النساء',
                'requirements' => 'يتطلب موعد مسبق',
                'featured' => true,
            ],
            [
                'name' => 'مانيكير وباديكير',
                'description' => 'العناية بالأظافر والأقدام',
                'price' => 40.00,
                'duration' => 45,
                'category_id' => $categories[3],
                'status' => 'active',
                'image' => 'website/img/services/4.jpg',
                'availability' => 'always',
                'target_audience' => 'النساء',
                'requirements' => null,
                'featured' => false,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }










        
        $clients = [
            [
                'name' => 'نورة عبدالله',
                'email' => 'noura@example.com',
                'phone' => '966501234567',
                'address' => 'الرياض، السعودية',
                'birth_date' => '1990-05-15',
                'gender' => 'female',
                'notes' => 'عميلة مميزة',
                'status' => 'active',
            ],
            [
                'name' => 'محمد خالد',
                'email' => 'mohammed@example.com',
                'phone' => '966501234568',
                'address' => 'جدة، السعودية',
                'birth_date' => '1985-08-22',
                'gender' => 'male',
                'notes' => null,
                'status' => 'active',
            ],
            [
                'name' => 'ليلى أحمد',
                'email' => 'layla@example.com',
                'phone' => '966501234569',
                'address' => 'الدمام، السعودية',
                'birth_date' => '1995-03-10',
                'gender' => 'female',
                'notes' => 'تفضل المواعيد المسائية',
                'status' => 'active',
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }









           $clients = Client::pluck('id')->toArray();
        $employees = Employee::pluck('id')->toArray();







        
        $inventories = [
            [
                'name' => 'شامبو مرطب',
                'description' => 'شامبو للعناية بالشعر الجاف',
                'quantity' => 50,
                'unit_price' => 20.00,
                'minimum_stock' => 10,
            ],
            [
                'name' => 'قناع الوجه',
                'description' => 'قناع مرطب لتنظيف البشرة',
                'quantity' => 30,
                'unit_price' => 15.00,
                'minimum_stock' => 5,
            ],
            [
                'name' => 'طلاء الأظافر',
                'description' => 'طلاء أظافر بألوان متنوعة',
                'quantity' => 100,
                'unit_price' => 5.00,
                'minimum_stock' => 20,
            ],
        ];

        foreach ($inventories as $inventory) {
            Inventory::create($inventory);
        }










           $services = Service::pluck('id')->toArray();
        $inventories = Inventory::pluck('id')->toArray();

        $serviceInventories = [
            [
                'service_id' => $services[0],
                'inventory_id' => $inventories[0],
                'quantity_used' => 1,
            ],
            [
                'service_id' => $services[1],
                'inventory_id' => $inventories[1],
                'quantity_used' => 2,
            ],
            [
                'service_id' => $services[3],
                'inventory_id' => $inventories[2],
                'quantity_used' => 1,
            ],
        ];

        foreach ($serviceInventories as $serviceInventory) {
            \DB::table('service_inventories')->insert($serviceInventory);
        }







          $offers = [
            [
                'name' => 'عرض الصيف',
                'description' => 'خصم 20% على خدمات العناية بالشعر',
                'discount_percentage' => 20.00,
                'start_date' => Carbon::today(),
                'end_date' => Carbon::today()->addMonths(1),
                'status' => 'active',
            ],
            [
                'name' => 'عرض العروس',
                'description' => 'باقة مكياج وعناية بالبشرة بخصم 30%',
                'discount_percentage' => 30.00,
                'start_date' => Carbon::today(),
                'end_date' => Carbon::today()->addMonths(2),
                'status' => 'active',
            ],
        ];

        foreach ($offers as $offer) {
            Offer::create($offer);
        }








            $offers = Offer::pluck('id')->toArray();
        $services = Service::pluck('id')->toArray();

        $offerServices = [
            [
                'offer_id' => $offers[0],
                'service_id' => $services[0],
            ],
            [
                'offer_id' => $offers[1],
                'service_id' => $services[2],
            ],
        ];

        foreach ($offerServices as $offerService) {
            \DB::table('offer_services')->insert($offerService);
        }







           $appointments = Appointment::pluck('id')->toArray();
        $clients = Client::pluck('id')->toArray();

        








           $appointments = Appointment::pluck('id')->toArray();
        $clients = Client::pluck('id')->toArray();







          $employees = Employee::pluck('id')->toArray();

     







           $users = User::pluck('id')->toArray();
        $clients = Client::pluck('id')->toArray();

        $notifications = [
            [
                'user_id' => $users[0],
                'client_id' => $clients[0],
                'title' => 'تأكيد موعد',
                'message' => 'تم تأكيد موعدك يوم غد الساعة 10:00 صباحًا',
                'type' => 'success',
                'status' => 'unread',
            ],
            [
                'user_id' => null,
                'client_id' => $clients[1],
                'title' => 'عرض جديد',
                'message' => 'استفد من عرض الصيف بخصم 20% على خدمات الشعر',
                'type' => 'info',
                'status' => 'unread',
            ],
            [
                'user_id' => $users[1],
                'client_id' => null,
                'title' => 'تحديث المخزون',
                'message' => 'المخزون لقناع الوجه أقل من الحد الأدنى',
                'type' => 'warning',
                'status' => 'unread',
            ],
        ];

        foreach ($notifications as $notification) {
            \DB::table('notifications')->insert($notification);
        }





        $works = [
            [
                'title' => 'تصفيف شعر العروس',
                'description' => 'تصفيف شعر احترافي للعرائس مع لمسات عصرية تناسب المناسبات الخاصة',
                'start_date' => now()->subDays(10)->format('Y-m-d'),
                'end_date' => now()->subDays(8)->format('Y-m-d'),
                'id_employee' => '',
                'main_image' => 'images/works/bridal_hair.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'مكياج المساء',
                'description' => 'مكياج مميز للمناسبات المسائية بألوان جذابة وثابتة طوال الليل',
                'start_date' => now()->subDays(5)->format('Y-m-d'),
                'end_date' => now()->subDays(3)->format('Y-m-d'),
                'id_employee' => '',
                'main_image' => 'images/works/evening_makeup.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'جلسة تنظيف البشرة',
                'description' => 'جلسة تنظيف عميق للبشرة مع ترطيب للحصول على بشرة نضرة وصحية',
                'start_date' => now()->subDays(2)->format('Y-m-d'),
                'end_date' => now()->subDays(1)->format('Y-m-d'),
                'id_employee' => '',
                'main_image' => 'images/works/skin_care.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

     






    }
}
