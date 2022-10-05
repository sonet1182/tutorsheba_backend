@extends('frontend.layouts.master')

@section('content')
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="card _14d25">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="mx-auto d-block mt-3" height="200px" width="200px" src="{{ asset($details->teacher_profile_picture) }}" alt="{{ $details->user ? $details->user ->name : '' }}"
                                onerror="this.onerror=null;this.src='https://cdn4.iconfinder.com/data/icons/instagram-ui-twotone/48/Paul-18-512.png';">



                                <p class="ml-4 mt-2"><i class="fa fa-clock-o"></i> Member Since: {{ $details->created_at }}</p>

                                <h5 class="text-center"> Total views: <strong> {{ $teacher->views }} </strong> </h5>


                                @if (!empty($primioum_tutor_check))
                                    <h5 class="bg-info text-light py-1 mt-1 pl-4">PREMIUM TUTOR</h5>
                                @endif
                            </div>
                            <div class="col-md-7 mt-3">
                                <div class="row">
                                    <div class="col-4">Name:</div>
                                    <div class="col-7">
                                        <h4>{{ $details->user ? $details->user->name : '' }}</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">ID#:</div>
                                    <div class="col-7">
                                        <h6>{{ $details->teacher_id }}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">Gender:</div>
                                    <div class="col-7">
                                        <h6>{{ $details->teacher_gender }}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">Qualification:</div>
                                    <div class="col-7">
                                        <h6>{{ $details->teacher_degree }}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">Area Covered:</div>
                                    <div class="col-7">
                                        {{ $details->districts ?  $details->districts->districtName : '' }}
                                        ({{ $details->tuition_area }})
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">Teaching:</div>
                                    <div class="col-7">
                                        {{ $details->tuition_subject }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">Present Location:</div>
                                    <div class="col-7">
                                        {{ $details->teacher_present_address }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col">
                                <table class="table">
                                    <thead class="thead-custom">
                                    <tr>
                                        <th scope="col">Tution Info</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">Expected Minimum Salary</th>
                                        <td>{{ $details->tuition_salary }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Current Status for Tuition </th>
                                        <td>Available</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Days Per Week</th>
                                        <td colspan="2">{{ $details->tuition_days }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Preffered Tution Style</th>
                                        <td>{{ $details->tuition_style }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Place of Learning</th>
                                        <td>Home Visit</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Extra Facilities</th>
                                        <td colspan="2">Phone help</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Preffered Medium of Version</th>
                                        <td>{{ $details->tuition_medium }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Preffered Class </th>
                                        <td>{{ $details->tuition_class }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Preffered Subjects</th>
                                        <td colspan="2">{{ $details->tuition_subject }}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Preferred Time</th>
                                        <td colspan="2">{{ $details->tuition_shift }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Preffered Area to Teach</th>
                                        <td colspan="2">{{ $details->districts ? $details->districts->districtName : '' }} ,<br> {{ $details->tuition_area }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h4 class="ml-2">Educational Qualification</h4>
                                <table class="table table-bordered desktop-view2">
                                    <thead class="thead-custom">
                                    <tr>
                                        <th>Exam Name</th>
                                        <th>Year</th>
                                        <th>Institute</th>
                                        <th>Group/Subject</th>
                                        <th>Result</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td> SSC / O-level / Dakhil</td>
                                        <td>{{ $details->ssc_year }}</td>

                                        <td>{{ $details->ssc_institute }}</td>
                                        <td>{{ $details->ssc_group }} </td>
                                        <td>{{ $details->ssc_gpa }}</td>
                                    </tr>


                                    <tr>
                                        <td>HSC / A level / Alim</td>
                                        <td>{{ $details->hsc_year }}</td>

                                        <td>{{ $details->hsc_institute }}</td>
                                        <td>{{ $details->hsc_group }} </td>
                                        <td>{{ $details->hsc_gpa }}</td>
                                    </tr>

                                    <tr>
                                        <td>Graduation / Bachelor / Diploma</td>
                                        <td>{{ $details->honours_year }}</td>
                                        <td>{{ $details->honours_institute }}</td>
                                        <td>{{ $details->honours_subject }} </td>
                                        <td>{{ $details->honours_gpa }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered mobile-view mb-3">


                                    <tbody class="mt-5">

                                    <tr>
                                        <th class="thead-custom">Exam Name</th>
                                        <td>SSC</td>
                                    </tr>

                                    <tr>
                                        <th class="thead-custom">Year</th>
                                        <td>{{ $details->ssc_year }}</td>
                                    </tr>

                                    <tr>
                                        <th class="thead-custom">Institute</th>
                                        <td>{{ $details->ssc_institute }}</td>
                                    </tr>

                                    <tr>
                                        <th class="thead-custom">Group/Subject</th>
                                        <td>{{ $details->ssc_group }} </td>
                                    </tr>

                                    <tr>
                                        <th class="thead-custom">GPA</th>
                                        <td>{{ $details->ssc_gpa }} </td>
                                    </tr>

                                    </tbody>
                                </table>

                                <table class="table table-bordered mobile-view mb-3">
                                    <tbody class="mt-5">
                                    <tr>
                                        <th class="thead-custom">Exam Name</th>
                                        <td>HSC</td>
                                    </tr>

                                    <tr>
                                        <th class="thead-custom">Year</th>
                                        <td>{{ $details->hsc_year }}</td>
                                    </tr>

                                    <tr>
                                        <th class="thead-custom">Institute</th>
                                        <td>{{ $details->hsc_institute }}</td>
                                    </tr>

                                    <tr>
                                        <th class="thead-custom">Group/Subject</th>
                                        <td>{{ $details->hsc_group }} </td>
                                    </tr>

                                    <tr>
                                        <th class="thead-custom">GPA</th>
                                        <td>{{ $details->hsc_gpa }} </td>
                                    </tr>

                                    </tbody>
                                </table>

                                <table class="table table-bordered mobile-view">
                                    <tbody class="mt-5">
                                    <tr>
                                        <th class="thead-custom">Exam Name</th>
                                        <td>Honours</td>
                                    </tr>

                                    <tr>
                                        <th class="thead-custom">Year</th>
                                        <td>{{ $details->honours_year }}</td>
                                    </tr>

                                    <tr>
                                        <th class="thead-custom">Institute</th>
                                        <td>{{ $details->honours_institute }}</td>
                                    </tr>

                                    <tr>
                                        <th class="thead-custom">Group/Subject</th>
                                        <td>{{ $details->honours_group }} </td>
                                    </tr>

                                    <tr>
                                        <th class="thead-custom">GPA</th>
                                        <td>{{ $details->honours_gpa }} </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4">
                    <h6 class="text-title">Contact with This tutor</h6>
                    <form action="{{ url('/student_to_teacher_request') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control" name="request_name" placeholder="Enter your full name">
                            <input type="hidden" name="tutor_id" value="{{ $details->id }}">
                        </div>
                        <!--<div class="form-group">-->
                        <!--    <label for="E-Mail">E-Mail</label>-->
                        <!--    <input type="email" name="request_email" class="form-control" id="E-Mail" placeholder="E-Mail">-->
                        <!--</div>-->
                        <div class="form-group">
                            <label for="PhoneNo">Phone Number</label>
                            <input type="number" name="request_phoneNumber" class="form-control" id="PhoneNo" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="DetailsInformation">Details Information</label>
                            <textarea rows="3" name="request_info" class="form-control" id="DetailsInformation"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection

