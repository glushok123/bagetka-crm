@extends('layouts.app')

@section('content')

<style>
    .modal-backdrop.show{
        opacity: 0 !important;
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
    <div class='container' >
        <div id='calendar'></div>
    </div>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="myOffcanvas" aria-labelledby="offcanvasScrollingLabel">
      <div class="offcanvas-header">

                <span  id="buttonEdit">

                </span>
                <span   id="buttonPrint">

                </span>
                <span   id="buttonDownload">

                </span>

        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Заказ № <span id="numberord">1</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="row">
            <div class="row">
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" placeholder="name@example.com" id="client_name" value="1"  disabled>
                    <label for="floatingInput">ФИО клиента</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="client_phone" placeholder="name@example.com" id="client_phone" value="" disabled>
                    <label for="floatingInput">Контактный телефон</label>
                </div>

            </div>
            <div class="row">
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" placeholder="name@example.com" id="employee_name" value="" disabled>
                    <label for="floatingInput">ФИО сотрудника</label>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-2">
                            <input type="date" class="form-control"  placeholder="name@example.com" id="date_reception" value="" disabled>
                            <label for="floatingInput">Дата приема</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-2">
                            <input type="date" class="form-control"  placeholder="name@example.com" id="date_issuance" value="" disabled>
                            <label for="floatingInput">Дата выдачи</label>
                        </div>
                    </div>
                </div>



                <!--div class="form-floating">
                    <select class="form-select"  aria-label="Floating label select example" name="status_materials">
                      <option value="1" selected>Наличные</option>
                      <option value="2">Я-деньги</option>
                      <option value="3">Безналичные</option>
                      <option value="4">чет</option>
                    </select>
                    <label for="floatingSelect">Статус материалов к заказу</label>
                </!div-->
            </div>
        </div>
        <br>
        <div class="row">

        </div>

        <br>

        <div class="row">
            <div class="row">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="out_of_work" disabled>
                    <label class="form-check-label" for="flexCheckDefault">
                        Без работы
                    </label>
                </div>
                <div class="form-floating mb-2">
                    <input type="number" class="form-control"  placeholder="name@example.com" id="prepayment" value="" disabled>
                    <label for="floatingInput">Предоплата</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="number" class="form-control"  placeholder="name@example.com" id="total_amount" value="" disabled>
                    <label for="floatingInput">Итого</label>
                </div>

            </div>
            <div class="row">
                <!--div class="form-floating mb-2">
                    <select class="form-select"  aria-label="Floating label select example" name="payment_status">
                      <option value="1" selected>Наличные</option>
                      <option value="2">Я-деньги</option>
                      <option value="3">Безналичные</option>
                      <option value="4">чет</option>
                    </select>
                    <label for="floatingSelect">Статус оплаты</label>
                </!div-->

                <div class="form-floating mb-2">
                    <textarea class="form-control" placeholder="Leave a comment here"  style="height: 80px" id="delivery" disabled></textarea>
                    <label for="floatingTextarea2">Доставка</label>
                </div>
                <div class="form-floating mb-2">
                    <textarea class="form-control" placeholder="Leave a comment here"  style="height: 80px" id="comment" disabled></textarea>
                    <label for="floatingTextarea2">Комментарий</label>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection

<style>
    .fc-event-title {
        padding: 0 1px;
        float: left;
        clear: none;
        margin-right: 10px;
    }
    .fc-daygrid-event{
        white-space: normal !important;
    }
</style>

@section('after_scripts')
    <script>
        const bsOffcanvas = new bootstrap.Offcanvas('#myOffcanvas')

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'ru',
                initialView: 'dayGridMonth',
                eventSources: [
                    {  
                        url: '/calendar/get/json/arb', // use the `url` property
                        //color: 'yellow',    // an option!
                        //textColor: 'black'  // an option!
                    },
                    {  
                        url: '/calendar/get/json/kuzn', // use the `url` property
                        color: 'green',    // an option!
                        textColor: 'white'  // an option!
                    },
                ],
                eventClick: function(info) {
                    console.log(info.event.id)
                    $('#loader-curent').show()
                    $.ajax({
                        url: '/calendar/get/json/id/' + info.event.id,
                        method: 'post',
                        dataType: "json",
                        data: {},
                        async: true,
                        success: function(data) {
                            $('#numberord').text(data.orderOld.numberord)
                            $('#client_name').val(data.orderNew.client_name)
                            $('#client_phone').val(data.orderNew.client_phone)
                            $('#employee_name').val(data.orderNew.employee_name)
                            $('#date_reception').val(data.orderNew.date_reception)
                            $('#date_issuance').val(data.orderNew.date_issuance)

                            if (data.orderNew.out_of_work == 1) {
                                $('#out_of_work').prop('checked', true);
                            }
                            $('#prepayment').val(data.orderNew.prepayment)
                            $('#total_amount').val(data.orderNew.total_amount)
                            $('#delivery').val(data.orderNew.delivery)
                            $('#comment').val(data.orderNew.comment)
                            $("#buttonEdit" ).html(data.buttonEdit);
                            $("#buttonPrint" ).html(data.buttonPrint);
                            $("#buttonDownload" ).html(data.buttonDownload);
                            console.log(data)
                            $('#loader-curent').hide()
                            bsOffcanvas.show()
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
                    
                    //let window1 = window.open("/orders/edit/" + info.event.id, "_blank");
                    //window1.focus();

                },
            });
            calendar.render();
            $('#loader-curent').hide()
        });

    </script>
@endsection

@section('description', 'CRM Багетной мастерской')
@section('keywords', 'CRM Багетной мастерской')
@section('title', 'CRM Багетной мастерской')