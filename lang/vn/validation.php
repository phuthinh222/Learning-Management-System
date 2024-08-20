<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

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
        'user_name' => [
            'required' => 'Bạn chưa nhập tên đăng nhập hoặc email',
            'regex' => 'Tên đăng nhập hoặc Email sai định dạng',
            'max' => 'Tên đăng nhập không được vượt quá :max ký tự'
        ],
        'password' => [
            'required' => 'Bạn chưa nhập mật khẩu',
            'regex' => 'Mật khẩu chứa ít nhất môt chữ cái viết hoa và môt chữ số',
            'confirmed' => 'Mật khẩu nhập lại chưa chính xác',
            'max' => 'Mật khẩu không được vượt quá :max ký tự'
        ],
        'name' => [
            'required' => 'Bạn chưa nhập họ tên',
            'regex' => 'Họ tên sai định dạng',
            'max' => 'Họ tên không được vượt quá :max ký tự'
        ],
        'user_name_register' => [
            'required' => 'Bạn chưa nhập tên đăng nhập',
            'regex' => 'Tên đăng nhập sai định dạng',
            'unique' => 'Tên đăng nhập đã tồn tại',
            'max' => 'Tên đăng nhập không được vượt quá :max ký tự'
        ],
        'email_address' => [
            'required' => 'Bạn chưa nhập địa chỉ Email',
            'regex' => 'Email sai định dạng',
            'unique' => 'Email đã tồn tại',
            'max' => 'Email dài không được vượt quá :max ký tự'
        ],
        'phone_number' => [
            'required' => 'Bạn chưa nhập số điện thoại',
            'regex' => 'Số điện thoại sai định dạng',
            'unique' => 'Số điện thoại đã tồn tại',
            'max' => 'Số điện thoại không được vượt quá :max ký tự'
        ],
        'date_of_birth' => [
            'required' => 'Bạn chưa nhập ngày sinh',
            'date_format' => 'Ngày sinh phải theo định dạng Y-m-d',
            'before' => 'Ngày sinh phải ít nhất 18 năm trước',
            'after' => 'Ngày sinh không được quá 70 năm trước',
        ],
        'address' => [
            'required' => 'Bạn chưa nhập địa chỉ',
            'max' => 'Địa chỉ không được vượt quá :max ký tự',
        ],
    ],

    'user_name' => [
        'required' => 'Bạn chưa nhập tên đăng nhập',
        'regex' => 'Tên đăng nhập sai định dạng',
        'unique' => 'Tên đăng nhập đã tồn tại'
    ],
    'update_student' => [
        'phone_number' => [
            'required' => 'Bạn chưa nhập số điện thoại',
            'regex' => 'Số điện thoại sai định dạng',
            'unique' => 'Số điện thoại đã tồn tại'
        ],
        'address' => [
            'required' => 'Bạn chưa nhập địa chỉ',
            'regex' => 'Địa chỉ sai định dạng',
            'max' => 'Địa chỉ vượt quá số lượng kí tự cho phép'
        ],
        'date_of_birth' => [
            'date' => 'Ngày sinh sai định dạng',
            'before' => 'Ngày sinh phải ít nhất 18 năm trước',
            'after' => 'Ngày sinh không được quá 70 năm trước',
        ]
    ],

    'teacher_department' => [
        'required' => 'Bạn chưa nhập Phòng Ban',
        'max' => 'Tên Phòng Ban quá dài',
        'regex' => 'Tên Phòng ban chứa các ký tự không hợp lệ'
    ],

    'teacher_phone_number' => [
        'required' => 'Bạn chưa nhập số điện thoại',
        'regex' => 'Số điện thoại sai định dạng',
        'unique' => 'Số điện thoại đã tồn tại',
        'max' => 'Số điện thoại quá dài'
    ],

    'teacher_date_of_birth' => [
        'date_format' => 'Ngày tháng năm sinh sai định dạng (YYYYY-MM-DD)',
        'before' => 'Chọn sai ngày tháng năm sinh',
        'after' => 'Chọn sai ngày tháng năm sinh',
    ],

    'teacher_name' => [
        'required' => 'Bạn chưa nhập họ và tên',
        'regex' => 'Họ và tên chứa các ký tự không hợp lệ',
        'max' => 'Họ tên quá dài',
    ],

    'teacher_position' => [
        'required' => 'Bạn chưa nhập vị trí làm việc',
        'max' => 'Tên vị trí quá dài',
        'regex' => 'Tên vị trí chứa các ký tự không hợp lệ'
    ],

    'teacher_address' => [
        'required' => 'Bạn chưa nhập địa chỉ',
        'max' => 'Địa chỉ quá dài'
    ],

    'teacher_certificate' => [
        'major' => [
            'required' => 'Bạn chưa nhập chuyên ngành',
            'max' => 'Tên chuyên ngành quá dài',
            'regex' => 'Tên chuyên ngành chứa các ký tự không hợp lệ'
        ],
        'level' => [
            'required' => 'Bạn chưa nhập cấp độ làm việc',
            'max' => 'Cấp độ làm việc quá dài',
            'regex' => 'Cấp độ làm việc chứa các ký tự không hợp lệ',
        ],
        'school_name' => [
            'required' => 'Bạn chưa nhập tên trường học',
            'max' => 'Tên trường học quá dài',
            'regex' => 'Tên trường học chứa các ký tự không hợp lệ'
        ],
        'certificate_image' => [
            'required' => 'Bạn chưa chọn ảnh minh chứng',
            'mimes' => 'Định dạng file không được hỗ trợ',
            'max' => 'Kích thước file quá lớn'
        ]
    ],

    'teacher_experiences' => [
        'company' => [
            'required' => 'Bạn chưa nhập tên công ty',
            'max' => 'Tên công ty quá dài',
            'regex' => 'Tên công ty chứa ký tự không hợp lệ'
        ],
        'position' => [
            'required' => 'Bạn chưa nhập vị trí',
            'max' => 'Vị trí quá dài',
            'regex' => 'Vị trí chứa ký tự không hợp lệ'
        ],
        'year' => [
            'required' => 'Bạn chưa nhập số năm kinh nghiệm',
            'min' => 'Số năm kinh nghiệm phải lớn hơn hoặc bằng 0',
            'max' => 'Số năm kinh nghiệm quá lớn',
            'numeric' => 'Số năm kinh nghiệm sai định dạng'
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
];
