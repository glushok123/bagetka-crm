@extends('layouts.app')

@section('content')

    <div class="container-fluid bg-white">
        <br>
        <div class="" style="width:100%">
            <table id="orders" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Филиал</th>
                        <th>Дата принятия</th>
                        <th>Номер</th>
                        <th width="10%">ФИО</th>
                        <th>Телефон</th>
                        <th width="10%">Комментарий</th>
                        <th>Сумма</th>
                        <th width="5%">Фото №1</th>
                        <th width="5%">Фото №2</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->department == 'arb' ? "Арбат" : "Кузня" }}</td>
                            <td>{{ $order->datein }}</td>
                            <td>{{ $order->numberord }}</td>
                            <td class="nowrap">{{ $order->client_name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->comment }}</td>
                            <td>{{ $order->payment }}</td>
                            <td>
                                <a href="http://orders.bagetnaya-masterskaya.com/calendar/{{ $order->file_front }}" target="_blank">
                                    {!! empty($order->file_front) == true ? '' : '<i class="bi bi-arrow-right-square-fill"></i>' !!} 
                                </a>
                            </td>
                            <td>
                                <a href="http://orders.bagetnaya-masterskaya.com/calendar/{{ $order->file_back }}" target="_blank">
                                    {!! empty($order->file_back) == true ? '' : '<i class="bi bi-arrow-right-square-fill"></i>' !!} 
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('orders.edit', ['id' => $order->id]) }}" type="button" class="btn btn-outline-success">Перейти (редактировать)</a>
                                <a href="#" type="button" class="btn btn-outline-info"><i class="bi bi-printer-fill"></i></a>
                                <a href="#" type="button" class="btn btn-outline-danger"><i class="bi bi-file-earmark-pdf"></i></a>
                            </td>
                        </tr>
                    @endforeach
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
    </div>

@endsection

@section('after_scripts')

    <script>
        $(document).ready(function () {
            $('#orders').DataTable(
                {
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    order: [[1, 'desc']],
                    drawCallback: function () {
                        var api = this.api();
                        var sum = 0;
                        var formated = 0;
                        //to show first th
                        $(api.column(0).footer()).html('Итого');

                        for(var i=6; i<=6;i++)
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
        });
    </script>
@endsection

@section('description', 'Список заказов')
@section('keywords', 'Список заказов')
@section('title', 'Список заказов')