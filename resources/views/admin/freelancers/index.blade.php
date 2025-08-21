@extends('admin.master')

@section('title', 'لوحة تحكم فريلانقو | قسم المستخدمين')

@section('css')
    <style>
        .dataTables_wrapper {
            overflow-x: auto;
        }

        .fixed-column {
            background-color: #f8f9fa;
            z-index: 1;
        }

        .product {
            position: relative;
            cursor: pointer;
        }

        .description-box {
            max-height: 50px;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 5px;
            background-color: #ffffff;
        }

        .scroll-box {
            max-height: 150px;
            overflow-y: auto;
            display: none;
            border: 1px solid #7212df;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: absolute;
            z-index: 10;
            top: 0;
            left: 0;
            width: 100%;
        }

        .product:hover .scroll-box {
            display: block;


        }

        .description-box:hover {
            max-height: 200px;

        }

        #sizes-container {
            margin-top: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .size-inputs .form-control {
            flex-grow: 1;
        }



        .show-sizes-btn {
            position: relative;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .show-sizes-btn:hover {
            background-color: #0056b3;
        }



        .color-picker {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .color-box {
            width: 30px;
            height: 30px;
            border: 2px solid #ccc;
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.2s, border-color 0.2s;
        }

        .color-box:hover {
            transform: scale(1.1);
            border-color: #7212df;
        }

        .color-box.selected {
            border-color: #7212df;
            box-shadow: 0 0 5px #7212df;
        }

        #selected-colors {
            color: #7212df;
        }

        /* ضبط حجم السلايدر */
        .album-swiper {
            width: 90px;
            /* عرض السلايدر */
            height: 90px;
            /* ارتفاع السلايدر */
            border: 1px solid #ddd;
            /* حواف مشابهة للصورة */
            border-radius: 4px;
            /* زوايا مدورة */
            padding: 2px;
            /* مسافة داخلية */
            overflow: hidden;
            /* منع تجاوز الصور */
        }

        /* ضبط حجم الصور داخل السلايدر */
        .album-swiper .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* لجعل الصور تتناسب مع الحجم */
        }

        /* تصغير حجم الأزرار */
        .album-swiper .swiper-button-next,
        .album-swiper .swiper-button-prev {
            font-size: 10px;
            /* حجم أصغر للأزرار */
            color: #000;
            /* لون الأزرار */
        }


        /* تصغير حجم الأزرار */
        .album-swiper .swiper-button-next,
        .album-swiper .swiper-button-prev {
            font-size: 12px;
            /* حجم النص داخل الأزرار */
            width: 15px;
            /* عرض الزر */
            height: 15px;
            /* ارتفاع الزر */
            color: #000;
            /* لون الأزرار */
            background-color: rgba(255, 255, 255, 0.8);
            /* خلفية خفيفة للزر */
            border-radius: 50%;
            /* جعل الزر دائريًا */
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
            /* ظل صغير للأزرار */
        }

        /* ضبط مكان الأزرار بالنسبة للسلايدر */
        .album-swiper .swiper-button-next {
            right: -10px;
            /* المسافة من الحافة اليمنى */
        }

        .album-swiper .swiper-button-prev {
            left: -10px;
            /* المسافة من الحافة اليسرى */
        }

        /* تحسين التفاعل عند المرور بالفأرة */
        .album-swiper .swiper-button-next:hover,
        .album-swiper .swiper-button-prev:hover {
            background-color: rgba(0, 0, 0, 0.6);
            /* تغيير الخلفية عند التفاعل */
            color: #fff;
            /* تغيير لون الأيقونة */
        }
    </style>
@stop

@section('content')

    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: " id="exampleModalLabel">اضافة مستقل جديد </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form_add" action="{{ route('admin.freelancer.store') }}" id="form_add"
                        enctype="multipart/form-data" action="" method="POST">
                        @csrf
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('  الاسم الكامل للمستخدم  ')</label>
                            <input placeholder="@lang('الاسم الكامل للمستخدم ')" name="fullname" class="form-control" type="text">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('البريد الالكتروني')</label>
                            <input id="email" placeholder="@lang('البريد الالكتروني ')" name="email" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>


                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('الدولة')</label>
                            <select name="country" class="form-control">
                                <option selected disabled> اختر الدولة </option>
                                @foreach ($countries as $c)
                                    <option value="{{ $c->id }}">{{ $c->name_ar }} | "{{ $c->code }}"</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('رقم الهاتف ')<span> "بدون مقدمة الدولة"</span></label>
                            <input id="phone" placeholder="@lang(' رقم الهاتف ')" name="phone" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('الخبرة')</label>
                            <select name="experience" class="form-control">
                                <option selected disabled>اختر مدة الخبرة</option>
                                <option value="0-1">سنة أو أقل</option>
                                <option value="0-1">من سنة لثلاث سنوات</option>
                                <option value="0-1">من ثلاث سنوات لخمس سنوات</option>
                                <option value="0-1">أكثر من خمس سنوات</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('المهارات')</label>
                            <div class="multi-select" id="multiSelect">
                                <div class="selected form-control">اختر المهارات...</div>
                                <div class="options shadow-sm">
                                    <input type="text" class="form-control form-control-sm mb-2"
                                        placeholder=" ابحث عن مهارة...">
                                    @foreach ($skills as $skill)
                                        <div class="option"><input type="checkbox" name="skills[]" value="{{ $skill->id }}"> {{ $skill->title }}</div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>


                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('النبذة الشخصية  ')</label>
                            <textarea placeholder="@lang('النبذة الشخصية  ')" name="bio" class="form-control"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">@lang('اغلاق')</button>
                            <button type="submit" style="background-color: #7212df"
                                class="btn text-white">@lang('حفظ')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل المنتج </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form_edit" id="form_edit" enctype="multipart/form-data"
                        action="{{ route('admin.user.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" class="form-control">

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' الاسم الكامل')</label>
                            <input id="edit_name" placeholder="@lang('الاسم الكامل')" name="fullname" class="form-control"
                                type="text">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' اسم المستخدم ')</label>
                            <input id="edit_username" placeholder="@lang('اسم المستخدم')" name="username"
                                class="form-control" type="text">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' البريد الالكتروني ')</label>
                            <input id="edit_email" placeholder="@lang('البريد الالكتروني ')" name="email" class="form-control"
                                type="text">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('الدولة')</label>
                            <select id="edit_country" name="country" class="form-control">
                                <option selected disabled> اختر الدولة </option>
                                @foreach ($countries as $c)
                                    <option value="{{ $c->id }}">{{ $c->name_ar }} | "{{ $c->code }}"
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('رقم الهاتف ')<span> "بدون مقدمة الدولة"</span></label>
                            <input id="edit_phone" placeholder="@lang(' رقم الهاتف ')" name="phone" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('النبذة الشخصية  ')</label>
                            <textarea id="edit_bio" placeholder="@lang('النبذة الشخصية  ')" name="bio" class="form-control"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">@lang('اغلاق')</button>
                            <button type="submit" style="background-color: #7212df"
                                class="btn text-white">@lang('تعديل')</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">@lang('التصفية')</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">@lang('  الاسم الكامل للمستخدم  ')</label>
                            <input placeholder="@lang('  الاسم الكامل للمستخدم  ')" class="form-control search_input" type="text"
                                id="search_name">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">@lang('اسم المستخدم')</label>
                            <input placeholder="@lang('اسم المستخدم')" class="form-control search_input" type="text"
                                id="search_username">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">@lang('الدولة')</label>
                            <select id="search_country" class="form-control search_input_select">
                                <option selected value=""> اختر الدولة </option>
                                @foreach ($countries as $c)
                                    <option value="{{ $c->id }}">{{ $c->name_ar }} | "{{ $c->code }}"
                                    </option>
                                @endforeach
                            </select>

                        </div>


                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">@lang('رقم الهاتف ')<span> "بدون مقدمة الدولة"</span></label>
                            <input id="search_phone" placeholder="@lang(' رقم الهاتف ')" class="form-control search_input">
                        </div>



                    </div>

                    <div class="my-3 d-flex gap-2">
                        <button type="submit" id="search_btn" style="background-color: #7212df"
                            class="btn text-white col-6">
                            @lang('بحث')
                        </button>
                        <button id="clear_btn" class="btn btn-secondary col-6" type="button">
                            <span><i class="fa fa-undo"></i> إعادة تهيئة</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-lg-12 col-xl-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="row g-3 align-items-center">
                        <div class="col">
                            <h5 class="mb-0">@lang('المستخدمين')</h5>
                        </div>
                        <div class="col">
                            <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                                <a data-bs-toggle="modal" data-bs-target="#add-modal" style="color: white"
                                    href="#" class="add-product-btn">
                                    <i class="fas fa-plus"></i> إضافة مستقل
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>@lang('الاسم كامل')</th>
                                    <th>@lang('اسم المستخدم ')</th>
                                    <th>@lang('البريد الالكتروني')</th>
                                    <th>@lang('البلد')</th>
                                    <th>@lang('رقم الهاتف')</th>
                                    <th>@lang('الخبرة')</th>
                                    <th>@lang('التقييم')</th>
                                    <th>@lang('المشاريع المكتملة')</th>
                                    <th>@lang('تاريخ الانضمام ')</th>
                                    <th>@lang('التوثيق  ')</th>
                                    <th>@lang('رصيد النقاط  ')</th>
                                    <th>@lang('النبذة')</th>
                                    <th>@lang('العمليات')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')



    <script>
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.freelancer.getdata') }}",
                data: function(d) {
                    d.fullname = $('#search_name').val();
                    d.username = $('#search_username').val();
                    d.phone = $('#search_phone').val();
                    d.country = $('#search_country').val();

                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: "fullname",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },

                {
                    data: "username",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },
                {
                    data: 'email',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },
                {
                    data: 'country',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },
                {
                    data: 'phone',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },

                {
                    data: 'experience',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },
 {
                    data: 'rating',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },
                {
                    data: 'completed_projects',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },

                {
                    data: 'registration_date',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },

                {
                    data: 'is_verified_id_card',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },

                {
                    data: 'points_balance',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },





                {
                    data: 'bio',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },

                {
                    data: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
            language: {
                url: "{{ asset('datatable_custom/i18n/ar.json') }}",
            }
        });


        $(document).ready(function() {
            $(document).on('click', '.update_btn', function(event) {
                event.preventDefault();
                var button = $(this)
                var id = button.data('id');
                var name = button.data('name');
                var username = button.data('username');
                var phone = button.data('phone');
                var country = button.data('country');
                var bio = button.data('bio');
                var email = button.data('email');
                $('#id').val(id);
                $('#edit_name').val(name);
                $('#edit_username').val(username);
                $('#edit_phone').val(phone);
                $('#edit_country').val(country);
                $('#edit_bio').val(bio);
                $('#edit_email').val(email);
            });
        });
    </script>

@stop
