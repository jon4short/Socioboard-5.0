@extends('home::layouts.UserLayout')
@section('title')
    <title>{{env('WEBSITE_TITLE')}} | Scheduling</title>
@endsection
@section('links')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/custom/emojionearea/css/emojionearea.min.css') }}"/>
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Page Vendors Styles-->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/custom/dropify/dist/css/dropify.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/custom/emojionearea/css/emojionearea.min.css') }}">

@endsection
@section('content')

    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="Sb_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <!--begin::Schedule-->
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        <div class="card card-custom gutter-b card-stretch">
                            <!--begin::Header-->
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title font-weight-bolder">Schedule Post</h3>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body pt-2 position-relative overflow-hidden">
                                <form action="/home/publishing/youtube-schedule" method="POST" id="publish_form">
                                @csrf
                                <!-- begin:Accounts list -->
                                    <div class="accounts-list">
                                        <ul class="nav justify-content-center nav-pills" id="AddAccountsTab"
                                            role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="linkedin-tab-accounts" data-toggle="tab"
                                                   href="#linkedin-add-accounts" aria-controls="linkedin">
                                                    <span class="nav-text"><i class="fab fa-youtube fa-2x"></i></span>
                                                </a>
                                            </li>
                                        </ul>
                                        <span id="validPassword" style="color: red;font-size: medium; text-alignment: center" role="alert">
                                            <strong>{{ $errors->first('account_id') }}</strong>
                                        </span>
                                        <div class="tab-content mt-5" id="AddAccountsTabContent">
                                                <div class="mt-3">


                                                        <!--begin::Page-->
                                                    @if($socialAccounts !== null)
                                                    <div class="scroll scroll-pull" data-scroll="true"
                                                         data-wheel-propagation="true"
                                                         style="height: auto; overflow-y: scroll;">
                                                            <span>Choose YouTube accounts for posting</span>
                                                        @foreach($socialAccounts['account'] as $accounts)
                                                            <div class="d-flex align-items-center flex-grow-1">
                                                                <!--begin::Facebook Fanpage Profile picture-->
                                                                <div class="symbol symbol-45 symbol-light mr-5">
                                                                        <span class="symbol-label">
                                                                            <img src="{{$accounts->profile_pic_url}}"
                                                                                 class="w-100 align-self-center"
                                                                                 alt=""/>
                                                                        </span>
                                                                </div>
                                                                <!--end::Facebook Fanpage Profile picture-->
                                                                <!--begin::Section-->
                                                                <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                                    <!--begin::Info-->
                                                                    <div class="d-flex flex-column align-items-cente py-2 w-75">
                                                                        <!--begin::Title-->
                                                                        <a href="javascript:;"
                                                                           class="font-weight-bold text-hover-primary font-size-lg mb-1">
                                                                            {{$accounts->first_name}}
                                                                        </a>
                                                                        <!--end::Title-->

                                                                        <!--begin::Data-->
                                                                        <span class="text-muted font-weight-bold">
                                                                                {{$accounts->friendship_counts}} followers
                                                                            </span>
                                                                        <!--end::Data-->
                                                                    </div>
                                                                    <!--end::Info-->
                                                                </div>
                                                                <!--end::Section-->
                                                                <!--begin::Checkbox-->
                                                                <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                                                                    <input type="checkbox"
                                                                           value="{{$accounts->account_id}}"
                                                                           name="account_id"/>
                                                                    <span></span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </div>
                                                    @endforeach
                                                    <!--end::Page-->
                                                    </div>
                                                    @else
                                                        <span style="text-align: center; padding-left: 200px" ><h4>Please add Youtube Accounts</h4></span>
                                                    @endif
                                                    <br><br>
                                                </div>
                                        </div>
                                    </div>
                                    <!-- end:Accounts list -->
                                    <div class="form-group">
                                        <div class="input-icon">
                                            <input class="form-control form-control-solid h-auto py-4 rounded-lg font-size-h6"
                                                   type="text" name="title" id="title" autocomplete="off"
                                                   placeholder="Video Title"/>
                                            <span><i class="fas fa-link"></i></span>
                                        </div>
                                        <span id="validPassword" style="color: red;font-size: small; text-alignment: center" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <textarea
                                                class="form-control border border-light h-auto py-4 rounded-lg font-size-h6"
                                                id="normal_post_area" rows="3" name="discription"
                                                placeholder="Write Something !"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control select2 form-control-solid form-control-lg h-auto py-4 rounded-lg font-size-h6"
                                                id="youtube_tags" name="param[]" multiple="multiple">
                                            <option label="Label"></option>
                                        </select>
                                    </div>

                                    <!-- image and video upload -->
                                    <div id="animation"></div>
                                    <div class="row mb-5" id="new_pic">
                                        <div class="col-12" id="option_upload">
                                            <ul class="btn-nav">
                                                <li>
                                                            <span>
                                                        <i class="fas fa-video fa-2x"></i>
                                                        <input type="file" name="" click-type="img-video-option"
                                                               class="picupload"
                                                               multiple accept="video/*"/>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Privacy Status</label>
                                        <div class="radio-inline">
                                            <label class="radio radio-rounded">
                                                <input type="radio" name="privacystatus" value="public"/>
                                                <span></span>
                                                Public
                                            </label>
                                            <label class="radio radio-rounded">
                                                <input type="radio" name="privacystatus" value="private"/>
                                                <span></span>
                                                Private
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="publish_post_div">
                                        <label for="day_publish_post_daterange">Publish At</label>
                                        <div class="form-group">
                                            <input type="text" name="datetime"
                                                   class="form-control form-control-solid h-auto py-4 rounded-lg font-size-h6 datetimepicker-input"
                                                   id="day_publish_post_daterange" placeholder="Select date & time"
                                                   data-toggle="datetimepicker"
                                                   data-target="#day_publish_post_daterange"/>
                                        </div>
                                    </div>
                                    <!-- end of image and video upload -->

                                    <!-- begin::schedule button -->
                                    <div class="d-flex justify-content-around">
                                        <button type="submit" id="publish_button"
                                                class="btn text-hover-success font-weight-bolder font-size-h6 px-4 py-4 mr-3 my-3 col-6">
                                            Post now
                                        </button>
                                    </div>
                                    <!-- end::schedule button -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-12">
                        <div class="card card-custom gutter-b card-stretch">
                            <!--begin::Header-->
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title font-weight-bolder">Preview</h3>

                                <!--begin::Desktop and Mobile view-->
                                <ul class="nav nav-light-warning nav-pills" id="preview-tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="desktop-preview" data-toggle="tab" href="#desktop-preview" role="tab"
                                           aria-controls="desktop-preview">Desktop</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="mobile-preview" data-toggle="tab" href="#mobile-preview" role="tab"
                                           aria-controls="mobile-preview">Mobile</a>
                                    </li>

                                </ul>
                                <!--begin::Desktop and Mobile view-->
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body pt-2 position-relative overflow-hidden">
                                <div>
                                    <ul class="nav nav-light-warning nav-pills" id="social-preview-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="facebook-tab-preview" data-toggle="tab"
                                               href="#facebook-preview">
                                                <span class="nav-text">Youtube</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="preview-tabContent">
                                        <div>
                                            <div class="tab-content mt-5" id="PreviewTabContent">
                                                <div class="tab-pane fade show active" id="facebook-preview"
                                                     role="tabpanel" aria-labelledby="facebook-tab-preview">
                                                    <!--begin::Image-->
                                                    <div class="preview-tab">
                                                        <div class="preview-tab-inner">
                                                            <!--begin::Top-->
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Symbol-->
                                                                <div class="symbol symbol-40 symbol-light-success mr-5">
                                                                            <span class="symbol-label">
                                                                                <img src="{{ asset('/media/svg/avatars/047-girl-25.svg') }}"
                                                                                     class="h-75 align-self-end" alt=""/>
                                                                            </span>
                                                                </div>
                                                                <!--end::Symbol-->
                                                                <!--begin::Info-->
                                                                <div class="d-flex flex-column flex-grow-1">
                                                                    <a href="javascript:;"
                                                                       class="text-hover-primary mb-1 font-size-lg font-weight-bolder">@php echo session('user')['userDetails']['first_name']. ' '.session('user')['userDetails']['last_name']; @endphp</a>
                                                                    <span class="text-muted font-weight-bold">Just now</span>
                                                                </div>
                                                                <!--end::Info-->
                                                            </div>
                                                            <!--end::Top-->

                                                            <!--begin::Bottom-->
                                                            <div class="pt-4">
                                                                <!--begin::Text-->
                                                                <h3 class="font-weight-bolder" id="preview_title"></h3>
                                                                <p class="font-size-lg font-weight-normal pt-5 mb-2"
                                                                   id="preview_text">

                                                                </p>
                                                                <!--end::Text-->
                                                                <!--begin::Image-->
                                                                <div class="" id="preview_video">
                                                                </div>
                                                                <!--end::Image-->

                                                                <!--begin::Action-->
                                                                <div class="d-flex justify-content-around mt-2">
                                                                    <div class=" font-weight-bolder font-size-sm p-2 disabled">
                                                                                <span class="svg-icon svg-icon-md svg-icon-danger">
                                                                                    <i class="fas fa-heart fa-fw"></i> Like
                                                                                </span>
                                                                    </div>
                                                                    <div class="font-weight-bolder font-size-sm p-2 disabled">
                                                                                <span class="svg-icon svg-icon-md svg-icon-dark-25">
                                                                                    <i class="fas fa-comments fa-fw"></i> Comments
                                                                                </span>
                                                                    </div>
                                                                    <div class="font-weight-bolder font-size-sm p-2 disabled">
                                                                                <span class="svg-icon svg-icon-md svg-icon-dark-25">
                                                                                    <i class="fas fa-share fa-fw"></i> Share
                                                                                </span>
                                                                    </div>
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Bottom-->
                                                        </div>
                                                    </div>
                                                    <!--end::Image-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Schedule-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/contentStudio/publishContent.js')}}"></script>
    <script>
        {!! file_get_contents(Module::find('ContentStudio')->getPath() . '/js/scheduling.js'); !!}
    </script>
    <script src="{{asset('plugins/custom/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{asset('plugins/custom/emojionearea/js/emojionearea.min.js') }}"></script>

    <!--end::Global Theme Bundle-->

    <script>
        $('#youtube_tags').select2({
            placeholder: 'Tags',
            tags: true
        });
        $("#day_publish_post_daterange").on("change.datetimepicker", function (e) {
            $('#day_publish_post_daterange').datetimepicker('minDate', moment().add(3, 'minutes'));
        });

        // schedule div toggle
        $("#publish_post_div").hide();
        $("input[name=privacystatus]").change(function () {
            if ($('input[name=privacystatus]:checked').val() === "private") {
                $("#publish_post_div").show();
            } else {
                $("#publish_post_div").hide();
            }
        });
        $(document).on('keyup change paste insert', '#normal_post_area', function (e) {
            $("#preview_text").html($(this).val())
        })
        $(document).on('keyup change paste insert', '#title', function (e) {
            $("#preview_title").html($(this).val())
        })
        $(document).on('change', '.picupload', function (event) {
            $('#animation').empty().append('<i style="size: A5" class="fa fa-spinner fa-spin"></i>');
            $('#hint_brand').css('display', 'block');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let getAttr = $(this).attr('click-type');
            let files = event.target.files;
            let output = document.getElementById("media-list");
            let z = 0;
            if (getAttr == 'img-video-option') {
                $('#media-list').html('');
                $('#media-list').html('<div><li class="myupload"><span><i class="fa fa-plus" aria-hidden="true"></i><input type="file" click-type="img-video-upload" id="picupload" class="picupload" title="Click to Add File" data-toggle="tooltip" multiple accept="video/*,.jpg, .png, .jpeg" style="width: 100px"></span></li></div>');
            }
            if (getAttr == 'img-video-option' || getAttr == 'img-video-upload') {
                // $('#hint_brand').css("display", "block");
                $('#option_upload').css("display", "none");

                for (let fileKey = 0; fileKey < files.length; fileKey++) {
                    let checkIsUploaded = false;
                    let fileItem = files[fileKey];

                    // names[iterator] = $(this).get(0).files[fileKey].name;
                    if (fileItem.type.match('image')) {
                        let form_data = new FormData();
                        form_data.append('file', fileItem);

                        $.ajax({
                            url: '/discovery/content_studio/image/upload', // point to server-side PHP script
                            dataType: 'text',  // what to expect back from the PHP script, if anything
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: (r) => {

                                checkIsUploaded = true;
                                let response = JSON.parse(r); // display response from the PHP script, if any
                                // $('#picupload').tooltip();
                                checkIsUploaded = true
                                $("body").find('.defaultImage').remove();

                                if (response.type == 'image') {
                                    $("body").find('.imageShow').prepend(`<img src='${response.media_url}' class='img-fluid image${iterator}' style="object-fit:contain;">`);

                                    $("body").find("#media-list").prepend(`
                                    <li>
                                        <img src="${response.media_url}">
                                        <div class="post-thumb">
                                            <div class="inner-post-thumb">
                                                <a href="javascript:void(0);" class="remove-pic" data-id=${iterator}>
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                `)

                                    $("body").find("#publishContentForm").append(`
                                    <input type='hidden' name='mediaUrl[]' class='image${iterator}' value="${response.mdia_path}">
                                `);

                                    $("body").find("#picupload").parent().children('i').removeClass('fa-spinner').removeClass('fa-spin').addClass('fa-plus')
                                    iterator++
                                }
                            }
                        });

                    } else if (fileItem.type.match('video')) {
                        let form_data = new FormData();
                        form_data.append('file', files[0]);
                        $.ajax({
                            url: '/discovery/content_studio/video/upload', // point to server-side PHP script
                            dataType: 'text',  // what to expect back from the PHP script, if anything
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: (r) => {
                                $('#animation').empty();
                                $("body").find('.defaultImage').remove();
                                let response = JSON.parse(r); // display response from the PHP script, if any

                                if (response.type == 'video') {
                                    $('#preview_video').append(`<video style="width:100%; height:auto" controls class='video${iterator}'><source src="${response.media_url}"></source></video>`);

                                    $("body").find("#new_pic").prepend(`
                                    <input type='hidden' name='videoUrl' value="${response.mdia_path}">

                                    <div id="video_data" style="position: relative; display: inline-block;">
                                        <video  style="width:30%; height:auto" ><source src="${response.media_url}"></source></video>
                                        <button type="button" id="close_image" class="btn btn-xs btn-icon btn-light btn-hover-primary" data-dismiss="modal" aria-label="Close" id="Sb_quick_user_close" style="position: absolute; top:0px; margin-left: -10px">
                                            <i class="ki ki-close icon-xs text-muted"></i>
                                        </button>
                                    </div>

                                `);
                                }
                            }
                        });
                    }
                }
            }
        });

        $(document).on('click', '#close_image', function (e) {
            $('#video_data,#new_pic,#preview_video').empty();
            $('#new_pic').append('<div class="col-12" id="option_upload">\n' +
                '                                            <ul class="btn-nav">\n' +
                '                                                <li>\n' +
                '                                                            <span>\n' +
                '                                                        <i class="fas fa-video fa-2x"></i>\n' +
                '                                                        <input type="file" name="" click-type="img-video-option"\n' +
                '                                                               class="picupload"\n' +
                '                                                               multiple accept="video/*"/>\n' +
                '                                                    </span>\n' +
                '                                                </li>\n' +
                '                                            </ul>\n' +
                '                                        </div>');
        })

        $(document).on('submit', '#publish_form', function (e) {
            e.preventDefault();
            $('#publish_button').empty().append('<i class="fa fa-spinner fa-spin"></i>Processing.');
            let form = document.getElementById('publish_form');
            let formData = new FormData(form);
            $.ajax({
                url: "/home/publishing/youtube-schedule",
                data: formData,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#publish_button').empty().append('Post Now');
                    if(response.code === 201){
                        for(let i=0; i<response.msg.length; i++){
                            toastr.error(response.msg[i]);
                        }
                    } else if (response.code === 401){
                        toastr.error(response.error)
                    } else if (response.code === 200){
                        toastr.success(response.data);
                    }else{
                        toastr.error(response.message);
                    }
                },
                error: function (error) {
                    $('#publish_button').empty().append('Post Now');
                    console.log(error)
                    toastr.error(error.error);
                }
            })
        });
        $('.multi-select-control').select2({
            width: 'resolve' //
        });
    </script>
@endsection
