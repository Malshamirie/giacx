# إعدادات اللغات ودعم RTL للنظام

## نظرة عامة
تم إنشاء سيدرز لإعدادات النظام لدعم تعدد اللغات (العربية والإنجليزية) مع دعم كامل للـ RTL (Right-to-Left) للغة العربية.

## الملفات المنشأة

### 1. SystemSettingsSeeder.php
سيدر شامل لإعدادات النظام يتضمن:
- الإعدادات العامة للموقع
- إعدادات اللغات
- إعدادات الترجمة
- إعدادات التصميم
- إعدادات المنطقة الزمنية
- إعدادات التاريخ والوقت

### 2. LanguageSettingsSeeder.php
سيدر متخصص لإعدادات اللغات يتضمن:
- إعدادات اللغات الأساسية
- إعدادات RTL
- إعدادات الترجمة
- إعدادات واجهة المستخدم

## الإعدادات المضافة

### إعدادات اللغات الأساسية
```php
'site_language' => 'en', // اللغة الافتراضية للموقع
'user_languages' => ['en', 'ar'], // اللغات المتاحة للمستخدمين
'rtl_languages' => ['ar'], // اللغات التي تدعم RTL
'content_translate' => true, // تفعيل ترجمة المحتوى
'language_switcher_position' => 'header', // موقع مبدل اللغة
'show_language_flag' => true, // إظهار أعلام اللغات
'language_detection' => true // اكتشاف لغة المتصفح تلقائياً
```

### إعدادات RTL
```php
'rtl_languages' => ['ar'], // اللغات التي تدعم RTL
'rtl_layout' => true, // تفعيل التخطيط من اليمين لليسار
'rtl_auto_detect' => true, // اكتشاف RTL تلقائياً حسب اللغة
'rtl_font_family' => 'Cairo, Tahoma, Arial, sans-serif',
'rtl_font_size' => 'medium',
'rtl_line_height' => 1.8,
'rtl_text_align' => 'right',
'rtl_direction' => 'rtl'
```

### إعدادات الترجمة
```php
'content_translate' => true, // تفعيل ترجمة المحتوى
'auto_translate' => false, // الترجمة التلقائية
'translation_provider' => 'manual', // manual, google, deepl
'translation_cache' => true, // تخزين الترجمة مؤقتاً
'translation_memory' => true, // ذاكرة الترجمة
'translation_quality' => 'high' // جودة الترجمة
```

### إعدادات واجهة المستخدم
```php
'ui_font_family' => [
    'en' => 'Inter, Roboto, Arial, sans-serif',
    'ar' => 'Cairo, Tahoma, Arial, sans-serif'
],
'ui_font_size' => [
    'en' => '14px',
    'ar' => '16px'
],
'ui_text_align' => [
    'en' => 'left',
    'ar' => 'right'
],
'ui_direction' => [
    'en' => 'ltr',
    'ar' => 'rtl'
]
```

## كيفية التشغيل

### تشغيل سيدر إعدادات النظام الشامل
```bash
php artisan db:seed --class=SystemSettingsSeeder
```

### تشغيل سيدر إعدادات اللغات فقط
```bash
php artisan db:seed --class=LanguageSettingsSeeder
```

### تشغيل جميع السيدرز
```bash
php artisan db:seed
```

## التحقق من التطبيق

### 1. التحقق من الإعدادات في قاعدة البيانات
```sql
SELECT * FROM settings WHERE name IN ('general', 'languages', 'rtl', 'translation', 'ui');
SELECT * FROM setting_translations WHERE setting_id IN (SELECT id FROM settings WHERE name IN ('general', 'languages', 'rtl', 'translation', 'ui'));
```

### 2. التحقق من الإعدادات في الكود
```php
// الحصول على إعدادات اللغات
$languageSettings = getGeneralSettings('user_languages');
$rtlLanguages = getGeneralSettings('rtl_languages');

// التحقق من دعم RTL
$isRTL = in_array(app()->getLocale(), getGeneralSettings('rtl_languages') ?? []);
```

### 3. التحقق من واجهة المستخدم
- تسجيل الدخول للموقع
- التحقق من ظهور مبدل اللغة في الهيدر
- تغيير اللغة إلى العربية والتحقق من تطبيق RTL
- التحقق من تغيير اتجاه النص والتصميم

## الميزات المدعومة

### ✅ دعم اللغات
- العربية (RTL)
- الإنجليزية (LTR)
- إمكانية إضافة لغات أخرى

### ✅ دعم RTL
- تخطيط من اليمين لليسار للعربية
- اكتشاف تلقائي للـ RTL
- خطوط عربية مناسبة (Cairo)
- محاذاة النص للجهة اليمنى
- عكس اتجاه العناصر (الهامش، الحشو، الحدود)

### ✅ الترجمة
- ترجمة المحتوى
- ذاكرة الترجمة
- تخزين الترجمة مؤقتاً
- قاموس المصطلحات
- جودة عالية للترجمة

### ✅ واجهة المستخدم
- خطوط مناسبة لكل لغة
- أحجام خطوط محسنة
- ارتفاع سطر مناسب
- اتجاه نص صحيح
- دعم كامل للـ CSS RTL

## ملاحظات مهمة

1. **الخطوط العربية**: تم استخدام خط Cairo للعربية وهو خط مجاني ومتاح على Google Fonts
2. **الترجمة**: تم تفعيل الترجمة اليدوية، يمكن تفعيل الترجمة التلقائية لاحقاً
3. **الأداء**: تم تفعيل التخزين المؤقت للترجمة لتحسين الأداء
4. **التوافق**: جميع الإعدادات متوافقة مع النظام الحالي
5. **التخصيص**: يمكن تخصيص الإعدادات حسب الحاجة

## استكشاف الأخطاء

### مشكلة عدم ظهور مبدل اللغة
1. تأكد من تشغيل السيدر بنجاح
2. تحقق من إعدادات `user_languages` في قاعدة البيانات
3. تحقق من وجود ملفات الترجمة في مجلد `lang`

### مشكلة عدم تطبيق RTL
1. تأكد من إضافة اللغة العربية في `rtl_languages`
2. تحقق من إعدادات `rtl_layout` و `rtl_auto_detect`
3. تأكد من وجود ملفات CSS للـ RTL

### مشكلة الترجمة
1. تأكد من تفعيل `content_translate`
2. تحقق من وجود ملفات الترجمة
3. تحقق من إعدادات التخزين المؤقت

## التطوير المستقبلي

1. **إضافة لغات أخرى**: يمكن إضافة لغات أخرى مثل الفرنسية، الألمانية، إلخ
2. **تحسين الترجمة**: يمكن ربط خدمات الترجمة التلقائية مثل Google Translate
3. **تحسين الأداء**: يمكن تحسين أداء الترجمة والتخزين المؤقت
4. **واجهة إدارة**: يمكن إنشاء واجهة إدارة للإعدادات
