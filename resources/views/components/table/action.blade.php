<div class="menu-item px-5">
    @php($action_prop = $action->toArray())
    @switch($action->type)
        @case(\App\View\Action::TYPE_DELETE_ALL)
            <a class="menu-link  text-danger  px-5  {{ $deleteSelectedClass }}"
               @if($action_prop['blank']) target="_blank" @endif
               app-dt-action-href="{{ $action->getUrl() }}" href="#"
            >
                <span>{{ $action_prop['name'] }}</span>
            </a>
            @break
        @case(\App\View\Action::TYPE_NORMAL)
            <a class="menu-link    px-5"
               @if($action_prop['blank']) target="_blank" @endif
               href="{{$action->getUrl()}}">
                <span>{{ $action_prop['name'] }}</span>
            </a>
            @break
        @case(\App\View\Action::TYPE_AJAX)
            <a class="menu-link  px-5  "
               @if($action_prop['blank']) target="_blank" @endif
               app-dt-action-href="{{ $action->getUrl() }}" href="#"
            >
                <span>{{ $action_prop['name'] }}</span>
            </a>
            @break
    @endswitch
</div>
