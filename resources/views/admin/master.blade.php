<!doctype html>
<html lang="en" class="semi-dark" @if (\Illuminate\Support\Facades\App::getLocale() == 'ar') dir="rtl" @endif>

<head>
    <!-- Required meta tags -->
    @yield('css')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('admin_assets_rtl/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('admin_assets_rtl/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets_rtl/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets_rtl/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin_assets_rtl/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets_rtl/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets_rtl/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets_rtl/css/icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('toastr/app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.2.2/css/fixedColumns.dataTables.min.css">

    <!-- loader-->
    <link href="{{ asset('admin_assets_rtl/css/pace.min.css') }}" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="{{ asset('admin_assets_rtl/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets_rtl/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets_rtl/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets_rtl/css/header-colors.css') }}" rel="stylesheet" />


    <link href="{{ asset('datatable_custom/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('datatable_custom/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('toastr/app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <style>
        /* تنسيق حاوية السوايبر */
        .swiper-container {
            width: 100%;
            height: 300px;
            /* يمكنك تعديل الارتفاع حسب الحاجة */
            margin: 0 auto;
            overflow: hidden;
            position: relative;
            /* لضمان تموضع الأزرار بشكل صحيح */
        }

        /* تنسيق الشرائح */
        .swiper-slide img {
            width: 100%;
            /* عرض الصورة بالكامل داخل السلايدر */
            height: auto;
            object-fit: contain;
            /* لتناسب الصورة داخل السلايدر */
        }

        /* تنسيق الأزرار */
        .swiper-button-next,
        .swiper-button-prev {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            /* توسيط الأزرار عموديًا */
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.8);
            color: #000;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        /* الزر السابق (يسار) */
        .swiper-button-prev {
            left: 10px;
        }

        /* الزر التالي (يمين) */
        .swiper-button-next {
            right: 10px;
        }



        .circle-container {
            display: flex;
            align-items: center;
        }

        .circle {
            width: 30px;
            height: 30px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            margin: 0 -15px;
            /* تعيين هامش يفصل بين الدوائر */
            overflow: hidden;
            border: 2px solid #706d6d;
            transition: 0.2s;

        }

        .circle-container:hover .circle {
            margin: 0 -17px;
            /* تعيين هامش يفصل بين الدوائر */
            transition: 0.2s;

        }

        .circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .circle1 {
            transform: translateX(-20px);
            z-index: 4;
        }

        .circle2 {
            transform: translateX(0);
            z-index: 3;
        }

        .circle3 {
            transform: translateX(20px);
            z-index: 2;
        }

        .add-product-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #7212df;
            /* اللون الأساسي للزر */
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            padding: 6px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-decoration: none;

        }

        /* تأثير التحويم */
        .add-product-btn:hover {
            background-color: #8c3ee4;
            transform: translateY(-2px);
        }

        /* أيقونة الزر */
        .add-product-btn i {
            font-size: 20px;
        }

        .btn-square {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            /* عرض الزر */
            height: 32px;
            /* ارتفاع الزر */
            border-radius: 4px;
            /* زوايا مستديرة صغيرة */
            background-color: #7212df;
            /* لون الخلفية */
            color: #fff;
            /* لون الأيقونة */
            font-size: 14px;
            /* حجم الأيقونة */
            transition: all 0.3s ease;
            /* تأثير عند التحويم */
            cursor: pointer;
        }

        /* تأثير التحويم */
        .btn-square:hover {
            background-color: #5e0eb5;
            /* لون أغمق عند التحويم */
            transform: scale(1.1);
            /* تكبير الزر قليلاً */
        }

        /* زر التعديل */
        .edit_btn {
            background-color: #7212df;
            color: #fff;
            /* لون أصفر */
        }

        .edit_btn:hover {
            color: #fff;
            /* لون أصفر أغمق عند التحويم */
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #7212df;
            border-color: #5e0eb5;
        }

        .page-link {
            position: relative;
            display: block;
            color: #7212df;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #dee2e6;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .swal-button {
            margin: 5px auto;
            /* محاذاة في المنتصف */
            display: block;
            /* الزر يصبح عنصرًا مستقلاً */
            padding: 10px;
            /* حواف داخلية للزر */
            font-size: 16px;
            /* حجم النص */
            border-radius: 8px;
            /* زوايا مستديرة */
            transition: all 0.3s ease-in-out;
            /* تأثير جميل عند التحويم */
        }

        /* زر التأكيد */
        .custom-confirm-btn {
            background-color: #d9534f;
            /* لون أحمر */
            color: #fff;
            border: none;
        }

        .custom-confirm-btn:hover {
            background-color: #c9302c;
            /* لون أحمر أغمق عند التحويم */
        }

        /* زر الإلغاء */
        .custom-cancel-btn {
            background-color: #6c757d;
            /* لون رمادي */
            color: #fff;
            border: none;
        }

        .search_input {
            width: 100%;
            padding: 6px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .suggestions {
            display: none;
            /* سيتم عرضها فقط عندما يتم تحديثها بواسطة JavaScript */
            border: 1px solid #ccc;
            background-color: #fff;
            position: absolute;
            z-index: 1000;
            width: 100%;
            max-height: 200px;
            /* لمنع ارتفاع الاقتراحات من تجاوز الحدود */
            overflow-y: auto;
            /* لإضافة شريط تمرير عند الحاجة */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* لإضافة ظل خفيف */
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
            /* لإضافة خط تحت كل اقتراح */
        }

        .suggestion-item:hover {
            background-color: #ddd3e8;
        }

        .form-control:focus {
            color: #212529;
            background-color: #fff;
            outline: 0;
            border-color: #f986fe;
            box-shadow: 0px 0px 0 .25rem rgb(142 13 253 / 25%)
        }
    </style>
    <title>@yield('title', env('APP_NAME'))</title>
</head>

<body>


    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->
        <header class="top-header">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-toggle-icon fs-3">
                    <i class="bi bi-list"></i>
                </div>


                {{--     <li class="nav-item dropdown dropdown-user-setting">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                  <div class="user-setting d-flex align-items-center">
                    <img src="{{ asset('admin_assets_rtl/images/avatars/avatar-1.png')}}" class="user-img" alt="">
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                          <img src="{{ asset('admin_assets_rtl/images/avatars/avatar-1.png')}}" alt="" class="rounded-circle" width="54" height="54">
                          <div class="ms-3">
                            <h6 class="mb-0 dropdown-user-name">Jhon Deo</h6>
                            <small class="mb-0 dropdown-user-designation text-secondary">HR Manager</small>
                          </div>
                       </div>
                     </a>
                   </li>
                   <li><hr class="dropdown-divider"></li>
                   <li>
                      <a class="dropdown-item" href="pages-user-profile.html">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-person-fill"></i></div>
                           <div class="ms-3"><span>Profile</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-gear-fill"></i></div>
                           <div class="ms-3"><span>Setting</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="index2.html">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-speedometer"></i></div>
                           <div class="ms-3"><span>Dashboard</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-piggy-bank-fill"></i></div>
                           <div class="ms-3"><span>Earnings</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-cloud-arrow-down-fill"></i></div>
                           <div class="ms-3"><span>Downloads</span></div>
                         </div>
                       </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                      <a class="dropdown-item" href="authentication-signup-with-header-footer.html">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-lock-fill"></i></div>
                           <div class="ms-3"><span>Logout</span></div>
                         </div>
                       </a>
                    </li>
                </ul>
              </li>
            <li class="nav-item dropdown dropdown-large">
                <div class="dropdown-menu dropdown-menu-end">
                   <div class="row row-cols-3 gx-2">
                      <div class="col">
                        <a href="ecommerce-orders.html">
                         <div class="apps p-2 radius-10 text-center">
                            <div class="apps-icon-box mb-1 text-white bg-gradient-purple">
                              <i class="bi bi-basket2-fill"></i>
                            </div>
                            <p class="mb-0 apps-name">Orders</p>
                         </div>
                        </a>
                      </div>
                      <div class="col">
                        <a href="javascript:;">
                        <div class="apps p-2 radius-10 text-center">
                           <div class="apps-icon-box mb-1 text-white bg-gradient-info">
                            <i class="bi bi-people-fill"></i>
                           </div>
                           <p class="mb-0 apps-name">Users</p>
                        </div>
                      </a>
                     </div>
                     <div class="col">
                      <a href="ecommerce-products-grid.html">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-gradient-success">
                          <i class="bi bi-trophy-fill"></i>
                         </div>
                         <p class="mb-0 apps-name">Products</p>
                      </div>
                      </a>
                    </div>
                    <div class="col">
                      <a href="component-media-object.html">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-gradient-danger">
                          <i class="bi bi-collection-play-fill"></i>
                         </div>
                         <p class="mb-0 apps-name">Media</p>
                      </div>
                      </a>
                    </div>
                    <div class="col">
                      <a href="pages-user-profile.html">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-gradient-warning">
                          <i class="bi bi-person-circle"></i>
                         </div>
                         <p class="mb-0 apps-name">Account</p>
                       </div>
                      </a>
                    </div>
                    <div class="col">
                      <a href="javascript:;">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-gradient-voilet">
                          <i class="bi bi-file-earmark-text-fill"></i>
                         </div>
                         <p class="mb-0 apps-name">Docs</p>
                      </div>
                      </a>
                    </div>
                    <div class="col">
                      <a href="ecommerce-orders-detail.html">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-gradient-branding">
                          <i class="bi bi-credit-card-fill"></i>
                         </div>
                         <p class="mb-0 apps-name">Payment</p>
                      </div>
                      </a>
                    </div>
                    <div class="col">
                      <a href="javascript:;">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-gradient-desert">
                          <i class="bi bi-calendar-check-fill"></i>
                         </div>
                         <p class="mb-0 apps-name">Events</p>
                      </div>
                    </a>
                    </div>
                    <div class="col">
                      <a href="javascript:;">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-gradient-amour">
                          <i class="bi bi-book-half"></i>
                         </div>
                         <p class="mb-0 apps-name">Story</p>
                        </div>
                      </a>
                    </div>
                   </div><!--end row-->
                </div>
              </li>


              </ul>
              </div>
 --}}
            </nav>
        </header>
        <!--end top header-->

        <!--start sidebar -->
        @include('admin.parts.side')
        <!--end sidebar -->

        <!--start content-->
        <main class="page-content">

            @yield('content')


        </main>
        <!--end page main-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->



    </div>
    <!--end wrapper-->

    <script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>

    <!-- Bootstrap bundle JS -->
    <script src="{{ asset('admin_assets_rtl/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('admin_assets_rtl/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets_rtl/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin_assets_rtl/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin_assets_rtl/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_assets_rtl/js/pace.min.js') }}"></script>
    <!--app-->
    <script src="{{ asset('datatable_custom/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable_custom/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('datatable_custom/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('toastr/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>

    <script src="{{ asset('admin_assets_rtl/js/app.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('js')

    <script>
        $('#search_btn').on('click', function(e) {
            table.draw();
            e.preventDefault();
        });

        $('#clear_btn').on('click', function(e) {
            e.preventDefault();
            $('.search_input').val("").trigger("change")
            table.draw();
        });



        $('#form_add').on('submit', function(event) {

            event.preventDefault();
            var data = new FormData(this);
            let url = $(this).attr('action');
            let method = $(this).attr('method');

            $('input').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            $.ajax({
                type: method,
                cache: false,
                contentType: false,
                processData: false,
                url: url,
                data: data,

                success: function(result) {
                    $("#add-modal").modal('hide');
                    $('#form_add').trigger("reset");
                    toastr.success("تمت العملية بنجاح");
                    table.draw()
                },
                error: function(data) {
                    if (data.status === 422) {
                        var response = data.responseJSON;
                        $.each(response.errors, function(key, value) {
                            var str = (key.split("."));
                            if (str[1] === '0') {
                                key = str[0] + '[]';
                            }
                            $('[name="' + key + '"], [name="' + key + '[]"]').addClass(
                                'is-invalid');
                            $('[name="' + key + '"], [name="' + key + '[]"]').closest(
                                '.form-group').find('.invalid-feedback').html(value[0]);
                        });
                    } else {
                        console.log('ahmed');
                    }
                }
            });
        })

        $('#form_edit').on('submit', function(event) {
            //  $('.search_input').val("").trigger("change")

            event.preventDefault();
            var data = new FormData(this);
            let url = $(this).attr('action');
            let method = $(this).attr('method');

            $('input').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            $.ajax({
                type: method,
                cache: false,
                contentType: false,
                processData: false,
                url: url,
                data: data,

                success: function(result) {
                    $("#edit-modal").modal('hide');
                    $('#form_edit').trigger("reset");
                    toastr.success("تم التعديل بنجاح");
                    table.draw()
                },
                error: function(data) {
                    if (data.status === 422) {
                        var response = data.responseJSON;
                        $.each(response.errors, function(key, value) {
                            var str = (key.split("."));
                            if (str[1] === '0') {
                                key = str[0] + '[]';
                            }
                            $('[name="' + key + '"], [name="' + key + '[]"]').addClass(
                                'is-invalid');
                            $('[name="' + key + '"], [name="' + key + '[]"]').closest(
                                '.form-group').find('.invalid-feedback').html(value[0]);
                        });
                    } else {
                        console.log('ahmed');
                    }
                }
            });
        })

        $(document).ready(function() {
            $(document).on('click', '.delete_btn', function(event) {
                event.preventDefault();
                var button = $(this)
                var id = button.data('id');
                var url = button.data('url');

                swal({
                    title: "هل أنت متأكد؟",
                    text: "هل ترغب حقاً في حذف هذا العنصر؟",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "إلغاء",
                            value: false,
                            visible: true,
                            className: "custom-cancel-btn",
                            closeModal: true,
                        },
                        confirm: {
                            text: " احذف",
                            value: true,
                            visible: true,
                            className: "custom-confirm-btn",
                            closeModal: true,
                        }
                    },
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var url = button.data('url');
                        $.ajax({
                            url: url,
                            method: "POST",
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                toastr.success('تم الحذف بنجاح');
                                table.draw();
                            }
                        });
                    } else {
                        toastr.error('تم إلغاء عملية الحذف');
                    }
                });



            });
        });



        // البحث وعرض الاقتراحات
        $('.search_input[data-ajax="true"]').on('input', function() {
            let input = $(this);
            let query = input.val();
            let url = input.data('url');
            let suggestionsBox = $('#' + input.attr('id') + '_suggestions');

            if (query.length > 0) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        console.log(data); // طباعة البيانات للتحقق من البنية
                        suggestionsBox.empty();

                        if (Array.isArray(data) && data.length > 0) {
                            let suggestions = '';
                            data.forEach(item => {
                                suggestions += `<div class="suggestion-item">${item}</div>`;
                            });
                            suggestionsBox.html(suggestions).show();
                        } else {
                            suggestionsBox.hide();
                        }
                    },
                    error: function() {
                        suggestionsBox.hide();
                    }
                });
            } else {
                suggestionsBox.hide();
            }
        });

        // عند النقر على عنصر من الاقتراحات
        $(document).on('click', '.suggestion-item', function() {
            let suggestion = $(this).text(); // النص المقترح
            let suggestionsBox = $(this).closest('.suggestions'); // صندوق الاقتراحات
            let inputId = suggestionsBox.attr('id').replace('_suggestions', ''); // استخراج ID الإدخال
            let input = $('#' + inputId); // تحديد الإدخال

            // تعيين القيمة للإدخال
            input.val(suggestion);

            // إخفاء صندوق الاقتراحات
            suggestionsBox.hide();
        });

        // إخفاء الاقتراحات عند النقر خارج الصندوق
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.form-group').length) {
                $('.suggestions').hide();
            }
        });


        $(document).ready(function() {
            const fileInput = $("#company-logo-input");
            const previewContainer = $("#preview-container");
            const previewImage = $("#preview-image");
            const removeButton = $("#remove-image");

            // عند اختيار صورة
            fileInput.on("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.attr("src", e.target.result); // تعيين الصورة
                        previewContainer.show(); // إظهار الحاوية
                    };
                    reader.readAsDataURL(file);
                }
            });

            // عند حذف الصورة
            removeButton.on("click", function() {
                previewImage.attr("src", ""); // تفريغ الصورة
                previewContainer.hide(); // إخفاء الحاوية
                fileInput.val(""); // إعادة تعيين الحقل
            });
        });
        $(document).ready(function() {
            const fileInput = $("#company-logo-input");
            const previewContainer = $("#preview-container");
            const previewImage = $("#preview-image");
            const removeButton = $("#remove-image");

            // عند اختيار صورة
            fileInput.on("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.attr("src", e.target.result); // تعيين الصورة
                        previewContainer.show(); // إظهار الحاوية
                    };
                    reader.readAsDataURL(file);
                }
            });

            // عند حذف الصورة
            removeButton.on("click", function() {
                previewImage.attr("src", ""); // تفريغ الصورة
                previewContainer.hide(); // إخفاء الحاوية
                fileInput.val(""); // إعادة تعيين الحقل
            });
        });
    </script>
</body>

</html>
