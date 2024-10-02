<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic
Product Version: 8.1.7
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../"/>
		<title>e-RDKK - Log In</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap Admin Template, HTML, VueJS, React, Angular. Laravel, Asp.Net Core, Ruby on Rails, Spring Boot, Blazor, Django, Express.js, Node.js, Flask Admin Dashboard Theme & Template" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="{{ asset('media/logos/logo.png') }}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{asset('plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('css/custom.style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
		<!--begin::Theme mode setup on page load-->
		<script>
            var defaultThemeMode = "light";
            var themeMode;
            if ( document.documentElement ) {
                if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
                    themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                    if ( localStorage.getItem("data-bs-theme") !== null ) {
                        themeMode = localStorage.getItem("data-bs-theme");
                    } else {
                        themeMode = defaultThemeMode;
                    }
                }
                if (themeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                }
                document.documentElement.setAttribute("data-bs-theme", themeMode);
            }
        </script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background-image: url("{{asset('media/auth/login.jpg')}}"); } [data-bs-theme="dark"] body { background-image: url("{{asset('media/auth/login.jpg')}}"); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid flex-lg-row">
				<!--begin::Aside-->
				<div class="d-flex flex-center w-lg-45 pt-15 pt-lg-0 px-10">
					<!--begin::Aside-->
					<div class="d-flex flex-center flex-column bg-login">
						<!--begin::Logo-->
						<a href="../../demo33/dist/index.html" class="mb-7 p-3">
							<img alt="Logo" src="{{asset('media/logos/logo.png')}}" height="100">
						</a>
						<!--end::Logo-->
						<!--begin::Title-->
                        @php
                            $year = now()->year;
                            if (now()->month > 9) {
                                $year += 1;
                            }
                        @endphp
						<h2 class="text-white fw-normal m-0 p-3">Kementerian Pertanian Republik Indonesia</h2>
						<h2 class="text-white fw-normal m-0 p-3">Usulan Kebutuhan Pupuk Bersubsidi Tahun {{ $year }}</h2>
						<!--end::Title-->
					</div>
					<!--begin::Aside-->
				</div>
				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-center w-lg-55 pt-15 pt-lg-0 px-10">
                    <div class="row w-100">
                        <!--begin::Card-->
                        <div class="card form-login-custom col-lg-6 col-xs-12">
                            <!--begin::Card body-->
                            <div class="card-body d-flex flex-column p-10 p-lg-10 pb-lg-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-center flex-column-fluid">
                                    <!--begin::Form-->
                                    <form method="POST" class="form w-100" id="kt_sign_in_form" action="{{ route('login.post') }}">
                                        @csrf
                                        <!--begin::Heading-->
                                        <div class="text-center mb-11">
                                            <!--begin::Title-->
                                            <h1 class="text-dark fw-bolder mb-3">Log In</h1>
                                            <!--end::Title-->
                                        </div>
                                        <!--begin::Heading-->

                                        @session('error')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $value }}
                                        </div>
                                        @endsession

                                        <!--begin::Separator-->
                                        <div class="separator separator-content my-14">
                                            {{-- <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span> --}}
                                        </div>
                                        <!--end::Separator-->
                                        <!--begin::Input group=-->
                                        <div class="fv-row mb-8">
                                            <!--begin::Email-->
                                            <input type="text" placeholder="Username" name="username"  autocomplete="off" class="form-control" bg-transparent" required/>
                                            <!--end::Email-->
                                        </div>
                                        <!--end::Input group=-->
                                        <!--begin::Input group=-->
                                        <div class="fv-row mb-8">
                                            <!--begin::Password-->
                                            <input type="password" placeholder="Password" name="password" id="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror bg-transparent" />
                                            <!--end::Password-->
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <!--end::Input group=-->
                                        <!--begin::Input group=-->
                                        <div class="fv-row mb-8">
                                            <!--begin::Tahun-->
                                            <select name="tahun" class="form-control bg-transparent">
                                                <option value="">--Pilih Tahun--</option>
                                                <option value="{{ $year }}" selected>{{ $year }}</option>
                                            </select>
                                            <!--end::Tahun-->
                                        </div>
                                        <!--end::Input group=-->
                                        <!--begin::Submit button-->
                                        <div class="d-grid mb-10">
                                            <button type="submit" id="" class="btn btn-primary">
                                                <!--begin::Indicator label-->
                                                <span class="indicator-labelx">Log In</span>
                                                <!--end::Indicator label-->
                                                <!--begin::Indicator progress-->
                                                <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                <!--end::Indicator progress-->
                                            </button>
                                        </div>
                                        <!--end::Submit button-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                        <!--begin::Card-->
                        <div class="card info-commodity col-lg-6 col-xs-12">
                            <!--begin::Card body-->
                            <div class="card-body d-flex flex-column p-10 p-lg-10 pb-lg-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-center flex-column-fluid no-align-item">
                                    <!--begin::Form-->
                                    <div class="form w-100">
                                        <!--begin::Heading-->
                                        <div class="text-center mb-11">
                                            <!--begin::Title-->
                                            <h1 class="text-dark fw-bolder mb-3">Dosis Pemupukan</h1>
                                            <!--end::Title-->
                                        </div>
                                        <!--begin::Heading-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-content my-14">
                                            {{-- <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span> --}}
                                        </div>
                                        <!--end::Separator-->
                                        <!--begin::Begin Information=-->
                                        <ol class="fs-4">
                                            <li>Bawang Merah</li>
                                            <li>Bawang Putih</li>
                                            <li>Cabai</li>
                                            <li>Jagung</li>
                                            <li>Kakao</li>
                                            <li>Kedelai</li>
                                            <li>Kopi</li>
                                            <li>Padi</li>
                                            <li>Tebu</li>
                                        </ol>
                                        <!--end::End Information-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{asset('plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="{{asset('js/custom/authentication/sign-in/general.js')}}"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
