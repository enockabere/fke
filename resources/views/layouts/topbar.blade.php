<header id="page-topbar">
    <nav class="navbar navbar-expand-lg  fixed-top navbar-light bg-light">
        <div class="container-fluid">

            <div class="float-left">

                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item" id="page-header-user-dropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">

                        <img class="rounded-circle header-profile-user img-fluid"
                            src="{{ URL::asset('images/dp.png')}}">
                    </button>
                    <div class="dropdown-menu dropdown-menu">

                        <a class="dropdown-item" href="/myprofile"><i
                                class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                        <a class="dropdown-item text-danger" href="/logout"><i
                                class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                    </div>
                </div>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon  text-black"
                        id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="mdi mdi-bell-outline"></i>
                        <span
                            class="badge badge-danger badge-pill">{{isset($user['Announcements'])?$user['Announcements']:0}}</span>
                        <span class="rightdt"><br></span>
                    </button>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu p-0"
                        aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="/notifications" class="small"> View All</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                            <a href="/notifications" class="text-reset notification-item">
                                <div class="media">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="bx bx-cart"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1">Notification Title</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">{{isset($user['Announcements'])?$user['Announcements']:0}}
                                                Announcements</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        <div class="p-2 border-top">
                            <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="/notifications">
                                <i class="mdi mdi-arrow-right-circle mr-1"></i> View More..
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <a class="navbar-brand" href="/alldownloads/">
            <img src="{{ URL::asset('images/fkelogo.png')}}" alt="" class="img-rounded img-fluid fkelogoIMG" srcset="">
        </a>
    </nav>
</header>