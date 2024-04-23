@extends('layouts.master')

@section('title') New Document @endsection
@section('css')

<link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">

@endsection

@section('content')
<link rel="stylesheet" href="/css/trix.css">

<div class="row" id="holder">
    <div class="col-md-12">
        <div class="content-title mt-3">
            <h3>Document </h3>
        </div>
        <ol class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="/documents-admin/" class="breadcrumbs text-danger"><i
                        class="fa fa-home"></i>
                    Home</a>
            </li>
            <li class="breadcrumb-item "><span class="breadcrumbs text-muted">
                    Document
                </span>
            </li>
        </ol>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ action('DocumentsAdminController@createUpdate') }}">
                    @csrf
                    <h4 class="card-title">Create/Edit Document</h4>
                    <input class="form-control" type="hidden" name="myAction" value="{{$data['myAction']}}">
                    @if($data['myAction'] == 'edit')
                    <input class="form-control" type="hidden" name="code" value="{{$data['Code']}}">
                    @endif
                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label">Title</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="text" class="form-control" name="title" placeholder="Title here"
                                    value="{{$data['myAction'] == 'edit'? $data['Title']:old('title')}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="col-md-2 col-form-label">Category</label>
                        <div class="col-md-10">
                            <select class="form-control" name="category" required>
                                <option value="">--Select--</option>
                                @if($data['categories'] != null)
                                @foreach ($data['categories'] as $category)
                                <option value="{{$category['Code']}}"
                                    {{($data['myAction'] == 'edit' && $data['Category'] == $category['Code'])? 'selected':''}}>
                                    {{$category["Code"]}} - {{$category["Document_Type"]}}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-md-2 col-form-label">Content</label>
                        <div class="col-md-10">
                            <input id="content" type="hidden" name="content" value="" />
                            <trix-editor input="content" value="78" style="min-height:300px" id="contentTrix">
                            </trix-editor>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="externalLinks" class="col-md-2 col-form-label">External Links</label>
                        <div class="col-md-10">
                            <input id="externalLinks" type="hidden" name="externalLinks" value="" />
                            <trix-editor input="externalLinks" id="linksTrix" style="min-height:100px"></trix-editor>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="templates" class="col-md-2 col-form-label">Templates</label>
                        <div class="col-md-10">
                            <input id="templates" type="hidden" name="templates" value="" />
                            <trix-editor input="templates" style="min-height:100px" id="templatesTrix">
                            </trix-editor>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="sequence" class="col-md-2 col-form-label">Display Sequence</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" name="sequence"
                                value="{{$data['myAction'] == 'edit'? $data['Sequence']:old('sequence')}}">
                        </div>
                    </div>
                    <button class=" btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->
</form>

@endsection



@section('script')
<!-- Required datatable js -->
<script src="{{ URL::asset('/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('/libs/jszip/jszip.min.js')}}"></script>
<script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="/js/trix.js"></script>
<script>
document.addEventListener("trix-initialize", function(event) {
    var editor = event.target;
    var myAction = "<?php echo $data['myAction']?>";
    if (myAction == "edit") {
        var content = '<?php echo $data['Content'];?>';
        var externalLinks = '<?php echo $data['ExternalLinks'];?>';
        var templates = '<?php echo $data['Templates'];?>';
        if (event.target.id == "contentTrix") {
            editor.editor.loadHTML(content);
        } else if (event.target.id == "linksTrix") {
            editor.editor.loadHTML(externalLinks);
        }
        // else if (event.target.id == "templatesTrix") {
        //     editor.editor.loadHTML(templates);
        // }
    }
});
</script>
@endsection