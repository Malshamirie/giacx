# تحديث أذونات المشاريع للمنظمة

## نظرة عامة
تم إضافة أذونات إدارة المشاريع للمنظمة (role_id = 3) في ملفات السيدر.

## التحديثات المضافة

### 1. في ملف SectionsTableSeeder.php
تم إضافة الأقسام التالية:

```php
// Organization Projects sections
$this->createPanelSection(['id' => 205], ['name' => 'panel_organization_projects', 'caption' => 'Organization Projects']);
$this->createPanelSection(['id' => 206], ['name' => 'panel_organization_projects_lists', 'section_group_id' => 205, 'caption' => 'Lists']);
$this->createPanelSection(['id' => 207], ['name' => 'panel_organization_projects_create', 'section_group_id' => 205, 'caption' => 'Create']);
$this->createPanelSection(['id' => 208], ['name' => 'panel_organization_projects_edit', 'section_group_id' => 205, 'caption' => 'Edit']);
$this->createPanelSection(['id' => 209], ['name' => 'panel_organization_projects_delete', 'section_group_id' => 205, 'caption' => 'Delete']);
```

### 2. في ملف PermissionsTableSeeder.php
تم إضافة الأذونات التالية:

```php
// Organization Projects 205 - 209
\App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100205], ['allow' => 1]); // panel_organization_projects
\App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100206], ['allow' => 1]); // panel_organization_projects_lists
\App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100207], ['allow' => 1]); // panel_organization_projects_create
\App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100208], ['allow' => 1]); // panel_organization_projects_edit
\App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100209], ['allow' => 1]); // panel_organization_projects_delete
```

## الأذونات المضافة

### أذونات مشاريع المنظمة (Organization Projects)
1. **`panel_organization_projects`** - إدارة مشاريع المنظمة
2. **`panel_organization_projects_lists`** - عرض قائمة مشاريع المنظمة
3. **`panel_organization_projects_create`** - إنشاء مشروع منظمة جديد
4. **`panel_organization_projects_edit`** - تعديل مشروع المنظمة
5. **`panel_organization_projects_delete`** - حذف مشروع المنظمة

## كيفية التشغيل

لتطبيق هذه التحديثات، قم بتشغيل الأوامر التالية:

```bash
# تشغيل سيدر الأقسام أولاً
php artisan db:seed --class=SectionsTableSeeder

# ثم تشغيل سيدر الأذونات
php artisan db:seed --class=PermissionsTableSeeder
```

أو لتشغيل جميع السيدرز:

```bash
php artisan db:seed
```

## التحقق من التطبيق

بعد تشغيل السيدر، يمكن التحقق من تطبيق الأذونات من خلال:

1. تسجيل الدخول بحساب منظمة
2. التحقق من ظهور قسم "مشاريع المنظمة" في القائمة الجانبية
3. التأكد من إمكانية:
   - عرض قائمة المشاريع
   - إنشاء مشروع جديد
   - تعديل المشاريع الموجودة
   - حذف المشاريع

## ملاحظات مهمة

1. تم استخدام `updateOrCreate` لضمان عدم تكرار الأذونات
2. جميع الأذونات تم تعيينها بـ `allow = 1` (مسموح)
3. تم إضافة تعليقات توضيحية لكل إذن
4. الأذونات تتطابق مع ما هو مستخدم في `ProjectController.php`
