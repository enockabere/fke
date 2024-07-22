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
                    <h3>@if ($data["Category"] == '01')
                        FAQs
                        @elseif ($data["Category"] == '02')
                        Business Practices
                        @elseif ($data["Category"] == '03')
                        Discipline & Separation
                        @elseif ($data["Category"] == '04')
                        Employment Relation
                        @elseif ($data["Category"] == '05')
                        Industrial & Labour Relations at workplace
                        @elseif ($data["Category"] == '06')
                        Labour Laws
                        @elseif ($data["Category"] == '07')
                        Member Services
                        @elseif ($data["Category"] == '08')
                        Working Environment & OSH
                        @endif
                    </h3>
                </div>
                <ol class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                                class="fa fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                            @if ($data["Category"] == '01')
                            FAQs
                            @elseif ($data["Category"] == '02')
                            Business Practices
                            @elseif ($data["Category"] == '03')
                            Discipline & Separation
                            @elseif ($data["Category"] == '04')
                            Employment Relation
                            @elseif ($data["Category"] == '05')
                            Industrial & Labour Relations at workplace
                            @elseif ($data["Category"] == '06')
                            Labour Laws
                            @elseif ($data["Category"] == '07')
                            Member Services
                            @elseif ($data["Category"] == '08')
                            Working Environment & OSH
                            @endif
                        </span></li>
                </ol>
                <button onclick="topFunction()" id="myBtn" title="Go to top"><i
                        class="fas fa-angle-double-up"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="">
                    @foreach ($Categories as $Categories)
                    @if ($Categories['Code'] == $activeCategory)
                    <div class="">
                        <div class="contentData contentActive">
                            <p>{{$Categories['Title']}}</p>
                        </div>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>
                    @else
                    <div class="">
                        <a href="/singleDownload/{{$Categories['Code']}}/{{$Categories['Category']}}/">
                            <div class="contentData">
                                <p>{{$Categories['Title']}}</p>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                        <hr style="margin-top: -10px;border-top: 1px dotted red;">
                    </div>

                    @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-7">
                <div class="contentCard">
                    <h5>Content</h5>
                    <hr>
                    <p>{!!$data["Content"]!!}</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="contentCard">
                    <h5>Downloadable Templates</h5>
                    <hr>
                    @if($data['attachments'] != null)
                    <ul>
                        @foreach($data['attachments'] as $attachment)
                        <li><a href="/document-attachment/view/{{$attachment['ID']}}/{{$attachment['File_Name']}}/{{$attachment['File_Extension']}}"
                                target="_blank">{{$attachment['File_Name']}}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contentCard">
                    <h5>External Links</h5>
                    <hr>
                    <p>{!!$data["ExternalLinks"]!!}</p>
                </div>
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