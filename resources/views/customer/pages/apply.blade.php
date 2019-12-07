@extends('customer.layouts.frontend')
@section('title')Apply Vacancy @endsection

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
                                <input type="text" class="form-control" id="fullname" name="name" required>
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
                                        <input type="text" class="form-control" id="d_birth" placeholder="ex: 1990/10/29" name="birth_date" required>
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
                                <label for="email">Address</label>
                                <textarea class="form-control" rows="4" name="address" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            @if(count($arr_criteria) > 0)
                                @foreach($arr_criteria as $c)
                                    <div class="box-questions mb-5">
                                        <h3 class="main_question">{{$c['criteria_name']}}</h3>
                                        @foreach($c['criteria_data'] as $key => $v)
                                            <div class="form-group">
                                                <label class="container_radio version_2">{{$v['name']}}
                                                    <input type="radio" name="question_criteria_{{$c['criteria_id']}}[]" 
                                                    value="{{$v['id'].'_'.$v['value']}}" {{($key == 0)? 'required' : ''}}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if(count($arr_skill) > 0)
                                <div class="box-questions mb-5">
                                    <h3 class="main_question">Choose Skills</h3>
                                    @foreach($arr_skill['skills'] as $s)
                                        <div class="form-group">
                                            <label class="container_check version_2">{{$s['name']}}
                                                <input type="checkbox" name="question_skills[]" value="{{$s['id'].'_'.$s['value']}}">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-apply btn-apply-hg active-btn btn-block">Send Application</button>
                </form>
            </div>
            
        </div>
        </div>
    </div>
@endsection