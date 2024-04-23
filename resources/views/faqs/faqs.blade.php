@extends('layouts.master')

@section('title') FAQS @endsection

@section('content')

@component('layouts.breadcrumb')
@slot('title') FAQS @endslot
@slot('li_1') Pages @endslot
@endcomponent

<div class="checkout-tabs">
    <div class="row">
        <div class="col-lg-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-gen-ques-tab" data-toggle="pill" href="#v-pills-gen-ques"
                    role="tab" aria-controls="v-pills-gen-ques" aria-selected="true">
                    <i class="bx bx-question-mark d-block check-nav-icon mt-4 mb-2"></i>
                    <p class="font-weight-bold mb-4">General Questions</p>
                </a>
                <a class="nav-link" id="v-pills-billing-tab" data-toggle="pill" href="#v-pills-billing" role="tab"
                    aria-controls="v-pills-billing" aria-selected="false">
                    <i class="bx bx-check-shield d-block check-nav-icon mt-4 mb-2"></i>
                    <p class="font-weight-bold mb-4">Billing</p>
                </a>
                <a class="nav-link" id="v-pills-support-tab" data-toggle="pill" href="#v-pills-support" role="tab"
                    aria-controls="v-pills-support" aria-selected="false">
                    <i class="bx bx-support d-block check-nav-icon mt-4 mb-2"></i>
                    <p class="font-weight-bold mb-4">Support</p>
                </a>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel"
                            aria-labelledby="v-pills-gen-ques-tab">
                            <h4 class="card-title mb-5">General Questions</h4>
                            @foreach ($General as $quiz)
                            <div class="faq-box media mb-4">
                                <div class="faq-icon mr-3">
                                    <i class="bx bx-help-circle font-size-20 text-success"></i>
                                </div>
                                <div class="media-body">
                                    <h5 class="font-size-15">{{$quiz['Question']}}?</h5>
                                    <p class="text-muted">{{$quiz['Answer']}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="tab-pane fade" id="v-pills-billing" role="tabpanel"
                            aria-labelledby="v-pills-billing-tab">
                            <h4 class="card-title mb-5">Billing Questions</h4>
                            @foreach ($Billing as $quiz)
                            <div class="faq-box media mb-4">
                                <div class="faq-icon mr-3">
                                    <i class="bx bx-help-circle font-size-20 text-success"></i>
                                </div>
                                <div class="media-body">
                                    <h5 class="font-size-15">{{$quiz['Question']}}?</h5>
                                    <p class="text-muted">{{$quiz['Answer']}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="tab-pane fade" id="v-pills-support" role="tabpanel"
                            aria-labelledby="v-pills-support-tab">
                            <h4 class="card-title mb-5">Support Questions</h4>
                            @foreach ($Support as $quiz)
                            <div class="faq-box media mb-4">
                                <div class="faq-icon mr-3">
                                    <i class="bx bx-help-circle font-size-20 text-success"></i>
                                </div>
                                <div class="media-body">
                                    <h5 class="font-size-15">{{$quiz['Question']}}?</h5>
                                    <p class="text-muted">{{$quiz['Answer']}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection