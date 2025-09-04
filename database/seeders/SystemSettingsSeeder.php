<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Translation\SettingTranslation;

class SystemSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // إعدادات عامة للنظام
        $this->createGeneralSettings();
        
        // إعدادات اللغات
        $this->createLanguageSettings();
        
        // إعدادات الترجمة
        $this->createTranslationSettings();
        
        // إعدادات التصميم
        $this->createDesignSettings();
        
        // إعدادات المنطقة الزمنية
        $this->createTimezoneSettings();
        
        // إعدادات التاريخ والوقت
        $this->createDateTimeSettings();
    }

    /**
     * إنشاء الإعدادات العامة
     */
    private function createGeneralSettings()
    {
        $generalSettings = [
            'site_name' => [
                'en' => 'GIACX Learning Platform',
                'ar' => 'منصة جياكس التعليمية'
            ],
            'site_email' => 'admin@giacx.com',
            'site_phone' => '+966500000000',
            'site_address' => [
                'en' => 'Riyadh, Saudi Arabia',
                'ar' => 'الرياض، المملكة العربية السعودية'
            ],
            'site_description' => [
                'en' => 'Advanced learning platform for organizations and individuals',
                'ar' => 'منصة تعليمية متقدمة للمنظمات والأفراد'
            ],
            'site_keywords' => [
                'en' => 'learning,education,training,courses,online learning',
                'ar' => 'تعليم,تدريب,دورات,تعلم إلكتروني,منصة تعليمية'
            ],
            'register_method' => 'mobile', // mobile, email, or both
            'maintenance_mode' => false,
            'maintenance_message' => [
                'en' => 'Site is under maintenance. Please try again later.',
                'ar' => 'الموقع تحت الصيانة. يرجى المحاولة مرة أخرى لاحقاً.'
            ]
        ];

        $this->createSetting('general', $generalSettings);
    }

    /**
     * إنشاء إعدادات اللغات
     */
    private function createLanguageSettings()
    {
        $languageSettings = [
            'site_language' => 'ar', // اللغة الافتراضية للموقع
            'user_languages' => ['en', 'ar'], // اللغات المتاحة للمستخدمين
            'rtl_languages' => ['ar'], // اللغات التي تدعم RTL
            'content_translate' => true, // تفعيل ترجمة المحتوى
            'auto_translate' => false, // الترجمة التلقائية
            'default_user_language' => 'ar', // اللغة الافتراضية للمستخدمين الجدد
            'language_switcher_position' => 'header', // موقع مبدل اللغة: header, footer, both
            'show_language_flag' => true, // إظهار أعلام اللغات
            'language_detection' => true // اكتشاف لغة المتصفح تلقائياً
        ];

        $this->createSetting('languages', $languageSettings);
    }

    /**
     * إنشاء إعدادات الترجمة
     */
    private function createTranslationSettings()
    {
        $translationSettings = [
            'translation_provider' => 'manual', // manual, google, deepl
            'google_translate_api_key' => '',
            'deepl_api_key' => '',
            'auto_translate_new_content' => false,
            'translation_quality' => 'high', // low, medium, high
            'translation_cache' => true,
            'translation_cache_duration' => 86400, // 24 hours in seconds
            'translation_memory' => true,
            'translation_glossary' => [
                'en' => [],
                'ar' => []
            ]
        ];

        $this->createSetting('translation', $translationSettings);
    }

    /**
     * إنشاء إعدادات التصميم
     */
    private function createDesignSettings()
    {
        $designSettings = [
            'rtl_layout' => true, // تفعيل التخطيط من اليمين لليسار
            'rtl_auto_detect' => true, // اكتشاف RTL تلقائياً حسب اللغة
            'theme_mode' => 'auto', // light, dark, auto
            'primary_color' => '#007bff',
            'secondary_color' => '#6c757d',
            'font_family' => [
                'en' => 'Inter, sans-serif',
                'ar' => 'Cairo, sans-serif'
            ],
            'font_size' => 'medium', // small, medium, large
            'line_height' => 1.6,
            'border_radius' => 'rounded', // none, small, rounded, large
            'animation_speed' => 'normal', // slow, normal, fast
            'show_animations' => true,
            'custom_css' => '',
            'custom_js' => ''
        ];

        $this->createSetting('design', $designSettings);
    }

    /**
     * إنشاء إعدادات المنطقة الزمنية
     */
    private function createTimezoneSettings()
    {
        $timezoneSettings = [
            'default_time_zone' => 'Asia/Riyadh',
            'timezone_detection' => true,
            'timezone_format' => 'UTC', // UTC, GMT, local
            'timezone_display' => 'name', // name, offset, both
            'timezone_list' => [
                'Asia/Riyadh' => 'Riyadh (GMT+3)',
                'Asia/Dubai' => 'Dubai (GMT+4)',
                'Asia/Kuwait' => 'Kuwait (GMT+3)',
                'Asia/Qatar' => 'Qatar (GMT+3)',
                'Asia/Bahrain' => 'Bahrain (GMT+3)',
                'Asia/Oman' => 'Oman (GMT+4)',
                'Asia/Amman' => 'Amman (GMT+3)',
                'Asia/Beirut' => 'Beirut (GMT+3)',
                'Asia/Damascus' => 'Damascus (GMT+3)',
                'Asia/Baghdad' => 'Baghdad (GMT+3)',
                'Asia/Cairo' => 'Cairo (GMT+2)',
                'Europe/London' => 'London (GMT+0)',
                'America/New_York' => 'New York (GMT-5)',
                'America/Los_Angeles' => 'Los Angeles (GMT-8)'
            ]
        ];

        $this->createSetting('timezone', $timezoneSettings);
    }

    /**
     * إنشاء إعدادات التاريخ والوقت
     */
    private function createDateTimeSettings()
    {
        $dateTimeSettings = [
            'date_format' => 'textual', // textual, numeric, custom
            'time_format' => '24_hours', // 12_hours, 24_hours
            'date_format_custom' => [
                'en' => 'F j, Y',
                'ar' => 'j F Y'
            ],
            'time_format_custom' => [
                'en' => 'H:i',
                'ar' => 'H:i'
            ],
            'week_start' => 'sunday', // sunday, monday
            'calendar_type' => 'gregorian', // gregorian, hijri
            'show_hijri_date' => false,
            'date_separator' => '/',
            'time_separator' => ':',
            'am_pm_labels' => [
                'en' => ['AM', 'PM'],
                'ar' => ['ص', 'م']
            ],
            'month_names' => [
                'en' => [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ],
                'ar' => [
                    'يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو',
                    'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
                ]
            ],
            'day_names' => [
                'en' => [
                    'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
                ],
                'ar' => [
                    'الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'
                ]
            ]
        ];

        $this->createSetting('datetime', $dateTimeSettings);
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

        // تجميع جميع القيم في مصفوفة واحدة
        $allValues = [];
        
        foreach ($values as $key => $value) {
            if (is_array($value) && isset($value['en']) && isset($value['ar'])) {
                // إذا كانت القيمة مصفوفة تحتوي على ترجمات
                foreach ($value as $locale => $translatedValue) {
                    if (!isset($allValues[$locale])) {
                        $allValues[$locale] = [];
                    }
                    $allValues[$locale][$key] = $translatedValue;
                }
            } else {
                // إذا كانت القيمة عادية (بدون ترجمة)
                if (!isset($allValues['en'])) {
                    $allValues['en'] = [];
                }
                $allValues['en'][$key] = $value;
            }
        }

        // إنشاء الترجمات
        foreach ($allValues as $locale => $localeValues) {
            SettingTranslation::updateOrCreate(
                [
                    'setting_id' => $setting->id,
                    'locale' => $locale,
                ],
                [
                    'value' => json_encode($localeValues)
                ]
            );
        }
    }
}
