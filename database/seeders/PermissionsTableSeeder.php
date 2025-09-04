<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dashboards 1 - 49
        \App\Models\Permission::updateOrCreate(['id' => 1], ['role_id' => 2, 'section_id' => 1, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 2], ['role_id' => 2, 'section_id' => 2, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 3], ['role_id' => 2, 'section_id' => 3, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 4], ['role_id' => 2, 'section_id' => 4, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 5], ['role_id' => 2, 'section_id' => 5, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 6], ['role_id' => 2, 'section_id' => 6, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 7], ['role_id' => 2, 'section_id' => 7, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 8], ['role_id' => 2, 'section_id' => 8, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 9], ['role_id' => 2, 'section_id' => 9, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 10], ['role_id' => 2, 'section_id' => 10, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 11], ['role_id' => 2, 'section_id' => 11, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 12], ['role_id' => 2, 'section_id' => 12, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 13], ['role_id' => 2, 'section_id' => 13, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 14], ['role_id' => 2, 'section_id' => 14, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 15], ['role_id' => 2, 'section_id' => 15, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 16], ['role_id' => 2, 'section_id' => 16, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 17], ['role_id' => 2, 'section_id' => 17, 'allow' => 1]);


        // Roles 50 - 99
        \App\Models\Permission::updateOrCreate(['id' => 50], ['role_id' => 2, 'section_id' => 50, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 51], ['role_id' => 2, 'section_id' => 51, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 52], ['role_id' => 2, 'section_id' => 52, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 53], ['role_id' => 2, 'section_id' => 53, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 54], ['role_id' => 2, 'section_id' => 54, 'allow' => 1]);

        // Users 100 - 149
        \App\Models\Permission::updateOrCreate(['id' => 100], ['role_id' => 2, 'section_id' => 100, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 101], ['role_id' => 2, 'section_id' => 101, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 102], ['role_id' => 2, 'section_id' => 102, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 103], ['role_id' => 2, 'section_id' => 103, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 104], ['role_id' => 2, 'section_id' => 104, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 105], ['role_id' => 2, 'section_id' => 105, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 106], ['role_id' => 2, 'section_id' => 106, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 107], ['role_id' => 2, 'section_id' => 107, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 108], ['role_id' => 2, 'section_id' => 108, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 109], ['role_id' => 2, 'section_id' => 109, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 110], ['role_id' => 2, 'section_id' => 110, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 111], ['role_id' => 2, 'section_id' => 111, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 112], ['role_id' => 2, 'section_id' => 112, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 113], ['role_id' => 2, 'section_id' => 113, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 114], ['role_id' => 2, 'section_id' => 114, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 115], ['role_id' => 2, 'section_id' => 115, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 116], ['role_id' => 2, 'section_id' => 116, 'allow' => 1]);

        // Webinar 150 - 199
        \App\Models\Permission::updateOrCreate(['id' => 150], ['role_id' => 2, 'section_id' => 150, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 151], ['role_id' => 2, 'section_id' => 151, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 152], ['role_id' => 2, 'section_id' => 152, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 153], ['role_id' => 2, 'section_id' => 153, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 154], ['role_id' => 2, 'section_id' => 154, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 155], ['role_id' => 2, 'section_id' => 155, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 156], ['role_id' => 2, 'section_id' => 156, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 157], ['role_id' => 2, 'section_id' => 157, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 158], ['role_id' => 2, 'section_id' => 158, 'allow' => 1]);

        // Categories 200 - 149
        \App\Models\Permission::updateOrCreate(['id' => 200], ['role_id' => 2, 'section_id' => 200, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 201], ['role_id' => 2, 'section_id' => 201, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 202], ['role_id' => 2, 'section_id' => 202, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 203], ['role_id' => 2, 'section_id' => 203, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 204], ['role_id' => 2, 'section_id' => 204, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 205], ['role_id' => 2, 'section_id' => 205, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 206], ['role_id' => 2, 'section_id' => 206, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 207], ['role_id' => 2, 'section_id' => 207, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 208], ['role_id' => 2, 'section_id' => 208, 'allow' => 1]);

        // tags 250 - 299
        \App\Models\Permission::updateOrCreate(['id' => 250], ['role_id' => 2, 'section_id' => 250, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 251], ['role_id' => 2, 'section_id' => 251, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 252], ['role_id' => 2, 'section_id' => 252, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 253], ['role_id' => 2, 'section_id' => 253, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 254], ['role_id' => 2, 'section_id' => 254, 'allow' => 1]);

        // Filters 300 - 349
        \App\Models\Permission::updateOrCreate(['id' => 300], ['role_id' => 2, 'section_id' => 300, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 301], ['role_id' => 2, 'section_id' => 301, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 302], ['role_id' => 2, 'section_id' => 302, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 303], ['role_id' => 2, 'section_id' => 303, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 304], ['role_id' => 2, 'section_id' => 304, 'allow' => 1]);

        // Quiz 350 - 399
        \App\Models\Permission::updateOrCreate(['id' => 350], ['role_id' => 2, 'section_id' => 350, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 351], ['role_id' => 2, 'section_id' => 351, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 352], ['role_id' => 2, 'section_id' => 352, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 353], ['role_id' => 2, 'section_id' => 353, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 354], ['role_id' => 2, 'section_id' => 354, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 355], ['role_id' => 2, 'section_id' => 355, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 356], ['role_id' => 2, 'section_id' => 356, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 357], ['role_id' => 2, 'section_id' => 357, 'allow' => 1]);

        // QuizResult 400 - 449
        \App\Models\Permission::updateOrCreate(['id' => 400], ['role_id' => 2, 'section_id' => 400, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 401], ['role_id' => 2, 'section_id' => 401, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 402], ['role_id' => 2, 'section_id' => 402, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 403], ['role_id' => 2, 'section_id' => 403, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 404], ['role_id' => 2, 'section_id' => 404, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 405], ['role_id' => 2, 'section_id' => 405, 'allow' => 1]);

        // Certificates 450 - 499
        \App\Models\Permission::updateOrCreate(['id' => 450], ['role_id' => 2, 'section_id' => 450, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 451], ['role_id' => 2, 'section_id' => 451, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 452], ['role_id' => 2, 'section_id' => 452, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 453], ['role_id' => 2, 'section_id' => 453, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 454], ['role_id' => 2, 'section_id' => 454, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 455], ['role_id' => 2, 'section_id' => 455, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 456], ['role_id' => 2, 'section_id' => 456, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 457], ['role_id' => 2, 'section_id' => 457, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 458], ['role_id' => 2, 'section_id' => 458, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 459], ['role_id' => 2, 'section_id' => 459, 'allow' => 1]);

        // Discount 500 - 549
        \App\Models\Permission::updateOrCreate(['id' => 500], ['role_id' => 2, 'section_id' => 500, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 501], ['role_id' => 2, 'section_id' => 501, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 502], ['role_id' => 2, 'section_id' => 502, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 503], ['role_id' => 2, 'section_id' => 503, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 504], ['role_id' => 2, 'section_id' => 504, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 505], ['role_id' => 2, 'section_id' => 505, 'allow' => 1]);

        // Group 550 - 599
        \App\Models\Permission::updateOrCreate(['id' => 550], ['role_id' => 2, 'section_id' => 550, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 551], ['role_id' => 2, 'section_id' => 551, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 552], ['role_id' => 2, 'section_id' => 552, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 553], ['role_id' => 2, 'section_id' => 553, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 554], ['role_id' => 2, 'section_id' => 554, 'allow' => 1]);

        // Payment Channels 600 - 649
        \App\Models\Permission::updateOrCreate(['id' => 600], ['role_id' => 2, 'section_id' => 600, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 601], ['role_id' => 2, 'section_id' => 601, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 602], ['role_id' => 2, 'section_id' => 602, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 603], ['role_id' => 2, 'section_id' => 603, 'allow' => 1]);

        // setting
        \App\Models\Permission::updateOrCreate(['id' => 650], ['role_id' => 2, 'section_id' => 650, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 651], ['role_id' => 2, 'section_id' => 651, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 652], ['role_id' => 2, 'section_id' => 652, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 653], ['role_id' => 2, 'section_id' => 653, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 654], ['role_id' => 2, 'section_id' => 654, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 655], ['role_id' => 2, 'section_id' => 655, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 656], ['role_id' => 2, 'section_id' => 656, 'allow' => 1]);

        // blog
        \App\Models\Permission::updateOrCreate(['id' => 700], ['role_id' => 2, 'section_id' => 700, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 701], ['role_id' => 2, 'section_id' => 701, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 702], ['role_id' => 2, 'section_id' => 702, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 703], ['role_id' => 2, 'section_id' => 703, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 704], ['role_id' => 2, 'section_id' => 704, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 705], ['role_id' => 2, 'section_id' => 705, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 706], ['role_id' => 2, 'section_id' => 706, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 707], ['role_id' => 2, 'section_id' => 707, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 708], ['role_id' => 2, 'section_id' => 708, 'allow' => 1]);

        // sales
        \App\Models\Permission::updateOrCreate(['id' => 750], ['role_id' => 2, 'section_id' => 750, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 751], ['role_id' => 2, 'section_id' => 751, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 752], ['role_id' => 2, 'section_id' => 752, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 753], ['role_id' => 2, 'section_id' => 753, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 754], ['role_id' => 2, 'section_id' => 754, 'allow' => 1]);

        // documents
        \App\Models\Permission::updateOrCreate(['id' => 800], ['role_id' => 2, 'section_id' => 800, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 801], ['role_id' => 2, 'section_id' => 801, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 802], ['role_id' => 2, 'section_id' => 802, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 803], ['role_id' => 2, 'section_id' => 803, 'allow' => 1]);

        // payouts
        \App\Models\Permission::updateOrCreate(['id' => 850], ['role_id' => 2, 'section_id' => 850, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 851], ['role_id' => 2, 'section_id' => 851, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 852], ['role_id' => 2, 'section_id' => 852, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 853], ['role_id' => 2, 'section_id' => 853, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 854], ['role_id' => 2, 'section_id' => 854, 'allow' => 1]);

        // offline payment
        \App\Models\Permission::updateOrCreate(['id' => 900], ['role_id' => 2, 'section_id' => 900, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 901], ['role_id' => 2, 'section_id' => 901, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 902], ['role_id' => 2, 'section_id' => 902, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 903], ['role_id' => 2, 'section_id' => 903, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 904], ['role_id' => 2, 'section_id' => 904, 'allow' => 1]);

        // supports 950 - 999
        \App\Models\Permission::updateOrCreate(['id' => 950], ['role_id' => 2, 'section_id' => 950, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 951], ['role_id' => 2, 'section_id' => 951, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 952], ['role_id' => 2, 'section_id' => 952, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 953], ['role_id' => 2, 'section_id' => 953, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 954], ['role_id' => 2, 'section_id' => 954, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 955], ['role_id' => 2, 'section_id' => 955, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 956], ['role_id' => 2, 'section_id' => 956, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 957], ['role_id' => 2, 'section_id' => 957, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 958], ['role_id' => 2, 'section_id' => 958, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 959], ['role_id' => 2, 'section_id' => 959, 'allow' => 1]);

        // Subscribes 1000 - 1049
        \App\Models\Permission::updateOrCreate(['id' => 1000], ['role_id' => 2, 'section_id' => 1000, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1001], ['role_id' => 2, 'section_id' => 1001, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1002], ['role_id' => 2, 'section_id' => 1002, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1003], ['role_id' => 2, 'section_id' => 1003, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1004], ['role_id' => 2, 'section_id' => 1004, 'allow' => 1]);

        // Notifications 1050 - 1074
        \App\Models\Permission::updateOrCreate(['id' => 1050], ['role_id' => 2, 'section_id' => 1050, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1051], ['role_id' => 2, 'section_id' => 1051, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1052], ['role_id' => 2, 'section_id' => 1052, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1053], ['role_id' => 2, 'section_id' => 1053, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1054], ['role_id' => 2, 'section_id' => 1054, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1055], ['role_id' => 2, 'section_id' => 1055, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1056], ['role_id' => 2, 'section_id' => 1056, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1057], ['role_id' => 2, 'section_id' => 1057, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1058], ['role_id' => 2, 'section_id' => 1058, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1059], ['role_id' => 2, 'section_id' => 1059, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1060], ['role_id' => 2, 'section_id' => 1060, 'allow' => 1]);

        // Noticeboards 1075 - 1099
        \App\Models\Permission::updateOrCreate(['id' => 1075], ['role_id' => 2, 'section_id' => 1075, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1076], ['role_id' => 2, 'section_id' => 1076, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1077], ['role_id' => 2, 'section_id' => 1077, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1078], ['role_id' => 2, 'section_id' => 1078, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1079], ['role_id' => 2, 'section_id' => 1079, 'allow' => 1]);

        // promotions 1100 - 1149
        \App\Models\Permission::updateOrCreate(['id' => 1100], ['role_id' => 2, 'section_id' => 1100, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1101], ['role_id' => 2, 'section_id' => 1101, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1102], ['role_id' => 2, 'section_id' => 1102, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1103], ['role_id' => 2, 'section_id' => 1103, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1104], ['role_id' => 2, 'section_id' => 1104, 'allow' => 1]);

        // testimonials 1150 - 1199
        \App\Models\Permission::updateOrCreate(['id' => 1150], ['role_id' => 2, 'section_id' => 1150, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1151], ['role_id' => 2, 'section_id' => 1151, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1152], ['role_id' => 2, 'section_id' => 1152, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1153], ['role_id' => 2, 'section_id' => 1153, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1154], ['role_id' => 2, 'section_id' => 1154, 'allow' => 1]);

        // admin_advertising 1200 - 1229
        \App\Models\Permission::updateOrCreate(['id' => 1200], ['role_id' => 2, 'section_id' => 1200, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1201], ['role_id' => 2, 'section_id' => 1201, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1202], ['role_id' => 2, 'section_id' => 1202, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1203], ['role_id' => 2, 'section_id' => 1203, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1204], ['role_id' => 2, 'section_id' => 1204, 'allow' => 1]);

        // admin newsletters 1230 - 1249
        \App\Models\Permission::updateOrCreate(['id' => 1230], ['role_id' => 2, 'section_id' => 1230, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1231], ['role_id' => 2, 'section_id' => 1231, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1232], ['role_id' => 2, 'section_id' => 1232, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1233], ['role_id' => 2, 'section_id' => 1233, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1234], ['role_id' => 2, 'section_id' => 1234, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1235], ['role_id' => 2, 'section_id' => 1235, 'allow' => 1]);

        // contact 1250 - 1299
        \App\Models\Permission::updateOrCreate(['id' => 1250], ['role_id' => 2, 'section_id' => 1250, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1251], ['role_id' => 2, 'section_id' => 1251, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1252], ['role_id' => 2, 'section_id' => 1252, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1253], ['role_id' => 2, 'section_id' => 1253, 'allow' => 1]);

        // special offers 1300 - 1349
        \App\Models\Permission::updateOrCreate(['id' => 1300], ['role_id' => 2, 'section_id' => 1300, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1301], ['role_id' => 2, 'section_id' => 1301, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1302], ['role_id' => 2, 'section_id' => 1302, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1303], ['role_id' => 2, 'section_id' => 1303, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1304], ['role_id' => 2, 'section_id' => 1304, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1305], ['role_id' => 2, 'section_id' => 1305, 'allow' => 1]);

        // pages 1350 - 1399
        \App\Models\Permission::updateOrCreate(['id' => 1350], ['role_id' => 2, 'section_id' => 1350, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1351], ['role_id' => 2, 'section_id' => 1351, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1352], ['role_id' => 2, 'section_id' => 1352, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1353], ['role_id' => 2, 'section_id' => 1353, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1354], ['role_id' => 2, 'section_id' => 1354, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1355], ['role_id' => 2, 'section_id' => 1355, 'allow' => 1]);

        // Comments 1400 - 1450
        \App\Models\Permission::updateOrCreate(['id' => 1400], ['role_id' => 2, 'section_id' => 1400, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1401], ['role_id' => 2, 'section_id' => 1401, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1402], ['role_id' => 2, 'section_id' => 1402, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1403], ['role_id' => 2, 'section_id' => 1403, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1404], ['role_id' => 2, 'section_id' => 1404, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1405], ['role_id' => 2, 'section_id' => 1405, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1406], ['role_id' => 2, 'section_id' => 1406, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1407], ['role_id' => 2, 'section_id' => 1407, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1408], ['role_id' => 2, 'section_id' => 1408, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1409], ['role_id' => 2, 'section_id' => 1409, 'allow' => 1]);

        // Reports 1400 - 1450
        \App\Models\Permission::updateOrCreate(['id' => 1450], ['role_id' => 2, 'section_id' => 1450, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1451], ['role_id' => 2, 'section_id' => 1451, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1452], ['role_id' => 2, 'section_id' => 1452, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1453], ['role_id' => 2, 'section_id' => 1453, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1454], ['role_id' => 2, 'section_id' => 1454, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1455], ['role_id' => 2, 'section_id' => 1455, 'allow' => 1]);

        // Additional Pages 1500 - 1549
        \App\Models\Permission::updateOrCreate(['id' => 1500], ['role_id' => 2, 'section_id' => 1500, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1501], ['role_id' => 2, 'section_id' => 1501, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1502], ['role_id' => 2, 'section_id' => 1502, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1503], ['role_id' => 2, 'section_id' => 1503, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1504], ['role_id' => 2, 'section_id' => 1504, 'allow' => 1]);

        // reviews Pages 1600 - 1649
        \App\Models\Permission::updateOrCreate(['id' => 1600], ['role_id' => 2, 'section_id' => 1600, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1601], ['role_id' => 2, 'section_id' => 1601, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1602], ['role_id' => 2, 'section_id' => 1602, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1603], ['role_id' => 2, 'section_id' => 1603, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1604], ['role_id' => 2, 'section_id' => 1604, 'allow' => 1]);

        // consultants Pages 1650 - 1674
        \App\Models\Permission::updateOrCreate(['id' => 1650], ['role_id' => 2, 'section_id' => 1650, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1651], ['role_id' => 2, 'section_id' => 1651, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1652], ['role_id' => 2, 'section_id' => 1652, 'allow' => 1]);

        // Referrals 1675 - 1699
        \App\Models\Permission::updateOrCreate(['id' => 1675], ['role_id' => 2, 'section_id' => 1675, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1676], ['role_id' => 2, 'section_id' => 1676, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1677], ['role_id' => 2, 'section_id' => 1677, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1678], ['role_id' => 2, 'section_id' => 1678, 'allow' => 1]);

        // agora history 1700 - 1724
        \App\Models\Permission::updateOrCreate(['id' => 1700], ['role_id' => 2, 'section_id' => 1700, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1701], ['role_id' => 2, 'section_id' => 1701, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1702], ['role_id' => 2, 'section_id' => 1702, 'allow' => 1]);

        // regions 1725 - 1749
        \App\Models\Permission::updateOrCreate(['id' => 1725], ['role_id' => 2, 'section_id' => 1725, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1726], ['role_id' => 2, 'section_id' => 1726, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1727], ['role_id' => 2, 'section_id' => 1727, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1728], ['role_id' => 2, 'section_id' => 1728, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1729], ['role_id' => 2, 'section_id' => 1729, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1730], ['role_id' => 2, 'section_id' => 1730, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1731], ['role_id' => 2, 'section_id' => 1731, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1732], ['role_id' => 2, 'section_id' => 1732, 'allow' => 1]);

        // Rewards 1750 - 1774
        \App\Models\Permission::updateOrCreate(['id' => 1750], ['role_id' => 2, 'section_id' => 1750, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1751], ['role_id' => 2, 'section_id' => 1751, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1752], ['role_id' => 2, 'section_id' => 1752, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1753], ['role_id' => 2, 'section_id' => 1753, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1754], ['role_id' => 2, 'section_id' => 1754, 'allow' => 1]);

        // Registration packages 1775 - 1799
        \App\Models\Permission::updateOrCreate(['id' => 1775], ['role_id' => 2, 'section_id' => 1775, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1776], ['role_id' => 2, 'section_id' => 1776, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1777], ['role_id' => 2, 'section_id' => 1777, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1778], ['role_id' => 2, 'section_id' => 1778, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1779], ['role_id' => 2, 'section_id' => 1779, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1780], ['role_id' => 2, 'section_id' => 1780, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 1781], ['role_id' => 2, 'section_id' => 1781, 'allow' => 1]);

        // Projects permissions for organizations (role_id = 3)
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100200], ['allow' => 1]); // panel_projects
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100201], ['allow' => 1]); // panel_projects_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100202], ['allow' => 1]); // panel_projects_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100203], ['allow' => 1]); // panel_projects_edit
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100204], ['allow' => 1]); // panel_projects_delete

        // Managers permissions for organizations (role_id = 3)
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 104005], ['allow' => 1]); // panel_organization_managers
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 104006], ['allow' => 1]); // panel_organization_managers_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 104007], ['allow' => 1]); // panel_organization_managers_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 104008], ['allow' => 1]); // panel_organization_managers_edit
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 104009], ['allow' => 1]); // panel_organization_managers_delete

        // Projects permissions for managers (role_id = 5)
        \App\Models\Permission::updateOrCreate(['role_id' => 5, 'section_id' => 100200], ['allow' => 1]); // panel_projects
        \App\Models\Permission::updateOrCreate(['role_id' => 5, 'section_id' => 100201], ['allow' => 1]); // panel_projects_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 5, 'section_id' => 100202], ['allow' => 1]); // panel_projects_create
        \App\Models\Permission::updateOrCreate(['role_id' => 5, 'section_id' => 100203], ['allow' => 1]); // panel_projects_edit
        \App\Models\Permission::updateOrCreate(['role_id' => 5, 'section_id' => 100204], ['allow' => 1]); // panel_projects_delete

        // Managers permissions for managers (role_id = 5)
        \App\Models\Permission::updateOrCreate(['role_id' => 5, 'section_id' => 104005], ['allow' => 1]); // panel_organization_managers
        \App\Models\Permission::updateOrCreate(['role_id' => 5, 'section_id' => 104006], ['allow' => 1]); // panel_organization_managers_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 5, 'section_id' => 104007], ['allow' => 1]); // panel_organization_managers_create
        \App\Models\Permission::updateOrCreate(['role_id' => 5, 'section_id' => 104008], ['allow' => 1]); // panel_organization_managers_edit
        \App\Models\Permission::updateOrCreate(['role_id' => 5, 'section_id' => 104009], ['allow' => 1]); // panel_organization_managers_delete

        // ========== ORGANIZATION PERMISSIONS (role_id = 3) ==========
        
        // Organization Instructors 1 - 9
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100001], ['allow' => 1]); // panel_organization_instructors
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100002], ['allow' => 1]); // panel_organization_instructors_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100003], ['allow' => 1]); // panel_organization_instructors_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100004], ['allow' => 1]); // panel_organization_instructors_edit
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100005], ['allow' => 1]); // panel_organization_instructors_delete

        // Organization Students 10 - 19
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100010], ['allow' => 1]); // panel_organization_students
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100011], ['allow' => 1]); // panel_organization_students_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100012], ['allow' => 1]); // panel_organization_students_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100013], ['allow' => 1]); // panel_organization_students_edit
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100014], ['allow' => 1]); // panel_organization_students_delete

        // Webinars 20 - 39
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100020], ['allow' => 1]); // panel_webinars
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100021], ['allow' => 1]); // panel_webinars_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100022], ['allow' => 1]); // panel_webinars_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100023], ['allow' => 1]); // panel_webinars_delete
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100024], ['allow' => 1]); // panel_webinars_learning_page
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100025], ['allow' => 1]); // panel_webinars_invited_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100026], ['allow' => 1]); // panel_webinars_organization_classes
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100027], ['allow' => 1]); // panel_webinars_my_purchases
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100028], ['allow' => 1]); // panel_webinars_my_class_comments
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100029], ['allow' => 1]); // panel_webinars_comments
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100030], ['allow' => 1]); // panel_webinars_favorites
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100031], ['allow' => 1]); // panel_webinars_personal_course_notes
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100032], ['allow' => 1]); // panel_webinars_duplicate
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100033], ['allow' => 1]); // panel_webinars_export_students_list
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100034], ['allow' => 1]); // panel_webinars_invoice
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100035], ['allow' => 1]); // panel_webinars_statistics

        // Upcoming Courses 40 - 49
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100040], ['allow' => 1]); // panel_upcoming_courses
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100041], ['allow' => 1]); // panel_upcoming_courses_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100042], ['allow' => 1]); // panel_upcoming_courses_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100043], ['allow' => 1]); // panel_upcoming_courses_delete
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100044], ['allow' => 1]); // panel_upcoming_courses_followings
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100045], ['allow' => 1]); // panel_upcoming_courses_followers

        // Bundles 50 - 59
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100050], ['allow' => 1]); // panel_bundles
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100051], ['allow' => 1]); // panel_bundles_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100052], ['allow' => 1]); // panel_bundles_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100053], ['allow' => 1]); // panel_bundles_delete
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100054], ['allow' => 1]); // panel_bundles_export_students_list
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100055], ['allow' => 1]); // panel_bundles_courses

        // Assignments 60 - 69
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100060], ['allow' => 1]); // panel_assignments
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100061], ['allow' => 1]); // panel_assignments_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100062], ['allow' => 1]); // panel_assignments_my_courses_assignments
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100063], ['allow' => 1]); // panel_assignments_students

        // Meetings 70 - 79
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100070], ['allow' => 1]); // panel_meetings
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100071], ['allow' => 1]); // panel_meetings_my_reservation
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100072], ['allow' => 1]); // panel_meetings_requests
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100073], ['allow' => 1]); // panel_meetings_settings

        // Quizzes 80 - 89
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100080], ['allow' => 1]); // panel_quizzes
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100081], ['allow' => 1]); // panel_quizzes_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100082], ['allow' => 1]); // panel_quizzes_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100083], ['allow' => 1]); // panel_quizzes_delete
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100084], ['allow' => 1]); // panel_quizzes_results
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100085], ['allow' => 1]); // panel_quizzes_my_results
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100086], ['allow' => 1]); // panel_quizzes_not_participated

        // Certificates 90 - 99
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100090], ['allow' => 1]); // panel_certificates
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100091], ['allow' => 1]); // panel_certificates_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100092], ['allow' => 1]); // panel_certificates_achievements
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100093], ['allow' => 1]); // panel_certificates_course_certificates

        // Products (Store) 100 - 119
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100100], ['allow' => 1]); // panel_products
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100101], ['allow' => 1]); // panel_products_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100102], ['allow' => 1]); // panel_products_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100103], ['allow' => 1]); // panel_products_delete
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100104], ['allow' => 1]); // panel_products_sales
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100105], ['allow' => 1]); // panel_products_purchases
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100106], ['allow' => 1]); // panel_products_comments
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100107], ['allow' => 1]); // panel_products_my_comments

        // Financial 120 - 139
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100120], ['allow' => 1]); // panel_financial
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100121], ['allow' => 1]); // panel_financial_sales_reports
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100122], ['allow' => 1]); // panel_financial_summary
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100123], ['allow' => 1]); // panel_financial_payout
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100124], ['allow' => 1]); // panel_financial_charge_account
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100125], ['allow' => 1]); // panel_financial_subscribes
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100126], ['allow' => 1]); // panel_financial_registration_packages
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100127], ['allow' => 1]); // panel_financial_installments

        // Support 140 - 159
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100140], ['allow' => 1]); // panel_support
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100141], ['allow' => 1]); // panel_support_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100142], ['allow' => 1]); // panel_support_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100143], ['allow' => 1]); // panel_support_tickets

        // Marketing 160 - 179
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100160], ['allow' => 1]); // panel_marketing
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100161], ['allow' => 1]); // panel_marketing_special_offers
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100162], ['allow' => 1]); // panel_marketing_promotions
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100163], ['allow' => 1]); // panel_marketing_affiliates
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100164], ['allow' => 1]); // panel_marketing_registration_bonus
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100165], ['allow' => 1]); // panel_marketing_coupons
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100166], ['allow' => 1]); // panel_marketing_new_coupon
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100167], ['allow' => 1]); // panel_marketing_delete_coupon

        // Forums 180 - 199
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100180], ['allow' => 1]); // panel_forums
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100181], ['allow' => 1]); // panel_forums_new_topic
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100182], ['allow' => 1]); // panel_forums_my_topics
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100183], ['allow' => 1]); // panel_forums_my_posts
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100184], ['allow' => 1]); // panel_forums_bookmarks

        // Blog 200 - 219
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100200], ['allow' => 1]); // panel_blog
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100201], ['allow' => 1]); // panel_blog_new_article
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100202], ['allow' => 1]); // panel_blog_my_articles
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100203], ['allow' => 1]); // panel_blog_delete_article
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100204], ['allow' => 1]); // panel_blog_comments

        // Noticeboard 220 - 239
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100220], ['allow' => 1]); // panel_noticeboard
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100221], ['allow' => 1]); // panel_noticeboard_history
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100222], ['allow' => 1]); // panel_noticeboard_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100223], ['allow' => 1]); // panel_noticeboard_delete
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100224], ['allow' => 1]); // panel_noticeboard_course_notices
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100225], ['allow' => 1]); // panel_noticeboard_course_notices_create

        // Rewards 240 - 259
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100240], ['allow' => 1]); // panel_rewards
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100241], ['allow' => 1]); // panel_rewards_lists

        // AI Contents 260 - 279
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100260], ['allow' => 1]); // panel_ai_contents
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100261], ['allow' => 1]); // panel_ai_contents_lists

        // Notifications 280 - 299
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100280], ['allow' => 1]); // panel_notifications
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100281], ['allow' => 1]); // panel_notifications_lists

        // Others 300 - 319
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100300], ['allow' => 1]); // panel_others
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100301], ['allow' => 1]); // panel_others_profile_setting
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100302], ['allow' => 1]); // panel_others_profile_url
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100303], ['allow' => 1]); // panel_others_logout

        // Organization Managers 4005 - 4009
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 104005], ['allow' => 1]); // panel_organization_managers
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 104006], ['allow' => 1]); // panel_organization_managers_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 104007], ['allow' => 1]); // panel_organization_managers_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 104008], ['allow' => 1]); // panel_organization_managers_edit
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 104009], ['allow' => 1]); // panel_organization_managers_delete

        // Projects 200 - 204
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100200], ['allow' => 1]); // panel_projects
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100201], ['allow' => 1]); // panel_projects_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100202], ['allow' => 1]); // panel_projects_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100203], ['allow' => 1]); // panel_projects_edit
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100204], ['allow' => 1]); // panel_projects_delete

        // Organization Projects 205 - 209
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100205], ['allow' => 1]); // panel_organization_projects
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100206], ['allow' => 1]); // panel_organization_projects_lists
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100207], ['allow' => 1]); // panel_organization_projects_create
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100208], ['allow' => 1]); // panel_organization_projects_edit
        \App\Models\Permission::updateOrCreate(['role_id' => 3, 'section_id' => 100209], ['allow' => 1]); // panel_organization_projects_delete

        // ========== END ORGANIZATION PERMISSIONS ==========
    }
}
