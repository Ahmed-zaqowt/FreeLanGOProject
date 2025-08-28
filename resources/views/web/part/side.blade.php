 <!-- الشريط الجانبي -->
 <div class="profile-sidebar">
     <div class="sidebar-card">
         <h3 class="sidebar-title"><i class="fas fa-bars"></i> القائمة الرئيسية</h3>
         <ul class="sidebar-menu">
             <li><a href="{{ route('web.dashboard') }}" class="{{ Route::is('web.dashboard') ? 'active' : '' }}"><i
                         class="fas fa-user-circle"></i> الملف الشخصي</a></li>
             <li><a href="{{ route('web.dashboard.project.index') }}" class="{{ Route::is('web.dashboard.project.index') ? 'active' : '' }}"><i
                         class="fas fa-project-diagram"></i> مشاريعي</a></li>
             <li><a href="#" class="{{ Route::is('dashboard') ? 'active' : '' }}"><i
                         class="fas fa-comments"></i> المحادثات</a></li>
             <li><a href="#" class="{{ Route::is('dashboard') ? 'active' : '' }}"><i class="fas fa-heart"></i>
                     المشاريع المفضلة</a></li>
             <li><a href="#" class="{{ Route::is('dashboard') ? 'active' : '' }}"><i class="fas fa-bell"></i>
                     الإشعارات</a></li>
             <li><a href="#" class="{{ Route::is('dashboard') ? 'active' : '' }}"><i class="fas fa-cog"></i>
                     الإعدادات</a></li>
             <li><a href="#" class="{{ Route::is('dashboard') ? 'active' : '' }}"><i
                         class="fas fa-sign-out-alt"></i> تسجيل الخروج</a></li>
         </ul>
     </div>
 </div>
