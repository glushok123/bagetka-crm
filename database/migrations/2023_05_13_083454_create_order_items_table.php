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
            $table->bigInteger('orders_id')->nullable();
            $table->string('article_baget')->nullable()->comment('Артикул багета');
            $table->string('chop')->nullable()->comment('Внутренний размер рамы (ЧОП)');
            $table->string('window_size')->nullable()->comment('Размер окна (работы)');
            $table->string('article_kanta')->nullable()->comment('Артикул канта');
            $table->string('article_pasp')->nullable()->comment('Артикул паспарту');
            $table->string('field_width')->nullable()->comment('Ширина поля');
            $table->string('quantity')->nullable()->comment('Кол-во');
            $table->string('amount')->nullable()->comment('Сумма');
            $table->string('backdrop')->nullable()->comment('Задник');
            $table->string('glass')->nullable()->comment('Стекло');

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
