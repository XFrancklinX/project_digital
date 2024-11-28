<?php

#return [
#
#    /*
#    |--------------------------------------------------------------------------
#    | Validation Language Lines
#    |--------------------------------------------------------------------------
#    |
#    | The following language lines contain the default error messages used by
#    | the validator class. Some of these rules have multiple versions such
#    | as the size rules. Feel free to tweak each of these messages here.
#    |
#    */
#
#    'accepted' => 'The :attribute field must be accepted.',
#    'accepted_if' => 'The :attribute field must be accepted when :other is :value.',
#    'active_url' => 'The :attribute field must be a valid URL.',
#    'after' => 'The :attribute field must be a date after :date.',
#    'after_or_equal' => 'The :attribute field must be a date after or equal to :date.',
#    'alpha' => 'The :attribute field must only contain letters.',
#    'alpha_dash' => 'The :attribute field must only contain letters, numbers, dashes, and underscores.',
#    'alpha_num' => 'The :attribute field must only contain letters and numbers.',
#    'array' => 'The :attribute field must be an array.',
#    'ascii' => 'The :attribute field must only contain single-byte alphanumeric characters and symbols.',
#    'before' => 'The :attribute field must be a date before :date.',
#    'before_or_equal' => 'The :attribute field must be a date before or equal to :date.',
#    'between' => [
#        'array' => 'The :attribute field must have between :min and :max items.',
#        'file' => 'The :attribute field must be between :min and :max kilobytes.',
#        'numeric' => 'The :attribute field must be between :min and :max.',
#        'string' => 'The :attribute field must be between :min and :max characters.',
#    ],
#    'boolean' => 'The :attribute field must be true or false.',
#    'can' => 'The :attribute field contains an unauthorized value.',
#    'confirmed' => 'The :attribute field confirmation does not match.',
#    'contains' => 'The :attribute field is missing a required value.',
#    'current_password' => 'The password is incorrect.',
#    'date' => 'The :attribute field must be a valid date.',
#    'date_equals' => 'The :attribute field must be a date equal to :date.',
#    'date_format' => 'The :attribute field must match the format :format.',
#    'decimal' => 'The :attribute field must have :decimal decimal places.',
#    'declined' => 'The :attribute field must be declined.',
#    'declined_if' => 'The :attribute field must be declined when :other is :value.',
#    'different' => 'The :attribute field and :other must be different.',
#    'digits' => 'The :attribute field must be :digits digits.',
#    'digits_between' => 'The :attribute field must be between :min and :max digits.',
#    'dimensions' => 'The :attribute field has invalid image dimensions.',
#    'distinct' => 'The :attribute field has a duplicate value.',
#    'doesnt_end_with' => 'The :attribute field must not end with one of the following: :values.',
#    'doesnt_start_with' => 'The :attribute field must not start with one of the following: :values.',
#    'email' => 'The :attribute field must be a valid email address.',
#    'ends_with' => 'The :attribute field must end with one of the following: :values.',
#    'enum' => 'The selected :attribute is invalid.',
#    'exists' => 'The selected :attribute is invalid.',
#    'extensions' => 'The :attribute field must have one of the following extensions: :values.',
#    'file' => 'The :attribute field must be a file.',
#    'filled' => 'The :attribute field must have a value.',
#    'gt' => [
#        'array' => 'The :attribute field must have more than :value items.',
#        'file' => 'The :attribute field must be greater than :value kilobytes.',
#        'numeric' => 'The :attribute field must be greater than :value.',
#        'string' => 'The :attribute field must be greater than :value characters.',
#    ],
#    'gte' => [
#        'array' => 'The :attribute field must have :value items or more.',
#        'file' => 'The :attribute field must be greater than or equal to :value kilobytes.',
#        'numeric' => 'The :attribute field must be greater than or equal to :value.',
#        'string' => 'The :attribute field must be greater than or equal to :value characters.',
#    ],
#    'hex_color' => 'The :attribute field must be a valid hexadecimal color.',
#    'image' => 'The :attribute field must be an image.',
#    'in' => 'The selected :attribute is invalid.',
#    'in_array' => 'The :attribute field must exist in :other.',
#    'integer' => 'The :attribute field must be an integer.',
#    'ip' => 'The :attribute field must be a valid IP address.',
#    'ipv4' => 'The :attribute field must be a valid IPv4 address.',
#    'ipv6' => 'The :attribute field must be a valid IPv6 address.',
#    'json' => 'The :attribute field must be a valid JSON string.',
#    'list' => 'The :attribute field must be a list.',
#    'lowercase' => 'The :attribute field must be lowercase.',
#    'lt' => [
#        'array' => 'The :attribute field must have less than :value items.',
#        'file' => 'The :attribute field must be less than :value kilobytes.',
#        'numeric' => 'The :attribute field must be less than :value.',
#        'string' => 'The :attribute field must be less than :value characters.',
#    ],
#    'lte' => [
#        'array' => 'The :attribute field must not have more than :value items.',
#        'file' => 'The :attribute field must be less than or equal to :value kilobytes.',
#        'numeric' => 'The :attribute field must be less than or equal to :value.',
#        'string' => 'The :attribute field must be less than or equal to :value characters.',
#    ],
#    'mac_address' => 'The :attribute field must be a valid MAC address.',
#    'max' => [
#        'array' => 'The :attribute field must not have more than :max items.',
#        'file' => 'The :attribute field must not be greater than :max kilobytes.',
#        'numeric' => 'The :attribute field must not be greater than :max.',
#        'string' => 'The :attribute field must not be greater than :max characters.',
#    ],
#    'max_digits' => 'The :attribute field must not have more than :max digits.',
#    'mimes' => 'The :attribute field must be a file of type: :values.',
#    'mimetypes' => 'The :attribute field must be a file of type: :values.',
#    'min' => [
#        'array' => 'The :attribute field must have at least :min items.',
#        'file' => 'The :attribute field must be at least :min kilobytes.',
#        'numeric' => 'The :attribute field must be at least :min.',
#        'string' => 'The :attribute field must be at least :min characters.',
#    ],
#    'min_digits' => 'The :attribute field must have at least :min digits.',
#    'missing' => 'The :attribute field must be missing.',
#    'missing_if' => 'The :attribute field must be missing when :other is :value.',
#    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
#    'missing_with' => 'The :attribute field must be missing when :values is present.',
#    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
#    'multiple_of' => 'The :attribute field must be a multiple of :value.',
#    'not_in' => 'The selected :attribute is invalid.',
#    'not_regex' => 'The :attribute field format is invalid.',
#    'numeric' => 'The :attribute field must be a number.',
#    'password' => [
#        'letters' => 'The :attribute field must contain at least one letter.',
#        'mixed' => 'The :attribute field must contain at least one uppercase and one lowercase letter.',
#        'numbers' => 'The :attribute field must contain at least one number.',
#        'symbols' => 'The :attribute field must contain at least one symbol.',
#        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
#    ],
#    'present' => 'The :attribute field must be present.',
#    'present_if' => 'The :attribute field must be present when :other is :value.',
#    'present_unless' => 'The :attribute field must be present unless :other is :value.',
#    'present_with' => 'The :attribute field must be present when :values is present.',
#    'present_with_all' => 'The :attribute field must be present when :values are present.',
#    'prohibited' => 'The :attribute field is prohibited.',
#    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
#    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
#    'prohibits' => 'The :attribute field prohibits :other from being present.',
#    'regex' => 'The :attribute field format is invalid.',
#    'required' => 'The :attribute field is required.',
#    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
#    'required_if' => 'The :attribute field is required when :other is :value.',
#    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
#    'required_if_declined' => 'The :attribute field is required when :other is declined.',
#    'required_unless' => 'The :attribute field is required unless :other is in :values.',
#    'required_with' => 'The :attribute field is required when :values is present.',
#    'required_with_all' => 'The :attribute field is required when :values are present.',
#    'required_without' => 'The :attribute field is required when :values is not present.',
#    'required_without_all' => 'The :attribute field is required when none of :values are present.',
#    'same' => 'The :attribute field must match :other.',
#    'size' => [
#        'array' => 'The :attribute field must contain :size items.',
#        'file' => 'The :attribute field must be :size kilobytes.',
#        'numeric' => 'The :attribute field must be :size.',
#        'string' => 'The :attribute field must be :size characters.',
#    ],
#    'starts_with' => 'The :attribute field must start with one of the following: :values.',
#    'string' => 'The :attribute field must be a string.',
#    'timezone' => 'The :attribute field must be a valid timezone.',
#    'unique' => 'The :attribute has already been taken.',
#    'uploaded' => 'The :attribute failed to upload.',
#    'uppercase' => 'The :attribute field must be uppercase.',
#    'url' => 'The :attribute field must be a valid URL.',
#    'ulid' => 'The :attribute field must be a valid ULID.',
#    'uuid' => 'The :attribute field must be a valid UUID.',
#
#    /*
#    |--------------------------------------------------------------------------
#    | Custom Validation Language Lines
#    |--------------------------------------------------------------------------
#    |
#    | Here you may specify custom validation messages for attributes using the
#    | convention "attribute.rule" to name the lines. This makes it quick to
#    | specify a specific custom language line for a given attribute rule.
#    |
#    */
#
#    'custom' => [
#        'attribute-name' => [
#            'rule-name' => 'custom-message',
#        ],
#    ],
#
#    /*
#    |--------------------------------------------------------------------------
#    | Custom Validation Attributes
#    |--------------------------------------------------------------------------
#    |
#    | The following language lines are used to swap our attribute placeholder
#    | with something more reader friendly such as "E-Mail Address" instead
#    | of "email". This simply helps us make our message more expressive.
#    |
#    */
#
#    'attributes' => [],
#
#];

return [

    'accepted'             => 'El :attribute debe ser aceptado.',
    'active_url'           => 'El :attribute no es una URL válida.',
    'after'                => 'El :attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => 'El :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'El :attribute solo puede contener letras.',
    'alpha_dash'           => 'El :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num'            => 'El :attribute solo puede contener letras y números.',
    'array'                => 'El :attribute debe ser un arreglo.',
    'before'               => 'El :attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => 'El :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'file'    => 'El :attribute debe pesar entre :min y :max kilobytes.',
        'string'  => 'El :attribute debe tener entre :min y :max caracteres.',
        'array'   => 'El :attribute debe tener entre :min y :max elementos.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'            => 'La confirmación del :attribute no coincide.',
    'date'                 => 'El :attribute no es una fecha válida.',
    'date_equals'          => 'El :attribute debe ser una fecha igual a :date.',
    'date_format'          => 'El :attribute no coincide con el formato :format.',
    'different'            => 'El :attribute y :other deben ser diferentes.',
    'digits'               => 'El :attribute debe ser de :digits dígitos.',
    'digits_between'       => 'El :attribute debe tener entre :min y :max dígitos.',
    'dimensions'           => 'El :attribute tiene dimensiones de imagen inválidas.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'email'                => 'El :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with'            => 'El :attribute debe terminar con uno de los siguientes: :values.',
    'exists'               => 'El :attribute seleccionado es inválido.',
    'file'                 => 'El :attribute debe ser un archivo.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'gt'                   => [
        'numeric' => 'El :attribute debe ser mayor que :value.',
        'file'    => 'El :attribute debe pesar más de :value kilobytes.',
        'string'  => 'El :attribute debe tener más de :value caracteres.',
        'array'   => 'El :attribute debe tener más de :value elementos.',
    ],
    'gte'                  => [
        'numeric' => 'El :attribute debe ser mayor o igual a :value.',
        'file'    => 'El :attribute debe pesar más o igual a :value kilobytes.',
        'string'  => 'El :attribute debe tener más o igual a :value caracteres.',
        'array'   => 'El :attribute debe tener :value elementos o más.',
    ],
    'image'                => 'El :attribute debe ser una imagen.',
    'in'                   => 'El :attribute seleccionado es inválido.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => 'El :attribute debe ser un número entero.',
    'ip'                   => 'El :attribute debe ser una dirección IP válida.',
    'ipv4'                 => 'El :attribute debe ser una dirección IPv4 válida.',
    'ipv6'                 => 'El :attribute debe ser una dirección IPv6 válida.',
    'json'                 => 'El :attribute debe ser una cadena JSON válida.',
    'lt'                   => [
        'numeric' => 'El :attribute debe ser menor que :value.',
        'file'    => 'El :attribute debe pesar menos de :value kilobytes.',
        'string'  => 'El :attribute debe tener menos de :value caracteres.',
        'array'   => 'El :attribute debe tener menos de :value elementos.',
    ],
    'lte'                  => [
        'numeric' => 'El :attribute debe ser menor o igual a :value.',
        'file'    => 'El :attribute debe pesar menos o igual a :value kilobytes.',
        'string'  => 'El :attribute debe tener menos o igual a :value caracteres.',
        'array'   => 'El :attribute no debe tener más de :value elementos.',
    ],
    'max'                  => [
        'numeric' => 'El :attribute no debe ser mayor que :max.',
        'file'    => 'El :attribute no debe pesar más que :max kilobytes.',
        'string'  => 'El :attribute no debe tener más de :max caracteres.',
        'array'   => 'El :attribute no debe tener más de :max elementos.',
    ],
    'mimes'                => 'El :attribute debe ser un archivo de tipo: :values.',
    'mimetypes'            => 'El :attribute debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'El :attribute debe ser al menos :min.',
        'file'    => 'El :attribute debe pesar al menos :min kilobytes.',
        'string'  => 'El :attribute debe tener al menos :min caracteres.',
        'array'   => 'El :attribute debe tener al menos :min elementos.',
    ],
    'not_in'               => 'El :attribute seleccionado es inválido.',
    'not_regex'            => 'El formato del :attribute es inválido.',
    'numeric'              => 'El :attribute debe ser un número.',
    'password'             => 'La contraseña es incorrecta.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El formato del :attribute es inválido.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_if'          => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values están presentes.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de los :values están presentes.',
    'same'                 => 'El :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El :attribute debe ser de :size.',
        'file'    => 'El :attribute debe pesar :size kilobytes.',
        'string'  => 'El :attribute debe tener :size caracteres.',
        'array'   => 'El :attribute debe contener :size elementos.',
    ],
    'starts_with'          => 'El :attribute debe comenzar con uno de los siguientes: :values.',
    'string'               => 'El :attribute debe ser una cadena de texto.',
    'timezone'             => 'El :attribute debe ser una zona horaria válida.',
    'unique'               => 'El :attribute ya ha sido registrado.',
    'uploaded'             => 'El :attribute no se pudo cargar.',
    'url'                  => 'El :attribute no es una URL válida.',
    'uuid'                 => 'El :attribute debe ser un UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Aquí puedes especificar tus propios mensajes de validación personalizados.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'mensaje-personalizado',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Aquí puedes especificar los nombres de atributos personalizados para las
    | reglas de validación. Por ejemplo, 'email' puede convertirse en 'correo electrónico'.
    |
    */

    'attributes' => [
        'email' => 'correo electrónico',
        'contraseña' => 'contraseña',
        'name' => 'nombre',
        // Puedes agregar más campos si es necesario
    ],
];

