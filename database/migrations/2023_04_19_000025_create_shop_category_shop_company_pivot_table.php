<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopCategoryShopCompanyPivotTable extends Migration
{
    public function up()
    {
        Schema::create('shop_category_shop_company', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_company_id');
            $table->foreign('shop_company_id', 'shop_company_id_fk_8356815')->references('id')->on('shop_companies')->onDelete('cascade');
            $table->unsignedBigInteger('shop_category_id');
            $table->foreign('shop_category_id', 'shop_category_id_fk_8356815')->references('id')->on('shop_categories')->onDelete('cascade');
        });
    }
}