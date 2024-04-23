@extends('layouts.master')

@section('title') View Service @endsection
@section('css')

<link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="//www.cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
    type="text/css">

@endsection

@section('content')
<link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<div class="row" id="holder">
    <div class="container-fluid px-0">
        <div class="row">
            <!-- Users box-->
            <div class="col-md-12 col-sm-12">
                <div class="content-title mt-3">
                    <h3> Service Request </h3>
                </div>
                <ol class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                                class="fa fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                            View Service Request
                        </span></li>
                </ol>
                <div class="bg-gray px-4 py-2 bg-light mb-2">
                    <div class="row">
                        <p class="h5 mb-0 py-1">Recent Services </p>
                        <button type="button" class="btn btn-danger  waves-effect waves-light ml-2" data-toggle="modal"
                            data-target="#composemodal">
                            New Service
                        </button>
                    </div>
                    <!--  Service Request Modal -->
                    <div class="modal fade col-lg-12" id="composemodal" tabindex="-1" role="dialog"
                        aria-labelledby="composemodalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="composemodalTitle">New Service</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="" action="{{ action('ServicesController@newInquiry') }}">
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="role" class="col-md-2 col-form-label">Subject</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="service" id="service">
                                                    <option>-------Select Subject--------</option>
                                                    @foreach ($Services as $service)
                                                    <option value="{{ $service['Service_Code'] }}">
                                                        {{ $service['Service_Code'] }} -
                                                        {{ $service['Service_Description'] }} -
                                                        {{ $service['Chargeable_Amount'] > 0 ? 'Chargeable' : 'Free' }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="role" class="col-md-2 col-form-label">Subject
                                                Description</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="servicevalue" id="servicevalue">
                                                    <option>Select Subject Description</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="role" class="form-label col-md-2">Inquiry</label>
                                            <textarea class="form-control col-md-10" id="role" name="sms"
                                                required></textarea>
                                        </div>
                                        @if ($service['Chargeable_Amount'] > 0)
                                        <div class="form-group row">
                                            <label for="role" class="col-md-2 col-form-label">Payment Method</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="paymethod">
                                                    <option value="">Select Payment Method</option>
                                                    @foreach ($PaymentMethods as $method)
                                                    <option value="{{ $method['Code'] }}"> {{ $method['Code'] }} -
                                                        {{ $method['Description'] }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Send <i
                                                class="fab fa-telegram-plane ml-1"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row rounded-lg overflow-hidden shadow">
            <div class="col-md-5">
                <div class="bg-white">
                    <div class="messages-box">
                        <div class="list-group rounded-0" id="lazyScrollLoading_services">
                            @foreach ($MyServices as $MyService)
                            <a href="#" name="AllServices" data-no="{{$MyService['No']}}"
                                class="list-group-item list-group-item-action list-group-item-light rounded-0 view_services">
                                <div class="media">
                                    <div class="media-body ml-4">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <h6 class="mb-0">{{ $MyService['Service_Code'] }}</h6><small
                                                class="small font-weight-bold">
                                                {{
                                                    date_format(date_create($MyService['Request_Date']), "d M")
                                                }}
                                            </small>
                                        </div>
                                        <p class="font-italic text-muted mb-0 text-small">
                                            {{ $MyService['Service_Description'] }}</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="px-4 py-5 chat-box bg-secondary" id="servicelines">
                    @foreach ($ServiceLines as $request)

                    @if($request['Response_Type'] == 'Inquiry')
                    <!-- User Message-->
                    <div class="media w-75 ml-auto mb-3 col-sm-12">
                        <div class="media-body">
                            <div class="bg-primary rounded py-2 px-3 mb-2 ">
                                <p class="text-small mb-0 text-white">{{ $request['response'] }}</p>
                            </div>
                            <p class="small text-muted">{{$request['Response_Time']}} |
                                {{ date_format(date_create($request['Response_Date']), "d M") }}</p>
                        </div>
                    </div>
                    @elseif ($request['Response_Type'] == 'Response')
                    <!-- FKE Response-->
                    <div class="media w-75 mb-3"><img
                            src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user"
                            width="50" class="rounded-circle">
                        <div class="media-body ml-3">
                            <div class="bg-light rounded py-2 px-3 mb-2">
                                <p class="text-small mb-0 text-muted"> {{$request['response']}} </p>
                            </div>
                            <p class="small text-muted">{{$request['Response_Time']}} |
                                {{ date_format(date_create($request['Response_Date']), "d M") }}</p>
                        </div>
                    </div>
                    @endif

                    @endforeach
                </div>

                <!-- Typing area -->
                <form action="{{ action('ServicesController@inquire') }}" class="bg-light">
                    <div class="input-group mt-2">
                        <input type="hidden" name="code" id="code" value="{{ $LastNo }}">
                        <input type="text" name="inquiry" placeholder="Type a message" aria-describedby="button-addon2"
                            class="form-control rounded-0 border-0 py-4 bg-light text-dark" required>
                        <div class="input-group-append">
                            <button id="button-addon2" type="submit" class="btn btn-link" style=""> <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Services Box-->


</div>
</div>
</div>
<!-- end row -->
</form>
@endsection



@section('script')

<!-- Required datatable js -->
<script src="{{URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{URL::asset('/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
<script src="{{URL::asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

<!-- form advanced init -->
<script src="{{URL::asset('/js/pages/form-advanced.init.js')}}"></script>
<script src="//www.code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="//www.cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<!-- Datatable init js -->
<script src="{{ URL::asset('/js/pages/datatables.init.js')}}"></script>
<script src="{{URL::asset('/js/pages/form-advanced.init.js')}}"></script>
<script type="text/javascript" src="js/jquery.lazyscrollloading.js"></script>

<!-- Load Services: -->
<script>
$(document).ready(function() {
    window.addEventListener('scroll', (e) => {
        const nav = document.querySelector('.navbar');
        if (window.pageYOffset > 0) {
            nav.classList.add("add-shadow");
        } else {
            nav.classList.remove("add-shadow");
        }
    });
    $("a[name=AllServices]").on('click', function(e) {
        e.preventDefault();
        var no = $(this).data('no');

        $('#code').empty();
        $('#code').val(no);

        var element = $('#servicelines');
        element.empty();

        $.ajax({
            url: '/servicelines/' + no,
            method: "GET",
            success: function(response) {
                var details = $.parseJSON(response);
                var MyServices = details.ServiceLines;

                if (MyServices !== null) {
                    $.each(MyServices, function(MyServices, service) {

                        if (service.Response_Type == 'Inquiry') {
                            var html =
                                '<div class="media w-75 ml-auto mb-3 col-sm-12">';
                            html += '<div class="media-body">';
                            html +=
                                '<div class="bg-primary rounded py-2 px-3 mb-2 ">';
                            html += '<p class="text-small mb-0 text-white">' +
                                service.response + '</p>';
                            html += '</div>';
                            html += '<p class="small text-muted">' + service
                                .Response_Time + ' | ' + service.service_date +
                                '</p>';
                            html += '</div>';
                            html += '</div>';

                        } else if (service.Response_Type == 'Response') {
                            var html = '<div class="media w-75 mb-3">';
                            html +=
                                '<img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">';
                            html += '<div class="media-body ml-3">';
                            html += '<div class="bg-light rounded py-2 px-3 mb-2">';
                            html += '<p class="text-small mb-0 text-muted">' +
                                service.response + '</p>';
                            html += '</div>';
                            html += '<p class="small text-muted">' + service
                                .Response_Time + ' | ' + service.service_date +
                                '</p>';
                            html += '</div>';
                            html += '</div>';
                        }

                        element.append(html);
                    });
                }
            }
        })
    });

    $("#lazyScrollLoading_services").lazyScrollLoading({
        isDefaultLazyImageMode: true
    });
});

$(document).ready(function() {
    //Load Service Description
    $('#service').change(function() {
        var Scode = $(this).val();
        $.ajax({
            url: '/serviceValues/' + Scode,
            Method: 'Get',
            success: function(response) {
                values = response;
                if (values !== null) {
                    var ServiceValues = "<option>Select Subject Description</option>";
                    $.each(response, function(value, data) {
                        var desc = data.Service_Value_Description;
                        ServiceValues += "<option value='" + desc + "'>" + desc +
                            "</option>";
                    });
                    $('#servicevalue').html(ServiceValues);
                }
            }
        })
    });
})
</script>
@endsection