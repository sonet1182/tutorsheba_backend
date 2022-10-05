@extends('frontend.layouts.master')

@section('content')
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="_14d25">
                        <div class="row" id="post-data">

                            @foreach ($search as $tutor)
                                <div class="col-xl-4 col-lg-4 col-md-6">
                                    <div class="fcrse_1 mb-20">
                                        <div class="tutor_img2 text-center pb-3">
                                            <a href="{{ url('/tutor-details/' . $tutor->teacher_id) }}">
                                                {{-- <img src="{{ asset($tutor->teacher_profile_picture) }}" alt=""
                                                    onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/data/icons/instagram-ui-twotone/48/Paul-18-512.png';"> --}}
                                                    <img class="card-img" src="{{ asset($tutor->teacher_profile_picture) }}" alt="{{$tutor->user ? $tutor->user->name : ''}}" onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/data/icons/instagram-ui-twotone/48/Paul-18-512.png';" />
                                            </a>
                                        </div>
                                        <div class="tutor_content_dt">
                                            <div class="tutor150">
                                                <a href="{{ url('/tutor-details/' . $tutor->teacher_id) }}"
                                                    class="tutor_name">{{ $tutor->user->name ?? '' }}</a>
                                                <div class="mef78" title="Verify">
                                                    <i class="uil uil-check-circle"></i>
                                                </div>
                                            </div>
                                            <div class="tutor_cate">{{ $tutor->teacher_university }}</div>
                                            <div class="pb-3">
                                                <h4>{{ $tutor->teacher_subject }}</h4>
                                                <span
                                                    class="vdt15">{{ $tutor->districts ? $tutor->districts->districtName : '' }}</span>
                                            </div>
                                            <ul class="tutor_social_links">
                                                <li>
                                                    <a href="#" class="fb"><i class="fab fa-facebook-f"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#" class="tw"><i class="fab fa-twitter"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#" class="ln"><i class="fab fa-linkedin-in"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#" class="yu"><i class="fab fa-youtube"></i></a>
                                                </li>
                                            </ul>
                                            <div class="tut1250">
                                                <span class="vdt15">100K Students</span>
                                                <span class="vdt15">15 Courses</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-12 ajax-load text-center">
                                {{ $search->links() }}
                            </div>


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
                @include('frontend.layouts.rightSidebar', [
                    'allDistrict' => $allDistrict,
                    'allMedium' => $allMedium,
                ])
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- <script type="text/javascript">
    var page = 1;
    var wnd = $(window).scrollTop() + $(window).height();
    var doc = $(document).height();

    $(window).scroll(function() {

        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadMoreData(page);
        }
    });


    function loadMoreData(page){
      $.ajax(
            {
                url: '?page=' + page,
                type: "get",
                beforeSend: function()
                {
                    $('.ajax-load').show();
                }
            })
            .done(function(data)
            {
                if(data.html == " "){
                    $('.ajax-load').html("No more records found");
                    return;
                }
                $('.ajax-load').hide();
                $("#post-data").append(data.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                  alert('server not responding...');
            });
    }
</script> --}}
@endsection
