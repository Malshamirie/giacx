# ربط أذونات المنظمة مع دور المنظمة

## نظرة عامة
تم تحديث ملف `database/seeders/PermissionsTableSeeder.php` لربط جميع الأذونات المتعلقة بالمنظمة مع دور المنظمة (role_id = 3).

## التحديثات المضافة

### 1. أذونات مديري المنظمة (Organization Instructors)
- `panel_organization_instructors` - إدارة المدربين
- `panel_organization_instructors_lists` - عرض قائمة المدربين
- `panel_organization_instructors_create` - إنشاء مدرب جديد
- `panel_organization_instructors_edit` - تعديل بيانات المدرب
- `panel_organization_instructors_delete` - حذف المدرب

### 2. أذونات طلاب المنظمة (Organization Students)
- `panel_organization_students` - إدارة الطلاب
- `panel_organization_students_lists` - عرض قائمة الطلاب
- `panel_organization_students_create` - إضافة طالب جديد
- `panel_organization_students_edit` - تعديل بيانات الطالب
- `panel_organization_students_delete` - حذف الطالب

### 3. أذونات الدورات التدريبية (Webinars)
- `panel_webinars` - إدارة الدورات التدريبية
- `panel_webinars_lists` - عرض قائمة الدورات
- `panel_webinars_create` - إنشاء دورة جديدة
- `panel_webinars_delete` - حذف الدورة
- `panel_webinars_learning_page` - صفحة التعلم
- `panel_webinars_invited_lists` - قائمة الدورات المدعوة
- `panel_webinars_organization_classes` - دورات المنظمة
- `panel_webinars_my_purchases` - مشترياتي
- `panel_webinars_my_class_comments` - تعليقات دوراتي
- `panel_webinars_comments` - التعليقات
- `panel_webinars_favorites` - المفضلة
- `panel_webinars_personal_course_notes` - الملاحظات الشخصية
- `panel_webinars_duplicate` - نسخ الدورة
- `panel_webinars_export_students_list` - تصدير قائمة الطلاب
- `panel_webinars_invoice` - الفواتير
- `panel_webinars_statistics` - الإحصائيات

### 4. أذونات الدورات القادمة (Upcoming Courses)
- `panel_upcoming_courses` - إدارة الدورات القادمة
- `panel_upcoming_courses_lists` - عرض قائمة الدورات القادمة
- `panel_upcoming_courses_create` - إنشاء دورة قادمة
- `panel_upcoming_courses_delete` - حذف الدورة القادمة
- `panel_upcoming_courses_followings` - المتابعات
- `panel_upcoming_courses_followers` - المتابعون

### 5. أذونات الحزم (Bundles)
- `panel_bundles` - إدارة الحزم
- `panel_bundles_lists` - عرض قائمة الحزم
- `panel_bundles_create` - إنشاء حزمة جديدة
- `panel_bundles_delete` - حذف الحزمة
- `panel_bundles_export_students_list` - تصدير قائمة الطلاب
- `panel_bundles_courses` - دورات الحزمة

### 6. أذونات الواجبات (Assignments)
- `panel_assignments` - إدارة الواجبات
- `panel_assignments_lists` - قائمة واجباتي
- `panel_assignments_my_courses_assignments` - واجبات دوراتي
- `panel_assignments_students` - واجبات الطلاب

### 7. أذونات الاجتماعات (Meetings)
- `panel_meetings` - إدارة الاجتماعات
- `panel_meetings_my_reservation` - حجوزاتي
- `panel_meetings_requests` - الطلبات
- `panel_meetings_settings` - الإعدادات

### 8. أذونات الاختبارات (Quizzes)
- `panel_quizzes` - إدارة الاختبارات
- `panel_quizzes_lists` - عرض قائمة الاختبارات
- `panel_quizzes_create` - إنشاء اختبار جديد
- `panel_quizzes_delete` - حذف الاختبار
- `panel_quizzes_results` - النتائج
- `panel_quizzes_my_results` - نتائجي
- `panel_quizzes_not_participated` - قائمة غير المشاركين

### 9. أذونات الشهادات (Certificates)
- `panel_certificates` - إدارة الشهادات
- `panel_certificates_lists` - عرض قائمة الشهادات
- `panel_certificates_achievements` - الإنجازات
- `panel_certificates_course_certificates` - شهادات الدورات

### 10. أذونات المنتجات (Products)
- `panel_products` - إدارة المنتجات
- `panel_products_lists` - عرض قائمة المنتجات
- `panel_products_create` - إنشاء منتج جديد
- `panel_products_delete` - حذف المنتج
- `panel_products_sales` - المبيعات
- `panel_products_purchases` - المشتريات
- `panel_products_comments` - التعليقات
- `panel_products_my_comments` - تعليقاتي

### 11. أذونات المالية (Financial)
- `panel_financial` - إدارة المالية
- `panel_financial_sales_reports` - تقارير المبيعات
- `panel_financial_summary` - الملخص المالي
- `panel_financial_payout` - المدفوعات
- `panel_financial_charge_account` - شحن الحساب
- `panel_financial_subscribes` - الاشتراكات
- `panel_financial_registration_packages` - حزم التسجيل
- `panel_financial_installments` - الأقساط

### 12. أذونات الدعم (Support)
- `panel_support` - إدارة الدعم
- `panel_support_lists` - عرض قائمة التذاكر
- `panel_support_create` - إنشاء تذكرة جديدة
- `panel_support_tickets` - التذاكر

### 13. أذونات التسويق (Marketing)
- `panel_marketing` - إدارة التسويق
- `panel_marketing_special_offers` - العروض الخاصة
- `panel_marketing_promotions` - الترويجات
- `panel_marketing_affiliates` - الشركاء
- `panel_marketing_registration_bonus` - مكافأة التسجيل
- `panel_marketing_coupons` - الكوبونات
- `panel_marketing_new_coupon` - إنشاء كوبون جديد
- `panel_marketing_delete_coupon` - حذف الكوبون

### 14. أذونات المنتديات (Forums)
- `panel_forums` - إدارة المنتديات
- `panel_forums_new_topic` - موضوع جديد
- `panel_forums_my_topics` - مواضيعي
- `panel_forums_my_posts` - مشاركاتي
- `panel_forums_bookmarks` - المفضلة

### 15. أذونات المدونة (Blog)
- `panel_blog` - إدارة المدونة
- `panel_blog_new_article` - مقال جديد
- `panel_blog_my_articles` - مقالاتي
- `panel_blog_delete_article` - حذف المقال
- `panel_blog_comments` - التعليقات

### 16. أذونات لوحة الإعلانات (Noticeboard)
- `panel_noticeboard` - إدارة لوحة الإعلانات
- `panel_noticeboard_history` - تاريخ الإعلانات
- `panel_noticeboard_create` - إنشاء إعلان جديد
- `panel_noticeboard_delete` - حذف الإعلان
- `panel_noticeboard_course_notices` - إعلانات الدورات
- `panel_noticeboard_course_notices_create` - إنشاء إعلان دورة

### 17. أذونات المكافآت (Rewards)
- `panel_rewards` - إدارة المكافآت
- `panel_rewards_lists` - عرض قائمة المكافآت

### 18. أذونات المحتوى الذكي (AI Contents)
- `panel_ai_contents` - إدارة المحتوى الذكي
- `panel_ai_contents_lists` - عرض قائمة المحتوى الذكي

### 19. أذونات الإشعارات (Notifications)
- `panel_notifications` - إدارة الإشعارات
- `panel_notifications_lists` - عرض قائمة الإشعارات

### 20. أذونات أخرى (Others)
- `panel_others` - إعدادات أخرى
- `panel_others_profile_setting` - إعدادات الملف الشخصي
- `panel_others_profile_url` - رابط الملف الشخصي
- `panel_others_logout` - تسجيل الخروج

### 21. أذونات مديري المنظمة (Organization Managers)
- `panel_organization_managers` - إدارة مديري المنظمة
- `panel_organization_managers_lists` - عرض قائمة المديرين
- `panel_organization_managers_create` - إنشاء مدير جديد
- `panel_organization_managers_edit` - تعديل بيانات المدير
- `panel_organization_managers_delete` - حذف المدير

### 22. أذونات المشاريع (Projects)
- `panel_projects` - إدارة المشاريع
- `panel_projects_lists` - عرض قائمة المشاريع
- `panel_projects_create` - إنشاء مشروع جديد
- `panel_projects_edit` - تعديل المشروع
- `panel_projects_delete` - حذف المشروع

### 23. أذونات مشاريع المنظمة (Organization Projects)
- `panel_organization_projects` - إدارة مشاريع المنظمة
- `panel_organization_projects_lists` - عرض قائمة مشاريع المنظمة
- `panel_organization_projects_create` - إنشاء مشروع منظمة جديد
- `panel_organization_projects_edit` - تعديل مشروع المنظمة
- `panel_organization_projects_delete` - حذف مشروع المنظمة

## كيفية التشغيل

لتطبيق هذه التحديثات، قم بتشغيل الأمر التالي:

```bash
php artisan db:seed --class=PermissionsTableSeeder
```

أو لتشغيل جميع السيدرز:

```bash
php artisan db:seed
```

## ملاحظات مهمة

1. جميع الأذونات تم ربطها مع دور المنظمة (role_id = 3)
2. تم استخدام `updateOrCreate` لضمان عدم تكرار الأذونات
3. جميع الأذونات تم تعيينها بـ `allow = 1` (مسموح)
4. تم إضافة تعليقات توضيحية لكل إذن لتسهيل الفهم والصيانة

## التحقق من التطبيق

بعد تشغيل السيدر، يمكن التحقق من تطبيق الأذونات من خلال:

1. تسجيل الدخول بحساب منظمة
2. التحقق من ظهور جميع الأقسام في القائمة الجانبية
3. التأكد من إمكانية الوصول لجميع الصفحات والوظائف
