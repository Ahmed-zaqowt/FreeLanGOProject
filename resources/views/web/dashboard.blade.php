@extends('master')
@section('title', 'فريلانقو | الملف الشخصي')
@section('content')
    <div class="profile-layout">
        <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <form class="form_edit" id="form_edit" enctype="multipart/form-data"
                        action="{{ route('web.profile.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $user->id }}" class="form-control">

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' الاسم الكامل')</label>
                            <input id="edit_name" placeholder="@lang('الاسم الكامل')" name="fullname" class="form-control"
                                type="text" value="{{ $user->fullname }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' اسم المستخدم ')</label>
                            <input id="edit_username" placeholder="@lang('اسم المستخدم')" name="username" class="form-control"
                                type="text" value="{{ $user->username }}">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' البريد الالكتروني ')</label>
                            <input id="edit_email" placeholder="@lang('البريد الالكتروني ')" name="email" class="form-control"
                                type="text" value="{{ $user->email }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('الدولة')</label>
                            <select id="edit_country" name="country" class="form-control">
                                <option selected disabled> اختر الدولة </option>
                                @foreach ($countries as $c)
                                    <option {{ $c->id == $user->country_id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name_ar }} | "{{ $c->code }}"
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('رقم الهاتف ')<span> "بدون مقدمة الدولة"</span></label>
                            <input id="edit_phone" placeholder="@lang(' رقم الهاتف ')" name="phone" class="form-control" value="{{ $user->phone }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('النبذة الشخصية  ')</label>
                            <textarea id="edit_bio" placeholder="@lang('النبذة الشخصية  ')" name="bio" class="form-control">{{ $user->bio }}</textarea>
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


        <div class="profile-content">
            <div class="profile-header">
                <div class="profile-image-container">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="صورة العميل" class="profile-image">
                    <div class="verified-badge">
                        <i class="fas fa-check"></i>
                    </div>
                </div>

                <div class="profile-info">
                    <h2 class="profile-name">
                        {{ $user->fullname }}
                        <span class="verified-text">
                            <i class="fas fa-check-circle"></i> {{ $user->is_verified_id_card ? 'موثق' : 'غير موثق' }}
                        </span>
                    </h2>
                    <p class="profile-email"><i class="fas fa-envelope"></i>{{ $user->email }}</p>
                </div>

                <!-- التعديل الجديد: إحصائيات وزر التعديل في أسفل المكون -->
                <div class="profile-stats-container">
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value completed">24</div>
                            <div class="stat-label">مكتملة</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value in-progress">5</div>
                            <div class="stat-label">قيد التنفيذ</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value cancelled">3</div>
                            <div class="stat-label">ملغية</div>
                        </div>
                    </div>

                    <div class="btn-edit-container">
                        <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#edit-modal">
                            <i class="fas fa-edit"></i> تعديل الملف الشخصي
                        </button>
                    </div>
                </div>
            </div>

            <div class="profile-details">
                <div class="detail-card">
                    <h3 class="card-title"><i class="fas fa-user-circle"></i> المعلومات الشخصية</h3>

                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-user"></i> الاسم الكامل:</div>
                        <div class="detail-value">{{ $user->fullname }} </div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-calendar"></i> تاريخ الانضمام:</div>
                        <div class="detail-value">{{ $reg_date }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-map-marker-alt"></i> البلد:</div>
                        <div class="detail-value">{{ $user->country->name_ar }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-phone"></i> رقم الهاتف:</div>
                        <div class="detail-value"> {{ $user->phone }} {{ $user->country->phone_code }}</div>
                    </div>
                </div>


                <div class="detail-card">
                    <h3 class="card-title"><i class="fas fa-file-alt"></i> الوصف الشخصي</h3>
                    <p class="project-desc">{{ $user->bio }}</p>
                </div>
            </div>
        </div>
    </div>
@stop
