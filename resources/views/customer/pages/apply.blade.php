@extends('customer.layouts.frontend')
@section('title')Apply Vacancy @endsection

@push('css')
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush
    
@section('content')
    <div class="page-header-area">
        <div class="container">
            <div class="head-text pgh">
                <h3>
                    <span>Apply Vacancy</span>
                    <div class="name-sub">{{ $data->title }}</div>
                </h3>
                <p class="sub-head"><a href="/" class="brd breadcrumb-a">Home</a><a href="{{ route('list_vacancy',$data->id_division) }}" class="brd breadcrumb-a">Vacancy Listing</a><a href="{{ route('detail_vacancy',[$data->id_division, $data->id_vacancy]) }}" class="brd breadcrumb-a">Detail Vacancy</a><span class="brd breadcrumb-active">Apply Vacancy</span></p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="section-padding-50 content-page-wrap mt-5">
        <div class="row justify-content-md-center row-form-apply">
            <div class="col-md-10">
                <form id="form-apply" action="{{ route('apply_vacancy_post') }}" method="post">
                    @csrf
                    <input type="hidden" name="job_vacancy_id" value="{{ $data->id_vacancy }}">
                    <input type="hidden" name="count_criteria" value="{{count($arr_criteria)}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname">Fullname</label>
                                <input type="text" class="form-control" id="fullname" name="name" required autofocus>
                            </div>
                            <div class="form-row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="p_birth">Place of birth</label>
                                        <input type="text" class="form-control" id="p_birth" name="birth_place" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="p_birth">Date of birth</label>
                                        <input id="d_birth" placeholder="ex: 1990/10/29" name="birth_date" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone number</label>
                                <input type="text" class="form-control" id="phone" placeholder="ex: 08....." name="phone" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea id="address"class="form-control" rows="4" name="address" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            @if(count($arr_criteria) > 0)
                                <?php $nnO = 1; foreach($arr_criteria as $c): ?>
                                    <div class="box-questions mb-5">
                                        <h3 class="main_question">{{$c['criteria_name']}}</h3>
                                        @foreach($c['criteria_data'] as $key => $v)
                                            <div class="form-group">
                                                <label class="container_radio version_2">{{$v['name']}}
                                                    <input class="rd" type="radio" name="question_criteria_{{$c['criteria_id']}}[]" 
                                                    value="{{$v['id'].'_'.$v['value']}}" {{($key == 0)? 'required' : ''}}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        @endforeach
                                        <div class="checkValidOpt_{{$nnO}}"></div>
                                    </div>
                                <?php $nnO++; endforeach ?>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if(count($arr_skill) > 0)
                                <div class="box-questions mb-5">
                                    <h3 class="main_question">Choose Skills</h3>
                                    @foreach($arr_skill['skills'] as $keys => $s)
                                        <div class="form-group">
                                            <label class="container_check version_2">{{$s['name']}}
                                                <input class="ch" type="checkbox" name="question_skills[]" value="{{$s['id'].'_'.$s['value']}}">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    @endforeach
                                    <div class="checkValidCh"></div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-apply btn-apply-hg active-btn btn-block" id="form_submit_btn">Send Application</button>
                </form>
            </div>
            
        </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('plugins/daterangepicker/moment.min.js') }}" type="text/javascript"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        var today;
        today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#d_birth').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd',
            maxDate: today,
            weekStartDay: 1
        });

        $(document).ready(function() {
              $("#form-apply").validate({
                errorPlacement: function(error, element) {
                    // nothing
                },
                rules: {
                  name : {
                    required: true
                  },
                  birth_place: {
                    required: true
                  },
                  birth_date: {
                    required: true
                  },
                  email: {
                    required: true,
                    email: true
                  },
                  phone: {
                    required: true
                  },
                  address: {
                    required: true
                  },
                },
              });

                $(".ch").rules("add", { 
                    required:true
                });
                $('#form-apply').submit();
                $('#fullname').focus();
                $('#form_submit_btn').prop('disabled', 'disabled');
            });

            $('input').on('change keyup paste input blur focus', function() {
                if ($("#form-apply").valid()) {
                    $('#form_submit_btn').prop('disabled', false);  
                } else {
                    $('#form_submit_btn').prop('disabled', 'disabled');
                }
            });
            $('#address').bind('change keyup paste input blur focus propertychange', function() {
                if ($("#form-apply").valid()) {
                    $('#form_submit_btn').prop('disabled', false);  
                } else {
                    $('#form_submit_btn').prop('disabled', 'disabled');
                }
            });
    </script>
@endpush