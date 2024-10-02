<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-header d-flex flex-stack d-none d-lg-flex pt-8 pb-2" id="kt_app_sidebar_header">
        <!--begin::Logo-->
        <a href="{{ '/ringkasan' }}" class="app-sidebar-logo align-items-center d-flex">
            <img alt="Logo" src="{{ asset('media/logos/logo.png') }}" class="h-25px d-none d-sm-inline app-sidebar-logo-default theme-light-show me-2" />
            <img alt="Logo" src="{{ asset('media/logos/logo.png') }}" class="h-20px h-lg-25px theme-dark-show me-2" />
            <span id="d-n-mini">e-RDKK</span>
        </a>
        <!--end::Logo-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-sm btn-icon bg-light btn-color-gray-700 btn-active-color-primary d-none d-lg-flex rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-outline ki-text-align-right rotate-180 fs-1"></i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--begin::Navs-->
    <div class="app-sidebar-navs flex-column-fluid py-6" id="kt_app_sidebar_navs">
        <div id="kt_app_sidebar_navs_wrappers" class="app-sidebar-wrapper hover-scroll-y my-2" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_header" data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">
            <!--begin::Sidebar menu-->
            <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary">
                <!--begin::Heading-->
                <div class="menu-item mb-2">
                    <div class="menu-heading text-uppercase fs-7 fw-bold">Menu</div>
                    <!--begin::Separator-->
                    <div class="app-sidebar-separator separator"></div>
                    <!--end::Separator-->
                </div>
                <!--end::Heading-->
                @php
                    $role = Session::get('role');
                    $role_id = Session::get('role_id');
                    $ringkasan = ['bank', 'pihc', 'jasindo', 'tamu', 'tamulagi'];
                @endphp

                @if (!in_array($role, $ringkasan))
                    <!--begin:Menu Ringkasan-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ '/ringkasan' }}"  id="menu-ringkasan">
                            <span class="menu-icon">
                                <i class="ki-outline ki-chart-simple fs-2"></i>
                            </span>
                            <span class="menu-title">Ringkasan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu Ringkasan-->
                @endif
                @if ($role == 'approver')
                    {{-- menu belum ada --}}
                    {{-- persetujuan --}}
                @endif
                @if ($role_id == 15)
                    {{-- menu belum ada --}}
                    {{-- pengesahan --}}
                @endif
                @if ($role_id == 10 || $role_id == 11)
                    {{-- menu belum ada --}}
                    {{-- pengawasan --}}
                    {{-- menu belum ada --}}
                    {{-- laporan --}}
                    {{-- menu belum ada --}}
                    {{-- ----rekap per subsektor --}}
                    @if ($role_id == 10)
                        {{-- menu belum ada --}}
                        {{-- ----rekap per kecamatan --}}
                    @endif
                    @if ($role_id == 11)
                        {{-- menu belum ada --}}
                        {{-- ----rekap per kabupaten --}}
                    @endif
                @endif
                @if ($role == 'user')
                    <!--begin:Menu Pengajuan-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ '/pengajuan' }}" id="menu-pengajuan">
                            <span class="menu-icon">
                                <i class="ki-outline ki-plus fs-2"></i>
                            </span>
                            <span class="menu-title">Pengajuan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu Pengajuan-->
                    <!--begin:Menu Update Pengajuan-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ '/pengajuan' }}" id="menu-update-pengajuan">
                            <span class="menu-icon">
                                <i class="ki-outline ki-notepad-edit fs-2"></i>
                            </span>
                            <span class="menu-title">Update Pengajuan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu Update Pengajuan-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ '/cetak' }}" id="menu-cetak">
                            <span class="menu-icon">
                                <i class="ki-outline ki-notepad-edit fs-2"></i>
                            </span>
                            <span class="menu-title">Cetak Data</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    {{-- menu belum ada --}}
                    {{-- data reject bank --}}
                    {{-- menu belum ada --}}
                    {{-- cetak data --}}
                @endif
                @if ($role_id == 2 || $role_id == 16 || $role == 'user' || $role == 'pihc')
                    @if ($role_id == 2 || $role_id == 16)
                        <!--begin:Menu Manajemen Pengguna-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ '/user' }}" id="menu-user">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-profile-user fs-2"></i>
                                </span>
                                <span class="menu-title">Manajemen Pengguna</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu Manajemen Pengguna-->
                        @if ($role_id == 16)
                            {{-- menu belum ada --}}
                            {{-- cari nik alokasi --}}
                            <!--begin:Menu Data Log Hapus-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ '/data-log-hapus' }}" id="menu-data-log-hapus">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-search fs-2"></i>
                                    </span>
                                    <span class="menu-title">Data Log Hapus</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu Data Log Hapus-->
                        @endif
                    @endif
                    @if ($role_id == 2)
                        {{-- menu belum ada --}}
                        {{-- manajemen bank --}}
                        {{-- menu belum ada --}}
                        {{-- laporan --}}
                        {{-- menu belum ada --}}
                        {{-- ----rekapitulasi data --}}
                        {{-- menu belum ada --}}
                        {{-- ----data disetujui --}}
                        {{-- menu belum ada --}}
                        {{-- ----jumlah pupuk per subsektor --}}
                        {{-- menu belum ada --}}
                        {{-- ----jumlah pupuk per komoditas --}}
                        {{-- menu belum ada --}}
                        {{-- ----NIK BPKP Kec --}}
                        {{-- menu belum ada --}}
                        {{-- data reject --}}
                        <!--begin:Menu Cari NIK-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ '/cari-nik' }}" id="menu-cari-nik">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-search fs-2"></i>
                                </span>
                                <span class="menu-title">Cari NIK</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu Cari NIK-->
                        {{-- menu belum ada --}}
                        {{-- hapus data usulan --}}
                        {{-- menu belum ada --}}
                        {{-- ----per desa --}}
                        {{-- menu belum ada --}}
                        {{-- ----per kecamatan --}}
                        {{-- menu belum ada --}}
                        {{-- ----per kabupaten --}}
                    @endif
                    <!--begin:Menu Master Data-->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion" id="master-data">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-cloud fs-2"></i>
                            </span>
                            <span class="menu-title">Master Data</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion" id="master-data-sub">
                            <!--begin:Menu Wilayah-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{'/wilayah'}}" id="menu-wilayah">
                                    <span class="menu-bullet">
                                        <i class="ki-outline ki-geolocation fs-2"></i>
                                    </span>
                                    <span class="menu-title">Wilayah</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu Wilayah-->
                            <!--begin:Menu Pengecer-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{'/pengecer'}}" id="menu-pengecer">
                                    <span class="menu-bullet">
                                        <i class="ki-outline ki-profile-user fs-2"></i>
                                    </span>
                                    <span class="menu-title">Pengecer</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu Pengecer-->
                            @if ($role == 'pihc')
                                {{-- menu belum ada --}}
                                {{-- ----rayon --}}
                            @else
                                {{-- menu belum ada --}}
                                {{-- ----kelompok tani --}}
                                <!--begin:Menu Subsektor-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{'/subsektor'}}" id="menu-subsektor">
                                        <span class="menu-bullet">
                                            <i class="far fa-lightbulb fs-2"></i>
                                        </span>
                                        <span class="menu-title">Subsektor</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu Subsektor-->
                                <!--begin:Menu Komoditas-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{'/komoditas'}}" id="menu-komoditas">
                                        <span class="menu-bullet">
                                            <i class="ki-outline ki-bank fs-2"></i>
                                        </span>
                                        <span class="menu-title">Komoditas</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu Komoditas-->
                            @endif
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu Master Data-->
                    @if ($role == 'pihc')
                        {{-- menu belum ada --}}
                        {{-- update data kios --}}
                        {{-- menu belum ada --}}
                        {{-- ----update kios per data --}}
                        {{-- menu belum ada --}}
                        {{-- ----update kios per poktan --}}
                        {{-- menu belum ada --}}
                        {{-- ----data kios --}}
                    @endif
                @endif
                @if ($role == 'jasindo')
                    {{-- menu belum ada --}}
                    {{-- download data --}}
                @endif
                @if ($role == 'tamulagi')
                    {{-- menu belum ada --}}
                    {{-- cari nik --}}
                @endif
                @if ($role == 'tamu' || $role == 'tamulagi')
                    {{-- menu belum ada --}}
                    {{-- data e-erdkk --}}
                    {{-- menu belum ada --}}
                    {{-- ----rekapitulasi (per subsektor) --}}
                    {{-- menu belum ada --}}
                    {{-- ----ringkasan data --}}
                @endif
                @if ($role == 'bank')
                    {{-- menu belum ada --}}
                    {{-- download data alokasi --}}
                    {{-- menu belum ada --}}
                    {{-- download data rayon --}}
                    {{-- menu belum ada --}}
                    {{-- upload data tidak valid --}}
                    {{-- menu belum ada --}}
                    {{-- data perubahan kios --}}
                    {{-- menu belum ada --}}
                    {{-- data reject --}}
                @endif
            </div>
            <!--end::Sidebar menu-->
        </div>
    </div>
    <!--end::Navs-->
</div>
