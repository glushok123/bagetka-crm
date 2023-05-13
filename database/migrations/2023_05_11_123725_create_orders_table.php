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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->comment('ФИО клиента');
            $table->string('client_phone')->comment('Контактный телефон');
            
            $table->string('payment_method')->comment('Форма расчета'); //Выбор
            $table->string('status_materials')->comment('Статус материалов к заказу'); //Выбор
            $table->string('payment_status')->comment('Статус оплаты'); //Выбор
            
            $table->dateTime('date_reception')->comment('Дата приема');
            $table->dateTime('date_issuance')->comment('Дата выдачи');
            $table->string('prepayment')->comment('Предоплата');
            $table->string('total_amount')->comment('Итого');
            $table->text('delivery')->comment('Доставка');
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
        Schema::dropIfExists('orders');
    }
};
