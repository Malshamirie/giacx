<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Translation\SettingTranslation;

class BasicLanguageSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // إعدادات اللغات الأساسية
        $this->createBasicSettings();
    }

    /**
     * إنشاء الإعدادات الأساسية
     */
    private function createBasicSettings()
    {
        // إعدادات عامة
        $generalSettings = [
            'site_language' => 'ar',
            'user_languages' => ['en', 'ar'],
            'rtl_languages' => ['ar'],
            'content_translate' => true,
            'default_time_zone' => 'Asia/Riyadh',
            'date_format' => 'textual',
            'time_format' => '24_hours'
        ];

        $this->createSetting('general', $generalSettings);
    }

    /**
     * إنشاء إعداد في قاعدة البيانات
     */
    private function createSetting($name, $values)
    {
        // إنشاء الإعداد الأساسي
        $setting = Setting::updateOrCreate(
            ['name' => $name],
            [
                'page' => 'general',
                'updated_at' => time(),
            ]
        );

        // إنشاء الترجمة باللغة الإنجليزية
        SettingTranslation::updateOrCreate(
            [
                'setting_id' => $setting->id,
                'locale' => 'en',
            ],
            [
                'value' => json_encode($values)
            ]
        );
    }
}
