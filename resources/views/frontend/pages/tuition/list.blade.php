@extends('frontend.layouts.master')

@section('content')
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="_14d25">
                        <div class="row">

                            <div class="col-md-9">
                                <h3 class="text-purple">
                                    Tuition list
                                </h3>
                                @if (session('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> {{ session('message') }}.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session('already'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Sorry!</strong> {{ session('already') }}.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <div class="filter_data"></div>
                                <div class="paginate_data"></div>

                            </div>

                            <div class="col-md-3">
                                <div class="accordion my-5" id="accordionExample">
                                    <div class="card border-radius-none">
                                        <div class="card-header">
                                            <h3 class="text-purple">
                                                SEARCH TUITION JOBS
                                            </h3>
                                            <h5>
                                                Find Tutuions, in your area
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <select  name="districts" class="form-control districts single-select">
                                                            <option value="" selected>Select Districts</option>
                                                            @foreach($allDistrict as $districts)
                                                                <option value="{{ $districts->id }}">{{ $districts->districtName }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div name="area" class="form-group col-md-12">
                                                        <div class="selectArea">
                                                            <select name="area" class="form-control area single-select">
                                                                <option value="">Select Area</option>
                                                            </select>
                                                        </div>
                                                        <div class="loadingImgArea" style="display: none;">
                                                            <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}" alt="TutorSheba" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <select name="medium" class="form-control medium single-select">
                                                            <option value="">Select Medium</option>
                                                            @foreach($allMedium as $medium)
                                                                <option value="{{ $medium->mediumName }}">{{ $medium->mediumName }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div name="class" class="form-group col-md-12">
                                                        <div class="selectClass">
                                                            <select name="class" class="form-control class single-select">
                                                                <option value="">Select Class</option>
                                                            </select>
                                                        </div>
                                                        <div class="loadingImgClass" style="display: none;">
                                                            <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}" alt="TutorSheba" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div name="subject" class="form-group col-md-12">
                                                        <div class="selectSubject">
                                                            <select name="subject" class="form-control subject single-select">
                                                                <option value="">Select Subject</option>
                                                            </select>
                                                        </div>
                                                        <div class="loadingImgSubject" style="display: none;">
                                                            <img class="loding" width="35" src="{{ asset('/img/loading.gif') }}" alt="TutorSheba" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <select name="gender" class="form-control gender single-select">
                                                            <option value="">Select Gender</option>
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card border-radius-none">
                                        <div class="card-header bg-custom" id="headingOne">
                                                <button class="btn btn-link text-light" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Tuition Jobs Result
                                    </button>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <ul class="list-group list-group-flush">
                                                <a href="#" class="list-group-item d-flex justify-content-between align-items-center text-dark">
                                    Male Tutor Preference
                                                    <span class="badge badge-pill">{{$filtermale}}</span>
                                                </a>
                                                <a href="#" class="list-group-item d-flex justify-content-between align-items-center text-dark">
                                    Female Tutor Preference
                                                    <span class="badge badge-pill">{{$filterfemale}}</span>
                                                </a>
                                                <a href="#" class="list-group-item d-flex justify-content-between align-items-center text-dark">
                                     Any Gender Preference
                                                    <span class="badge badge-pill">{{$filteranygender}}</span>
                                                </a>
                                                <a href="#" class="list-group-item d-flex justify-content-between align-items-center text-dark">
                                     All Tutors
                                                    <span class="badge badge-pill">{{$total}}</span>
                                                </a>
                                                <a href="#" class="list-group-item d-flex justify-content-between align-items-center text-dark">
                                     Search Result
                                                    <span class="badge badge-pill total_number"></span>
                                                </a>
                                            </ul>
                                        </div>
                                    </div>



                                    @if ($ads_images_tuition_job)
                                    <div class="mt-3 sponserBanner">
                                        <h5 class="text-title">SPONSORED</h5>
                                        <div class="card mb-3">
                                            <a href="{{!empty($ads_images_tuition_job->link) ? $ads_images_tuition_job->link : ''}}" target="{{!empty($ads_images_tuition_job->link) ? '_blank' : '_self'}}"><img class="card-img" src="{{ asset($ads_images_tuition_job->img) }}"></a>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>

                            {{-- @include('tuition') --}}

                            <div class="col-md-12 ajax-load text-center" style="display:none">
                                <div class="spinner text-center">
                                    <div class="bounce1"></div>
                                    <div class="bounce2"></div>
                                    <div class="bounce3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>






                {{-- @include('frontend.layouts.rightSidebar',['allDistrict'=>$allDistrict, 'allMedium'=>$allMedium]) --}}
            </div>
        </div>
    </div>
@endsection

@section('js')

<script type="text/javascript">
    $(document).ready( function(){

        filter_data();

        function filter_data()
        {
            // $('.filter_data').html('<div id="loading" style="" ></div>');
            $('.paginate_data').html('');

            var districts_value = $('.districts').val();
            var area_value = $('.area').val();
            var medium_value = $('.medium').val();
            var class_value = $('.class').val();
            var subject_value = $('.subject').val();
            var gender_value = $('.gender').val();
            $.ajax({
                url:"/tuition-list",
                method:"GET",
                data:{districts_value:districts_value, area_value:area_value, medium_value:medium_value, class_value:class_value, subject_value:subject_value, gender_value:gender_value},
                success:function(data){
                    $('.filter_data').html(data.html);
                    $('.paginate_data').html(data.paginate);
                    $('.total_number').html(data.total);
                },
                error: function(ts) { alert(ts.responseText) }
            });
        }

        $(document).on('change', '.districts, .area, .medium, .class, .subject, .gender', function() {
            filter_data();
        });

        $(document).on('click', '.pagination a', function(e){
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];

            getProducts(page);
        })

        function getProducts(page){
            var districts_value = $('.districts').val();
            var area_value = $('.area').val();
            var medium_value = $('.medium').val();
            var class_value = $('.class').val();
            var subject_value = $('.subject').val();
            var gender_value = $('.gender').val();

            $.ajax({
                url: '/tuition-list/?page='+page,
                method:"GET",
                data:{districts_value:districts_value, area_value:area_value, medium_value:medium_value, class_value:class_value, subject_value:subject_value, gender_value:gender_value},
                success:function(data)
                {
                    $('.filter_data').html(data.html);
                    $('.paginate_data').html(data.paginate);
                }
            })
        }
    });
    </script>
@endsection
