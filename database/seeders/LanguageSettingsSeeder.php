<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Translation\SettingTranslation;

class LanguageSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // إعدادات اللغات الأساسية
        $this->createBasicLanguageSettings();
        
        // إعدادات RTL
        $this->createRTLSettings();
        
        // إعدادات الترجمة
        $this->createTranslationSettings();
        
        // إعدادات واجهة المستخدم
        $this->createUISettings();
    }

    /**
     * إنشاء إعدادات اللغات الأساسية
     */
    private function createBasicLanguageSettings()
    {
        $basicLanguageSettings = [
            'site_language' => 'en',
            'user_languages' => ['en', 'ar'],
            'default_user_language' => 'en',
            'language_switcher_position' => 'header',
            'show_language_flag' => true,
            'language_detection' => true,
            'available_languages' => [
                'en' => [
                    'name' => 'English',
                    'native_name' => 'English',
                    'flag' => '🇺🇸',
                    'direction' => 'ltr',
                    'locale' => 'en',
                    'active' => true
                ],
                'ar' => [
                    'name' => 'Arabic',
                    'native_name' => 'العربية',
                    'flag' => '🇸🇦',
                    'direction' => 'rtl',
                    'locale' => 'ar',
                    'active' => true
                ]
            ]
        ];

        $this->createSetting('languages', $basicLanguageSettings);
    }

    /**
     * إنشاء إعدادات RTL
     */
    private function createRTLSettings()
    {
        $rtlSettings = [
            'rtl_languages' => ['ar'],
            'rtl_layout' => true,
            'rtl_auto_detect' => true,
            'rtl_font_family' => 'Cairo, Tahoma, Arial, sans-serif',
            'rtl_font_size' => 'medium',
            'rtl_line_height' => 1.8,
            'rtl_text_align' => 'right',
            'rtl_margin_direction' => 'right',
            'rtl_padding_direction' => 'right',
            'rtl_border_direction' => 'right',
            'rtl_float_direction' => 'right',
            'rtl_clear_direction' => 'right',
            'rtl_text_indent' => 'right',
            'rtl_unicode_bidi' => 'embed',
            'rtl_direction' => 'rtl'
        ];

        $this->createSetting('rtl', $rtlSettings);
    }

    /**
     * إنشاء إعدادات الترجمة
     */
    private function createTranslationSettings()
    {
        $translationSettings = [
            'content_translate' => true,
            'auto_translate' => false,
            'translation_provider' => 'manual',
            'translation_cache' => true,
            'translation_cache_duration' => 86400,
            'translation_memory' => true,
            'translation_quality' => 'high',
            'translation_glossary' => [
                'en' => [
                    'learning' => 'learning',
                    'education' => 'education',
                    'training' => 'training',
                    'course' => 'course',
                    'instructor' => 'instructor',
                    'student' => 'student',
                    'organization' => 'organization'
                ],
                'ar' => [
                    'learning' => 'تعلم',
                    'education' => 'تعليم',
                    'training' => 'تدريب',
                    'course' => 'دورة',
                    'instructor' => 'مدرب',
                    'student' => 'طالب',
                    'organization' => 'منظمة'
                ]
            ],
            'translation_auto_save' => true,
            'translation_review_required' => false,
            'translation_notifications' => true
        ];

        $this->createSetting('translation', $translationSettings);
    }

    /**
     * إنشاء إعدادات واجهة المستخدم
     */
    private function createUISettings()
    {
        $uiSettings = [
            'ui_language' => 'en',
            'ui_rtl_support' => true,
            'ui_font_family' => [
                'en' => 'Inter, Roboto, Arial, sans-serif',
                'ar' => 'Cairo, Tahoma, Arial, sans-serif'
            ],
            'ui_font_size' => [
                'en' => '14px',
                'ar' => '16px'
            ],
            'ui_line_height' => [
                'en' => 1.6,
                'ar' => 1.8
            ],
            'ui_text_align' => [
                'en' => 'left',
                'ar' => 'right'
            ],
            'ui_direction' => [
                'en' => 'ltr',
                'ar' => 'rtl'
            ],
            'ui_margin_start' => [
                'en' => 'margin-left',
                'ar' => 'margin-right'
            ],
            'ui_margin_end' => [
                'en' => 'margin-right',
                'ar' => 'margin-left'
            ],
            'ui_padding_start' => [
                'en' => 'padding-left',
                'ar' => 'padding-right'
            ],
            'ui_padding_end' => [
                'en' => 'padding-right',
                'ar' => 'padding-left'
            ],
            'ui_border_start' => [
                'en' => 'border-left',
                'ar' => 'border-right'
            ],
            'ui_border_end' => [
                'en' => 'border-right',
                'ar' => 'border-left'
            ],
            'ui_float' => [
                'en' => 'float-left',
                'ar' => 'float-right'
            ],
            'ui_clear' => [
                'en' => 'clear-left',
                'ar' => 'clear-right'
            ],
            'ui_text_indent' => [
                'en' => 'text-indent: 0',
                'ar' => 'text-indent: 0'
            ],
            'ui_unicode_bidi' => [
                'en' => 'unicode-bidi: normal',
                'ar' => 'unicode-bidi: embed'
            ]
        ];

        $this->createSetting('ui', $uiSettings);
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
