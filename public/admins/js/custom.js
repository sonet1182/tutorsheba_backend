$('#dataTable').DataTable();

$('#dataTableButtons').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
    ]
});

$(".district,.area,.medium,.class,.subject,.gender, .instiTypes, .studyTypes, .institute, .departments, .curciculam").select2({
    theme: "classic",
    width: '100%'
});

$(".sub_jec_maltiple").select2({
    multiple: true,
    theme: "classic",
    width: '100%'
});

$('select.district').on('change', function() {
    var stateID = $(this).val();
    $(".selectArea").hide();
    $(".loadingImgArea").show();
    $.ajax({
        type: "get",
        url: '/area-list',
        data:{'id':stateID},
        dataType: "json",
        success:function(data) {
            var len = data.length;
//                      console.log(data);
            $(".loadingImgArea").hide();
            $(".selectArea").show();
            $(".area").empty();
            $(".area").append("<option value=''>" + 'Select Area' + "</option>");
            for (var i = 0; i < len; i++) {
                var id = data[i]['id'];
//                          console.log(data[i]['id'])
                var areaName = data[i]['areaName'];
                $(".area").append("<option value='" + areaName + "'>" + areaName + "</option>");
            }
        }
    });
});
$('select.medium').on('change', function() {
    var mediumName = $(this).val();
    $(".selectClass").hide();
    $(".loadingImgClass").show();
    $.ajax({
        type: "get",
        url: '/class-list',
        data:{'mname':mediumName},
        dataType: "json",
        success:function(data) {
            var len = data.length;
            $(".loadingImgClass").hide();
            $(".selectClass").show();
            $(".class").empty();
            $(".class").append("<option value=''>" + 'Select Class' + "</option>");
            for (var i = 0; i < len; i++) {
                var id = data[i]['id'];
                var className = data[i]['className'];
                $(".class").append("<option value='" + className + "'>" + className + "</option>");
            }
        }
    });
});
$('select.medium, select.class').on('change', function() {
    var className = $(this).val();
    $(".selectSubject").hide();
    $(".loadingImgSubject").show();
    $.ajax({
        type: "get",
        url: '/subject-list',
        data:{'cname':className},
        dataType: "json",
        success:function(data) {
            var len = data.length;
            $(".loadingImgSubject").hide();
            $(".selectSubject").show();
            $(".subject").empty();
            $(".subject").append("<option value=''>" + 'Select Subject' + "</option>");
            for (var i = 0; i < len; i++) {
                var id = data[i]['id'];
                var subjectName = data[i]['subjectName'];
                $(".subject").append("<option value='" + subjectName + "'>" + subjectName + "</option>");
            }
        }
    });
});
// $('select.medium, select.class').on('change', function() {
//     var className = $(this).val();
//     $(".selectSubject").hide();
//     $(".loadingImgSubject").show();
//     $.ajax({
//         type: "get",
//         url: '/subject-list',
//         data:{'cname':className},
//         dataType: "json",
//         success:function(data) {
//             var len = data.length;
//             $(".loadingImgSubject").hide();
//             $(".selectSubject").show();
//             $(".subject").empty();
//             $(".subject").append("<option value=''>" + 'Select Subject' + "</option>");
//             for (var i = 0; i < len; i++) {
//                 var id = data[i]['id'];
//                 var subjectName = data[i]['subjectName'];
//                 $(".subject").append("<option value='" + subjectName + "'>" + subjectName + "</option>");
//             }
//         }
//     });
// });

$('select.instiTypes').on('change', function() {
    var stateID = $(this).val();
    $("#tuition_area").hide();
    $(".selectInsti").hide();
    $(".loadingImgInstiType").show();
    $.ajax({
        type: "get",
        url: '/institute-list',
        data:{'id':stateID},
        dataType: "json",
        success:function(data) {
            var len = data.length;
            $(".loadingImgInstiType").hide();
            $("#tuition_area").hide();
            $(".selectInsti").show();
            $(".institute").empty();
            $(".institute").append("<option value=''>" + 'Select Institute' + "</option>");
            for (var i = 0; i < len; i++) {
                var id = data[i]['id'];
                var university = data[i]['university'];
                $(".institute").append("<option value='" + university + "'>" + university + "</option>");
            }
        }
    });
});

$('select.studyTypes').on('change', function() {
    var stateID = $(this).val();
    // $("#tuition_area").hide();
    $(".selectDepartments").hide();
    $(".loadingImgDepartmets").show();
    $.ajax({
        type: "get",
        url: '/department-list',
        data:{'id':stateID},
        dataType: "json",
        success:function(data) {
            var len = data.length;
            $(".loadingImgDepartmets").hide();
            $("#tuition_area").hide();
            $(".selectDepartments").show();
            $(".departments").empty();
            $(".departments").append("<option value=''>" + 'Select departments' + "</option>");
            for (var i = 0; i < len; i++) {
                var id = data[i]['id'];
                var name = data[i]['name'];
                $(".departments").append("<option value='" + name + "'>" + name + "</option>");
            }
        }
    });
});
