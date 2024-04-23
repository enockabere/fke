@extends('layouts.master')

@section('title') Downloads @endsection
@section('content')
<style>
.contentData:hover {
    background-color: #EBEDEF !important;
    padding: 0rem 1rem 0rem 1rem !important;

}

mark {
    background: red !important;
    color: white;
}
</style>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<section class="sectionContent">
    <div class="container">
        <div class="row my-4">
            <div class="col-md-12">
                <div class="content-title mt-3">
                    <h3>Search Results {{$searchQuery}}</h3>
                </div>
                <ol class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="/alldownloads/" class="breadcrumbs text-danger"><i
                                class="fa fa-home"></i>
                            Home</a>
                    </li>
                    <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                            Search Results
                        </span>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row my-5" id="highlight">
            @forelse ($data as $data)
            <div class="">
                <a href="/singleDownload/{{$data['Document_Category']}}/{{$data['Document_Type']}}/">
                    <div class="contentData">
                        <p>{{$data['Name']}}</p>
                        <div>
                            <p class="text-dark">
                                {{$data['Body']}}
                            </p>
                            </br>
                            <a href="/singleDownload/{{$data['Document_Category']}}/{{$data['Document_Type']}}/"
                                class="text-danger">View
                                Result
                                <span><i class="fa fa-arrow-right text-success"></i></span> <span>
                            </a>
                        </div>
                </a>
                <hr style="border-top: 1px dotted red;">
            </div>
            @empty
            <p class="text-muted">We found 0 resulsts from search query = {{$searchQuery}} </p>
            @endforelse
        </div>
    </div>
</section>
<script>
$(document).ready(function() {
    var src_str = $("#highlight").html();
    var term = '<?php echo $searchQuery; ?>';
    term = term.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
    var pattern = new RegExp("(" + term + ")", "gi");

    src_str = src_str.replace(pattern, "<mark>$1</mark>");
    src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/, "$1</mark>$2<mark>$4");

    $("#highlight").html(src_str)
});
</script>

@endsection