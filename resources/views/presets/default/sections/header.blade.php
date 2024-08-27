 <!--========================== Header section Start ==========================-->
 <div class="header-main-area">
     <div class="header" id="header">
         <div class="container-fluid position-relative">
             <div class="row">
                 <div class="header-wrapper">
                     <div class="logo-menu-wrapper">
                         <div class="logo-wrapper">
                             <a href="{{ route('home') }}" class="normal-logo"> <img
                                     src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="Logo"></a>
                         </div>
                         <div class="menu-wrapper">
                             <ul class="main-menu">
                                 @foreach ($pages as $page)
                                     @if ($page->slug != 'blog')
                                         <li class="main-menu__menu-item">
                                             <a class="main-menu__menu-link {{ Request::url() == url('/') . '/' . $page->slug ? 'active' : '' }}"
                                                 aria-current="page"
                                                 href="{{ route('pages', [$page->slug]) }}">{{ __(ucfirst($page->name)) }}</a>
                                         </li>
                                     @endif
                                 @endforeach
                                 <li class="main-menu__menu-item">
                                     <div class="language-box ms-1">
                                         <select class="select langSel">
                                             @foreach ($languages as $language)
                                                 <option value="{{ $language->code }}"
                                                     @if (Session::get('lang') === $language->code) selected @endif>
                                                     {{ __(ucfirst($language->name)) }}
                                                 </option>
                                             @endforeach
                                         </select>
                                     </div>
                                 </li>
                             </ul>
                         </div>
                     </div>
                     <div class="menu-right-wrapper">
                         <ul>
                             @guest
                                 <li class="login-button-wrap"><a class='login-btn' href="{{ route('user.login') }}"><i
                                             class="fas fa-user"></i> @lang('Login') </a></li>
                             @endguest
                             @auth
                                 <li class="login-button-wrap"><a class='login-btn' href="{{ route('user.home') }}"><i
                                             class="fas fa-tachometer-alt"></i> @lang('Dashboard')</a></li>
                             @endauth

                             <li class="love-btn-wrap">
                                 <a href="{{ route('user.wishlist') }}">
                                     <div class="love-btn"><i class="fas fa-heart"></i> <span
                                             class="wishlist-count">{{ $wishlist ?? 00 }}</span></div>
                                 </a>

                             </li>
                             <li class="mobile-menubar"><i class="fas fa-bars sidebar-menu-show-hide"></i></li>
                             <li><a class='btn btn--base' href="{{ route('hostel_list') }}"> @lang('Book Now') </a>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!--========================== Header section End ==========================-->

 @include($activeTemplate . 'sections.sidebar-mobile-manu')

 @push('script')
     <script>
         (function($) {
             "use strict";
             $(".langSel").on("change", function() {
                 window.location.href = "{{ route('home') }}/change/" + $(this).val();
             });
         });
     </script>
 @endpush
