// === Dropdown === //

$('.ui.dropdown')
  .dropdown()
;

// === Model === //
$('.ui.modal')
  .modal({
    blurring: true
  })
  .modal('show')
;

// === Tab === //
$('.menu .item')
  .tab()
;

// === checkbox Toggle === //
$('.ui.checkbox')
  .checkbox()
;

// === Toggle === //
$('.enable.button')
  .on('click', function() {
    $(this)
      .nextAll('.checkbox')
        .checkbox('enable')
    ;
  })
;


// Home Live Stream
$('.live_stream').owlCarousel({
	items:10,
	loop:true,
	margin:10,
	nav:true,
	dots:false,
	navText: ["<i class='uil uil-angle-left'></i>", "<i class='uil uil-angle-right'></i>"],
	responsive:{
		0:{
			items:2
		},
		600:{
			items:3
		},
		1000:{
			items:3
		},
		1200:{
			items:5
		},
		1400:{
			items:6
		}
	}
})

// Featured Courses home
$('.featured_courses').owlCarousel({
	items:10,
	loop:false,
	margin:20,
	nav:true,
	dots:false,
	navText: ["<i class='uil uil-angle-left'></i>", "<i class='uil uil-angle-right'></i>"],
	responsive:{
		0:{
			items:1
		},
		600:{
			items:2
		},
		1000:{
			items:1
		},
		1200:{
			items:2
		},
		1400:{
			items:3
		}
	}
})

// Featured Courses home
$('.top_instrutors').owlCarousel({
	items:10,
    loop: true,
	autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:false,
	margin:20,
	nav:true,
	dots:false,
	navText: ["<i class='uil uil-angle-left'></i>", "<i class='uil uil-angle-right'></i>"],
	responsive:{
		0:{
			items:1
		},
		600:{
			items:3
		},
		1000:{
			items:3
		},
		1200:{
			items:3
		},
		1400:{
			items:4
		}
	}
})

// Student Says
$('.Student_says').owlCarousel({
	items:10,
	loop:false,
	margin:30,
	nav:true,
	dots:false,
	navText: ["<i class='uil uil-angle-left'></i>", "<i class='uil uil-angle-right'></i>"],
	responsive:{
		0:{
			items:1
		},
		600:{
			items:2
		},
		1000:{
			items:2
		},
		1200:{
			items:3
		},
		1400:{
			items:3
		}
	}
})

// features Careers
$('.feature_careers').owlCarousel({
	items:4,
	loop:false,
	margin:20,
	nav:true,
	dots:false,
	navText: ["<i class='uil uil-angle-left'></i>", "<i class='uil uil-angle-right'></i>"],
	responsive:{
		0:{
			items:1
		},
		600:{
			items:1
		},
		1000:{
			items:1
		},
		1200:{
			items:1
		},
		1400:{
			items:1
		}
	}
})

/*Floating Code for Iframe Start*/
if (jQuery('iframe[src*="https://www.youtube.com/embed/"],iframe[src*="https://player.vimeo.com/"],iframe[src*="https://player.vimeo.com/"]').length > 0) {
	/*Wrap (all code inside div) all vedio code inside div*/
	jQuery('iframe[src*="https://www.youtube.com/embed/"],iframe[src*="https://player.vimeo.com/"]').wrap("<div class='iframe-parent-class'></div>");
	/*main code of each (particular) vedio*/
	jQuery('iframe[src*="https://www.youtube.com/embed/"],iframe[src*="https://player.vimeo.com/"]').each(function(index) {

		/*Floating js Start*/
		var windows = jQuery(window);
		var iframeWrap = jQuery(this).parent();
		var iframe = jQuery(this);
		var iframeHeight = iframe.outerHeight();
		var iframeElement = iframe.get(0);
		windows.on('scroll', function() {
			var windowScrollTop = windows.scrollTop();
			var iframeBottom = iframeHeight + iframeWrap.offset().top;
			//alert(iframeBottom);

			if ((windowScrollTop > iframeBottom)) {
				iframeWrap.height(iframeHeight);
				iframe.addClass('stuck');
				jQuery(".scrolldown").css({"display": "none"});
			} else {
				iframeWrap.height('auto');
				iframe.removeClass('stuck');
			}
		});
		/*Floating js End*/
	});
}

/*Floating Code for Iframe End*/

// expand/collapse all Start

var headers = $('#accordion .accordion-header');
var contentAreas = $('#accordion .ui-accordion-content ').hide()
.first().show().end();
var expandLink = $('.accordion-expand-all');

// add the accordion functionality
headers.click(function() {
    // close all panels
    contentAreas.slideUp();
    // open the appropriate panel
    $(this).next().slideDown();
    // reset Expand all button
    expandLink.text('Expand all')
        .data('isAllOpen', false);
    // stop page scroll
    return false;
});

// hook up the expand/collapse all
expandLink.click(function(){
    var isAllOpen = !$(this).data('isAllOpen');
    console.log({isAllOpen: isAllOpen, contentAreas: contentAreas})
    contentAreas[isAllOpen? 'slideDown': 'slideUp']();

    expandLink.text(isAllOpen? 'Collapse All': 'Expand all')
                .data('isAllOpen', isAllOpen);
});


// Payment Method Accordion
$('input[name="paymentmethod"]').on('click', function () {
	var $value = $(this).attr('value');
	$('.return-departure-dts').slideUp();
	$('[data-method="' + $value + '"]').slideDown();
});


// === Radio buttons Tabs=== //

// Share post popup radio buttons
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".share-box").not(targetBox).hide();
        $(targetBox).show();
    });
});

// Video Lecture popup radio buttons
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".video-box").not(targetBox).hide();
        $(targetBox).show();
    });
});

// Quiz popup radio buttons
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".quiz-box").not(targetBox).hide();
        $(targetBox).show();
    });
});

// Intro Box popup radio buttons
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".intro-box").not(targetBox).hide();
        $(targetBox).show();
    });
});

// === Custom Toggle Menu For Top Nav === //

$(document).on('click', 'a.nav-icon-list', function(e) {
	e.preventDefault();
	$('.lecture-sidebar').toggle();
});

// Right Click Disable
// window.oncontextmenu = function () {
// 	return false;
// }
// $(document).keydown(function (event) {
// 	if (event.keyCode == 123) {
// 		return false;
// 	}
// 	else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
// 		return false;
// 	}
// });

//Fetched Js
// ------select2-----
$('.single-select').select2({
    width: '100%'
});
$('.multiple-select').select2({
    multiple: true,
    width: '100%',
});
$('select.area-m-select').select2({
    multiple: true,
    width: '100%',
    placeholder: "Select tuition provide area",
});
$('select.subject-m-select').select2({
    multiple: true,
    width: '100%',
    placeholder: "Select tuition Preferred Subjects",
});
$('select.medium-m-select').select2({
    multiple: false,
    width: '100%',
    placeholder: "Select tuition Preferred Medium",
});
$('select.class-m-select').select2({
    multiple: true,
    width: '100%',
    placeholder: "Select provide tuition Classes",
});
$('select.days-m-select').select2({
    multiple: true,
    width: '100%',
    placeholder: "Select provide tuition days",
});
$('select.timing-m-select').select2({
    multiple: true,
    width: '100%',
    placeholder: "Select timing shift",
});
$('select.tutoring-m-select').select2({
    multiple: true,
    width: '100%',
    placeholder: "Select tutoring style",
});
// $('#pref_sub').val(["3", "4", "5"]).trigger('change');


// ------------------------ All Ajax Code Start ------------------------
$(document).ready(function(){
    $('select.districts').on('change', function() {
        var stateID = $(this).val();
        $("#tuition_area").hide();
        $(".selectArea").hide();
        $(".loadingImgArea").show();
        $.ajax({
            type: "get",
            url: '/area-list',
            data:{'id':stateID},
            dataType: "json",
            success:function(data) {
                var len = data.length;
                $(".loadingImgArea").hide();
                $("#tuition_area").hide();
                $(".selectArea").show();
                $(".area").empty();
                $(".area").append("<option value=''>" + 'Select Area' + "</option>");
                for (var i = 0; i < len; i++) {
                    var id = data[i]['id'];
                    var areaName = data[i]['areaName'];
                    $(".area").append("<option value='" + areaName + "'>" + areaName + "</option>");
                }
            }
        });
    });

    $('select.districts').filter(function() {
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
                $(".loadingImgArea").hide();
                $(".selectArea").show();
                $(".area").empty();
                $(".area").append("<option value=''>" + 'Select Area' + "</option>");
                const urlParams = new URLSearchParams(window.location.search);
                const myParam = urlParams.get('area');
                for (var i = 0; i < len; i++) {
                    var id = data[i]['id'];
                    var areaName = data[i]['areaName'];
                    if (areaName == myParam) {
                        var selected = "selected='selected'";
                    } else {
                        selected = "";
                    }
                    $(".area").append("<option value='" + areaName + "' " + selected + ">" + areaName + "</option>");
                }
            }
        });
    });
});

$(document).ready(function(){
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

    $('select.medium2').on('change', function() {
        var mediumName = $(this).val();
        $(".selectClass").hide();
        $(".loadingImgClass").show();
        $.ajax({
            type: "get",
            url: '/class-list2',
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

    $('select.medium').filter(function() {
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
                const urlParams = new URLSearchParams(window.location.search);
                const myParam = urlParams.get('class');
                for (var i = 0; i < len; i++) {
                    var id = data[i]['id'];
                    var className = data[i]['className'];
                    if (className == myParam) {
                        var selected = "selected='selected'";
                    } else {
                        selected = "";
                    }
                    $(".class").append("<option value='" + className + "' " + selected + ">" + className + "</option>");
                }
            }
        });
    });
});


$(document).ready(function(){
    $('select.medium, select.class').on('change', function() {
        var className = $('select.class').val();
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

    $('select.class').filter(function() {
        var className = $(this).val();
        const urlParams = new URLSearchParams(window.location.search);
        const myParam = urlParams.get('class');
        if (className == '' && myParam != '') {
            className = myParam;
        }
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
                const urlParams = new URLSearchParams(window.location.search);
                const myParam = urlParams.get('subject');
                for (var i = 0; i < len; i++) {
                    var id = data[i]['id'];
                    var subjectName = data[i]['subjectName'];
                    if (subjectName == myParam) {
                        var selected = "selected='selected'";
                    } else {
                        selected = "";
                    }
                    $(".subject").append("<option value='" + subjectName + "' " + selected + ">" + subjectName + "</option>");
                }
            }
        });
    });
});
// ------------------------ / All Ajax Code End ------------------------


// ------------------------ All Custome Code Start ------------------------
// image display upload image
// $("#imageUpload").change(function () {
//     readURL(this);
// });

// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             $('#imagePreview').attr('src', e.target.result).fadeIn('slow');
//         };
//         reader.readAsDataURL(input.files[0]);
//     }
// }

// image validation only jpg, jpeg, and png file support or display upload image
$(function() {
  $("#btn_del").hide();
  $("#imageUpload").on("change", function() {
    var files = !!this.files ? this.files : [];
    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.png)$/;
    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

    if (regex.test(files[0].type)) { // only image file
      var reader = new FileReader(); // instance of the FileReader
      reader.readAsDataURL(files[0]); // read the local file

      $("#btn_del").show();

      $("#btn_del").on("click", function() {
        $('#imagePreview').attr('src', imageUpload).fadeIn('slow');
        $('#imageUpload').val('')
        $("#btn_del").css("display", "none");
        $('#error').text('').hide(); // Empty or hide the error message
      });

      reader.onload = function(e) { // set image data as background of div
        $('#imagePreview').attr('src', e.target.result).fadeIn('slow');
        $('#error').text('').hide(); // Empty or hide the error message
      }
    } else {
      $('#error').show().text('Please upload only jpg, jpeg or png'); // Add an error message
      $('#imageUpload').val('')
    }
  });
});

$("#nid_card").change(function () {
    nidURL(this);
});
$("#student_card").change(function () {
    studentURL(this);
});
function nidURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#editNidPreview').attr('src', e.target.result).fadeIn('slow');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function studentURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#editStudentPreview').attr('src', e.target.result).fadeIn('slow');
        };
        reader.readAsDataURL(input.files[0]);
    }
}


