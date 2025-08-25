@extends('master')
@section('title' , 'فريلانقو | المشاريع')
@section('content')
<div class="profile-layout">


    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: " id="exampleModalLabel">اضافة مشروع جديد </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form_add" action="{{ route('web.project.store') }}" id="form_add"
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

                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">@lang('اغلاق')</button>
                            <button type="submit" style="background-color: #7212df"
                                class="btn text-white">@lang('نشر')</button>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> تعديل مشروع جديد</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <form class="form_edit" id="form_edit" enctype="multipart/form-data"
                        action="{{ route('web.project.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" class="form-control">

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' عنوان المشروع ')</label>
                            <input id="edit_title" placeholder="@lang('عنوان المشروع ')" name="title" class="form-control"
                                type="text" >
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' ميزانية المشروع  ')</label>
                            <input id="edit_budget" placeholder="@lang(' ميزانية المشروع')" name="budget" class="form-control"
                                type="text" >
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('   مدة المشروع')</label>
                            <input id="edit_duration" placeholder="@lang(' مدة المشروع ')" name="duration" class="form-control"
                                type="text">
                            <div class="invalid-feedback"></div>
                        </div>


                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' وصف توضيحي للمشروع  ')</label>
                            <textarea id="edit_desc" placeholder="@lang(' وصف توضيحي للمشروع  ')" name="desc" class="form-control"></textarea>
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


        @include('web.part.side')

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
                                <a data-bs-toggle="modal" data-bs-target="#add-modal" style="background-color: rgb(134, 56, 251) ; color:white"
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
                                    <th>@lang('العنوان')</th>
                                    <th>@lang('وصف المشروع')</th>
                                    <th>@lang('الميزانية')</th>
                                    <th>@lang('المدة ')</th>
                                    <th>@lang('تاريخ الانتهاء')</th>
                                    <th>@lang('الحالة ')</th>
                                    <th>@lang('العمليات')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
                url: "{{ route('web.project.getdata') }}",
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
                    data: "title",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },

                {
                    data: "description",
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
                    data: 'deadline',
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
                var budget  = button.data('budget');
                var duration  = button.data('duration');
                var desc = button.data('desc');
                var bio = button.data('bio');
                var email = button.data('email');
                $('#id').val(id);
                $('#edit_title').val(title);
                $('#edit_budget').val(budget);
                $('#edit_duration').val(duration);
                $('#edit_desc').val(desc);
            });
        });

</script>
@stop
