@extends('layouts.master')

@section('title') Content @endsection

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<section class="sectionContent detailContent">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="content-title">
                    <h3>@if ($DocType == '01')
                        FAQs
                        @elseif ($DocType == '02')
                        Business Practices
                        @elseif ($DocType == '03')
                        Discipline & Separation
                        @elseif ($DocType == '04')
                        Employment Relation
                        @elseif ($DocType == '05')
                        Industrial & Labour Relations at workplace
                        @elseif ($DocType == '06')
                        Labour Laws
                        @elseif ($DocType == '07')
                        Member Services
                        @elseif ($DocType == '08')
                        Working Environment & OSH
                        @endif
                    </h3>
                </div>
                <ol class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                                class="fa fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                            @if ($DocType == '01')
                            FAQs
                            @elseif ($DocType == '02')
                            Business Practices
                            @elseif ($DocType == '03')
                            Discipline & Separation
                            @elseif ($DocType == '04')
                            Employment Relation
                            @elseif ($DocType == '05')
                            Industrial & Labour Relations at workplace
                            @elseif ($DocType == '06')
                            Labour Laws
                            @elseif ($DocType == '07')
                            Member Services
                            @elseif ($DocType == '08')
                            Working Environment & OSH
                            @endif
                        </span></li>
                </ol>
                <button onclick="topFunction()" id="myBtn" title="Go to top"><i
                        class="fas fa-angle-double-up"></i></button>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-5">
                <div class="p-2">
                    @foreach ($Categories as $Categories)
                    @if ($Categories['Code'] == $activeCategory)
                    <div class="p-2">
                        <div class="contentData contentActive">
                            <p>{{$Categories['Document_Category']}}</p>
                        </div>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>
                    @else
                    <div class="p-2">
                        <a href="/singleDownload/{{$Categories['Code']}}/{{$Categories['Document_Type']}}/">
                            <div class="contentData">
                                <p>{{$Categories['Document_Category']}}</p>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>

                    @endif
                    @endforeach
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="contentCard">
                            <h5>Downloadable Templates</h5>
                            <hr>
                        </div>
                        <div class="row">
                            @forelse ($templates as $templates)
                            <div class="col-md-6">
                                <div class="fileDownloads mt-2">
                                    <div class="file-man-box" id="fileMan">
                                        <div class="file-img-box"><img src="{{ URL::asset('images/file.png')}}"
                                                alt="icon"></div>
                                        <a href="/download/{{$templates['ID']}}/{{$templates['File_Type']}}/{{$templates['File_Extension']}}"
                                            type="button" class="file-download"><i class="fa fa-download"></i></a>

                                        <div class="file-man-title">
                                            <h5 class="mb-0 text-overflow">
                                                {{$templates['File_Name']}}.{{$templates['File_Extension']}}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-md-12">
                                <p class="text-muted text-small">No Downlodable Templates</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6" id='Test'>

                @forelse ($documentLine as $documentLine)
                <div class="sectionHeaders">
                    <h4>{{$documentLine['Name']}}</h4>
                    <p>
                        {{$documentLine['Body']}}
                    </p>
                    @if ($documentLine['Has_List'] == TRUE)
                    @foreach ($ListItems as $ListItems)
                    @if ($ListItems['Document_Category_Line'] == $documentLine['Code'])
                    <ul>
                        <li>{{$ListItems['Item_Title']}}</li>
                    </ul>
                    @endif
                    @endforeach
                    @endif

                </div>
                @empty
                <p class="text-muted mt-4">No Article Content</p>
                @endforelse
                <div class="contentCard">
                    <h5>External Links </h5>
                    <hr>
                </div>
                @forelse ($links as $links)

                <div class="sectionHeaders my-3">
                    <a href="{{$links['Link']}}" target='blank'><span class="text-success mr-3"><i
                                class="fa fa-caret-right" aria-hidden="true"></i></span>{{$links['Link_Name']}} </a>
                </div>
                @empty
                <p class="text-muted mt-4">No Extarnal Link(s)</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
<!-- end row -->
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

})
// Scroll to Top BTN
// Get the button
let mybutton = document.getElementById("myBtn");

window.onscroll = function() {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>
@endsection