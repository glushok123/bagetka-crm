<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>


    <style>
        body {
            font-size: 11px;
        }
        .custom-margin-top{
            margin-top:10px;
        }
        .custom-padding-top{
            padding-top:10px;
        }
        .border-table-custom {
            border: 1px solid black;
        }
        .border-table-custom  th{
            border: 1px solid black;
        }
        .border-table-custom td{
            border: 1px solid black;
        }
        tr.spaceUnder>td {
            padding-bottom: 1em;
        }
        tr.spaceUnder2>td {
            padding: 1em;
        }
        .text-bold{
            font-weight: bold; 
            font-size:15px;
        }
        .custom-checkbox{
            width: 15px !important;
            height: 15px !important;
        }
        .custom-font-size{
            font-size: 10px !important;
        }
    </style>

    <div class="container-fluid">
        <div class="row text-end">
            <span>Ст.м. Арбатская. Бланк заказа №1</span>
        </div>

        <table width="100%" class="custom-margin-top">
            <tr class="spaceUnder">
                <td class="text-start"><span>Форма расчета:  </span></td>
                <td class="text-end"><span>Принял: ___________________ </span></td>
            </tr>
            <tr class="spaceUnder">
                <td class="text-end" colspan="2"><span>Дата приема: ______________  </span><span>Дата выдачи:  _______________ </span></td>
            </tr>
            <tr class="spaceUnder">
                <td class="text-start" style="width:60%"><span>ФИО клиента: ______________  </span> <br> <span>Контактный телефон :  _______________ </span></td>
                <td class="" style="width:40%">
                    <div style="border: 1px solid black; min-height: 70px;">
                        <div class="row">
                            <span class="fst-italic" style="margin-left: 5px;">Статус материалов к заказу</span>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>


    <table class="table border-table-custom custom-margin-top custom-font-size" >
        <tr class="text-center">
            <th>Артикул багета</th>
            <th>Внутренний размер рамы (ЧОП)</th>
            <th>Размер окна (работы)</th>
            <th>Артикул канта</th>
            <th>Артикул паспарту</th>
            <th>Ширина поля </th>
            <th>Кол-во</th>
            <th>Сумма</th>

        </tr>
        @foreach([0,0,0] as $user)
            <tr>
                <td>Артикул багета</td>
                <td>Внутренний размер рамы (ЧОП)</td>
                <td>Размер окна (работы)</td>
                <td>Артикул канта</td>
                <td>Артикул паспарту</td>
                <td>Ширина поля </td>
                <td>Кол-во</td>
                <td>Сумма</td>
            </tr>
        @endforeach
    </table>

    <div class="row">

    </div>

    <table class="table  " >
        <tr class="text-center " >

            @foreach([0,0,0] as $user)
                <td >
   

                    <div style="border: 1px solid black; margin:3px;">
                        <div>
                            <span>Задник</span>
                            <div>
                                <input type="checkbox" id="scales" name="scales custom-checkbox" checked>
                                <label for="scales">Scales</label>
                              </div>
                        </div>
                        <hr>
                        <div>
                            <span>Стекло</span>
                        </div>
                    </td>
                    </div>

            @endforeach


        </tr>

    </table>

            
    <table width="100%" class="">
        <tr class="spaceUnder">
            <td  style="width:50%">
                <div style="border: 1px solid black; min-height: 170px;">
                    <div class="row">
                        <span class="fst-italic" style="margin-left: 5px;">Схема работы/описание</span>
                    </div>
                </div>
            </td>
            <td>
                <table width="100%" class="custom-margin-top">
                    <tr class="spaceUnder">
                        <td  style="width:50%">
                            <div style="border: 1px solid black; min-height: 40px;">
                                <div class="row">
                                    <span class="fst-italic" style="margin-left: 5px;">Предоплата:</span>
                                </div>
                            </div>
                            <div style="border: 1px solid black; min-height: 40px;">
                                <div class="row">
                                    <span class="fst-italic" style="margin-left: 5px;">Итого:</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="border: 1px solid black; min-height: 80px;">
                                <div class="row">
                                    <span class="fst-italic" style="margin-left: 5px;">Статус оплаты</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span>Я получил(а) и проверила готовый заказ в Багетной мастерской №1.</span>
                        </td>
                    </tr>
                    <tr>
                      
                        <td class="text-end" colspan="2"><span>ФИО: ______________  </span><span>Подпись :  _______________ </span></td>

                    </tr>
                </table>

            </td>

        </tr>
    </table>

    <hr style="border-top: 3px solid black;">

    <table>
        <tr>
            <td style="width:40%">
                <span class="text-bold">Бланк заказа № 17</span><br>
                <span class="text-bold">Дата получения __________</span><br><br>

                <div style="border: 1px solid black; min-height: 80px;">
                    <div class="row">
                        <span class="fst-italic" style="margin-left: 5px;">Сумма заказа:</span>
                    </div>
                </div>
            </td>
            <td style="width:60%">
                <ul>
                    <li>В течения дня получения Вам поступит СМС-уведомление о готовности, после которого Вы сможете получить заказ. </li>
                    <li>В случае отказа клиента от выполненных/ работ, сумма внесенной предоплаты не возвращается!</li>
                    <li>Срок хранения выполненного заказа – 1 месяц </li>
                </ul>
                <div style="margin-left:20px;">
                    <span><b>тел.</b>: 8(495)665-25-61 <b>WhatsApp</b>: 8(926)865-92-95 </span><br>
                    <span><b>Instagram</b>: bagetnaya1</span><br>
                    <span><b>e-mail</b>: manager@bagetnaya-masterskaya.com </span><br>
                    <span><b>web</b>: www.bagetnaya-masterskaya.com </span>
                </div>
            </td>
        </tr>
    </table>
    <br>
    <div class="row text-end">
        <span class="fst-italic">заказ оформлен в Багетной мастерской №1 по адресу: ул. Арбат, дом №1, ст.м. Арбатская</span>
    </div>
</body>
</html>