<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToShopCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('shop_companies', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_8336281')->references('id')->on('companies');
        });
    }
}