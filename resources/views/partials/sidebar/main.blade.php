<nav class="col-md-2 sidebar">
    <div class="user-box text-center pt-5 pb-3">
        <div class="user-img">
            <img src="{{ auth()->user()->present()->avatar }}"
                 width="90"
                 height="90"
                 alt="user-img"
                 class="rounded-circle img-thumbnail img-responsive">
        </div>
        <h5 class="my-3">
            <a href="{{ route('profile') }}">{{ auth()->user()->present()->nameOrEmail }}</a>
        </h5>

        <ul class="list-inline mb-2">
            <li class="list-inline-item">
                <a href="{{ route('profile') }}" title="@lang('My Profile')">
                    <i class="fas fa-cog"></i>
                </a>
            </li>

            <li class="list-inline-item">
                <a href="{{ route('auth.logout') }}" class="text-custom" title="@lang('Logout')">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            @foreach (\Vanguard\Plugins\Vanguard::availablePlugins() as $plugin)
                @include('partials.sidebar.items', ['item' => $plugin->sidebar()])
            @endforeach

            <li class="nav-item">
                <a class="nav-link" href="#ocr-dropdown" data-toggle="collapse" aria-expanded="false">
                    <i class="fa fa-file"></i>
                    <span>OCR Labeling</span>
                </a>
            <?php $inShow = \Request::is('ocr') || \Request::is('ocr/invalid') || \Route::is('*.template') ?>
                <ul class="list-unstyled sub-menu collapse @if($inShow) show @endif" id="ocr-dropdown">
                    <li class="nav-item">
                        <a  class="nav-link @if(\Request::is('ocr') || \Request::is('ocr/invalid')) active @endif" 
                            href="{{ url('ocr') }}">
                            <span>OCR Tool</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link @if(\Route::is('*.template')) active @endif" 
                            href="{{ route('index.template') }}">
                            <span>Templates</span>
                        </a>
                    </li>
                </ul>
            </li>  
            
            @if(Auth::user()->hasPermission('company.manage'))
            <li class="nav-item">
                <a class="nav-link" href="#company-dropdown" data-toggle="collapse" aria-expanded="false">
                    <i class="fas fa-building"></i>
                    <span>Company Manage</span>
                </a>
            <?php $inShow = \Request::is('company') || \Route::is('*.company') ?>
            <?php $ininShow = \Request::is('company') || \Route::is('slug.company') || \Route::is('add.company') ?>
                <ul class="list-unstyled sub-menu collapse @if($inShow) show @endif" id="company-dropdown">
                    <li class="nav-item">
                        <a  class="nav-link @if($ininShow) active @endif" 
                            href="{{ url('company') }}">
                            <span>Company</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link @if(\Route::is('ocr.key.company')) active @endif" 
                            href="{{route('ocr.key.company')}}">
                            <span>OCR Key</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="#api-reference" data-toggle="collapse" aria-expanded="false">
                    <i class="fas fa-info-circle"></i>                   
                    <span>API Reference</span>
                </a>
            <?php $inShow = \Request::is('api') || \Route::is('api.*') ?>
                <ul class="list-unstyled sub-menu collapse @if($inShow) show @endif" id="api-reference">
                    <li class="nav-item">
                        <a  class="nav-link @if(\Route::is('api.index')) active @endif" 
                            href="{{ route('api.index') }}">
                            <span>API How To</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link @if(\Route::is('api.test')) active @endif" 
                            href="{{ route('api.test') }}">
                            <span>API TEST</span>
                        </a>
                    </li>
                </ul>
            </li>
             
        </ul>
    </div>
</nav>

