<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
            <div style="
                background: linear-gradient(145deg, #0d9488, #0f766e);
                padding: 8px;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(13, 148, 136, 0.3);
                transition: transform 0.3s ease;
            " onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-museum text-white fs-2x"></i>
            </div>
            <div class="d-flex flex-column ms-3 app-sidebar-logo-default">
                <span class="fs-3 fw-bolder text-uppercase" style="letter-spacing: 1px; font-family: 'Segoe UI', sans-serif; color: #ffffff; text-shadow: 0 0 10px rgba(255,255,255,0.3);">BDARU</span>
                <span class="fs-8 fw-light" style="margin-top: -4px; letter-spacing: 0.5px; color: rgba(255,255,255,0.9); text-shadow: 0 0 5px rgba(255,255,255,0.2);">Museum Digital Indonesia</span>
            </div>
        </a>

        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->

    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-3 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

                    <!--begin:Menu item-->
                    <div class="menu-item ">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">DASHBOARD</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('dashboard') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <span class="menu-icon">
                                <i class="fas fa-tachometer-alt fs-4"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item ">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">MANAJEMEN KONTEN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('collections-management.*') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('collections-management.*') ? 'active' : '' }}" href="{{ route('collections-management.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-boxes fs-4"></i>
                            </span>
                            <span class="menu-title">Koleksi</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('news-management.*') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('news-management.*') ? 'active' : '' }}" href="{{ route('news-management.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-newspaper fs-4"></i>
                            </span>
                            <span class="menu-title">Berita</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('events-management.*') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('events-management.*') ? 'active' : '' }}" href="{{ route('events-management.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-calendar-alt fs-4"></i>
                            </span>
                            <span class="menu-title">Agenda</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('testimonials-management.*') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('testimonials-management.*') ? 'active' : '' }}" href="{{ route('testimonials-management.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-comments fs-4"></i>
                            </span>
                            <span class="menu-title">Testimoni</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('team-members-management.*') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('team-members-management.*') ? 'active' : '' }}" href="{{ route('team-members-management.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-users fs-4"></i>
                            </span>
                            <span class="menu-title">Tim Museum</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item ">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">KATEGORI & PENGATURAN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('admin.categories.*') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-tags fs-4"></i>
                            </span>
                            <span class="menu-title">Kategori</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('admin.news-categories.*') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('admin.news-categories.*') ? 'active' : '' }}" href="{{ route('admin.news-categories.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-list-alt fs-4"></i>
                            </span>
                            <span class="menu-title">Kategori Berita</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('admin.settings.*') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-cog fs-4"></i>
                            </span>
                            <span class="menu-title">Pengaturan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    @if(Auth::user()->hasRole('admin'))
                    <!--begin:Menu item-->
                    <div class="menu-item ">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">ADMINISTRASI</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('users.*') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('users.*') ? 'active' : '' }}" href="#">
                            <span class="menu-icon">
                                <i class="fas fa-user-cog fs-4"></i>
                            </span>
                            <span class="menu-title">Manajemen User</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('roles.*') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('roles.*') ? 'active' : '' }}" href="#">
                            <span class="menu-icon">
                                <i class="fas fa-user-shield fs-4"></i>
                            </span>
                            <span class="menu-title">Role & Permission</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('analytics.*') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('analytics.*') ? 'active' : '' }}" href="#">
                            <span class="menu-icon">
                                <i class="fas fa-chart-bar fs-4"></i>
                            </span>
                            <span class="menu-title">Analitik</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item {{ Route::is('backup.*') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('backup.*') ? 'active' : '' }}" href="#">
                            <span class="menu-icon">
                                <i class="fas fa-database fs-4"></i>
                            </span>
                            <span class="menu-title">Backup Database</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @endif

                    <!--begin:Menu item-->
                    <div class="menu-item ">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">WEBSITE</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('home') }}" target="_blank">
                            <span class="menu-icon">
                                <i class="fas fa-external-link-alt fs-4"></i>
                            </span>
                            <span class="menu-title">Lihat Website</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('profile.edit') }}">
                            <span class="menu-icon">
                                <i class="fas fa-user-edit fs-4"></i>
                            </span>
                            <span class="menu-title">Edit Profil</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="menu-icon">
                                <i class="fas fa-sign-out-alt fs-4"></i>
                            </span>
                            <span class="menu-title">Logout</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>

<!-- Form for logout -->
<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
    @csrf
</form>
