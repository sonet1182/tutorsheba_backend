@extends('frontend.layouts.master')

@section('content')
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">

                {{-- <div class="col-xl-12 col-lg-8">
                    <div class="section3125">
                        <div class="explore_search">
                            <div class="ui search focus">
                                <div class="ui left icon input swdh11">
                                    <input class="prompt srch_explore" type="text" placeholder="Search Tutors..." />
                                    <i class="uil uil-search-alt icon icon2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}


                <div class="col-xl-9 col-lg-8">
                    <div class="_14d25">
                        <div class="row" id="post-data">

                            @include('data')

                            {{-- <div class="col-md-12">
                                <div class="main-loader mt-2 ajax-load">
                                    <div class="spinner">
                                        <div class="bounce1"></div>
                                        <div class="bounce2"></div>
                                        <div class="bounce3"></div>
                                    </div>
                                </div>
                            </div> --}}

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
                @include('frontend.layouts.rightSidebar',['allDistrict'=>$allDistrict, 'allMedium'=>$allMedium])
            </div>
        </div>
    </div>
@endsection

@section('js')

<script type="text/javascript">
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
</script>
@endsection
