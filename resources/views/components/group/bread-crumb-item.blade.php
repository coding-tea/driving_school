@if(  $isCurrentPage()  )
    <li class="breadcrumb-item  text-muted  ">
        {{ $getName() }}
    </li>
@else
    <li class="breadcrumb-item ">
        <a  href="{{ $getUrl()  }}" class="">
            {{  $getName()  }}
        </a>
    </li>
@endif
