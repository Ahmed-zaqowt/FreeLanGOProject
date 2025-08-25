<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') </title>


    <link rel="icon" href="{{ asset('admin_assets_rtl/images/favicon-32x32.png') }}" type="image/png" />
    <link href="{{ asset('admin_assets_rtl/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dash/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dash/css/pages.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dash/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dash/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('toastr/app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link href="{{ asset('datatable_custom/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('datatable_custom/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.2.2/css/fixedColumns.dataTables.min.css">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <i class="fas fa-rocket"></i> FreelanGo
            </div>

            <div class="navbar-content">
                <ul class="navbar-links">
                    <li><a href="index.html"><i class="fas fa-home"></i> الرئيسية</a></li>
                    <li><a href="projects.html"><i class="fas fa-project-diagram"></i> المشاريع</a></li>
                    <li><a href="about.html"><i class="fas fa-info-circle"></i> عن المنصة</a></li>
                    <li><a href="contact.html"><i class="fas fa-envelope"></i> اتصل بنا</a></li>
                </ul>
            </div>

            <div class="navbar-actions">
                <a href="register.html" class="btn-apply"><i class="fas fa-user-plus"></i> إنشاء حساب</a>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>عن FreelanGo</h3>
                    <p>منصة عربية تربط بين أصحاب المشاريع والمحترفين المستقلين لتنفيذ الأعمال بكفاءة وابتكارية.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>روابط سريعة</h3>
                    <ul class="footer-links">
                        <li><a href="index.html"><i class="fas fa-chevron-left"></i> الرئيسية</a></li>
                        <li><a href="projects.html"><i class="fas fa-chevron-left"></i> المشاريع</a></li>
                        <li><a href="how-it-works.html"><i class="fas fa-chevron-left"></i> كيف تعمل المنصة</a></li>
                        <li><a href="pricing.html"><i class="fas fa-chevron-left"></i> الأسعار</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>الدعم والمساعدة</h3>
                    <ul class="footer-links">
                        <li><a href="faq.html"><i class="fas fa-chevron-left"></i> الأسئلة الشائعة</a></li>
                        <li><a href="support.html"><i class="fas fa-chevron-left"></i> مركز الدعم</a></li>
                        <li><a href="terms.html"><i class="fas fa-chevron-left"></i> الشروط والأحكام</a></li>
                        <li><a href="privacy.html"><i class="fas fa-chevron-left"></i> سياسة الخصوصية</a></li>
                    </ul>
                </div>
            </div>

            <div class="copyright">
                © 2023 FreelanGo. جميع الحقوق محفوظة.
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets-dash/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-dash/js/app.js') }}"></script>
    <script src="{{ asset('admin_assets_rtl/js/jquery.min.js') }}"></script>
    <script src="{{ asset('toastr/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('datatable_custom/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable_custom/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('datatable_custom/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    @yield('js')
    <script>
        $('#form_edit').on('submit', function(event) {
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
                    if (result.success) {
                        $("#edit-modal").modal('hide');
                        $('#form_edit').trigger("reset");
                        table.draw();
                        toastr.success(result.success);
                    } else if (result.error) {
                        toastr.error(result.error, "خطأ");
                    }
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
                        toastr.error("حدث خطأ غير متوقع", "خطأ");
                    }
                },
            });
        })
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
                            success: function(result) {
                                if (result.success) {
                                    toastr.success(result.success);
                                    table.draw()
                                } else if (result.error) {
                                    toastr.error(result.error, "خطأ");
                                }
                            }
                        });
                    } else {
                        toastr.error('تم إلغاء عملية الحذف');
                    }
                });
            });
        });

    </script>
</body>

</html>
