<!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
<!-- BEGIN: HEADER -->
<header class="c-layout-header c-layout-header-4 c-layout-header-default-mobile" data-minimize-offset="80">
    <div class="c-navbar">
        <div class="container">
            <!-- BEGIN: BRAND -->
            <div class="c-navbar-wrapper clearfix">
                <div class="c-brand c-pull-left">
                    <a href="/" class="c-logo">
                        <img src="/templates/frontend/assets/base/img/layout/logos/Lamborghini-logo.png" alt="JANGO" class="c-desktop-logo">
                        <img src="/templates/frontend/assets/base/img/layout/logos/Lamborghini-logo.png" alt="JANGO" class="c-desktop-logo-inverse">
                        <img src="/templates/frontend/assets/base/img/layout/logos/Lamborghini-logo.png" alt="JANGO" class="c-mobile-logo"> </a>
                    <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                        <span class="c-line"></span>
                        <span class="c-line"></span>
                        <span class="c-line"></span>
                    </button>
                    <button class="c-topbar-toggler" type="button">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <button class="c-search-toggler" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <!-- END: BRAND -->
                <!-- BEGIN: QUICK SEARCH -->
                <form class="c-quick-search" action="#">
                    <input type="text" name="query" placeholder="Type to search..." value="" class="form-control" autocomplete="off">
                    <span class="c-theme-link">&times;</span>
                </form>
                <!-- END: QUICK SEARCH -->
                <!-- BEGIN: HOR NAV -->
                <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
                <!-- BEGIN: MEGA MENU -->
                <!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
                <?php
                    $headerPages = \App\Model\Page::getPagesForFrontend('header', 0);
                ?>
                <nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold">
                    @if( count($headerPages) > 0 )
                    <ul class="nav navbar-nav c-theme-nav">
                        @foreach($headerPages as $value)
                        <li class='c-menu-type-classic '>
                            <a href="{{ $value->pageUrl() }}" class="c-link dropdown-toggle">
                                {{ $value->title }} <span class="c-arrow c-toggler"></span>
                            </a>
                            <?php
                                $headerSubPages = \App\Model\Page::getPagesForFrontend('header', $value->id);
                            ?>
                            
                            @if( count($headerSubPages) > 0 )
                            <ul class="dropdown-menu c-menu-type-classic c-pull-left">
                                @foreach($headerSubPages as $value2)
                                <li>
                                    <a href='{{ $value2->pageUrl() }}'>{{ $value2->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                            
                        </li>
                        @endforeach
                        
                        <li>
                            <a href="{{ route('users-login') }}" data-toggle="modal" data-target="#login-form" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold">
                                <i class="icon-user"></i> Sign In</a>
                        </li>
                    </ul>
                    @endif
                </nav>
                <!-- END: MEGA MENU -->
                <!-- END: LAYOUT/HEADERS/MEGA-MENU -->
                <!-- END: HOR NAV -->
            </div>
        </div>
    </div>
</header>
<!-- END: HEADER -->
<!-- END: LAYOUT/HEADERS/HEADER-1 -->
