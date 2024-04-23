@extends('layouts.master')

@section('title') My Profile @endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="content-title mt-3">
            <h3>My Profile</h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    Payment Gateway
                </span></li>
        </ol>
    </div>
</div>
<div class="row" id="holder">
    <div class="col-md-8">
        <div class="card h-100 p-2">
            <div class="row">
                <!-- Logo -->
                <div class="col-md-3">
                    <div class="profilelogos">
                        <img src="{{ URL::asset('images/client-logos/1.jpg')}}" class="img-fluid">
                        <!-- <img src=<?= $user['logo']; ?>> -->
                    </div>
                </div>
                <style>
                .profilelogos {
                    padding: 20px
                }

                .profilelogos img {
                    height: auto;
                    width: 140px;
                    border-radius: 50%
                }

                @media screen and (max-width:767px) {
                    .profilelogos {
                        margin-left: auto;
                        margin-right: auto;
                        width: 8em
                    }

                    #pro1 {
                        padding-left: 15px;
                    }

                    #c1 {
                        margin-left: 0px;
                        margin-bottom: 10px;
                    }
                }
                </style>
                <!-- Contact Details -->
                <div class="col-md-9" id="pro1">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="pname">{{$user['contact']}}</p>
                            <p class="pcompany">{{$MyProfile['Name']}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <i class="fas fa-users"> No of Employees:
                                {{number_format($MyProfile['No_of_Employees'])}} </i>
                        </div>
                        <div class="col-md-6">
                            <i class="fas fa-dollar-sign"> Outstanding Balance:
                                {{number_format(($MyProfile['Member_Balances'] + $MyProfile['Balance']),2)}} </i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-md-4">
                    <div class="card h-100 mb-2"
                        style="border-radius: 8px;background: whitesmoke; border: 2px solid #011A77">
                        <div class="card-body mx-auto text-center" id="c1">
                            <div class="row">
                                <div class="col-md-12  mb-1">
                                    <button class="btn btn-success" style=""><i class="far fa-envelope"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span> {{$MyProfile['E_Mail']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 mb-2"
                        style="border-radius: 8px;background: whitesmoke; border: 2px solid #011A77">
                        <div class="card-body mx-auto text-center">
                            <div class="row">
                                <div class="col-md-12  mb-1">
                                    <button class="btn btn-primary" style=""><i class="fas fa-phone"></i></button>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span>
                                        {{$MyProfile['Phone_No']}}
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100"
                        style="border-radius: 8px;background: whitesmoke; border: 2px solid #011A77">
                        <div class="card-body mx-auto text-center">
                            <div class="row">
                                <div class="col-md-12 mb-1">
                                    <button class="btn btn-danger" style=""><i class="fas fa-briefcase"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span>
                                        {{$MyProfile['Member_Type']}}
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 subscriptionstatus">
            <div class="p-2  mx-auto text-center">
                <p style="margin-top:35%">Subscription Status</p>
                <p class="my-4">{{$MyProfile['Status']}}</p>
                <p class="pstitle2">Expires on {{date_format(date_create($MyProfile['Expiry_Date']),"d F Y ")}}</p>
                @if ((($MyProfile['Member_Balances'] + $MyProfile['Balance']) > 0) &&
                ($user['Category_code'] !== 'AFF'))
                <a class="btn" id="dash_btns"
                    href="/paymentgateway/{{($MyProfile['Member_Balances'] + $MyProfile['Balance'])}}">Pay Now <i
                        class="mdi mdi-plus-circle"></i></a>
                @else
                <a class="btn ppaybutton" href="/downloadCertificate/{{$MyProfile['No']}}"><i class="fa fa-eye"
                        aria-hidden="true"></i>Membership Certificate</a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="card-body">
        <!-- Update Profile and Update Password -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">
                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                    <span class="d-none d-sm-block">Update Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#password" role="tab">
                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                    <span class="d-none d-sm-block">Update Password</span>
                </a>
            </li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content p-3 text-muted">
            <div class="tab-pane active" id="profile" role="tabpanel">
                <form method="POST" action="{{ action('UsersController@updateProfile') }}" id="submitprofileupdate"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <label for="businessname">Business Name</label>
                            <input class="form-control" name="businessname" type="text" placeholder="Business Name"
                                value="{{$MyProfile['Name']}}" id="Upbusinessname">
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="compreg">{{ __('Company Registration Number') }}</label>
                            <input class="form-control" name="compreg" type="text"
                                placeholder="Company Registration Number" id="compreg">
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="compreg">KRA Pin No.</label>
                            <input class="form-control" name="kraPinNo" type="text" placeholder="KRA Pin" id="kraPinNo">
                        </div>
                    </div>
                    <div class="spacer-10"></div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="email">Company E-Mail Address</label>
                            <input class="form-control" name="email" type="email" placeholder="Company E-Mail Address"
                                value="{{$MyProfile['E_Mail']}}" id="email">
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="phonenumber">Phone Number</label>
                            <input class="form-control" name="phone" type="text" placeholder="Phone Number"
                                value="{{$MyProfile['Phone_No']}}" id="phone">
                        </div>
                    </div>
                    <div class="spacer-10"></div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="natureofbusiness">{{ __('Nature Of Business') }}</label>
                                <select class="form-control" name="natureofbusiness" id="natureofbusiness">
                                    <option value="">Select Nature Of Business</option>
                                    <option value="Profit Making Institution">Profit Making Institution</option>
                                    <option value="Educational/Medical Institution">Educational/Medical Institution
                                    </option>
                                    <option value="Charitable/Religious Institution">Charitable/Religious
                                        Institution</option>
                                    @if(isset($MyProfile['Institution_Type']))
                                    <option value="{{$MyProfile['Institution_Type']}}" selected="selected">
                                        {{$MyProfile['Institution_Type']}}</option>
                                    @endif;
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">{{ __('Membership Category') }}</label>
                                <select id="category" name="category" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-12">
                            <label for="employees">No of Employeesss</label>
                            <input class="form-control" name="employees" type="text" placeholder="No of Employees"
                                value="{{$MyProfile['No_of_Employees']}}" id="employees">
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <label for="nssfcertificate">Upload NSSF document</label>
                            <div class="custom-file">
                                <input type="file" name="nssfcertificate" class="custom-file-input"
                                    id="nssfcertificate">
                                <label class="custom-file-label" for="nssfcertificate">Update NSSF Certificate</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <label for="physical_address">Company Physical Address</label>
                            <input class="form-control" name="physical_address" type="text"
                                placeholder="Building and Floor" value="{{$MyProfile['Building_and_Floor']}}"
                                id="physical_address">
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <label for="businesspermit">Upload Business Permit</label>
                            <div class="custom-file">
                                <input type="file" name="businesspermit" class="custom-file-input" id="businesspermit">
                                <label class="custom-file-label" for="businesspermit">Update Business Permit</label>
                            </div>
                        </div>
                    </div>
                    <div class="spacer-20"></div>
                    <button class="btn btn-primary">Update Profile</button>
            </div>
            </form>
            <div class="tab-pane" id="password" role="tabpanel">
                <form method="POST" action="{{ action('UsersController@updatePassword') }}" id="submitprofileupdate"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <label for="oldpassword">Old Passsword</label>
                            <input class="form-control" type="password" name="oldpassword" placeholder="Old Password">
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="newpassword">New Passsword</label>
                            <input class="form-control" type="password" name="newpassword" placeholder="New Password">
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="passwordconfirmation">Re-enter Passsword</label>
                            <input class="form-control" type="password" name="passwordconfirmation"
                                placeholder="Password Confirmation">
                        </div>

                    </div>
                    <div class="spacer-20"></div>
                    <button class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')

<!-- Required datatable js -->
<script src="{{ URL::asset('/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('/libs/jszip/jszip.min.js')}}"></script>
<script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js')}}"></script>

<!-- Datatable init js -->
<script src="{{ URL::asset('/js/pages/datatables.init.js')}}"></script>

<script>
window.onload = function set_variables() {
    //get list of category
    var regno = '<?= $regno; ?>';
    console.log(regno);

    $.ajax({
        type: "GET",
        url: "/memcategories/" + regno,
        success: function(result) {
            $("#category").html(result);
            var categs = <?php echo json_encode($MyProfile['Member_Category']); ?>;
            var catdesc = <?php echo json_encode($MyProfile['Category_Description']); ?>;

            if (categs) {
                console.log(categs);
                $('#category').append('<option value="' + categs + '" selected>' + catdesc +
                    '</option>');
            }

            var category = "<?php echo session('category');?>";
            var old_category = "<?php echo old('category');?>";
            category_cookie != null && category_cookie != '' ? $("#category").val(category_cookie) : $(
                "#category").val(old_category);
            $("#category").prop('disabled', false);
        }
    });
}

var $code = $('#Upbusinessname');
$('.edit-element').on('mousedown', function() {
    $(this).data('inputFocused', $code.is(":focus"));
}).click(function() {
    if ($(this).data('inputFocused')) {
        $code.blur();
    } else {
        $code.focus();
    }
});
</script>

@endsection