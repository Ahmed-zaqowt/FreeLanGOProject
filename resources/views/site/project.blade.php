@extends('master')
@section('title' , 'فريلانقو | المشاريع ')
@section('content')
    <header class="main-header">
        <div class="container">
            <h1><i class="fas fa-project-diagram"></i> المشاريع المتاحة</h1>
            <p>تصفح أحدث المشاريع المنشورة وابدأ العمل مع أفضل المحترفين</p>

            <div class="search-container">
                <input type="text" id="search"
                    placeholder="ابحث عن مشروع حسب التخصص، المهارات، أو الكلمات المفتاحية..." />
                <button class="search-btn"><i class="fas fa-search"></i> بحث</button>
            </div>

            <div class="stats-container">
                <div class="stat-card">
                    <i class="fas fa-project-diagram"></i>
                    <div>
                        <div class="stat-value">1,248</div>
                        <div class="stat-label">مشروع نشط</div>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <div>
                        <div class="stat-value">5,742</div>
                        <div class="stat-label">محترف مسجل</div>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-handshake"></i>
                    <div>
                        <div class="stat-value">3,896</div>
                        <div class="stat-label">مشروع مكتمل</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="layout">
            <aside class="filters-sidebar">
                <h3><i class="fas fa-filter"></i> فلترة المشاريع</h3>

                <div class="filter-group">
                    <label for="category"><i class="fas fa-folder"></i> التصنيف:</label>
                    <select id="category">
                        <option>الكل</option>
                        <option>برمجة وتطوير</option>
                        <option>تصميم جرافيك</option>
                        <option>كتابة وترجمة</option>
                        <option>تسويق إلكتروني</option>
                        <option>تصميم صوت وفيديو</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label><i class="fas fa-money-bill-wave"></i> الميزانية ($):</label>
                    <div class="budget-range">
                        <input type="number" placeholder="من" id="budgetMin" />
                        <input type="number" placeholder="إلى" id="budgetMax" />
                    </div>
                </div>

                <div class="filter-group">
                    <label for="duration"><i class="fas fa-clock"></i> المدة:</label>
                    <select id="duration">
                        <option>الكل</option>
                        <option>أقل من 3 أيام</option>
                        <option>3 - 7 أيام</option>
                        <option>أسبوع - أسبوعين</option>
                        <option>أكثر من أسبوعين</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="experience"><i class="fas fa-star"></i> مستوى الخبرة:</label>
                    <select id="experience">
                        <option>الكل</option>
                        <option>مبتدئ</option>
                        <option>متوسط</option>
                        <option>خبير</option>
                    </select>
                </div>

                <button class="btn-filter"><i class="fas fa-check"></i> تطبيق الفلاتر</button>
                <button class="btn-filter reset-btn"><i class="fas fa-redo"></i> إعادة تعيين</button>
            </aside>

            <main class="projects-section">
                <div class="projects-header">
                    <h2><i class="fas fa-list"></i> المشاريع المتاحة</h2>
                    <div class="sort-container">
                        <label for="sort"><i class="fas fa-sort"></i> ترتيب حسب:</label>
                        <select id="sort">
                            <option>الأحدث</option>
                            <option>الأعلى سعراً</option>
                            <option>الأقرب موعداً</option>
                            <option>الأكثر تطابقاً</option>
                        </select>
                    </div>
                </div>

                <div class="projects-container" id="projectsList">
                    @foreach ($projects as $project)
                        <div class="project-card">
                            <h2><i class="fas fa-paint-brush"></i> {{$project->title}}   </h2>
                            <p class="project-desc">   {{ $project->description }}
                              </p>
                            <div class="project-meta">
                                <div class="meta-item"><i class="fas fa-money-bill"></i> {{ $project->budget }}</div>
                                <div class="meta-item"><i class="fas fa-clock"></i> {{ $project->duration }} أيام</div>
                                <div class="meta-item"><i class="fas fa-briefcase"></i> {{ $project->proposals->count() }} عروض</div>
                            </div>
                            <div class="project-footer">
                                <span class="project-category">تصميم جرافيك</span>
                                <a href="{{ route($guard . '.offer' , $project->id) }}" class="btn-apply"><i class="fas fa-paper-plane"></i>  {{ $guard == 'freelancer' ? 'تقديم عرض'  : 'عرض التفاصيل'}}</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </main>
        </div>
    </div>
@stop
