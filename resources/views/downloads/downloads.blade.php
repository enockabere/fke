<!-- @extends('layouts.master') -->

@section('title') Downloads @endsection

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<style>
.domain-form .form-group input {
    z-index: 999 !important;
    height: 50px !important;
    border: transparent;
}

.form-control {
    height: 52px !important;
    background: #fff !important;
    color: #3a4348 !important;
    font-size: 18px;
    border-radius: 0px;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
}

.px-4 {
    padding-left: 1.5rem !important;
}

.domain-form .form-group .search-domain {
    background: #ba0e2c;
    border: 2px solid #ba0e2c;
    color: #fff;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    border-radius: 0;
}
</style>
<section class="contentSection">
    <div class="container-fluid">
        <!-- banner start -->
        <div class="row my-4">
            <div class="col-md-7">
                <div class="content-title">
                    <h3>Welcome, <span class="header-title">{{$MyProfile['Name']}}</span> </h3>
                    <p>
                        All systems are running smoothly! You have <span class="br"><a
                                href="/notification">{{isset($user['Announcements'])?$user['Announcements']:0}} unread
                                notifications</a></span>
                    </p>
                </div>
            </div>
            <div class="col-md-5 mt-4">
                <form action="{{action('DownloadsController@SearchContent')}}" class="domain-form" method="post">
                    {{ csrf_field() }}
                    <div class="form-group d-md-flex">
                        <input type="text" class="form-control px-4" name='searchQuery'
                            placeholder="Enter your search query...">
                        <input type="submit" class="search-domain btn btn-primary px-5" value="Search in FKE">
                    </div>
                </form>
            </div>
        </div>
        <script>
        document.querySelector(".header-title").innerText = document.querySelector(".header-title").innerText
            .toLowerCase().replace(/\b(\w)/g, x => x.toUpperCase());
        </script>
        <div class="row my-4">
            <div class="col-md-5 my-2">
                <div class="content-banner">
                    <div class="mr-auto text-center text-white-70">
                        <p>
                            Be part of our journey and find out how Kenya’s premier employers’ organization
                            can empower
                            your business.
                        </p>
                        <div class="banner-action">
                            <a href="https://www.fke-kenya.org/sites/default/files/downloads/FKE%20Training%20Calendar%202024_1.pdf"
                                class="btn btn-primary button-5" target="blank">Learn More <i
                                    class="fa fa-arrow-circle-right mx-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-2">
                <div class="card-box bg-red h-100">
                    <div class="inner">
                        <h3>KES
                            {{($MyProfile['Member_Balances'] + $MyProfile['Balance']) > 0 ? number_format(($MyProfile['Member_Balances'] + $MyProfile['Balance']), 2) : number_format(0,2)}}
                        </h3>
                        <p> Balance Due </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-wallet"></i>
                    </div>
                    @if ((($MyProfile['Member_Balances'] + $MyProfile['Balance']) > 0) && ($user['Category_code'] !==
                    'AFF'))
                    <a href="/paymentgateway/{{($MyProfile['Member_Balances'] + $MyProfile['Balance'])}}"
                        class="card-box-footer">Pay Now <i class="fa fa-arrow-circle-right"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-md-2 my-2">
                <div class="card-box iconCard h-100">
                    <div class="inner">
                        <h3>{{$ServicesCount}} </h3>
                        <p>Active Service Requests</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <a href="/myservices/active" class="card-box-footer">View All <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-2 my-2">
                <div class="card-box iconCard h-100">
                    <div class="inner">
                        <h3><i class="las la-user-circle"></i></h3>
                        <p>My Profile</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="/myprofile" class="card-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
</section>
<section class="sectionContent">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 my-1">
                <div class="menu-card">
                    <div class="contentCard">
                        <h3>Member Services</h3>
                    </div>
                    <div class="memberservices my-2 drops1">
                        <h4>Request for services online</h4>
                        <div class='menu-drops menu1'>
                            <p><a href="/newservice/" class="small-ident"><i class="las la-hand-point-right"></i> New
                                    Request</a></p>
                            <p><a href="/myservices/" class="small-ident"><i class="las la-hand-point-right"></i> My
                                    Services </a>
                            </p>
                        </div>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>
                    <div class="memberservices my-2 drops2">
                        <h4 class="">Book appointment online </h4>
                        <div class='menu-drops menu2'>
                            <p><a href="/newappointments" class="small-ident"><i class="las la-hand-point-right"></i>
                                    New Appointment
                                </a>
                            </p>
                            <p><a href="/Rescheduledappointments" class="small-ident"><i
                                        class="las la-hand-point-right"></i> Rescheduled
                                    Appointment </a></p>
                            <p><a href="/allappointments" class="small-ident"><i class="las la-hand-point-right"></i>
                                    All
                                    Appointments
                                </a>
                            </p>
                        </div>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>
                    <div class="memberservices my-2 drops3">
                        <h4>Trainings</h4>
                        <div class='menu-drops menu3'>
                            <p><a href="/alltrainings/" class="small-ident"><i class="las la-hand-point-right"></i> All
                                    Trainings </a>
                            </p>
                            <p><a href="/mytrainings/" class="small-ident"><i class="las la-hand-point-right"></i> My
                                    Trainings </a>
                            </p>
                        </div>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>
                    <div class="memberservices my-2 drops4">
                        <h4>Events</h4>
                        <div class='menu-drops menu4'>
                            <p><a href="/upcomingevents/" class="small-ident"><i class="las la-hand-point-right"></i>
                                    All Events </a>
                            </p>
                            <p><a href="/myevents/" class="small-ident"><i class="las la-hand-point-right"></i> My
                                    Events </a>
                            </p>
                        </div>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>
                    <!-- <div class="memberservices my-2">
                        <p><a href="/cases" class="solo-menu"> Case
                                Management
                            </a>
                        </p>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div> -->
                    <div class="memberservices my-2 drops5">
                        <h4>Financials</h4>
                        <div class='menu-drops menu5'>
                            <p><a href="/quotations" class="small-ident"><i class="las la-hand-point-right"></i>
                                    Quotations</a>
                            </p>
                            <p><a href="/financials" class="small-ident"><i class="las la-hand-point-right"></i>
                                    Invoices </a>
                            </p>
                            <p><a href="/receipts" class="small-ident"><i class="las la-hand-point-right"></i> Receipts
                                </a>
                            </p>
                            <p><a href="/getStatement/{{session('member_no')}}" target="_blank" class="small-ident"><i
                                        class="las la-hand-point-right"></i> Statement </a>
                            </p>

                        </div>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>
                    <div class="memberservices my-2 drops6">
                        <h4>User
                            Management</h4>
                        <div class='menu-drops menu6'>
                            <p><a href="/users" class="small-ident"><i class="las la-hand-point-right"></i>
                                    Users</a>
                            </p>
                            @if ($user['membertype'] == 'ASSOCIATION')
                            <p><a href="/associatedcompanies" class="small-ident"><i
                                        class="las la-hand-point-right"></i>
                                    Associated Companies </a>
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="memberservices my-2">
                        <p><a href="/users" class="solo-menu">
                            </a>
                        </p>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>
                    @if(session('isDocumentsAdmin') != null && session('isDocumentsAdmin') == true)
                    <div class="memberservices my-2">
                        <p><a href="/documents-admin" class="solo-menu">
                                Documents Admin </a>
                        </p>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>
                    @endif
                    <div class="memberservices my-2">
                        <p><a href="/contact" class="solo-menu"><i
                                    class="bx bx-mail-send font-size-16 align-middle mr-1 text-danger"></i>
                                Contact </a>
                        </p>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>

                    <div class="memberservices my-2">
                        <p><a href="/logout" class="solo-menu"><i
                                    class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
                                Logout </a>
                        </p>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>
                </div>
            </div>
            <div class="col-md-9 my-1">
                <div class="row">
                    <div class="col-md-4 my-1">
                        <div class="contentCard">
                            <h5>Industrial & Labour Relations at workplace </h5>
                            <hr>
                        </div>
                        @foreach ($IndustrialLabour as $IndustrialLabour)
                        <a href="/singleDownload/{{$IndustrialLabour['Code']}}/{{$IndustrialLabour['Category']}}/">
                            <div class="contentData">
                                <p>{{$IndustrialLabour['Title']}}</p>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                        @endforeach
                    </div>
                    <div class="col-md-4 my-1">
                        <div class="contentCard">
                            <h5>Discipline & Separation</h5>
                            <hr>
                        </div>
                        @foreach ($DisciplineSeparation as $DisciplineSeparation)
                        <a
                            href="/singleDownload/{{$DisciplineSeparation['Code']}}/{{$DisciplineSeparation['Category']}}/">
                            <div class="contentData">
                                <p>{{$DisciplineSeparation['Title']}}</p>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                        @endforeach
                    </div>
                    <div class="col-md-4 my-1">
                        <div class="contentCard">
                            <h5>Labour Laws</h5>
                            <hr>
                        </div>
                        @foreach ($labourLaws as $labourLaws)
                        <a href="/singleDownload/{{$labourLaws['Code']}}/{{$labourLaws['Category']}}/">
                            <div class="contentData">
                                <p>{{$labourLaws['Title']}}</p>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    @if (count($EmploymentRelation) > 0)
                    <div class="col-md-4 my-1">
                        <div class="contentCard">
                            <h5>Employment Relation </h5>
                            <hr>
                        </div>
                        @foreach ($EmploymentRelation as $EmploymentRelation)
                        <a href="/singleDownload/{{$EmploymentRelation['Code']}}/{{$EmploymentRelation['Category']}}/">
                            <div class="contentData">
                                <p>{{$EmploymentRelation['Title']}}</p>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                        @endforeach
                    </div>
                    @endif
                    @if (count($BusinessPractices) > 0)
                    <div class="col-md-4 my-1">
                        <div class="contentCard">
                            <h5>Business Practices</h5>
                            <hr>
                        </div>
                        @foreach ($BusinessPractices as $BusinessPractices)
                        <a href="/singleDownload/{{$BusinessPractices['Code']}}/{{$BusinessPractices['Category']}}/">
                            <div class="contentData">
                                <p>{{$BusinessPractices['Title']}}</p>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                        @endforeach
                    </div>
                    @endif
                    @if (count($WorkingEnvironment) > 0)
                    <div class="col-md-4 my-1">
                        <div class="contentCard">
                            <h5>Working Environment & OSH</h5>
                            <hr>
                        </div>
                        @foreach ($WorkingEnvironment as $WorkingEnvironment)
                        <a href="/singleDownload/{{$WorkingEnvironment['Code']}}/{{$WorkingEnvironment['Title']}}/">
                            <div class="contentData">
                                <p>{{$WorkingEnvironment['Title']}}</p>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                        @endforeach
                    </div>
                    @endif
                    @if (count($FAQs) > 0)
                    <div class="col-md-4 my-1">
                        <div class="contentCard">
                            <h5>FAQs</h5>
                            <hr>
                        </div>
                        @foreach ($FAQs as $FAQs)
                        <a href="/singleDownload/{{$FAQs['Code']}}/{{$FAQs['Title']}}/">
                            <div class="contentData">
                                <p>{{$FAQs['Title']}}</p>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</section>

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

});
</script>

@endsection