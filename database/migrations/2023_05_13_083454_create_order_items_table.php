<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('orders_id');

            $table->string('article_baget')->comment('Артикул багета');
            $table->string('chop')->comment('Внутренний размер рамы (ЧОП)');
            $table->string('window_size')->comment('Размер окна (работы)');
            $table->string('article_kanta')->comment('Артикул канта');
            $table->string('article_pasp')->comment('Артикул паспарту');
            $table->string('field_width')->comment('Ширина поля');
            $table->string('quantity')->comment('Кол-во');
            $table->string('amount')->comment('Сумма');

            $table->foreign('orders_id')->references('id')->on('orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
