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

    'accepted' => ':attribute kabul edilmelidir.',
    'active_url' => ':attribute dogry URL bolmalydyr.',
    'after' => ':attribute :date dan/den soňky sene bolmalydyr.',
    'after_or_equal' => ':attribute :date dan/den soňky ýa-da deň sene bolmalydyr.',
    'alpha' => ':attribute diňe harplardan durmalydyr.',
    'alpha_dash' => ':attribute diňe harplardan, sanlardan we tirelerden durmalydyr.',
    'alpha_num' => ':attribute diňe harplardan we sanlardan durmalydyr.',
    'array' => ':attribute ýygyndy bolmalydyr.',
    'before' => ':attribute :date dan/den öňki sene bolmalydyr.',
    'before_or_equal' => ':attribute :date dan/den öňki ýa-da deň sene bolmalydyr.',
    'between' => [
        'numeric' => ':attribute :min - :max arasynda bolmalydyr.',
        'file' => ':attribute :min - :max kilobaýt arasynda bolmalydyr.',
        'string' => ':attribute :min - :max harplar arasynda bolmalydyr.',
        'array' => ':attribute :min - :max arasynda madda eýe bolmalydyr.',
    ],
    'boolean' => ':attribute diňe dogry ýa-da ýalňyş bolmalydyr.',
    'confirmed' => ':attribute tassyklamasy deň däl.',
    'date' => ':attribute dogry sene bolmalydyr.',
    'date_equals' => ':attribute :date deň sene bolmalydyr.',
    'date_format' => ':attribute :format formatyna deň däl.',
    'different' => ':attribute bilen :other birbirinden tapawutly bolmalydyr.',
    'digits' => ':attribute :digits san bolmalydyr.',
    'digits_between' => ':attribute :min - :max arasynda san bolmalydyr.',
    'dimensions' => ':attribute surady dogry ölçeglerde bolmalydyr.',
    'distinct' => ':attribute gaýtadan ulanylmaly däl.',
    'email' => ':attribute dogry formatda e-poçta salgysy bolmalydyr.',
    'ends_with' => ':attribute şulardan biri bilen tamamlanmalydyr: :values',
    'exists' => 'Saýlanan :attribute nädogry.',
    'file' => ':attribute faýl bolmalydyr.',
    'filled' => ':attribute meýdany zerur.',
    'gt' => [
        'numeric' => ':attribute :value sanyndan uly bolmalydyr.',
        'file' => ':attribute :value kilobaýtdan uly bolmalydyr.',
        'string' => ':attribute :value harpdan köp bolmalydyr.',
        'array' => ':attribute :value maddadan köp bolmalydyr.',
    ],
    'gte' => [
        'numeric' => ':attribute :value sanyndan uly ýa-da deň bolmalydyr.',
        'file' => ':attribute :value kilobaýtdan uly ýa-da deň bolmalydyr.',
        'string' => ':attribute :value harpdan köp ýa-da deň bolmalydyr.',
        'array' => ':attribute :value maddadan köp ýa-da deň bolmalydyr.',
    ],
    'image' => ':attribute surat bolmalydyr.',
    'in' => 'Saýlanan :attribute nädogry.',
    'in_array' => ':attribute :other ýygyndysynda ýok.',
    'integer' => ':attribute san bolmalydyr.',
    'ip' => ':attribute dogry formatda IP salgysy bolmalydyr.',
    'ipv4' => ':attribute dogry formatda IPv4 salgysy bolmalydyr.',
    'ipv6' => ':attribute dogry formatda IPv6 salgysy bolmalydyr.',
    'json' => ':attribute dogry formatda JSON bolmalydyr.',
    'lt' => [
        'numeric' => ':attribute :value sanyndan kiçi bolmalydyr.',
        'file' => ':attribute :value kilobaýtdan kiçi bolmalydyr.',
        'string' => ':attribute :value harpdan az bolmalydyr.',
        'array' => ':attribute :value maddadan az bolmalydyr.',
    ],
    'lte' => [
        'numeric' => ':attribute :value sanyndan kiçi ýa-da deň bolmalydyr.',
        'file' => ':attribute :value kilobaýtdan kiçi ýa-da deň bolmalydyr.',
        'string' => ':attribute :value harpdan az ýa-da deň bolmalydyr.',
        'array' => ':attribute :value maddadan az ýa-da deň bolmalydyr.',
    ],
    'max' => [
        'numeric' => ':attribute :max dan/den kiçi bolmalydyr.',
        'file' => ':attribute :max kilobaýtdan kiçi bolmalydyr.',
        'string' => ':attribute :max harpdan kiçi bolmalydyr.',
        'array' => ':attribute :max maddadan kiçi bolmalydyr.',
    ],
    'mimes' => ':attribute diňe :values formatlarynda bolmalydyr.',
    'mimetypes' => ':attribute diňe :values faýl formatlarynda bolmalydyr.',
    'min' => [
        'numeric' => ':attribute :min dan/den uly bolmalydyr.',
        'file' => ':attribute :min kilobaýtdan uly bolmalydyr.',
        'string' => ':attribute :min harpdan köp bolmalydyr.',
        'array' => ':attribute :min maddadan köp bolmalydyr.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'Saýlanan :attribute nädogry.',
    'not_regex' => ':attribute formaty nädogry.',
    'numeric' => ':attribute san bolmalydyr.',
    'password' => 'açarsöz nädogry.',
    'present' => 'The :attribute field must be present.',
    'regex' => ':attribute formaty nädogry.',
    'required' => ':attribute meýdany zerur.',
    'required_if' => ':attribute meýdany, :other :value deň bolanda zerurdyr.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => ':attribute meýdany :values bar bolanda zerurdyr.',
    'required_with_all' => ':attribute meýdany haýsyda bolsa bir :values bar bolanda zerurdyr.',
    'required_without' => ':attribute meýdany :values ýok bolanda zerurdyr.',
    'required_without_all' => ':attribute meýdany :values dan haýsyda bolsa biri ýok bolanda zerurdyr.',
    'same' => ':attribute :other bilen deň bolmalydyr.',
    'size' => [
        'numeric' => ':attribute :size sandan ybarat bolmalydyr.',
        'file' => ':attribute :size kilobaýtdan ybarat bolmalydyr.',
        'string' => ':attribute :size harpdan ybarat bolmalydyr.',
        'array' => ':attribute :size maddadan ybarat bolmalydyr.',
    ],
    'starts_with' => ':attribute şulardan biri bilen başlamalydyr: :values',
    'string' => ':attribute harp/san bolmalydyr.',
    'timezone' => ':attribute dogry zolak bolmalydyr.',
    'unique' => ':attribute öňden hasaba alyndy.',
    'uploaded' => ':attribute ýüklemesi şowsuz.',
    'url' => ':attribute formaty nädogry',
    'uuid' => ':attribute dogry UUID bolmalydyr.',

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
        'u_name' => 'Ady',
        'username' => 'Ulanyjy ady',
        'password' => 'Açarsöz',
        'current_password' => 'Köne açarsöz',
        'new_password' => 'Täze açarsöz',
        'new_password_confirm' => 'Täze açarsöz tassyklamasy',
        'name' => 'Ady',
        'image' => 'Surat',
        'datetime_start' => 'Başlaýan wagty',
        'datetime_end' => 'Gutarýan wagty',
        'status' => 'Ýagdaýy',
        'code' => 'Kody',
        'name_tm' => 'Название (tm)',
        'name_ru' => 'Название (ru)',
        'name_en' => 'Название (en)',
        'icon' => 'Ikony',
        'sort_order' => 'Tertibi',
        'customer' => 'Müşderi',
        'category' => 'Kategoriýa',
        'body' => 'Mazmuny',
        'price' => 'Bahasy',
        'title_tm' => 'Sözbaşy (tm)',
        'title_ru' => 'Sözbaşy (ru)',
        'title_en' => 'Sözbaşy (en)',
        'image_tm' => 'Surat (tm)',
        'image_ru' => 'Surat (ru)',
        'image_en' => 'Surat (en)',
        'url' => 'Salgy',
        'date_start' => 'Başlaýan güni',
        'date_end' => 'Gutarýan güni',
        'body_tm' => 'Mazmuny (tm)',
        'body_ru' => 'Mazmuny (ru)',
        'body_en' => 'Mazmuny (en)',
        'message' => 'Haty',
        'categories' => 'Kategoriýalar',
        'description' => 'Düşündiriş',
        'description_tm' => 'Düşündiriş (tm)',
        'description_ru' => 'Düşündiriş (ru)',
        'description_en' => 'Düşündiriş (en)',
        'images' => 'Suratlar',
        'title' => 'Sözbaşy',
        'email' => 'E-poçta',
        'file' => 'Faýl',
        'phone_or_email' => 'Telefon belgi ýa-da e-poçta',
        'search' => 'Gözleg',
        'note' => 'Bellik',
        'slug' => 'Salgy',
        'minute' => 'Minut',
        'phone' => 'Telefon',
        'phones' => 'Telefonlar',
        'datetime' => 'Wagty',
        'available' => 'Elýeterli',
        'unavailable' => 'Elýeterli däl',
        'job' => 'Hünäri',
        'job_tm' => 'Hünäri (tm)',
        'job_ru' => 'Hünäri (ru)',
        'job_en' => 'Hünäri (en)',
        'month' => 'Aý',
        'download' => 'Ýükle',
        'published_at' => 'Çap edilen wagty',
    ],
];