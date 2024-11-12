<?php
function DayMonthOnly($your_date)
{
    $months = array("Jan" => "يناير",
                     "Feb" => "فبراير",
                     "Mar" => "مارس",
                     "Apr" => "أبريل",
                     "May" => "مايو",
                     "Jun" => "يونيو",
                     "Jul" => "يوليو",
                     "Aug" => "أغسطس",
                     "Sep" => "سبتمبر",
                     "Oct" => "أكتوبر",
                     "Nov" => "نوفمبر",
                     "Dec" => "ديسمبر");
    //$your_date = date('y-m-d'); // The Current Date
    $en_month = date("M", strtotime($your_date));
    foreach ($months as $en => $ar) {
        if ($en == $en_month) { $ar_month = $ar; }
    }

    $find = array ("Sat", "Sun", "Mon", "Tue", "Wed" , "Thu", "Fri");
    $replace = array ("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
    $ar_day_format = date("D", strtotime($your_date)); // The Current Day
    $ar_day = str_replace($find, $replace, $ar_day_format);

    header('Content-Type: text/html; charset=utf-8');
    $standard = array("0","1","2","3","4","5","6","7","8","9");
    $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
    $current_date = $ar_day.' '.date('d', strtotime($your_date)).' '.$ar_month.' '.date('Y', strtotime($your_date));
    $arabic_date = str_replace($standard , $eastern_arabic_symbols , $current_date);

    return $arabic_date;
}
function arabicMonth($your_date)
{
    $months = array("Jan" => "يناير",
                     "Feb" => "فبراير",
                     "Mar" => "مارس",
                     "Apr" => "أبريل",
                     "May" => "مايو",
                     "Jun" => "يونيو",
                     "Jul" => "يوليو",
                     "Aug" => "أغسطس",
                     "Sep" => "سبتمبر",
                     "Oct" => "أكتوبر",
                     "Nov" => "نوفمبر",
                     "Dec" => "ديسمبر");
    //$your_date = date('y-m-d'); // The Current Date
    $en_month = date("M", strtotime($your_date));
    foreach ($months as $en => $ar) {
        if ($en == $en_month) { $ar_month = $ar; }
    }
    return $ar_month;
}
function getTime($time)
{
    $time = '';
    $time .= date('H:m',strtotime($time));
    $time .= date('a',strtotime($time)) == 'am' ? ' ص ' : 'م';
    return $time;
}

function panelLangMenu()
{
    $list = [];
    $locales = Config::get('app.locales');

    if (Session::get('Lang') != 'ar') {
        $list[] = [
            'flag' => 'sa',
            'text' => trans('common.lang1Name'),
            'lang' => 'ar'
        ];
    } else {
        $selected = [
            'flag' => 'sa',
            'text' => trans('common.lang1Name'),
            'lang' => 'ar'
        ];
    }
    if (Session::get('Lang') != 'en') {
        $list[] = [
            'flag' => 'us',
            'text' => trans('common.lang2Name'),
            'lang' => 'en'
        ];
    } else {
        $selected = [
            'flag' => 'us',
            'text' => trans('common.lang2Name'),
            'lang' => 'en'
        ];
    }

    return [
        'selected' => $selected,
        'list' => $list
    ];
}

function getCssFolder()
{
    return trans('common.cssFile');
}

function getRolesList($lang,$value,$guard = null)
{
    $list = [];
    if ($guard == null) {
        $roles = App\Models\roles::orderBy('name_'.$lang,'asc')->get();
    } else {
        $roles = App\Models\roles::where('guard',$guard)->orderBy('name_'.$lang,'asc')->get();
    }
    foreach ($roles as $role) {
        $list[$role[$value]] = $role['name_'.$lang] != '' ? $role['name_'.$lang] : $role['name_ar'];
    }
    return $list;
}

function messageSubjects($lang)
{
    $list = [
        'ar' => [
            [
                'id' => 'question',
                'name' => 'استفسار'
            ],
            [
                'id' => 'suggest',
                'name' => 'اقتراح'
            ],
            [
                'id' => 'request',
                'name' => 'طلب'
            ],
            [
                'id' => 'complaint',
                'name' => 'شكوى'
            ]
        ],
        'en' => [
            [
                'id' => 'question',
                'name' => 'question'
            ],
            [
                'id' => 'suggest',
                'name' => 'suggest'
            ],
            [
                'id' => 'request',
                'name' => 'request'
            ],
            [
                'id' => 'complaint',
                'name' => 'complaint'
            ]
        ],
        'fr' => [
            [
                'id' => 'question',
                'name' => 'question'
            ],
            [
                'id' => 'suggest',
                'name' => 'suggest'
            ],
            [
                'id' => 'request',
                'name' => 'request'
            ],
            [
                'id' => 'complaint',
                'name' => 'complaint'
            ]
        ]
    ];
    return $list[$lang];
}

function messageSubjectsList($lang)
{
    $list = [];
    foreach (messageSubjects($lang) as $key => $value) {
        $list[$value['id']] = $value['name'];
    }
    return $list;
}


function getSettingValue($key)
{
    $value = '';
    $setting = App\Models\Settings::where('key',$key)->first();
    if ($setting != '') {
        $value = $setting['value'];
    }
    return $value;
}

function getSettingImageLink($key)
{
    $link = '';
    $setting = App\Models\Settings::where('key',$key)->first();
    if ($setting != '') {
        if ($setting['value'] != '') {
            $link = asset('uploads/settings/'.$setting['value']);
        }
    }
    return $link;
}

function getSettingImageValue($key)
{
    $value = '';
    if (getSettingImageLink($key) != '') {
        $value .= '<div class="row"><div class="col-12">';
        $value .= '<span class="avatar mb-2">';
        $value .= '<img class="round" src="'.getSettingImageLink($key).'" alt="avatar" height="90" width="90">';
        $value .= '</span>';
        $value .= '</div>';
        $value .= '<div class="col-12">';
        $value .= '<a href="'.route('admin.settings.deletePhoto',['key'=>$key]).'"';
        $value .= ' class="btn btn-danger btn-sm">'.trans("common.delete").'</a>';
        $value .= '</div></div>';
    }
    return $value;
}

function supportHousingList($lang)
{
    $list = [
        'ar' => [
            'worthy' => 'مستحق',
            'not_worthy' => 'غير مستحق'
        ],
        'en' => [
            'worthy' => 'Worthy',
            'not_worthy' => 'Not Worthy'
        ]
    ];
    return $list[$lang];
}

function systemMainSections()
{
    $systemMainSections = [
        'settings' => 'settings',
        'users' => 'users',
        'roles' => 'roles',


        'FAQs' => 'FAQs',
        // 'managements' => 'managements',
        // 'jobs' => 'jobs',
        // 'userAccounts' => 'userAccounts',
        // 'attendance' => 'attendance',
        // 'projects' => 'projects',
        // 'units' => 'units',
        // 'clients' => 'clients',
        // 'contracts' => 'contracts',
        // 'followups' => 'followups',
        // 'reports' => 'reports',
        // 'homeStats' => 'homeStats',
    ];
    return $systemMainSections;
}

function getPermissions($role = null)
{

    $roleData = '';
    if ($role != null) {
        $roleData = App\Models\roles::find($role);
    }

    $permissionsArr = [];
    foreach (systemMainSections() as $section) {
        $permissionsArr[$section] = [
            'name' => trans('common.'.$section),
            'permissions' => []
        ];
        $settingPermissions = App\Models\permissions::where('group',$section)->get();
        foreach ($settingPermissions as $permission) {
            $hasIt = 0;
            if ($roleData != '') {
                if ($roleData->hasPermission($permission['id']) == 1) {
                    $hasIt = 1;
                }
            }
            $permissionsArr[$section]['permissions'][] = [
                'id' => $permission['id'],
                'can' => $permission['can'],
                'name' => $permission['name_'.session()->get('Lang')],
                'hasIt' => $hasIt
            ];
        }
    }
    return $permissionsArr;
}

function monthArray($lang)
{
    $arr = [
        'ar' => [
            '01' => '01 يناير',
            '02' => '02 فبراير',
            '03' => '03 مارس',
            '04' => '04 أبريل',
            '05' => '05 مايو',
            '06' => '06 يونيو',
            '07' => '07 يوليو',
            '08' => '08 أغسطس',
            '09' => '09 سبتمبر',
            '10' => '10 أكتوبر',
            '11' => '11 نوفمبر',
            '12' => '12 ديسمبر',
        ],
        'en' => [
            '01' => '01 يناير',
            '02' => '02 فبراير',
            '03' => '03 مارس',
            '04' => '04 أبريل',
            '05' => '05 مايو',
            '06' => '06 يونيو',
            '07' => '07 يوليو',
            '08' => '08 أغسطس',
            '09' => '09 سبتمبر',
            '10' => '10 أكتوبر',
            '11' => '11 نوفمبر',
            '12' => '12 ديسمبر',
        ]
    ];
    return $arr[$lang];
}
function yearArray()
{
    $cunrrentYear = date('Y');
    $firstYear = 2020;
    $arr = [];
    for ($i=$cunrrentYear; $i >= $firstYear; $i--) {
        $arr[$i] = $i;
    }
    return $arr;
}

function contractStatusList($lang = 'ar')
{
    $list = [
        'ar' => [
            'new' => 'جديد',
            'inProgress' => 'جاري العمل',
            'done' => 'تم الإنتهاء والتسليم',
            'cancel' => 'تم الإلغاء',
            'waitingDeliver' => 'فى انتظار التسليم',
            'onHold' => 'موقوف مؤقتاً'
        ],
        'en' => [
            'new' => 'جديد',
            'inProgress' => 'جاري العمل',
            'done' => 'تم الإنتهاء والتسليم',
            'cancel' => 'تم الإلغاء',
            'waitingDeliver' => 'فى انتظار التسليم',
            'onHold' => 'موقوف مؤقتاً'
        ]
    ];
    return $list[$lang];
}

function themeModeClasses()
{
    if (session()->get('theme_mode') == 'light') {
        $arr = [
            'html' => 'semi-dark-layout',
            'navbar' => 'navbar-light',
            'icon' => 'moon',
            'menu' => 'menu-dark'
        ];
    } else {
        $arr = [
            'html' => 'dark-layout',
            'navbar' => 'navbar-dark',
            'icon' => 'sun',
            'menu' => 'menu-dark'
        ];
    }
    return $arr;
}


