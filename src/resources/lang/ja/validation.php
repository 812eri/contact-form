<?php

return [
    'required' => ':attributeを入力してください',
    'email' => ':attributeはメール形式で入力してください',
    'string' => ':attributeは文字列で入力してください',
    'max' => [
        'string' => ':attributeは:max文字以下で入力してください',
    ],
    'min' => [
        'string' => ':attributeは:min文字以上で入力してください',
    ],
    'unique' => 'この:attributeは既に使用されています',

    'attributes' => [
        'name' => 'お名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
    ],
];
