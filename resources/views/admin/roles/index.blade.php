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
    {{--
    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: " id="exampleModalLabel">اضافة منتج جديد </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form_add" action="{{ route('admin.user.store') }}" id="form_add" enctype="multipart/form-data"
                        action="" method="POST">
                        @csrf
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('اسم المستخدم')</label>
                            <input placeholder="@lang('اسم المستخدم')" name="name" class="form-control" type="text">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('البريد الالكتروني')</label>
                            <input id="email" placeholder="@lang('البريد الالكتروني ')" name="email" class="form-control">
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
    </div> --}}
    {{--
    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل المنتج </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form_edit" id="form_edit" enctype="multipart/form-data"
                        action="{{ route('dash.subcat.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" class="form-control">

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('اسم المنتج ')</label>
                            <input id="edit_name" placeholder="@lang('اسم  المنتج')" name="name" class="form-control"
                                type="text">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('وصف المنتج')</label>
                            <textarea id="edit_desc" placeholder="@lang('وصف المنتج ')" name="description" class="form-control"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">الكمية الإجمالية</label>
                            <input id="edit_total_quantity" name="total_quantity" class="form-control" type="number"
                                min="0" placeholder="إجمالي الكمية">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('السعر')</label>
                            <input id="edit_price" placeholder="@lang('السعر')" name="price" class="form-control"
                                type="number">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' القسم الفرعي ')</label>
                            <select id="edit_subcat" name="maincat" class="form-control">
                                @foreach ($subcat as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('الشركة المنتجة')</label>
                            <select id="edit_company_id" name="company_id" class="form-control">
                                <option >لا توجد شركة </option>
                                @foreach ($company as $com)
                                <option value="{{ $com->id }}">{{ $com->name }}</option>
                            @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('كود الخصم')</label>
                            <select id="edit_coupon" name="coupon" class="form-control">
                                <option selected disabled> اختر كود الخصم </option>
                                <option value="false">لا يوجد اي خصومات</option>
                                @foreach ($coupons as $co)
                                    <option value="{{ $co->id }}">{{ $co->code }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' صورة المنتج الرئيسية')</label>
                            <input id="company-logo-input" name="photo" class="form-control" type="file">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('صور المنتج')</label>
                            <input name="album[]" multiple class="form-control" type="file">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('فيديو المنتج')</label>
                            <input name="video" class="form-control" type="file">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">هل المنتج يحتوي على أحجام؟</label>
                            <input type="checkbox" id="product_sizes_checkbox" name="has_sizes">
                        </div>
                        <div id="product_sizes_section" style="display: none;">
                            <div id="product_sizes_inputs">
                                <!-- يتم إضافة الحقول ديناميكيًا هنا -->
                            </div>
                            <button type="button" id="add_product_size" class="btn btn-secondary btn-sm">إضافة حجم
                                جديد</button>
                        </div>


                        <!-- Checkbox هل للمنتج ألوان؟ -->
                        <div class="mb-2">
                            <label class="form-label">هل للمنتج لون؟</label>
                            <input type="checkbox" id="edit-has-colors-checkbox">
                        </div>

                        <!-- حاوية الألوان -->
                        <div id="edit-color-picker-wrapper" style="display: none;">
                            <label class="form-label">حدد الألوان:</label>
                            <div id="edit-color-picker-container" class="color-picker"></div>
                            <p>الألوان المختارة: <span id="edit-selected-colors"></span></p>
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
--}}

    <div class="row">
        <div class="col-12">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">@lang('التصفية')</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <form class="form_add" action="{{ route('admin.role.store') }}" id="form_add"
                            enctype="multipart/form-data" action="" method="POST">
                            @csrf
                            <div class="mb-2 form-group">
                                <label class="form-label">@lang('اسم الدور')></label>
                                <input placeholder="@lang('اسم الدور')" name="name" class="form-control" type="text">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-2 form-group">
                                <label class="form-label">@lang('وصف الدور ')</label>
                                <input placeholder="@lang('وصف الدور')" name="description" class="form-control" type="text">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-2 form-group">
                            <label class="form-label">@lang(' مستحق الصلاحية')</label>
                            <select id="email" placeholder="@lang('وصف الصلاحية ')" name="guard" class="form-control">
                                <option disabled selected>حدد المستحق </option>
                                @foreach ($guards as $key => $value)
                                    <option value="{{ $value }}">{{ $key }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>


                            <div class="mb-2 form-group">
                                <label class="form-label">@lang(' الصلاحيات و الاذنونات')</label>
                                @foreach ($permissions as $guard => $perms)
                                    <h4>{{ __($guard) }}</h4>
                                    @foreach ($perms as $perm)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                                value="{{ $perm->id }}" id="perm-{{ $perm->id }}">
                                            <label class="form-check-lable"
                                                for="perm-{{ $perm->id }}">{{ $perm->description }}</label>

                                        </div>
                                    @endforeach
                                @endforeach
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

                        </form>
                        {{--
                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">@lang('اسم المنتج')</label>
                            <input placeholder="@lang('اسم المنتج')" class="form-control" type="text"
                                id="search_name">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">@lang('السعر')</label>
                            <input placeholder="@lang('السعر')" class="form-control" type="text"
                                id="search_price">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">القسم الفرعي</label>
                            <input id="search_subcat" type="text" placeholder="القسم الفرعي"
                                class="form-control search_input" data-ajax="true"
                                data-url="{{ route('dash.product.search.subcategory') }}">
                            <div class="suggestions" id="search_subcat_suggestions"></div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">القسم الرئيسي</label>
                            <input id="search_maincat" type="text" placeholder="القسم الرئيسي"
                                class="form-control search_input" data-ajax="true"
                                data-url="{{ route('dash.product.search.maincategory') }}">
                            <div class="suggestions" id="search_maincat_suggestions"></div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">@lang('كود الخصم')</label>
                            <input placeholder="@lang('كود الخصم')" class="form-control search_input" data-ajax="true"
                                data-url="{{ route('dash.coupon.search.code') }}" type="text" id="search_code">
                            <div class="suggestions" id="search_code_suggestions"></div>
                        </div>
                    </div>
 --}}

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
                                <h5 class="mb-0">@lang('المنتجات')</h5>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                                    <a data-bs-toggle="modal" data-bs-target="#add-modal" style="color: white"
                                        href="#" class="add-product-btn">
                                        <i class="fas fa-plus"></i> إضافة منتج
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
                                        <th>@lang('البريد الالكتروني')</th>
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



        <script></script>

    @stop
