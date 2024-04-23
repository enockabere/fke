<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu" id="sidebarNav" style="background-color: #23282d">

    <div class="h-100">

        <div class="user-wid text-center py-4">

            <img src="{{ URL::asset('images/fkelogo2.png')}}" alt="" width="40%">


        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="/dashboard/" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="#" class="has-arrow waves-effect">
                        <i class="mdi mdi-download"></i>
                        <span>Content</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/alldownloads">All Content</a></li>
                        <!-- <li><a href="/mydownloads">My Downloads</a></li> -->
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow waves-effect">

                        <span>Request for services online</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/newservice/">New Request</a></li>
                        <li><a href="/myservices/">My Services</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-calendar"></i>
                        <span>Book appointment online</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/newappointments">New Appointment</a></li>
                        <li><a href="/Rescheduledappointments">Rescheduled Appointment</a></li>
                        <li><a href="/allappointments">All Appointments</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Trainings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/alltrainings/">All Trainings</a></li>
                        <li><a href="/mytrainings/">My Trainings</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="has-arrow waves-effect">
                        <i class="mdi mdi-calendar-text"></i>
                        <span>Events</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/upcomingevents/">All Events</a></li>
                        <li><a href="/myevents/">My Events</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow waves-effect">
                        <i class="mdi mdi-briefcase"></i>
                        <span>Case Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/cases">My Cases</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/myprofile" class=" waves-effect">
                        <i class="mdi mdi-account-badge"></i>
                        <span>Profile Management </span>
                    </a>
                </li>

                <!-- <li>
                    <a href="#" class="has-arrow waves-effect">
                        <i class="mdi mdi-account-group"></i>
                        <span>User Management</span>
                    </a>
                    <ul>
                        <li><a href="/users">Users</a></li>
                        @if (isset($user['membertype']) and $user['membertype'] == 'ASSOCIATION')
                        <li><a href="/associatedcompanies">Associated Companies</a></li>
                        @endif
                    </ul>
                </li> -->

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-bank-plus"></i>
                        <span>Financials</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/quotations">Quotations</a></li>
                        <li><a href="/financials">Invoices</a></li>
                        <li><a href="/receipts">Receipts</a></li>
                        <li><a href="/getStatement/{{session('member_no')}}" target="_blank">Statement</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/faqs/" class=" waves-effect">
                        <i class="mdi mdi-file"></i>
                        <span>FAQs</span>
                    </a>
                </li>
                @if(session('isDocumentsAdmin') != null && session('isDocumentsAdmin') == true)
                <li>
                    <a href="/documents-admin" class=" waves-effect">
                        <i class="mdi mdi-file"></i>
                        <span>Documents Admin</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->