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
                <div id="block-alert"></div>
                <div class="rqd-notif"><b class="rq">*</b> Required fields</div>
                <form id="form-apply" action="{{ route('apply_vacancy_post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="job_vacancy_id" value="{{ $data->id_vacancy }}">
                    <input type="hidden" name="count_criteria" value="{{count($arr_criteria)}}">
                    <input type="hidden" name="vacancy_name" value="{{ $data->title }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group parent" valid-name="Fullname">
                                <label for="fullname">Fullname <i class="rqd">*</i></label>
                                <input type="text" class="form-control" id="fullname" name="name" required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-7">
                                    <div class="form-group parent" valid-name="Place of birth">
                                        <label for="p_birth">Place of birth <i class="rqd">*</i></label>
                                        <input type="text" class="form-control" id="p_birth" name="birth_place" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group parent" valid-name="Date of birth">
                                        <label for="p_birth">Date of birth <i class="rqd">*</i></label>
                                        <input id="d_birth" placeholder="ex: 1990/10/29" name="birth_date" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group parent" valid-name="Email address" data-alert="a-email">
                                <label for="email">Email address <i class="rqd">*</i></label>
                                <input type="email" class="form-control mail-input" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group parent" valid-name="NIK (KTP)" data-alert="a-nik">
                                        <label for="ktp">NIK (KTP) <i class="rqd">*</i></label>
                                        <input type="text" class="form-control ktp-input" id="ktp" name="ktp" minlength="16" maxlength="16" required>
                                    </div>
                                    <div class="form-group parent" valid-name="Nationality">
                                        <label for="nationality">Nationality <i class="rqd">*</i></label>
                                        <input type="text" class="form-control" id="nationality" placeholder="ex: Indonesia" name="nationality" required>
                                    </div>
                                    <div class="form-group parent" valid-name="Phone number">
                                        <label for="phone">Phone number <i class="rqd">*</i></label>
                                        <input type="text" class="form-control" id="phone" placeholder="ex: 08....." name="phone" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group parent" valid-name="Photo">
                                        <label for="phone">Photo <i class="rqd">*</i> <img src="{{ asset('img/help.svg') }}" alt="Info Photo" class="opt-info" width="16" data-toggle="tooltip" data-placement="top" title="Maximum file size 1 MB - acceptable file types .jpg, .jpeg, .gif, .png."></label>
                                        <input type="file" class="form-control img-input-hidden data-file-photo error" id="photo" name="photo" accept="image/x-png,image/gif,image/jpeg" required>
                                        <div class="position-relative">
                                            <div class="box-photo-upload photo_upload" ondrop="dropHandler(event);">
                                               <span class="d-block w-100 tx-drag-drop"><a href="javascript:void(0);" onclick="searchImageFile(this);">Upload a file</a> or drag and drop here</span>
                                            </div>
                                            <img src="" class="box-photo-upload img-upload d-none">
                                            <div class="opt-image-edit d-none" onclick="searchImageFile(this);" data-toggle="tooltip" data-placement="left" title="Edit Photo">
                                                <img src="{{ asset('img/edit-button.svg') }}" alt="Edit Photo" class="opt-edit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box-questions parent" valid-name="Gender">
                                <label>Gender <i class="rqd">*</i></label>
                                <div class="form-group">
                                    <label class="container_radio version_2 d-inline-block mr-4">Laki-laki
                                        <input class="rd" type="radio" name="gender" value="1" required>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container_radio version_2 d-inline-block">Perempuan
                                        <input class="rd" type="radio" name="gender" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group parent" valid-name="Religion">
                                <label for="religion_sel">Religion <i class="rqd">*</i></label>
                                <select name="religion" class="form-control" id="religion_sel" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="1">Islam</option>
                                    <option value="2">Kristen</option>
                                    <option value="3">Hindu</option>
                                    <option value="4">Buddha</option>
                                    <option value="5">Konghucu</option>
                                    <option value="6">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group parent" valid-name="Blood Type">
                                <label for="blood_sel">Blood Type <i class="rqd">*</i></label>
                                <select name="blood_type" class="form-control" id="blood_sel" required>
                                    <option value="">Pilih Golongan Darah</option>
                                    <option value="1">O</option>
                                    <option value="2">A</option>
                                    <option value="3">B</option>
                                    <option value="4">AB</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group parent" valid-name="Height">
                                    <label for="height">Height <i class="rqd">*</i></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="height" name="height" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Cm</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group parent" valid-name="Weight">
                                    <label for="weight">Weight <i class="rqd">*</i></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="weight" name="weight" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="social_media">Social Media</label>
                                <textarea id="social_media" valid-name="Social Media" class="form-control" rows="1" name="social_media" placeholder="FB: xxxx IG: xxxx etc."></textarea>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-12">
                            <div class="form-group parent" valid-name="Address">
                                <label for="address">Address <i class="rqd">*</i></label>
                                <textarea id="address" class="form-control" rows="4" name="address" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            @if(count($arr_criteria) > 0)
                                @foreach($arr_criteria as $c)
                                    <div class="box-questions mb-5 parent" valid-name="Question {{$c['criteria_name']}}">
                                        <h3 class="main_question">{{$c['criteria_name']}} <i class="rqd">*</i></h3>
                                        @foreach($c['criteria_data'] as $key => $v)
                                            <div class="form-group">
                                                <label class="container_radio version_2">{{$v['name']}}
                                                    <input class="rd" type="radio" name="question_criteria_{{$c['criteria_id']}}[]" 
                                                    value="{{$v['id'].'_'.$v['value']}}" {{($key == 0)? "required" : '' }}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if(count($arr_skill) > 0)
                                <div class="box-questions mb-5 parent" valid-name="Choose Skills">
                                    <h3 class="main_question">Choose Skills <i class="rqd">*</i> <img src="{{ asset('img/help.svg') }}" alt="Info Photo" class="opt-info" width="16" data-toggle="tooltip" data-placement="top" title="You must choose skill at least one"></h3>
                                    @foreach($arr_skill['skills'] as $keys => $s)
                                        <div class="form-group">
                                            <label class="container_check version_2">{{$s['name']}}
                                                <input class="ch" type="checkbox" name="question_skills[]" value="{{$s['id'].'_'.$s['value']}}" {{($keys == 0)? "required" : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <button type="button" class="btn btn-apply btn-apply-hg active-btn btn-block" id="form_submit_btn">Send Application</button>
                    <button type="submit" class="d-none">Submit</button>
                </form>
            </div>
            
        </div>
        </div>
    </div>
@endsection

@push('script-top')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha256-x3YZWtRjM8bJqf48dFAv/qmgL68SI4jqNWeSLMZaMGA=" crossorigin="anonymous"></script>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js" integrity="sha256-vb+6VObiUIaoRuSusdLRWtXs/ewuz62LgVXg2f1ZXGo=" crossorigin="anonymous"></script>

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
            $('[data-toggle="tooltip"]').tooltip();
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
                    religion: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    blood_type: {
                        required: true
                    },
                    ktp: {
                        required: true,
                        minlength: 16
                    },
                    weight: {
                        required: true
                    },
                    height: {
                        required: true
                    },
                    nationality: {
                        required: true
                    }
                }
            });

            $(".ch").rules("add", { 
                required:true
            });
            // $('#photo').rules('add', {
            //     required: true,
            //     accept: "image/jpeg, image/gif, image/png"
            // });
            $('#form-apply').submit();
            $('#fullname').focus();
            // exec valid form
            fncFormValid();

        });
        function execValdiationError() {
            var dataAlert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
                            '<button onclick="execHideAlert();" type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                '<span aria-hidden="true">×</span>'+
                            '</button>'+
                            '<h5 class="alert-heading">Validation error.</h5>';
            $('.error').each(function() {
                if( $(this).attr('type') == "checkbox"){
                    $('.ch').closest('label').find('.checkmark').each(function() {
                        $(this).addClass('is-invalid');
                    }); 
                }else if( $(this).attr('type') == "radio" ){
                    $(this).closest('label').find('.checkmark').addClass('is-invalid');
                }else if( $(this).attr('type') == "file" ){
                    $(this).closest('.form-group').find('.photo_upload').addClass('is-invalid');
                }else{
                    $(this).addClass('is-invalid');
                }
                var getTxErr = $(this).closest('.parent');
                if( $( this ).prop( 'required' )){
                    var cond_alert = ($(this).attr("name") == "ktp" || $(this).attr("name") == "email")? ' '+getTxErr.attr('data-alert') : '';
                    dataAlert += '<div class="list-err'+cond_alert+'"><b>'+getTxErr.attr('valid-name')+'</b> is required. </div>';
                }
                // validate ktp
                if( $(this).val() != "" && $(this).attr("name") == "ktp" ){
                    if($(this).val().length != 16) {
                        dataAlert += "<div class='list-err'><b>"+getTxErr.attr('valid-name')+"</b> must be a 16 digit number.</div>";
                    }
                }
                // validate email
                if( $(this).val() != "" && $(this).attr("type") == "email" ){
                    var regex = /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@a-zA-Z0-9?(?:.a-zA-Z0-9?)$/i;
                    if(!regex.test($("input[type = 'email']").val())) {
                        dataAlert += "<div class='list-err'><b>"+getTxErr.attr('valid-name')+"</b> must be a valid email.</div>";
                    }
                }
            });
            dataAlert += '<hr>'+
                            '<div class="mb-0"><small>Semua kolom yang bertanda <b>*</b> harus diisi.</small></div>'+
                        '</div>';
            if( !$('#block-alert').hasClass('hide-alert') ){
                $('#block-alert').html(dataAlert);

                if($('input.ktp-input').val() != "" && $('input.ktp-input').val().length != 16) {
                    $('#block-alert').find('.list-err.a-nik').remove();
                }
                var regex = /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@a-zA-Z0-9?(?:.a-zA-Z0-9?)$/i;
                if(!regex.test($("input.mail-input").val()) && $("input.mail-input").val() != "" ) {
                    $('#block-alert').find('.list-err.a-email').remove();
                }
            } 
            if($('.error').length == 0) {
                $('#block-alert').html('');
            }
        }
        function fncFormValid() {
            $('#form_submit_btn').click(function(){ 
                $('#block-alert').removeClass('hide-alert');
                if($('.error').length > 0){
                    $('#form-apply').addClass('has-exec');
                    execValdiationError();
                    $('html, body').animate({
                        scrollTop: $("#block-alert").offset().top - 115
                    }, 500, 'linear');
                }else{
                    $('#form-apply').removeClass('has-exec');
                    $('#form-apply').submit();
                }
            });
        }
        function execHideAlert() {
            $('#block-alert').addClass('hide-alert');
        }
        $('input:not(.mail-input)').on('change keyup paste input blur focus', function() {
            if($('#form-apply').hasClass('has-exec')){
                if($(this).val() != ""){
                    $(this).removeClass('is-invalid error');
                }else{
                    $(this).addClass('is-invalid error');
                }  
                execValdiationError();
            }
        });
        $('input.mail-input').on('change keyup paste input blur focus', function() {
            if($('#form-apply').hasClass('has-exec')){
                var regex = /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@a-zA-Z0-9?(?:.a-zA-Z0-9?)$/i;
                if(!regex.test($(this).val()) && $(this).val() != "") {
                    $(this).removeClass('is-invalid');
                }else{
                    $(this).addClass('is-invalid');
                }
                execValdiationError();
            }
        });
        $('input.ktp-input').on('change keyup paste input blur focus', function() {
            if($('#form-apply').hasClass('has-exec')){
                if($(this).val() != "" && $(this).val().length == 16){
                    $(this).removeClass('is-invalid error');
                }else{
                    $(this).addClass('is-invalid error');
                }
                execValdiationError();
            }
        });
        $('#address').bind('change keyup paste input blur focus propertychange', function() {
            if($('#form-apply').hasClass('has-exec')){
                if($(this).val() != ""){
                    $(this).removeClass('is-invalid error');
                }else{
                    $(this).addClass('is-invalid error');
                }
                execValdiationError();
            }
        });
        $('select').on('change', function() {
            if( $(this).val() != "" ){
                $(this).removeClass('is-invalid error');
                execValdiationError();
            }else{
                $(this).addClass('is-invalid error');
                execValdiationError();
            }
        });
        $('.rd').change(function () {
            var hasCx = $(this);
            if($('#form-apply').hasClass('has-exec')){
                if(hasCx.hasClass('valid')){
                    $(this).closest('.parent').find('.checkmark').each(function() {
                        $(this).removeClass('is-invalid');
                    }); 
                }
            }
        });
        $('.ch:checkbox').change(function () {
            var hasCx = $(this);
            if($('#form-apply').hasClass('has-exec')){
                if($('input[name="question_skills[]"]:checked').length > 0){
                    hasCx.closest('.parent').find('.checkmark.is-invalid').each(function() {
                        $(this).removeClass('is-invalid');
                    });
                }
                else {
                    $(this).closest('.parent').find('.checkmark').each(function() {
                        $(this).addClass('is-invalid');
                        execValdiationError();
                    });
                }
            }
        });


        $(".photo_upload").on("dragover", function(event) {
            event.preventDefault();  
            event.stopPropagation();
            $(this).addClass('on_dragging');
            $('.tx-drag-drop').text('Drop image here.');
        });

        $(".photo_upload").on("dragleave", function(event) {
            event.preventDefault();  
            event.stopPropagation();
            $(this).removeClass('on_dragging');
            $('.tx-drag-drop').html('<span class="d-block w-100 tx-drag-drop"><a href="javascript:void(0);" onclick="searchImageFile(this);">Upload a file</a> or drag and drop here</span>');
        });

        function dropHandler(ev) {
            ev.preventDefault();  
            $('.photo_upload').removeClass('on_dragging');
            $('.tx-drag-drop').html('<span class="d-block w-100 tx-drag-drop"><a href="javascript:void(0);" onclick="searchImageFile(this);">Upload a file</a> or drag and drop here</span>');
            if (ev.dataTransfer.items && ev.dataTransfer.items.length > 1) {
                alert("Only allowed to upload one file");
                return false;
            }
            if(ev.dataTransfer.files[0].size >= (1048576)){ //in byte = 1MB
                alert("The maximum file size is 1MB");
                return false;
            }
            if(checkImgFileType(ev.dataTransfer.files[0]) == true) {        
                $("#photo").prop("files", ev.dataTransfer.files);

                var blob = ev.dataTransfer.items[0].getAsFile();
                var URLObj = window.URL || window.webkitURL;
                var source = URLObj.createObjectURL(blob);

                var reader = new FileReader();
                reader.onload = function(ev) {
                    // get loaded data and render thumbnail.
                    $('.box-photo-upload.img-upload').removeClass('d-none');
                    $('.opt-image-edit').removeClass('d-none');
                    $('.box-photo-upload.img-upload').attr('src', ev.target.result);
                    $('.data-file-photo').removeClass('error');
                    $('.box-photo-upload:not(.img-upload)').addClass('d-none');
                    execValdiationError();
                };
                // read the image file as a data URL.
                reader.readAsDataURL(ev.dataTransfer.files[0]);
            }
        };
        function checkImgFileType(file_) {
            var file = file_;
            var fileType = file["type"];
            var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
            if ($.inArray(fileType, validImageTypes) < 0) {
                alert("Only allowed to upload image file");
                return false;
            }else{
                return true;
            }
        }
        function searchImageFile(this_) {
            var file = $(this_).parents().find("#photo");
            file.trigger("click");
        }
        $('#photo').change(function(e) {
            if(this.files[0].size >= (1000000)){ //in byte = 1MB
                alert("The maximum file size is 1MB");
                return false;
            }
            if(checkImgFileType(this.files[0]) == true) {
                var fileName = e.target.files[0].name;
                var reader = new FileReader();
                reader.onload = function(e) {
                    // get loaded data and render thumbnail.
                    $('.box-photo-upload.img-upload').removeClass('d-none');
                    $('.opt-image-edit').removeClass('d-none');
                    $('.box-photo-upload.img-upload').attr('src', e.target.result);
                    $('.data-file-photo').removeClass('error');
                    $('.box-photo-upload:not(.img-upload)').addClass('d-none');
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            }else{
                $('.box-photo-upload.img-upload').addClass('d-none');
                $('.opt-image-edit').addClass('d-none');
                $('.box-photo-upload.img-upload').attr('src', "");
                $('.box-photo-upload:not(.img-upload)').removeClass('d-none');
            }
        });
    </script>
@endpush