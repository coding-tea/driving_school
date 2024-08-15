<ol class="breadcrumb breadcrumb-line text-muted fs-6 fw-semibold">
@isset($breadCrumb)
    @foreach($breadCrumb as $page)
        <x-group.bread-crumb-item :name="$page->getName()" :url="$page->getUrl()"  />
    @endforeach
@else
    {{  config('app.description') }}
@endisset

</ol>
