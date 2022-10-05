@foreach ($tutors as $tutor)
    <div class="item">
        <div class="fcrse_1 mb-20">
            <div class="tutor_img2 text-center pb-3">
                <a href="{{ url('/tutor-details/' . $tutor->teacher_id) }}"><img
                        src="{{ asset($tutor->teacher_profile_picture) }}" alt=""
                        onerror="this.src='/assets/images/hd_dp.jpg"></a>
            </div>
            <div class="tutor_content_dt">
                <div class="tutor150">
                    <a href="{{ url('/tutor-details/' . $tutor->teacher_id) }}"
                        class="tutor_name ellipsis">{{ $tutor->name }}</a>
                    <div class="mef78" title="Verify">
                        <i class="uil uil-check-circle"></i>
                    </div>
                </div>
                <div class="tutor_cate ellipsis">{{ $tutor->teacher_university }}</div>
                <div class="pb-3">
                    <h4 class=" ellipsis">{{ $tutor->teacher_subject }}</h4>
                    <span class="vdt15 ellipsis">{{ $tutor->districts ? $tutor->districts->districtName : '' }}</span>
                </div>

                <div>
                    <a href="{{ url('/tutor-details/' . $tutor->teacher_id) }}" class="text-center btn btn-info btn-sm px-2">
                        View Details</i>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endforeach
