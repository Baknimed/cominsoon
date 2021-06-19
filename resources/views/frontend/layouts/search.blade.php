<div class="site__search golo-ajax-search">
    <a title="Close" href="#" class="search__close">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
            <path fill="#5D5D5D" fill-rule="nonzero" d="M9.3 8.302l6.157-6.156a.706.706 0 1 0-.999-.999L8.302 7.304 2.146 1.148a.706.706 0 1 0-.999.999l6.157 6.156-6.156 6.155a.706.706 0 0 0 .998.999L8.302 9.3l6.156 6.156a.706.706 0 1 0 .998-.999L9.301 8.302z" />
        </svg>
    </a><!-- .search__close -->
    <form action="{{route('search')}}" class="site__search__form" method="GET">
        <div class="site__search__field">
            <span class="site__search__icon">
                <i class="la la-search la-24"></i>
            </span><!-- .site__search__icon -->
            <input class="site__search__input" type="text" name="keyword" placeholder="{{__('Search places ...')}}" autocomplete="off">
            <div class="search-result"></div>
            <div class="golo-loading-effect"><span class="golo-loading"></span></div>
        </div><!-- .search__input -->
    </form><!-- .search__form -->
</div>