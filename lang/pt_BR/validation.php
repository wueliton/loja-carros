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

    'accepted'             => 'O campo deve ser aceito.',
    'accepted_if'          => 'O deve ser aceito quando :other for :value.',
    'active_url'           => 'O campo não é uma URL válida.',
    'after'                => 'O campo deve ser uma data posterior a :date.',
    'after_or_equal'       => 'O campo deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'O campo só pode conter letras.',
    'alpha_dash'           => 'O campo só pode conter letras, números e traços.',
    'alpha_num'            => 'O campo só pode conter letras e números.',
    'array'                => 'O campo deve ser uma matriz.',
    'ascii'                => 'O campo deve conter somente caracteres alfanuméricos.',
    'before'               => 'O campo deve ser uma data anterior :date.',
    'before_or_equal'      => 'O campo deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => 'O campo deve ser entre :min e :max.',
        'file'    => 'O campo deve ser entre :min e :max kilobytes.',
        'string'  => 'O campo deve ser entre :min e :max caracteres.',
        'array'   => 'O campo deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo deve ser verdadeiro ou falso.',
    'can'                  => 'O campo contém valores não autorizado.',
    'confirmed'            => 'O campo de confirmação não confere.',
    'contains'             => 'O campo está faltando um valor obrigatório.',
    'current_password'     => 'A senha está incorreta.',
    'date'                 => 'O campo não é uma data válida.',
    'date_equals'          => 'O campo deve ser uma data igual a :date.',
    'date_format'          => 'O campo não corresponde ao formato :format.',
    'decimal'              => 'O campo deve ter :decimal casas decimais.',
    'declined'             => 'O deve ser recusado.',
    'declined_if'          => 'O deve ser recusado quando :other for :value.',
    'different'            => 'Os campos e :other devem ser diferentes.',
    'digits'               => 'O campo deve ter :digits dígitos.',
    'digits_between'       => 'O campo deve ter entre :min e :max dígitos.',
    'dimensions'           => 'O campo tem dimensões de imagem inválidas.',
    'distinct'             => 'O campo tem um valor duplicado.',
    'doesnt_end_with'      => 'O campo não pode terminar com um dos seguintes: :values.',
    'doesnt_start_with'    => 'O não pode começar com um dos seguintes: :values.',
    'email'                => 'O campo deve ser um endereço de e-mail válido.',
    'ends_with'            => 'O campo deve terminar com um dos seguintes: :values',
    'enum'                 => 'O selecionado é inválido.',
    'exists'               => 'O campo selecionado é inválido.',
    'extensions'           => 'O campo deve conter uma das seguintes extensões: :values.',
    'file'                 => 'O campo deve ser um arquivo.',
    'filled'               => 'O campo deve ter um valor.',
    'gt' => [
        'numeric' => 'O campo deve ser maior que :value.',
        'file'    => 'O campo deve ser maior que :value kilobytes.',
        'string'  => 'O campo deve ser maior que :value caracteres.',
        'array'   => 'O campo deve conter mais de :value itens.',
    ],
    'gte' => [
        'numeric' => 'O campo deve ser maior ou igual a :value.',
        'file'    => 'O campo deve ser maior ou igual a :value kilobytes.',
        'string'  => 'O campo deve ser maior ou igual a :value caracteres.',
        'array'   => 'O campo deve conter :value itens ou mais.',
    ],
    'hex_color'            => 'O campo deve ser uma cor hexadecimal válida.',
    'image'                => 'O campo deve ser uma imagem.',
    'in'                   => 'O campo selecionado é inválido.',
    'in_array'             => 'O campo não existe em :other.',
    'integer'              => 'O campo deve ser um número inteiro.',
    'ip'                   => 'O campo deve ser um endereço de IP válido.',
    'ipv4'                 => 'O campo deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O campo deve ser um endereço IPv6 válido.',
    'json'                 => 'O campo deve ser uma string JSON válida.',
    'list' => 'O campo deve ser uma lista.',
    'lowercase' => 'O campo deve estar em letras minúsculas.',
    'lt' => [
        'numeric' => 'O campo deve ser menor que :value.',
        'file'    => 'O campo deve ser menor que :value kilobytes.',
        'string'  => 'O campo deve ser menor que :value caracteres.',
        'array'   => 'O campo deve conter menos de :value itens.',
    ],
    'lte' => [
        'numeric' => 'O campo deve ser menor ou igual a :value.',
        'file'    => 'O campo deve ser menor ou igual a :value kilobytes.',
        'string'  => 'O campo deve ser menor ou igual a :value caracteres.',
        'array'   => 'O campo não deve conter mais que :value itens.',
    ],
    'mac_address' => 'O campo deve ser um MAC address válido.',
    'max' => [
        'numeric' => 'O campo não pode ser superior a :max.',
        'file'    => 'O campo não pode ser superior a :max kilobytes.',
        'string'  => 'O campo não pode ser superior a :max caracteres.',
        'array'   => 'O campo não pode ter mais do que :max itens.',
    ],
    'max_digits'           => 'O campo não pode ser superior a :max dígitos',
    'mimes'                => 'O campo deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O campo deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => 'O campo deve ser pelo menos :min.',
        'file'    => 'O campo deve ter pelo menos :min kilobytes.',
        'string'  => 'O campo deve ter pelo menos :min caracteres.',
        'array'   => 'O campo deve ter pelo menos :min itens.',
    ],
    'missing'              => 'O campo deve estar ausente.',
    'missing_if'           => 'O campo deve estar ausente quando :other for :value.',
    'missing_unless'       => 'O campo deve estar ausente, a menos que :other seja :value.',
    'missing_with'         => 'O campo não deve estar presente quando houver :values.',
    'missing_with_all'     => 'O campo deve estar ausente quando :values estiverem presentes.',
    'min_digits'           => 'O campo deve ter pelo menos :min dígitos',
    'not_in'               => 'O campo selecionado é inválido.',
    'multiple_of'          => 'O campo deve ser um múltiplo de :value.',
    'not_regex'            => 'O campo possui um formato inválido.',
    'numeric'              => 'O campo deve ser um número.',
    'password' => [
        'letters'          => 'O campo deve conter pelo menos uma letra.',
        'mixed'            => 'O campo deve conter pelo menos uma letra maiúscula e uma letra minúscula.',
        'numbers'          => 'O campo deve conter pelo menos um número.',
        'symbols'          => 'O campo deve conter pelo menos um símbolo.',
        'uncompromised'    => 'A senha que você inseriu em está em um vazamento de dados.'
            . ' Por favor escolha uma senha diferente.',
    ],
    'present'              => 'O campo deve estar presente.',
    'present_if'           => 'O campo deve estar presente quando :other for :value.',
    'present_unless'       => 'O campo deve estar presente, a menos que :other seja :value.',
    'present_with'         => 'O campo deve estar presente quando :values estiver presente.',
    'present_with_all'     => 'O campo deve estar presente quando :values estiverem presentes.',
    'regex'                => 'O campo tem um formato inválido.',
    'required'             => 'O campo é obrigatório.',
    'required_array_keys'  => 'O campo deve conter entradas para: :values.',
    'required_if'          => 'O campo é obrigatório quando :other for :value.',
    'required_if_accepted' => 'O campo é obrigatório quando :other for aceito.',
    'required_if_declined' => 'O campo é obrigatório quando :other for recusado.',
    'required_unless'      => 'O campo é obrigatório exceto quando :other for :values.',
    'required_with'        => 'O campo é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo é obrigatório quando :values está presente.',
    'required_without'     => 'O campo é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo é obrigatório quando nenhum dos :values estão presentes.',
    'prohibited'           => 'O campo é proibido.',
    'prohibited_if'        => 'O campo é proibido quando :other for :value.',
    'prohibited_unless'    => 'O campo é proibido exceto quando :other for :values.',
    'prohibits'            => 'O campo proíbe :other de estar presente.',
    'same'                 => 'Os campos e :other devem corresponder.',
    'size'                 => [
        'numeric' => 'O campo deve ser :size.',
        'file'    => 'O campo deve ser :size kilobytes.',
        'string'  => 'O campo deve ser :size caracteres.',
        'array'   => 'O campo deve conter :size itens.',
    ],
    'starts_with'          => 'O campo deve começar com um dos seguintes valores: :values',
    'string'               => 'O campo deve ser uma string.',
    'timezone'             => 'O campo deve ser uma zona válida.',
    'unique'               => 'O campo já está sendo utilizado.',
    'uploaded'             => 'Ocorreu uma falha no upload do campo :attribute.',
    'uppercase'            => 'O campo deve conter letras maiúsculas.',
    'url'                  => 'O campo tem um formato inválido.',
    'ulid'                 => 'O campo deve ser um ULID válido.',
    'uuid'                 => 'O campo deve ser um UUID válido.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'address'   => 'endereço',
        'age'       => 'idade',
        'body'      => 'conteúdo',
        'cell'      => 'célula',
        'city'      => 'cidade',
        'country'   => 'país',
        'date'      => 'data',
        'day'       => 'dia',
        'excerpt'   => 'resumo',
        'first_name' => 'primeiro nome',
        'gender'    => 'gênero',
        'marital_status' => 'estado civil',
        'profession' => 'profissão',
        'nationality' => 'nacionalidade',
        'hour'      => 'hora',
        'last_name' => 'sobrenome',
        'message'   => 'mensagem',
        'minute'    => 'minuto',
        'mobile'    => 'celular',
        'month'     => 'mês',
        'name'      => 'nome',
        'zipcode'   => 'cep',
        'company_name'   => 'razão social',
        'neighborhood' => 'bairro',
        'number'    => 'número',
        'password'  => 'senha',
        'phone'     => 'telefone',
        'second'    => 'segundo',
        'sex'       => 'sexo',
        'state'     => 'estado',
        'street'    => 'rua',
        'subject'   => 'assunto',
        'text'      => 'texto',
        'time'      => 'hora',
        'title'     => 'título',
        'username'  => 'usuário',
        'year'      => 'ano',
        'description' => 'descrição',
        'password_confirmation' => 'confirmação da senha',
        'current_password' => 'senha atual',
        'complement' => 'complemento',
        'modality' => 'modalidade',
        'category' => 'categoria',
        'blood_type' => 'tipo sanguíneo',
        'birth_date' => 'data de nascimento'
    ],

];
