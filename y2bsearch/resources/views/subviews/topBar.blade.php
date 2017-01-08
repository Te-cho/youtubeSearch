<header class="demo-header mdl-layout__header mdl-layout__header--scroll mdl-color--grey-100 mdl-color-text--grey-800">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Youtube Search</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
        <i class="material-icons">search</i>
      </label>
        <form method="GET" action="/">
          <div class="mdl-textfield__expandable-holder">
            <input class="mdl-textfield__input" type="text" id="search" name="search">
            <label class="mdl-textfield__label" for="search">Enter your query...</label>
          </div>
        </form>
    </div>
  </div>
</header>
{{-- search bar --}}
<div class="demo-ribbon-primary">
  <div class="sw">
    <center>
    @include('subviews.searchBar')
  </center>
  </div>
</div>
<div class="demo-ribbon-secondary"></div>