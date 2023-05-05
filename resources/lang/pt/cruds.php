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

];
