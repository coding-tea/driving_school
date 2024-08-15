@push('style')
    <style>

        .label-file {
            cursor: pointer;
            color: #ffffff;
            font-weight: bold;
        }
        .label-file:hover {
            color: #606567;
        }


           .input-file {
               display: none;
           }

    </style>
@endpush
<div class="card mt-3">
    <div class="card-body">
        @include('partials.alert-error')
        @if(isCleanArray($actions))
            @foreach($actions as $action)
                @switch($action->type)
                    @case(\App\View\Action::TYPE_EXCEL_IMPORT)
                        @php($url = $action->getUrl())
                    @break
                    @case(\App\View\Action::TYPE_EXCEL_EXPORT)
                        @php($urlExport = $action->getUrl())
                    @break
                @endswitch
            @endforeach
            @isset($url)
                <x-form.form method="post"  :action="$url" :show-form-buttons="false">
                        <div class="card card-bordered ribbon ribbon-top row">
                            <div class="ribbon-label col-lg-2 col-sm-12">
                                <input type="file" name="{{$name}}" id="file" class="input-file" />
                                <label for="file" class="label-file"><strong>Choose a file</strong></label>
                                <i class="fa fa-file-excel text-white fs-5 ms-2"></i>
                            </div>
                            <div class="card-title col-12 mt-lg-5 mt-sm-20 row">
                                {!! $slot !!}
                            </div>
                            <div class="col-12 row card-body text-center ">
                                <div class="col-lg-4 col-sm-12 pb-5">
                                    <button type="submit" class="btn btn-outline btn-outline-primary btn-active-light-primary">Sauvegarder</button>
                                </div>
                                @if($showButtonExportDataTable)
                                    @isset($urlExport)
                                    <div class="col-lg-4 col-sm-12 pb-5">
                                        <a app-dt-action-href-export="{{ $urlExport }}" href="#"  class="btn btn-outline btn-outline-primary btn-active-light-primary ms-3">Export</a>
                                    </div>
                                    @endisset
                                @endif
                                @if($showButtonExportModel)
                                    <div class="col-lg-4 col-sm-12 pb-5">
                                        <a app-model-action-href="{{ $urlExport }}" href="#"  class="btn btn-outline btn-outline-primary btn-active-light-primary">Export</a>
                                    </div>
                                @endif
                                @empty(!$downloadRoute)
                                <div class="col-lg-4 col-sm-12 pb-5">
                                    <a href="{{route($downloadRoute)}}" class="btn btn-outline btn-outline-primary btn-active-light-primary">Télécharger</a>
                                </div>
                                @endempty
                            </div>
                        </div>
                </x-form.form>
            @endisset
        @endif
    </div>
</div>

@vite(pageJs('components/dataImport'))
