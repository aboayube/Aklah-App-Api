<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            //مقالات
            'category-index',
            'category-store',
            'category-edit',
            'category-update',
            'category-delete',
            //وصفات
            'wasfas-index',
            'wasfas-store',
            'wasfas-edit',
            'wasfas-update',
            'wasfas-delete',

            //تصنيفات
            'ratingreservation-index',
            'ratingreservation-store',
            'ratingreservation-edit',
            'ratingreservation-update',
            'ratingreservation-delete',
            'ratingreservation-show',



            //reservation
            'reservation-index',
            'reservation-store',
            'reservation-edit',
            'reservation-update',
            'reservation-delete',
            'reservation-show',
            'reservation-updateStatus',

            //اسئلة الشائعة
            /*   'faq-index',
            'faq-store',
            'faq-edit',
            'faq-update',
            'faq-delete', */
            //اطباء
            'chef-index',
            'chef-store',
            'chef-edit',
            'chef-update',
            'chef-delete',
            //مشرفين
            'supervisors-index',
            'supervisors-store',
            'supervisors-edit',
            'supervisors-update',
            'supervisors-delete',
            //مستخدمين
            'users-index',
            'users-store',
            'users-edit',
            'users-show',
            'users-update',
            'users-delete',
            //خدمات الموقع
            'services-index',
            'services-store',
            'services-edit',
            'services-update',
            'services-delete',
            'services-subscribeChif',
            // تعليقات المستخدمين
            'contactus-index',
            'contactus-create',
            'contactus-store',
            'contactus-delete',
            //اعدادات
            'settings-index',
            'settings-update',
            //صلاحيات
            'role-index',
            'role-store',
            'role-edit',
            'role-delete',
            //profile
            'profile',



            'wasfas-users',

            //rating
            'rating-index',
            'rating-create',
            'rating-store',
            'rating-rating',
            'rating-delete',


        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
