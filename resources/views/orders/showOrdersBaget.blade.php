@extends('layouts.app')

@section('content')


<style>
            .hidden{
            display:none;
        }
        /********************  Preloader Demo-11 *******************/
            .loader11{width:100px;height:70px;margin:50px auto;position:relative}
            .loader11 span{display:block;width:5px;height:10px;background:#e43632;position:absolute;bottom:0;animation:loading-11 2.25s infinite ease-in-out}
            .loader11 span:nth-child(2){left:11px;animation-delay:.2s}
            .loader11 span:nth-child(3){left:22px;animation-delay:.4s}
            .loader11 span:nth-child(4){left:33px;animation-delay:.6s}
            .loader11 span:nth-child(5){left:44px;animation-delay:.8s}
            .loader11 span:nth-child(6){left:55px;animation-delay:1s}
            .loader11 span:nth-child(7){left:66px;animation-delay:1.2s}
            .loader11 span:nth-child(8){left:77px;animation-delay:1.4s}
            .loader11 span:nth-child(9){left:88px;animation-delay:1.6s}
            @-webkit-keyframes loading-11{
                0%{height:10px;transform:translateY(0);background:#ff4d80}
                25%{height:60px;transform:translateY(15px);background:#3423a6}
                50%{height:10px;transform:translateY(-10px);background:#e29013}
                100%{height:10px;transform:translateY(0);background:#e50926}
            }
            @keyframes loading-11{
                0%{height:10px;transform:translateY(0);background:#ff4d80}
                25%{height:60px;transform:translateY(15px);background:#3423a6}
                50%{height:10px;transform:translateY(-10px);background:#e29013}
                100%{height:10px;transform:translateY(0);background:#e50926}
            }
</style>

<div class="container">
    <br/>
    <div class="row">

        <div class="col-md-12">
            <a href="{{ route('orders.create') }}" class="btn btn-outline-primary">Добавить заказ</a>
        </div>
    </div>
    <br/>
</div>


<div class="container" id='loader-curent'>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <div class="loader11">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <br/>
</div>

    <div class="container bg-white">
        <br>
        <div class="" style="width:100%">
            <table id="orders" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th width="4%">№</th>
                        <th width="4%">Номер</th>
                        <th width="8%">Дата принятия</th>
                        <th width="4%">Филиал</th>
                        <th width="8%">ФИО</th>
                        <th width="15%">Телефон</th>
                        <th width="10%">Комментарий</th>
                        <th width="4%">Сумма</th>
                        <th width="4%">Фото №1</th>
                        <th width="4%">Фото №2</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tfoot>
            </table>
        </div>

        <br>
    </div>

@endsection

@section('after_scripts')

    <script>
        $(document).ready(function () {
           var tableOrders =  $('#orders').DataTable(
                {
                    "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                        var info = $(this).DataTable().page.info();
                        $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
                        return nRow;
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    order: [[2, 'desc']],
                    drawCallback: function () {
                        var api = this.api();
                        var sum = 0;
                        var formated = 0;
                        //to show first th
                        $(api.column(0).footer()).html('Итого');

                        for(var i=7; i<=7;i++)
                        {
                            sum = api.column(i, {page:'current'}).data().sum();

                            //to format this sum
                            formated = parseFloat(sum).toLocaleString(undefined, {minimumFractionDigits:2});
                            $(api.column(i).footer()).html(formated);
                        }
                    },
                    language: {
                        "processing": "Подождите...",
                        "search": "Поиск:",
                        "lengthMenu": "Показать _MENU_ записей",
                        "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                        "infoEmpty": "Записи с 0 до 0 из 0 записей",
                        "infoFiltered": "(отфильтровано из _MAX_ записей)",
                        "loadingRecords": "Загрузка записей...",
                        "zeroRecords": "Записи отсутствуют.",
                        "emptyTable": "В таблице отсутствуют данные",
                        "paginate": {
                            "first": "Первая",
                            "previous": "Предыдущая",
                            "next": "Следующая",
                            "last": "Последняя"
                        },
                        "aria": {
                            "sortAscending": ": активировать для сортировки столбца по возрастанию",
                            "sortDescending": ": активировать для сортировки столбца по убыванию"
                        },
                        "select": {
                            "rows": {
                                "_": "Выбрано записей: %d",
                                "1": "Выбрана одна запись"
                            },
                            "cells": {
                                "_": "Выбрано %d ячеек",
                                "1": "Выбрана 1 ячейка "
                            },
                            "columns": {
                                "1": "Выбран 1 столбец ",
                                "_": "Выбрано %d столбцов "
                            }
                        },
                        "searchBuilder": {
                            "conditions": {
                                "string": {
                                    "startsWith": "Начинается с",
                                    "contains": "Содержит",
                                    "empty": "Пусто",
                                    "endsWith": "Заканчивается на",
                                    "equals": "Равно",
                                    "not": "Не",
                                    "notEmpty": "Не пусто",
                                    "notContains": "Не содержит",
                                    "notStartsWith": "Не начинается на",
                                    "notEndsWith": "Не заканчивается на"
                                },
                                "date": {
                                    "after": "После",
                                    "before": "До",
                                    "between": "Между",
                                    "empty": "Пусто",
                                    "equals": "Равно",
                                    "not": "Не",
                                    "notBetween": "Не между",
                                    "notEmpty": "Не пусто"
                                },
                                "number": {
                                    "empty": "Пусто",
                                    "equals": "Равно",
                                    "gt": "Больше чем",
                                    "gte": "Больше, чем равно",
                                    "lt": "Меньше чем",
                                    "lte": "Меньше, чем равно",
                                    "not": "Не",
                                    "notEmpty": "Не пусто",
                                    "between": "Между",
                                    "notBetween": "Не между ними"
                                },
                                "array": {
                                    "equals": "Равно",
                                    "empty": "Пусто",
                                    "contains": "Содержит",
                                    "not": "Не равно",
                                    "notEmpty": "Не пусто",
                                    "without": "Без"
                                }
                            },
                            "data": "Данные",
                            "deleteTitle": "Удалить условие фильтрации",
                            "logicAnd": "И",
                            "logicOr": "Или",
                            "title": {
                                "0": "Конструктор поиска",
                                "_": "Конструктор поиска (%d)"
                            },
                            "value": "Значение",
                            "add": "Добавить условие",
                            "button": {
                                "0": "Конструктор поиска",
                                "_": "Конструктор поиска (%d)"
                            },
                            "clearAll": "Очистить всё",
                            "condition": "Условие",
                            "leftTitle": "Превосходные критерии",
                            "rightTitle": "Критерии отступа"
                        },
                        "searchPanes": {
                            "clearMessage": "Очистить всё",
                            "collapse": {
                                "0": "Панели поиска",
                                "_": "Панели поиска (%d)"
                            },
                            "count": "{total}",
                            "countFiltered": "{shown} ({total})",
                            "emptyPanes": "Нет панелей поиска",
                            "loadMessage": "Загрузка панелей поиска",
                            "title": "Фильтры активны - %d",
                            "showMessage": "Показать все",
                            "collapseMessage": "Скрыть все"
                        },
                        "buttons": {
                            "pdf": "PDF",
                            "print": "Печать",
                            "collection": "Коллекция <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
                            "colvis": "Видимость столбцов",
                            "colvisRestore": "Восстановить видимость",
                            "copy": "Копировать",
                            "copyKeys": "Нажмите ctrl or u2318 + C, чтобы скопировать данные таблицы в буфер обмена.  Для отмены, щелкните по сообщению или нажмите escape.",
                            "copyTitle": "Скопировать в буфер обмена",
                            "csv": "CSV",
                            "excel": "Excel",
                            "pageLength": {
                                "-1": "Показать все строки",
                                "_": "Показать %d строк",
                                "1": "Показать 1 строку"
                            },
                            "removeState": "Удалить",
                            "renameState": "Переименовать",
                            "copySuccess": {
                                "1": "Строка скопирована в буфер обмена",
                                "_": "Скопировано %d строк в буфер обмена"
                            },
                            "createState": "Создать состояние",
                            "removeAllStates": "Удалить все состояния",
                            "savedStates": "Сохраненные состояния",
                            "stateRestore": "Состояние %d",
                            "updateState": "Обновить"
                        },
                        "decimal": ".",
                        "infoThousands": ",",
                        "autoFill": {
                            "cancel": "Отменить",
                            "fill": "Заполнить все ячейки <i>%d<i><\/i><\/i>",
                            "fillHorizontal": "Заполнить ячейки по горизонтали",
                            "fillVertical": "Заполнить ячейки по вертикали",
                            "info": "Информация"
                        },
                        "datetime": {
                            "previous": "Предыдущий",
                            "next": "Следующий",
                            "hours": "Часы",
                            "minutes": "Минуты",
                            "seconds": "Секунды",
                            "unknown": "Неизвестный",
                            "amPm": [
                                "AM",
                                "PM"
                            ],
                            "months": {
                                "0": "Январь",
                                "1": "Февраль",
                                "10": "Ноябрь",
                                "11": "Декабрь",
                                "2": "Март",
                                "3": "Апрель",
                                "4": "Май",
                                "5": "Июнь",
                                "6": "Июль",
                                "7": "Август",
                                "8": "Сентябрь",
                                "9": "Октябрь"
                            },
                            "weekdays": [
                                "Вс",
                                "Пн",
                                "Вт",
                                "Ср",
                                "Чт",
                                "Пт",
                                "Сб"
                            ]
                        },
                        "editor": {
                            "close": "Закрыть",
                            "create": {
                                "button": "Новый",
                                "title": "Создать новую запись",
                                "submit": "Создать"
                            },
                            "edit": {
                                "button": "Изменить",
                                "title": "Изменить запись",
                                "submit": "Изменить"
                            },
                            "remove": {
                                "button": "Удалить",
                                "title": "Удалить",
                                "submit": "Удалить",
                                "confirm": {
                                    "_": "Вы точно хотите удалить %d строк?",
                                    "1": "Вы точно хотите удалить 1 строку?"
                                }
                            },
                            "multi": {
                                "restore": "Отменить изменения",
                                "title": "Несколько значений",
                                "noMulti": "Это поле должно редактироватся отдельно, а не как часть групы",
                                "info": "Выбранные элементы содержат разные значения для этого входа.  Чтобы отредактировать и установить для всех элементов этого ввода одинаковое значение, нажмите или коснитесь здесь, в противном случае они сохранят свои индивидуальные значения."
                            },
                            "error": {
                                "system": "Возникла системная ошибка (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">Подробнее<\/a>)."
                            }
                        },
                        "searchPlaceholder": "Что ищете?",
                        "stateRestore": {
                            "creationModal": {
                                "button": "Создать",
                                "search": "Поиск",
                                "columns": {
                                    "search": "Поиск по столбцам",
                                    "visible": "Видимость столбцов"
                                },
                                "name": "Имя:",
                                "order": "Сортировка",
                                "paging": "Страницы",
                                "scroller": "Позиция прокрутки",
                                "searchBuilder": "Редактор поиска",
                                "select": "Выделение",
                                "title": "Создать новое состояние",
                                "toggleLabel": "Включает:"
                            },
                            "removeJoiner": "и",
                            "removeSubmit": "Удалить",
                            "renameButton": "Переименовать",
                            "duplicateError": "Состояние с таким именем уже существует.",
                            "emptyError": "Имя не может быть пустым.",
                            "emptyStates": "Нет сохраненных состояний",
                            "removeConfirm": "Вы уверены, что хотите удалить %s?",
                            "removeError": "Не удалось удалить состояние.",
                            "removeTitle": "Удалить состояние",
                            "renameLabel": "Новое имя для %s:",
                            "renameTitle": "Переименовать состояние"
                        },
                        "thousands": " "
                    },
                }
            );

            $.ajax({
                url: '/orders/get/json',
                method: 'post',
                dataType: "json",
                data: {},
                async: true,
                success: function(data) {
                    tableOrders.clear().draw();
                    tableOrders.rows.add(data.data).draw();
                    $('#loader-curent').hide()
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
        });
    </script>
@endsection

@section('description', 'Список заказов')
@section('keywords', 'Список заказов')
@section('title', 'Список заказов')