<!-- BEGIN: CONTENT/BLOG/BLOG-SIDEBAR-1 -->
<div class="c-content-ver-nav">
    <div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
        <div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
            <h3 class="c-font-bold c-font-uppercase">Contact</h3>
            <div class="c-line-left c-theme-bg"></div>
        </div>
        <div class="col-sm-12 col-xs-12">
            <p class="c-address c-font-16">
                ADDRESS:<br>
                Automobili Lamborghini S.p.A.,S.<br>
                Via Modena 12<br>
                Agata Bolognese (BO) 40019 Italy
                <br><br>
                PHONE<br>
                +39 051 959.7611
                <br><br>
                EMAIL<br>
                <a class="c-theme-color" href="mailto:lamborghini@legalmail.it">lamborghini@legalmail.it</a>
                <br><br>
            </p>
        </div>
    </div>
</div>
<?php
    $asidePages = \App\Model\Page::getPagesForFrontend('aside', 0);
?>

@if( count($asidePages) > 0 )
<div class="c-content-ver-nav">
    <div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
        <h3 class="c-font-bold c-font-uppercase">NAVIGATION</h3>
        <div class="c-line-left c-theme-bg"></div>
    </div>
    <ul class="c-menu c-arrow-dot1 c-theme">
        @foreach($asidePages as $value)
        <li>
            <a href="{{ $value->pageUrl() }}">{{ $value->title }}</a>
        </li>
        @endforeach
    </ul>
</div>
<!-- END: CONTENT/BLOG/BLOG-SIDEBAR-1 -->
@endif
