    @if(session("success"))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fas fa-check"></i> {{session('success')}}
    </div>
    @endif
    @if(session("error"))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fas fa-exclamation-circle"></i> {{session('error')}}
    </div>
    @endif
    @if(session("info"))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fas fa-info-circle"></i> {{session('info')}}
    </div>
    @endif