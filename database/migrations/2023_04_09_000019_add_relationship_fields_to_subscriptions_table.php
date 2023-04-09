<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8302744')->references('id')->on('users');
            $table->unsignedBigInteger('subscription_type_id')->nullable();
            $table->foreign('subscription_type_id', 'subscription_type_fk_8303182')->references('id')->on('subscription_types');
        });
    }
}
