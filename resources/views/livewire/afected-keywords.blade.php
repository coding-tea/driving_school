<div>
    <div class="row">
        <div class="col-12 col-sm-10 mt-5">
            <label for="keyword" class="form-label"> {{ trans('profilcv/keyword.keyword') }} </label>
            <select wire:model="keyword" class="form-select" id="keyword">
                <option></option>
                @foreach ($keywords as $item)
                    <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-2 mt-5 d-flex align-items-center justify-content-center">
            <button class="btn btn-icon-primary btn-text-primary mt-5" wire:click="create">
                <i class="ki-duotone ki-plus fs-3"></i>
                add
            </button>
        </div>
    </div>

    <div class="mt-10 d-flex justify-content-center align-items-center gap-2">
        @foreach ($profilcv_keywords as $item)
            <span class="badge badge-light-warning p-3" style="font-size: 15px; cursor: pointer"
                wire:click="delete({{ $item->id }})"> {{ $item->keyword->title }} &emsp; <i
                    class="fa-solid fa-x"></i></span>
        @endforeach

    </div>
</div>
