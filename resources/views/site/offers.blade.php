@extends('master')
@section('title' , 'فريلانقو | التفاصيل والعروض')
@section('content')

    <header class="project-header">
        <div class="container">
            <h1><i class="fas fa-file-invoice-dollar"></i> العروض المقدمة على المشروع</h1>
        </div>
    </header>

    <div class="container">
        <div class="project-info">
            <h2 class="project-title"><i class="fas fa-paint-brush"></i> تصميم واجهة متجر إلكتروني</h2>
            <p class="project-description">
                نبحث عن مصمم محترف لإنشاء واجهة متجر تجاوبية باستخدام Figma أو Adobe XD. يجب أن تكون التصاميم عصرية وتواكب
                أحدث اتجاهات UI/UX. المتجر سيكون لمنتجات إلكترونية ويجب أن يكون التصميم سهل الاستخدام وجذاب بصرياً مع مراعاة
                تجربة المستخدم على مختلف الأجهزة.
            </p>
            <div class="project-meta">
                <div class="meta-item"><i class="fas fa-money-bill"></i> 300$ - 500$</div>
                <div class="meta-item"><i class="fas fa-clock"></i> 5 أيام</div>
                <div class="meta-item"><i class="fas fa-briefcase"></i> 3 عروض</div>
                <span class="project-category">تصميم جرافيك</span>
            </div>
        </div>

        @if ($guard == 'freelancer')
            <div class="add-bid-section mt-5">
                <div class="form-header">
                    <i class="fas fa-plus-circle"></i>
                    <h2>إضافة عرض جديد</h2>
                </div>

                <form id="bidForm" class="p-4 border rounded shadow-sm bg-light">
                    <div class="row mb-3">
                        <!-- قيمة العرض -->
                        <div class="col-md-6 mb-3">
                            <label for="bidAmount" class="form-label">
                                <i class="fas fa-money-bill-wave"></i> قيمة العرض ($)
                            </label>
                            <input type="number" class="form-control" id="bidAmount" placeholder="أدخل قيمة العرض"
                                min="100" max="1000" required>
                        </div>

                        <!-- المدة -->
                        <div class="col-md-6 mb-3">
                            <label for="bidDuration" class="form-label">
                                <i class="fas fa-clock"></i> المدة المتوقعة (أيام)
                            </label>
                            <input type="number" class="form-control" id="bidDuration" placeholder="عدد الأيام اللازمة"
                                min="1" max="30" required>
                        </div>
                    </div>

                    <!-- رسالة العرض -->
                    <div class="mb-3">
                        <label for="bidMessage" class="form-label">
                            <i class="fas fa-comment-alt"></i> رسالة العرض
                        </label>
                        <textarea class="form-control" id="bidMessage" rows="4"
                            placeholder="صف عرضك، خبراتك السابقة، ولماذا أنت الأنسب لهذا المشروع..." required></textarea>
                    </div>

                    <div class="row mb-3">
                        <!-- عدد التعديلات -->
                        <div class="col-md-6 mb-3">
                            <label for="revisions" class="form-label">
                                <i class="fas fa-sync-alt"></i> عدد التعديلات المتاحة
                            </label>
                            <select class="form-select" id="revisions" required>
                                <option value="1">مرة واحدة</option>
                                <option value="2">مرتين</option>
                                <option value="3">ثلاث مرات</option>
                                <option value="unlimited">غير محدود</option>
                            </select>
                        </div>


                    </div>

                    <!-- زر الإرسال -->
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-paper-plane"></i> تقديم العرض
                    </button>
                </form>
            </div>
        @endif

        <div class="add-bid-section mt-5 mb-5">
            <div class="layout">
                <main class="bids-section">
                    <div class="section-header">
                        <h2><i class="fas fa-file-alt"></i> العروض المقدمة</h2>
                        <div class="sort-container">
                            <label for="sort"><i class="fas fa-sort"></i> ترتيب حسب:</label>
                            <select id="sort">
                                <option>الأحدث</option>
                                <option>الأقل سعراً</option>
                                <option>الأقصر مدة</option>
                                <option>الأعلى تقييماً</option>
                            </select>
                        </div>
                    </div>
                    @foreach ($project->proposals as $pro)
                        <div class="bids-container">
                            <div class="bid-card">
                                <div class="bid-header">
                                    <div class="bid-user">
                                        <div class="user-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="user-info">
                                            <h3>أحمد محمد</h3>
                                            <div class="user-rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span>(4.5)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bid-price">{{ $pro->bid_amount }}$</div>
                                </div>

                                <div class="bid-details">
                                    <div class="bid-detail">
                                        <span class="detail-label">المدة المتوقعة</span>
                                        <span class="detail-value">{{ $pro->delivery_time }} أيام</span>
                                    </div>
                                    <div class="bid-detail">
                                        <span class="detail-label">عدد التعديلات</span>
                                        <span class="detail-value">3 مرات</span>
                                    </div>
                                </div>

                                <div class="bid-message">
                                    {{ $pro->presentation_text }}
                                </div>

                                @if ($guard == 'web' && $project->user_id == auth()->guard('web')->user()->id)
                                    <div class="bid-actions">
                                        <button class="btn-action btn-accept"><i class="fas fa-check-circle"></i> قبول
                                            العرض</button>
                                        <button class="btn-action btn-reject"><i class="fas fa-times-circle"></i> رفض
                                            العرض</button>
                                        <button class="btn-action"><i class="fas fa-envelope"></i> مراسلة</button>
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach



                </main>
            </div>

        </div>


    </div>
@stop
