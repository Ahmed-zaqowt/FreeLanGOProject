<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - FreelanGo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets-dash/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dash/css/pages.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dash/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dash/css/bootstrap.min.css') }}" rel="stylesheet">
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
</body>
</html>
