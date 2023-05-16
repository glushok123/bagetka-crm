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
            $table->string('order_number')->nullable()->comment('Номер заказа введенный пользователейм');

            $table->string('client_name')->nullable()->comment('ФИО клиента');
            $table->string('client_phone')->nullable()->comment('Контактный телефон');

            $table->string('payment_method')->nullable()->comment('Форма расчета'); //Выбор
            $table->string('status_materials')->nullable()->comment('Статус материалов к заказу'); //Выбор
            $table->string('payment_status')->nullable()->comment('Статус оплаты'); //Выбор

            $table->dateTime('date_reception')->nullable()->comment('Дата приема');
            $table->dateTime('date_issuance')->nullable()->comment('Дата выдачи');
            $table->string('prepayment')->nullable()->comment('Предоплата');
            $table->string('total_amount')->nullable()->comment('Итого');
            $table->text('delivery')->nullable()->comment('Доставка');
            $table->text('comment')->nullable()->comment('Коментарий');
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
