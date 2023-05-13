@extends('layouts.app')

@section('content')

    <div class='container' >
        <div class="row text-center">
            <h2>Форма создания заказа</h2>
        </div>

        <hr>

        <form action="/" method="post" class="needs-validation" id="myForm">
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control"  placeholder="name@example.com" name="client_name">
                        <label for="floatingInput">ФИО клиента</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="client_phone" placeholder="name@example.com" name="client_phone">
                        <label for="floatingInput">Контактный телефон</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select"  aria-label="Floating label select example" name="payment_method">
                          <option value="1" selected>Наличные</option>
                          <option value="2">Я-деньги</option>
                          <option value="3">Безналичные</option>
                          <option value="4">чет</option>
                        </select>
                        <label for="floatingSelect">Форма расчета</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control"  placeholder="name@example.com" name="date_reception">
                        <label for="floatingInput">Дата приема</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control"  placeholder="name@example.com" name="date_issuance">
                        <label for="floatingInput">Дата выдачи</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select"  aria-label="Floating label select example" name="status_materials">
                          <option value="1" selected>Наличные</option>
                          <option value="2">Я-деньги</option>
                          <option value="3">Безналичные</option>
                          <option value="4">чет</option>
                        </select>
                        <label for="floatingSelect">Статус материалов к заказу</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Артикул багета</th>
                            <th>Внутренний размер рамы (ЧОП)</th>
                            <th>Размер окна (работы)</th>
                            <th>Артикул канта</th>
                            <th>Артикул паспарту</th>
                            <th>Ширина поля</th>
                            <th>Кол-во</th>
                            <th>Сумма</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-baget">
                        <tr>
                            <td><input type="text" class="form-control" name="article_baget[0]"></td>
                            <td><input type="text" class="form-control" name="chop[0]"></td>
                            <td><input type="text" class="form-control" name="window_size[0]"></td>
                            <td><input type="text" class="form-control" name="article_kanta[0]"></td>
                            <td><input type="text" class="form-control" name="article_pasp[0]"></td>
                            <td><input type="text" class="form-control" name="field_width[0]"> </td>
                            <td><input type="text" class="form-control" name="quantity[0]"></td>
                            <td><input type="text" class="form-control" name="amount[0]"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <button type="button" class="btn btn-info" style="max-width: 190px;" id="add-row-table">+ (добавить строку)</button>
            </div>

            <br>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control"  placeholder="name@example.com" name="prepayment">
                        <label for="floatingInput">Предоплата</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control"  placeholder="name@example.com" name="total_amount">
                        <label for="floatingInput">Итого</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <select class="form-select"  aria-label="Floating label select example" name="payment_status">
                          <option value="1" selected>Наличные</option>
                          <option value="2">Я-деньги</option>
                          <option value="3">Безналичные</option>
                          <option value="4">чет</option>
                        </select>
                        <label for="floatingSelect">Статус оплаты</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="delivery"></textarea>
                        <label for="floatingTextarea2">Доставка</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Создать</button>
            <button type="button" class="btn btn-primary" id="create-button">ТЕСТ</button>
          </form>
    </div>

@endsection

@section('after_scripts')


    <script>
        $("#client_phone").mask("8-999-999-99-99");

        var countRow = 1;

        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
                })
        })()

        function addRowTable() {
            let blockHtml = '<tr>';
            blockHtml = blockHtml + ' <td><input type="text" class="form-control"  name="article_baget[' + countRow + ']"></td>';
            blockHtml = blockHtml + ' <td><input type="text" class="form-control"  name="chop[' + countRow + ']"></td>';
            blockHtml = blockHtml + ' <td><input type="text" class="form-control"  name="window_size[' + countRow + ']"></td>';
            blockHtml = blockHtml + ' <td><input type="text" class="form-control"  name="article_kanta[' + countRow + ']"></td>';
            blockHtml = blockHtml + ' <td><input type="text" class="form-control"  name="article_pasp[' + countRow + ']"></td>';
            blockHtml = blockHtml + ' <td><input type="text" class="form-control"  name="field_width[' + countRow + ']"></td>';
            blockHtml = blockHtml + ' <td><input type="text" class="form-control"  name="quantity[' + countRow + ']"></td>';
            blockHtml = blockHtml + ' <td><input type="text" class="form-control"  name="amount[' + countRow + ']"></td>';
            blockHtml = blockHtml + '</tr>';
            $('#tbody-baget').append(blockHtml);
            countRow = countRow + 1;
        }

        function createButton() {

            var data = {};
            // переберём все элементы input, textarea и select формы с id="myForm "
            $('#myForm').find ('input, textearea, select').each(function() {
                // добавим новое свойство к объекту $data
                // имя свойства – значение атрибута name элемента
                // значение свойства – значение свойство value элемента
                data[this.name] = $(this).val();
            });

            console.log(data)

            let formData = new FormData($('#myForm')[0])
            console.log(formData)
            $.ajax({
                url: 'http://localhost:8083/orders/create',
                method: 'post',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data){
                    console.log(formData)
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.status === 0) {
                        alert('Not connect. Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found (404).');
                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error (500).');
                    } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert('Time out error.');
                    } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error. ' + jqXHR.responseText);
                    }
                }
            });
        }

        $(document).on('click', '#add-row-table', function() { addRowTable() }); // Добавление новой строки в таблице
        $(document).on('click', '#create-button', function() { createButton() }); // Отправка запроса на добавление нового заказа

    </script>
@endsection

@section('description', 'Форма создания заказа')
@section('keywords', 'Форма создания заказа')
@section('title', 'Форма создания заказа')