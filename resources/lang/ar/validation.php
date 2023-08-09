<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */


    'accepted'             => 'يجب قبول الحقل :attribute',
    'accepted_if'          => 'يجب قبول :attribute عندما تكون :other هي :value',
    'active_url'           => 'الحقل :attribute لا يُمثّل رابطًا صحيحًا',
    'after'                => 'يجب على الحقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date',
    'after_or_equal'       => 'الحقل :attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date',
    'alpha'                => 'يجب أن لا يحتوي الحقل :attribute سوى على حروف',
    'alpha_dash'           => 'يجب أن لا يحتوي الحقل :attribute على حروف، أرقام ومطّات',
    'alpha_num'            => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array'                => 'يجب أن يكون الحقل :attribute ًمصفوفة',
    'before'               => 'يجب على الحقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date',
    'before_or_equal'      => 'الحقل :attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max',
        'file'    => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
    ],
    'boolean'              => 'يجب أن تكون قيمة الحقل :attribute إما true أو false ',
    'confirmed'            => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'current_password'     => 'كلمة المرور غير صحيحة',
    'date'                 => 'الحقل :attribute ليس تاريخًا صحيحًا',
    'date_equals'          => 'يجب أن تكون :attribute تاريخ يساوي :date',
    'date_format'          => 'لا يتوافق الحقل :attribute مع الشكل :format',
    'different'            => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits'               => 'يجب أن يحتوي الحقل :attribute على :digits رقمًا/أرقام',
    'digits_between'       => 'يجب أن يحتوي الحقل :attribute بين :min و :max رقمًا/أرقام ',
    'dimensions'           => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة',
    'distinct'             => 'للحقل :attribute قيمة مُكرّرة',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
    'ends_with'            => 'يجب أن تنتهي :attribute بأحد ما يلي: :values',
    'exists'               => ':attribute المحدد غير صالح',
    'file'                 => 'الـ :attribute يجب أن يكون من ملفا',
    'filled'               => 'الحقل :attribute إجباري',
    'gt' => [
        'numeric' => 'يجب أن يكون :attribute أكبر من :value',
        'file' => 'يجب أن يكون :attribute أكبر من :value كيلو بايت',
        'string' => 'يجب أن يكون  :attribute أكبر من :value حرفًا',
        'array' => 'يجب أن تحتوي :attribute على أكثر من :value العناصر',
    ],
    'gte' => [
        'numeric' => 'يجب أن تكون :attribute أكبر من أو تساوي :value',
        'file' => 'يجب أن تكون :attribute أكبر من أو تساوي :value كيلو بايت',
        'string' => 'يجب أن تكون :attribute أكبر من أو تساوي :value حرفًا',
        'array' => 'يجب أن تحتوي :attribute على عناصر :value أو أكثر',
    ],
    'image'                => 'يجب أن يكون الحقل :attribute صورةً',
    'in'                   => 'الحقل :attribute لاغٍ',
    'in_array'             => 'الحقل :attribute غير موجود في :other',
    'integer'              => 'يجب أن يكون الحقل :attribute عددًا صحيحًا',
    'ip'                   => 'يجب أن يكون الحقل :attribute عنوان IP ذا بُنية صحيحة',
    'ipv4'                 => 'يجب أن يكون الحقل :attribute عنوان IPv4 ذا بنية صحيحة',
    'ipv6'                 => 'يجب أن يكون الحقل :attribute عنوان IPv6 ذا بنية صحيحة',
    'json'                 => 'يجب أن يكون الحقل :attribute نصا من نوع JSON',
    'lt' => [
        'numeric' => 'يجب أن تكون :attribute أقل من :value',
        'file' => 'يجب أن تكون :attribute أقل من :value كيلو بايت',
        'string' => 'يجب أن تكون :attribute أقل من :value حرفًا',
        'array' => 'يجب أن تحتوي :attribute على أقل من :value العناصر',
    ],
    'lte' => [
        'numeric' => 'يجب أن تكون :attribute أقل من أو تساوي :value',
        'file' => 'يجب أن تكون :attribute أقل من أو تساوي :value كيلو بايت',
        'string' => 'يجب أن تكون :attribute أقل من أو تساوي :value حرفًا',
        'array' => 'يجب ألا تحتوي :attribute على أكثر من :value عناصر ',
    ],
    'max'                  => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أصغر لـ :max',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'string'  => 'يجب أن لا يتجاوز طول نص :attribute :max حروفٍ/حرفًا',
        'array'   => 'يجب أن لا يحتوي الحقل :attribute على أكثر من :max عناصر/عنصر',
    ],
    'mimes'                => 'يجب أن يكون الحقل ملفًا من نوع : :values',
    'mimetypes'            => 'يجب أن يكون الحقل ملفًا من نوع : :values',
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أكبر لـ :min',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'string'  => 'يجب أن يكون طول نص :attribute على الأقل :min حروفٍ/حرفًا',
        'array'   => 'يجب أن يحتوي الحقل :attribute على الأقل على :min عُنصرًا/عناصر',
    ],
    'multiple_of' => 'يجب أن تكون :attribute مضاعف :value',
    'not_in'               => 'الحقل :attribute لاغٍ',
    'not_regex' => 'تنسيق :attribute غير صالح',
    'numeric'              => 'يجب على الحقل :attribute أن يكون رقمًا',
    'password' => 'كلمة المرور غير صحيحة',
    'present'              => 'يجب تقديم الحقل :attribute',
    'regex'                => 'صيغة الحقل :attribute غير صحيحة',
    'required'             => 'الحقل :attribute مطلوب',
    'required_if'          => 'الحقل :attribute مطلوب في حال ما إذا كان :other يساوي :value',
    'required_unless'      => 'الحقل :attribute مطلوب في حال ما لم يكن :other يساوي :values',
    'required_with'        => 'الحقل :attribute إذا توفّر :values',
    'required_with_all'    => 'الحقل :attribute إذا توفّر :values',
    'required_without'     => 'الحقل :attribute إذا لم يتوفّر :values',
    'required_without_all' => 'الحقل :attribute إذا لم يتوفّر :values',
    'prohibited' => 'حقل :attribute محظور',
    'prohibited_if' => 'حقل :attribute محظور عند :other هو :value',
    'prohibited_unless' => 'حقل :attribute محظور ما لم يكن :other في :values',
    'same'                 => 'يجب أن يتطابق الحقل :attribute مع :other',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية لـ :size',
        'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
        'string'  => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
        'array'   => 'يجب أن يحتوي الحقل :attribute على :size عنصرٍ/عناصر بالظبط',
    ],
    'starts_with' => 'يجب أن تبدأ :attribute بأحد ما يلي: :values',
    'string'               => 'يجب أن يكون الحقل :attribute نصآ',
    'timezone'             => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique'               => 'قيمة الحقل :attribute مُستخدمة من قبل',
    'uploaded'             => 'فشل في تحميل الـ :attribute',
    'url'                  => 'صيغة الرابط :attribute غير صحيحة',
    'uuid' => 'يجب أن تكون :attribute UUID صالحة',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'                  => 'الاسم',
        'username'              => 'اسم المُستخدم',
        'email'                 => 'البريد الالكتروني',
        'first_name'            => 'الاسم الأول',
        'last_name'             => 'الاسم الثاني',
        'password'              => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city'                  => 'المدينة',
        'country'               => 'الدولة',
        'address'               => 'العنوان',
        'phone'                 => 'الهاتف',
        'mobile'                => 'الجوال',
        'age'                   => 'العمر',
        'sex'                   => 'الجنس',
        'gender'                => 'النوع',
        'day'                   => 'اليوم',
        'month'                 => 'الشهر',
        'year'                  => 'السنة',
        'hour'                  => 'ساعة',
        'minute'                => 'دقيقة',
        'second'                => 'ثانية',
        'content'               => 'المُحتوى',
        'description'           => 'الوصف',
        'excerpt'               => 'المُلخص',
        'date'                  => 'التاريخ',
        'time'                  => 'الوقت',
        'available'             => 'مُتاح',
        'size'                  => 'الحجم',
        'price'                 => 'السعر',
        'desc'                  => 'نبذه',
        'title'                 => 'العنوان',
        'q'                     => 'البحث',
        'link'                  => ' ',
        'slug'                  => ' ',

        // -- Mohammed A. Alzard ---------
        'phone_or_email'                  => 'الجوال أو البريد الإلكتروني',

        // companies table
        'en.company_name' => 'اسم الشركة باللغة الإنجليزية',
        'ar.company_name' => 'اسم الشركة باللغة العربية',
        'category_id' => 'قسم',
        'avatar' => 'صورة',
        'position' => 'position',
        'nationality' => 'جنسية',
        'state' => 'الحالة',
        'email_verified_at' => 'تم التحقق في البريد الإلكتروني في ',
        'is_active' => 'مفعل؟',
        'logo' => 'الشعار',
        'about' => 'نبذة',
        'website' => 'الموقع الإلكتروني',
        'zip_code' => 'الرمز البريدي',
        'url_facebook' => 'رابط الفيسبوك',
        'url_twitter' => 'رابط تويتر',
        'url_instagram' => 'رابط انستغرام',
        'url_snapchat' => 'رابط سناب شات',
        'url_behance' => 'رابط بيهانس',
        'url_dribbble' => 'رابط دريبيل',
        'url_linkedin' => 'رابط لينكدان',
        'url_youtube' => 'رابط اليوتيوب',
        'url_whatsapp' => 'راب الواتساب',
        'url_vimeo' => 'رابط الفيمو',
        'url_rss' => 'رابط RSS',
        'phone_verified_at' => 'تم التحقق من الجوال في',
        'cr_number' => 'رقم السجل التجاري', // commercial register number
        'cr_image' => 'صورة السجل التجاري', // commercial register image
        'vat_number' => 'رقم الضريبة',
        'vat_certificate' => 'شهادة ضريبة القيمة المضافة',
        'vat' => 'ضريبة القيمة المضافة',
        'applies_vat' => 'يطبق ضريبة القيمة المضافة',
        'cover' => 'الغلاف',
        'tc_version_accepted' => 'الموافقة على الشروط والاحكام',
        'status' => 'الحالات',
        'referred_by_id' => 'نسب من قبل',
        'deleted_at' => 'تم حذفه في',
        // 'remember_token' => ' ',
        'created_at' => 'أنشئت في',
        'updated_at' => 'تم التحديث في',
        'other_phone' => 'الرقم الجديد',

        'company_id' => 'معرف الشركة',
        'uniqid' => 'معرف فريد',
        'open_24_hours' => 'مفتوحة 24 ساعة',
        'branch_no' => 'رقم الفرع',
        'branch_area' => 'منطقة الفرع',
        'url_google_map' => 'رابط خريطة جوجل',
        'longitude' => 'خط الطول',
        'latitude' => 'خط العرض',
        'manager' => 'مدير',

        'parent_id' => 'الأب',
        'personal_email' => 'البريد الإلكتروني الشخصي',

        'company_offers' => 'عروض الشركة',
        'companies' => 'شركات',
        'offer_type_id' => 'نوع العرض',
        'offer_types' => 'أنواع العروض',
        'currency_id' => 'عملة ',
        'currencies' => 'العملات',
        'offer_type' => 'نوع العرض',
        'DISCOUNT' => 'خصم',
        'discount_price' => 'سعر الخصم',
        'i_times' => 'I Times',
        'z_times' => 'Z Times',
        'y_price' => 'Y Price',
        'y_name' => 'Y Name',
        'y_name_en' => 'Y Name EN',
        'y_name_ar' => 'Y Name AR',
        'image' => 'صورة',
        'is_scheduled' => 'مجدولة',
        'start_date' => 'تاريخ البدء',
        'end_date' => 'تاريخ الانتهاء',
        'is_custom_hours' => 'ساعات مخصصة',
        'available_hours' => 'الساعات المتاحة',
        'options' => 'خيارات',
        'has_quantity' => 'لديه كمية',
        'quantity' => 'كمية',
        'has_promo_code' => 'لديه رمز ترويجي',
        'promo_code' => 'رمز ترويجي',
        'order_by' => 'ترتيب حسب',
        'branch_ids' => 'معرف الفروع',
        'all_branches' => 'الفروع',
        'en.title' => 'العنوان بالإنجليزي',
        'ar.title' => 'العنوان بالعربي',
        'DISCOUNT' => 'خصم',
        'working_hours' => 'ساعات العمل',
        'from1' => 'من',
        'to1' => 'إلى',
        'en.name' => 'الاسم إنجليزي',
        'ar.name' => 'الاسم عربي',

        'your_images' => 'صورك',
        'other_images' => 'صور الشريك',

    ],

];
