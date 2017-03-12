<div id="header" class="ui borderless main menu fixed" style="position: fixed; top: 0px; left: auto; z-index: 10;">
    <div class="ui container">
        <a href="/" class="header item logo-link">
            <img class="logo" src="{{asset('images/logo.png')}}">
        </a>
        @if($showSearch)
            <form method="GET" action="/" class="header item">
                <div class="ui action input">
                    <input type="search" name="search" placeholder="Search...">
                    <button class="ui icon button">
                        <i class="search icon"></i>
                    </button>
                </div>
            </form>
        @else
            <div style="float: right;position: absolute;right: 1vh;top: 1.6vh;color: white;font-size: 1.3em;">
                <i class="users icon"></i>
                <span>{{$pageViews}}</span>
            </div>
        @endif
    </div>
</div>
