<div class="card mb-3">
    <div class="row">
        <div class="col-md-2 col-sm-5 col-xs-12 text-center">
            <a href="{{ url('/tutor_details') }}/{{ $teacher->teacher->teacher_id }}">

                <img class="styleBorderImg" src="{{ asset($teacher->teacher->teacher_profile_picture) }}"
                    alt="{{ $teacher->name }}"
                    onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/teacher/icons/instagram-ui-twotone/48/Paul-18-512.png';" /></a>
            <br>
            <strong>ID # {{ $teacher->teacher->teacher_id }} </strong>
        </div>
        <div class="col-md-4 col-sm-7 col-xs-12"> <strong><span class="text-info">
                    {{ $teacher->teacher ? $teacher->teacher->name : '' }} </span></strong> <br>
            <span style="color: green;"> Member Since: {{ $teacher->teacher->created_at->format('d-M-Y') }} </span>
            <br>
            <span>{{ $teacher->teacher->tuition_salary }}</span> <br>
            <strong>Qualification:</strong> {{ $teacher->teacher->teacher_degree }} <br>
            <strong>Honours Ins:</strong> {{ $teacher->teacher->honours_institute }} <br>
            <strong>Tuition Me:</strong> {{ $teacher->teacher->tuition_medium }} <br>
            <strong>Teaching:</strong> {{ $teacher->teacher->tuition_subject }}
            <br><br>

            <strong>Applied:</strong> {{ $teacher->created_at->format('h:i A | d-M-Y') }}
        </div>
        <div class="col-sm-4 space-htop">
            <strong>{{ $teacher->teacher->districts ? $teacher->teacher->districts->districtName : '' }}
                <br></strong> <span class="text-lowercase">{{ $teacher->teacher->tuition_area }}</span>
        </div>
        <div class="col-sm-2">
            <a href="{{ url('/manager/teacher_details') }}{{ $teacher->teacher->user_id }}"
                class="btn btn-lg btn-info mt-2">View Details</a>
        </div>
        <div class="col-sm-12 ml-2 mb-1">
            <strong>Experience:</strong> {{ $teacher->teacher->tuition_experience }}
        </div>
    </div>
</div>
