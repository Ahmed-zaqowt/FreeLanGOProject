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
                    <h5 class="modal-title" style="color: " id="exampleModalLabel">اضافة مشروع جديد </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form_add" action="{{ route('admin.user.store') }}" id="form_add"
                        enctype="multipart/form-data" action="" method="POST">
                        @csrf
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('    عنوان المشروع  ')</label>
                            <input placeholder="@lang('   عنوان المشروع')" name="title" class="form-control" type="text">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('  ميزانية المشروع')</label>
                            <input id="phone" placeholder="@lang(' ميزانية المشروع  ')" name="budget" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' مدة المشروع بالايام')</label>
                            <input id="email" placeholder="@lang('  مدة المشروع بالايام')" name="duration" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('  وصف توضيحي للمشروع ')</label>
                            <textarea placeholder="@lang('  وصف توضيحي للمشروع ')" name="desc" class="form-control"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('المستخدم ')</label>
                            <select  name="user" class="form-control">
                                <option selected disabled> اختر المستخدم </option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fullname }}
                                    </option>
                                @endforeach
                            </select>
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
                            <label class="form-label">@lang(' عنوان المشروع ')</label>
                            <input id="edit_title" placeholder="@lang('عنوان المشروع ')" name="title" class="form-control"
                                type="text">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' ميزانية المشروع  ')</label>
                            <input id="edit_budget" placeholder="@lang(' ميزانية المشروع')" name="budget" class="form-control"
                                type="text">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('   مدة المشروع')</label>
                            <input id="edit_duration" placeholder="@lang(' مدة المشروع ')" name="duration"
                                class="form-control" type="text">
                            <div class="invalid-feedback"></div>
                        </div>


                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' وصف توضيحي للمشروع  ')</label>
                            <textarea id="edit_desc" placeholder="@lang(' وصف توضيحي للمشروع  ')" name="desc" class="form-control"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('المستخدم ')</label>
                            <select id="edit_user" name="user" class="form-control">
                                <option selected disabled> اختر المستخدم </option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fullname }}
                                    </option>
                                @endforeach
                            </select>
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
                                    <i class="fas fa-plus"></i> إضافة مستخدم
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
                                    <th>@lang('اسم المستخدم ')</th>
                                    <th>@lang('عنوان المشروع')</th>
                                    <th>@lang('ميزانية المشروع')</th>
                                    <th>@lang('الوقت اللازم بالايام')</th>
                                    <th>@lang('تفاصيل المشروع')</th>
                                    <th>@lang('الحالة ')</th>
                                    <th>@lang('عدد العروض ')</th>
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
                url: "{{ route('admin.project.getdata') }}",
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
                    data: "user",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },

                {
                    data: "title",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },
                {
                    data: 'budget',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },
                {
                    data: 'duration',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },
                {
                    data: 'description',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },



                {
                    data: 'status',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },

                    {
                    data: 'proposals_count',
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
                var title = button.data('title');
                var budget = button.data('budget');
                var duration = button.data('duration');
                var desc = button.data('desc');
                var bio = button.data('bio');
                var email = button.data('email');
                var user = button.data('user');
                $('#id').val(id);
                $('#edit_title').val(title);
                $('#edit_budget').val(budget);
                $('#edit_duration').val(duration);
                $('#edit_desc').val(desc);
                $('#edit_user').val(user);
            });
        });
    </script>

@stop
