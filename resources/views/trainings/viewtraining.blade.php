@extends('layouts.master')

@section('title') Trainings @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/libs/bootstrap-rating/bootstrap-rating.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <div class="col-md-9 col-sm-12">
        <div class="content-title mt-3">
            <h3> Offered Trainings </h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    Offered Trainings
                </span></li>
        </ol>
        <div class="card">
            <div class="training">
                <h3>{{$Training['Programme_Code']}} - {{$Training['Programme']}}</h3>
                <div class="spacer-20"></div>
                <div class="row">
                    <div class="col-lg-4"><b>Cost: {{$Training['Total_Payable']}}
                            {{$Training['Invoicing_Method']}} </b> </div>
                    @if ($Training['Inclusive_of_VAT'] == 1)
                    <div class="col-lg-4">
                        <p><b>Cost Inclusive of VAT: <span class="text-primary">Yes</span> </b></p>
                    </div>
                    @else
                    <div class="col-lg-4">
                        <p><b>Cost Inclusive of VAT: <span class="text-primary">No</span> </b></p>
                    </div>
                    @endif
                    <div class="col-lg-4"><b>Training Method: {{$Training['Training_Method']}} </b> </div>

                    <div class="col-lg-4">
                        <b>{{$Training['Training_Method'] == 'Physical' ? 'Venue: '.$Training['Venue'] : '' }} </b>
                    </div>

                </div>
                <div class="tdivider"></div>
                <div class="spacer-10"></div>
                <p>{{$Training['Description']}}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Training Modules</h4>
                <div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive allTable">
                        <thead>
                            <tr>
                                <th>Programme Code</th>
                                <th>Module</th>
                                <th>Module Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Modules as $module)
                            <tr>
                                <td>{{$module['Programme_Code']}}</td>
                                <td>{{$module['Module']}}</td>
                                <td>{{$module['Module_Description']}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Targeted Participants</h4>

                <div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive allTable">
                        <thead>
                            <tr>
                                <th>Programme Code</th>
                                <th>Participant</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Participants as $Participant)
                            <tr>
                                <td>{{$Participant['Programme_Code']}}</td>
                                <td>{{$Participant['Target_Participant']}}</td>
                                <td>{{$Participant['Target_Participant_Description']}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Training Dates</h4>

                <div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive allTable">
                        <thead>
                            <tr>
                                <th>Programme Code</th>
                                <th>Module</th>
                                <th>Training Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Dates as $Date)
                            <tr>
                                <td>{{$Date['Programme_Code']}}</td>
                                <td>{{$Date['Training_Module']}}</td>
                                <td>{{$Date['Training_Date']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card p-3">
            <div class="form-group row eventform">
                <form method="POST" action="{{ action('TrainingsController@RegisterNewTraining') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="hidden" name="trainingno" value="{{$Training['No']}}">
                    <input Type="hidden" name="trainingtype" value="{{$Training['Training_Type']}}">
                    <button type="submit" class="btn btn-info w-100">Register Training <i
                            class="fas fa-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3><b>Training Facilitators:</b></h3>
            </div>
        </div>
        @foreach ($Facilitators as $facilitator)
        <div class="card trainercard">
            <div class="row">
                <div class="col-3">
                    <div class="col-md-6">
                        <div class="mt-4 mt-md-0">
                            <!--src="{{ URL::asset('images/dp.png') }}"-->

                            <img class="rounded-circle traineravi" alt="200x200" src=<?= $facilitator['image'] ?>
                                data-holder-rendered=" true">
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <p class="trainername">{{$facilitator['Facilitator_Name']}}</p>
                    <p class="trainerinfo">{{$facilitator['More_info']}}</p>
                    <div class="tdivider"></div>

                    <input type="hidden" class="rating" data-filled="mdi mdi-star text-primary"
                        data-empty="mdi mdi-star-outline text-muted" data-readonly value="5" />

                </div>
            </div>

        </div>
        @endforeach

    </div>
</div>

@endsection
@section('script')

<!-- Required datatable js -->
<script src="{{ URL::asset('/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js') }}"></script>

<!-- Bootstrap rating js -->
<script src="{{ URL::asset('libs/bootstrap-rating/bootstrap-rating.min.jss') }}"></script>

<script src="{{ URL::asset('js/pages/rating-init.jss') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
</script>

<!-- Datatable init js -->
<script src="{{ URL::asset('/js/pages/datatables.init.js') }}"></script>

@endsection