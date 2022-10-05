
@foreach($alltuitions as $tuition)
<div class="card my-4 tuition-list">
    <div class="card-body recent_tutor">
        <button class="btn btn-sm btn-danger text-light px-3">Job ID-{{$tuition->id}}</button>
        <h3 class="t_title">{{ $tuition->title }}</h3>
        <div class="form-row pb-1">
            <div class="col-md-4" style="font-size: 15px">
                <b class="text-primary">Category :</b> {{ $tuition->s_medium }}
            </div>
            <div class="col-md-4" style="font-size: 15px">
                <b class="text-primary">Class :</b> {{ $tuition->s_class }}
            </div>
            <div class="col-md-4" style="font-size: 15px">
                <b class="text-primary">Salary :</b> {{ number_format((int)$tuition->t_salary) }} BDT
            </div>
        </div>
        <span><b>Subjects :</b> {{ $tuition->t_subject }}</span>
        <br><b>{{ $tuition-> t_days }} </b>
        <div class="row">
            <div class="col-md-8">
                <div>
                    <h4 class="py-3"><i class="fa fa-map-marker text-primary"></i> {{ $tuition->districts->districtName }},{{ $tuition->s_area }}</h4>
                </div>
                <p class="">Other Requirements - {{$tuition->ex_information}}.</p>
            </div>
            <div class="col-md-4 mt-2">
                <div>
                    <a href="/tuition-list/view/{{$tuition->id}}" class="btn btn-sm btn-info text-light">
                        <i class="fa fa-link"></i> More details
                    </a>
                </div>
                <small>Published Time:  {{ $tuition->created_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
</div>
@endforeach
