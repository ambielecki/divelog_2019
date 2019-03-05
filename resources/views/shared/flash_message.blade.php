{{-- Flash Message Code --}}
@if(\Session::has('flash_warning'))
    <div class="flash red darken-3 white-text valign-wrapper">
        <span class="flow-text flash_span">{{ \Session::get('flash_warning') }}</span><i class="material-icons flash_close right-align" aria-hidden="true">highlight_off</i>
    </div>
@endif

@if(\Session::has('flash_success'))
    <div class="flash green white-text valign-wrapper">
        <span class="flow-text flash_span">{{ \Session::get('flash_success') }}</span><i class="material-icons flash_close right-align" aria-hidden="true">highlight_off</i>
    </div>
@endif

@if(\Session::has('flash_message'))
    <div class="flash yellow lighten-4 valign-wrapper">
        <span class="flow-text flash_span">{{ \Session::get('flash_message') }}</span><i class="material-icons flash_close right-align" aria-hidden="true">highlight_off</i>
    </div>
@endif
