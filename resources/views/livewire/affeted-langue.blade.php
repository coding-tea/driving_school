<div>
    <div class="row">
        <div class="col-12 col-sm-5 mt-5">
            <label for="langueS" class="form-label"> {{ trans('profilcv/langue.langue') }} </label>
            <select wire:model="langueSelected" class="form-select" id="langueS">
                <option></option>
                @foreach ($langues as $item)
                    <option value="{{ $item['id'] }}">{{ $item['nom'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-5 mt-5">
            <label for="level" class="form-label"> {{ trans('profilcv/langue.level') }} </label>
            <select class="form-select" wire:model="level" id="level">
                <option></option>
                <option value="EP">Elementary proficiency</option>
                <option value="LWP">Limited working proficiency
                </option>
                <option value="PWP">Professional working
                    proficiency</option>
                <option value="FPP">Full professional
                    proficiency</option>
                <option value="NBP">Native or bilingual
                    proficiency</option>
            </select>
        </div>
        <div class="col-12 col-sm-2 mt-5 d-flex align-items-center justify-content-center">
            <button class="btn btn-icon-primary btn-text-primary mt-5" wire:click="add">
                <i class="ki-duotone ki-plus fs-3"></i>
                add
            </button>
        </div>
    </div>

    <div class="mt-10 d-flex justify-content-center align-items-center gap-2">
        @foreach ($profilcv_langues as $item)
            <span class="badge badge-light-success p-3" style="font-size: 15px; cursor: pointer"
                wire:click="delete({{ $item->id }})"> {{ $item->langue->nom }} &emsp; <i
                    class="fa-solid fa-x"></i></span>
        @endforeach

    </div>
</div>
