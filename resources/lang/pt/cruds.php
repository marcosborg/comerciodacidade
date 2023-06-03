<?php

return [
    'userManagement' => [
        'title'          => 'Gestão de usuários',
        'title_singular' => 'Gestão de usuários',
    ],
    'permission' => [
        'title'          => 'Permissões',
        'title_singular' => 'Permissão',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Grupos',
        'title_singular' => 'Função',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Usuários',
        'title_singular' => 'Usuário',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'register' => [
        'title'          => 'Register',
        'title_singular' => 'Register',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'email'               => 'Email',
            'email_helper'        => ' ',
            'company_name'        => 'Company Name',
            'company_name_helper' => ' ',
            'phone'               => 'Phone',
            'phone_helper'        => ' ',
            'message'             => 'Message',
            'message_helper'      => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'newsletter' => [
        'title'          => 'Newsletter',
        'title_singular' => 'Newsletter',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'page' => [
        'title'          => 'Page',
        'title_singular' => 'Page',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Título',
            'title_helper'       => ' ',
            'description'        => 'Descrição',
            'description_helper' => ' ',
            'image'              => 'Imagem',
            'image_helper'       => ' ',
            'text'               => 'Texto',
            'text_helper'        => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'planMenu' => [
        'title'          => 'Planos',
        'title_singular' => 'Plano',
    ],
    'plan' => [
        'title'          => 'Planos',
        'title_singular' => 'Plano',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'price'             => 'Price',
            'price_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'planItem' => [
        'title'          => 'Item',
        'title_singular' => 'Item',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'text'              => 'Text',
            'text_helper'       => ' ',
            'plan'              => 'Plan',
            'plan_helper'       => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'company' => [
        'title'          => 'Company',
        'title_singular' => 'Company',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Nome',
            'name_helper'       => ' ',
            'vat'               => 'NIPC / NIF',
            'vat_helper'        => ' ',
            'address'           => 'Morada',
            'address_helper'    => ' ',
            'zip'               => 'Código Postal',
            'zip_helper'        => ' ',
            'location'          => 'Localidade',
            'location_helper'   => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'logo'              => 'Logo',
            'logo_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
        ],
    ],
    'subscriptionType' => [
        'title'          => 'Subscription Type',
        'title_singular' => 'Subscription Type',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'months'            => 'Months',
            'months_helper'     => ' ',
            'discount'          => 'Discount',
            'discount_helper'   => '%',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'plan'              => 'Plan',
            'plan_helper'       => ' ',
        ],
    ],
    'subscription' => [
        'title'          => 'Subscription',
        'title_singular' => 'Subscription',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'user'                     => 'User',
            'user_helper'              => ' ',
            'start_date'               => 'Start Date',
            'start_date_helper'        => ' ',
            'end_date'                 => 'End Date',
            'end_date_helper'          => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'subscription_type'        => 'Subscription Type',
            'subscription_type_helper' => ' ',
        ],
    ],
    'subscriptionPayment' => [
        'title'          => 'Subscription Payment',
        'title_singular' => 'Subscription Payment',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'subscription'        => 'Subscription',
            'subscription_helper' => ' ',
            'value'               => 'Value',
            'value_helper'        => ' ',
            'paid'                => 'Paid',
            'paid_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'method'              => 'Method',
            'method_helper'       => ' ',
        ],
    ],
    'shopSetting' => [
        'title'          => 'Shop Settings',
        'title_singular' => 'Shop Setting',
    ],
    'shopCategory' => [
        'title'          => 'Shop Category',
        'title_singular' => 'Shop Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'image'              => 'Image',
            'image_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'shopLocation' => [
        'title'          => 'Shop Location',
        'title_singular' => 'Shop Location',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'shopType' => [
        'title'          => 'Shop Type',
        'title_singular' => 'Shop Type',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'icon'              => 'Icon',
            'icon_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'shopTax' => [
        'title'          => 'Shop Taxes',
        'title_singular' => 'Shop Tax',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'tax'               => 'Tax',
            'tax_helper'        => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'shopCompany' => [
        'title'          => 'Shop Company',
        'title_singular' => 'Shop Company',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'company'              => 'Company',
            'company_helper'       => ' ',
            'about'                => 'About',
            'about_helper'         => ' ',
            'shop_location'        => 'Shop Location',
            'shop_location_helper' => ' ',
            'contacts'             => 'Contacts',
            'contacts_helper'      => ' ',
            'photos'               => 'Photos',
            'photos_helper'        => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'shop_categories'        => 'Shop Categories',
            'shop_categories_helper' => ' ',
            'address'                => 'Address',
            'address_helper'         => ' ',
            'youtube'                => 'Youtube',
            'youtube_helper'         => ' ',
            'latitude'               => 'Latitude',
            'latitude_helper'        => ' ',
            'longitude'              => 'Longitude',
            'longitude_helper'       => ' ',
        ],
    ],
    'shopProductCategory' => [
        'title'          => 'Shop Product Category',
        'title_singular' => 'Shop Product Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'company'           => 'Company',
            'company_helper'    => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'image'             => 'Imagem',
            'image_helper'      => ' ',
        ],
    ],
    'shopProduct' => [
        'title'          => 'Shop Product',
        'title_singular' => 'Shop Product',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'reference'          => 'Reference',
            'reference_helper'   => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'photos'             => 'Photos',
            'photos_helper'      => ' ',
            'price'              => 'Price',
            'price_helper'       => ' ',
            'tax'                => 'Tax',
            'tax_helper'         => ' ',
            'state'              => 'State',
            'state_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'shop_product_categories'        => 'Shop Product Categories',
            'shop_product_categories_helper' => ' ',
            'shop_product_sub_categories'        => 'Sub Categorias',
            'shop_product_sub_categories_helper' => ' ',
            'youtube'                            => 'Youtube',
            'youtube_helper'                     => ' ',
            'attachment_name'                    => 'Nome do anexo',
            'attachment_name_helper'             => ' ',
            'attachment'                         => 'Anexo',
            'attachment_helper'                  => ' ',
            'position'                           => 'Position',
            'position_helper'                    => ' ',
            'stock'                              => 'Stock',
            'stock_helper'                       => ' ',
        ],
    ],
    'shopProductVariation' => [
        'title'          => 'Shop Product Variations',
        'title_singular' => 'Shop Product Variation',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'shop_product'        => 'Shop Product',
            'shop_product_helper' => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'price'               => 'Price',
            'price_helper'        => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'stock'               => 'Stock',
            'stock_helper'        => ' ',
        ],
    ],
    'shopProductFeature' => [
        'title'          => 'Shop Product Feature',
        'title_singular' => 'Shop Product Feature',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'shop_product'        => 'Shop Product',
            'shop_product_helper' => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'shopProductSubCategory' => [
        'title'          => 'Shop Product Sub Category',
        'title_singular' => 'Shop Product Sub Category',
        'fields'         => [
            'id'                           => 'ID',
            'id_helper'                    => ' ',
            'shop_product_category'        => 'Shop Product Category',
            'shop_product_category_helper' => ' ',
            'name'                         => 'Name',
            'name_helper'                  => ' ',
            'created_at'                   => 'Created at',
            'created_at_helper'            => ' ',
            'updated_at'                   => 'Updated at',
            'updated_at_helper'            => ' ',
            'deleted_at'                   => 'Deleted at',
            'deleted_at_helper'            => ' ',
        ],
    ],
    'manageCategory' => [
        'title'          => 'Gerir categorias',
        'title_singular' => 'Gerir categoria',
    ],
    'myCategory' => [
        'title'          => 'Categorias',
        'title_singular' => 'Categoria',
    ],
    'mySubCategory' => [
        'title'          => 'Subcategorias',
        'title_singular' => 'Subcategoria',
    ],
    'myShop' => [
        'title'          => 'A minha loja',
        'title_singular' => 'A minha loja',
    ],
    'myProduct' => [
        'title'          => 'Produtos',
        'title_singular' => 'Produto',
    ],
    'shopCompanySchedule' => [
        'title'          => 'Shop Company Schedule',
        'title_singular' => 'Shop Company Schedule',
        'fields'         => [
            'id'                                 => 'ID',
            'id_helper'                          => ' ',
            'shop_company'                       => 'Empresa',
            'shop_company_helper'                => ' ',
            'monday_morning_opening'             => 'Monday Morning Opening',
            'monday_morning_opening_helper'      => ' ',
            'monday_morning_closing'             => 'Monday Morning Closing',
            'monday_morning_closing_helper'      => ' ',
            'moday_afternoon_opening'            => 'Moday Afternoon Opening',
            'moday_afternoon_opening_helper'     => ' ',
            'monday_afternoon_closing'           => 'Monday Afternoon Closing',
            'monday_afternoon_closing_helper'    => ' ',
            'tuesday_morning_opening'            => 'Tuesday Morning Opening',
            'tuesday_morning_opening_helper'     => ' ',
            'tuesday_morning_closing'            => 'Tuesday Morning Closing',
            'tuesday_morning_closing_helper'     => ' ',
            'tuesday_afternoon_opening'          => 'Tuesday Afternoon Opening',
            'tuesday_afternoon_opening_helper'   => ' ',
            'tuesday_afternoon_closing'          => 'Tuesday Afternoon Closing',
            'tuesday_afternoon_closing_helper'   => ' ',
            'wednesday_morning_opening'          => 'Wednesday Morning Opening',
            'wednesday_morning_opening_helper'   => ' ',
            'wednesday_morning_closing'          => 'Wednesday Morning Closing',
            'wednesday_morning_closing_helper'   => ' ',
            'wednesday_afternoon_opening'        => 'Wednesday Afternoon Opening',
            'wednesday_afternoon_opening_helper' => ' ',
            'wednesday_afternoon_closing'        => 'Wednesday Afternoon Closing',
            'wednesday_afternoon_closing_helper' => ' ',
            'thursday_morning_opening'           => 'Thursday Morning Opening',
            'thursday_morning_opening_helper'    => ' ',
            'thursday_morning_closing'           => 'Thursday Morning Closing',
            'thursday_morning_closing_helper'    => ' ',
            'thursday_afternoon_opening'         => 'Thursday Afternoon Opening',
            'thursday_afternoon_opening_helper'  => ' ',
            'thursday_afternoon_closing'         => 'Thursday Afternoon Closing',
            'thursday_afternoon_closing_helper'  => ' ',
            'friday_morning_opening'             => 'Friday Morning Opening',
            'friday_morning_opening_helper'      => ' ',
            'friday_morning_closing'             => 'Friday Morning Closing',
            'friday_morning_closing_helper'      => ' ',
            'friday_afternoon_opening'           => 'Friday Afternoon Opening',
            'friday_afternoon_opening_helper'    => ' ',
            'friday_afternoon_closing'           => 'Friday Afternoon Closing',
            'friday_afternoon_closing_helper'    => ' ',
            'saturday_morning_opening'           => 'Saturday Morning Opening',
            'saturday_morning_opening_helper'    => ' ',
            'saturday_morning_closing'           => 'Saturday Morning Closing',
            'saturday_morning_closing_helper'    => ' ',
            'saturday_afternoon_opening'         => 'Saturday Afternoon Opening',
            'saturday_afternoon_opening_helper'  => ' ',
            'saturday_afternoon_closing'         => 'Saturday Afternoon Closing',
            'saturday_afternoon_closing_helper'  => ' ',
            'sunday_morning_opening'             => 'Sunday Morning Opening',
            'sunday_morning_opening_helper'      => ' ',
            'sunday_morning_closing'             => 'Sunday Morning Closing',
            'sunday_morning_closing_helper'      => ' ',
            'sunday_afternoon_opening'           => 'Sunday Afternoon Opening',
            'sunday_afternoon_opening_helper'    => ' ',
            'sunday_afternoon_closing'           => 'Sunday Afternoon Closing',
            'sunday_afternoon_closing_helper'    => ' ',
            'created_at'                         => 'Created at',
            'created_at_helper'                  => ' ',
            'updated_at'                         => 'Updated at',
            'updated_at_helper'                  => ' ',
            'deleted_at'                         => 'Deleted at',
            'deleted_at_helper'                  => ' ',
        ],
    ],
    'serviceDuration' => [
        'title'          => 'Service Duration',
        'title_singular' => 'Service Duration',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'minutes'           => 'Minutes',
            'minutes_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'service' => [
        'title'          => 'Service',
        'title_singular' => 'Service',
        'fields'         => [
            'id'                                 => 'ID',
            'id_helper'                          => ' ',
            'name'                               => 'Nome',
            'name_helper'                        => ' ',
            'shop_company'                       => 'Loja',
            'shop_company_helper'                => ' ',
            'price'                              => 'Preço',
            'price_helper'                       => ' ',
            'description'                        => 'Descrição',
            'description_helper'                 => ' ',
            'service_duration'                   => 'Duração',
            'service_duration_helper'            => ' ',
            'photos'                             => 'Fotografias',
            'photos_helper'                      => ' ',
            'created_at'                         => 'Created at',
            'created_at_helper'                  => ' ',
            'updated_at'                         => 'Updated at',
            'updated_at_helper'                  => ' ',
            'deleted_at'                         => 'Deleted at',
            'deleted_at_helper'                  => ' ',
            'reference'                          => 'Reference',
            'reference_helper'                   => ' ',
            'shop_product_categories'            => 'Shop Product Categories',
            'shop_product_categories_helper'     => ' ',
            'shop_product_sub_categories'        => 'Shop Product Sub Categories',
            'shop_product_sub_categories_helper' => ' ',
            'tax'                                => 'Tax',
            'tax_helper'                         => ' ',
            'youtube'                            => 'Youtube',
            'youtube_helper'                     => ' ',
            'attachment_name'                    => 'Attachment Name',
            'attachment_name_helper'             => ' ',
            'attachment'                         => 'Attachment',
            'attachment_helper'                  => ' ',
            'state'                              => 'State',
            'state_helper'                       => ' ',
            'position'                           => 'Position',
            'position_helper'                    => ' ',
        ],
    ],
    'serviceEmployee' => [
        'title'          => 'Service Employee',
        'title_singular' => 'Service Employee',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'service'           => 'Service',
            'service_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'shop_company'        => 'Shop Company',
            'shop_company_helper' => ' ',
        ],
    ],
    'shopSchedule' => [
        'title'          => 'Shop Schedule',
        'title_singular' => 'Shop Schedule',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'service_employee'        => 'Service Employee',
            'service_employee_helper' => ' ',
            'start_time'              => 'Start Time',
            'start_time_helper'       => ' ',
            'end_time'                => 'End Time',
            'end_time_helper'         => ' ',
            'service'                 => 'Service',
            'service_helper'          => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'client'                  => 'Client',
            'client_helper'           => ' ',
            'notes'                   => 'Notes',
            'notes_helper'            => ' ',
        ],
    ],
    'myService' => [
        'title'          => 'Serviços',
        'title_singular' => 'Serviço',
    ],
    'myEmployee' => [
        'title'          => 'Funcionários',
        'title_singular' => 'Funcionário',
    ],
    'address' => [
        'title'          => 'Address',
        'title_singular' => 'Address',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'address'           => 'Address',
            'address_helper'    => ' ',
            'city'              => 'City',
            'city_helper'       => ' ',
            'zip'               => 'Zip',
            'zip_helper'        => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'country'           => 'Country',
            'country_helper'    => ' ',
        ],
    ],
    'country' => [
        'title'          => 'Countries',
        'title_singular' => 'Country',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'short_code'        => 'Short Code',
            'short_code_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'client' => [
        'title'          => 'Clientes',
        'title_singular' => 'Cliente',
    ],

];
