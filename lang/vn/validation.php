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
            'regex' => 'Tên đăng nhập hoặc Email sai định dạng'
        ],
        'password' => [
            'required' => 'Bạn chưa nhập mật khẩu',
            'regex' => 'Mật khẩu chứa ít nhất môt chữ cái viết hoa và môt chữ số',
            'confirmed' => 'Mật khẩu nhập lại chưa chính xác'
        ],
        'name' => [
            'required' => 'Bạn chưa nhập họ tên',
            'regex' => 'Họ tên sai định dạng',
        ],
        'user_name_register' => [
            'required' => 'Bạn chưa nhập tên đăng nhập',
            'regex' => 'Tên đăng nhập sai định dạng',
            'unique' => 'Tên đăng nhập đã tồn tại'
        ],
        'email_address' => [
            'required' => 'Bạn chưa nhập địa chỉ Email',
            'regex' => 'Email sai định dạng',
            'unique' => 'Email đã tồn tại'
        ],
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
