@extends('master')
@section('content')
    <section class="reset-section">
        <div class="reset-container">
            <div class="reset-header">
                <div class="reset-icon">
                    <i class="fas fa-key"></i>
                </div>
                <h1>استعادة كلمة المرور</h1>
                <p>أدخل بريدك الإلكتروني المسجل وسنرسل لك رابطًا لاستعادة كلمة المرور الخاصة بك</p>
            </div>

            <form method="POST" action="{{ route($guard . '.forget-password.submit') }}" class="reset-form">
                @csrf
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> البريد الإلكتروني</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input name="email" type="email" id="email" class="form-control" placeholder="ادخل بريدك الإلكتروني"
                            required>
                    </div>
                </div>

                <button type="submit" class="btn-reset" id="resetBtn">
                    <i class="fas fa-paper-plane"></i> إرسال رابط الاستعادة
                    <i class="fas fa-spinner fa-spin"></i>
                    <i class="fas fa-check"></i>
                </button>

                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i>
                    <h3>تم إرسال رابط الاستعادة بنجاح!</h3>
                    <p>لقد أرسلنا رابطًا لاستعادة كلمة المرور إلى بريدك الإلكتروني. يرجى التحقق من صندوق الوارد.</p>
                </div>
            </form>

            <div class="links-container">
                <a href="login.html"><i class="fas fa-arrow-left"></i> العودة لتسجيل الدخول</a>
                <a href="register.html"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
            </div>
        </div>
    </section>
@stop
