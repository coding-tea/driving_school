<div class="card mb-5 mb-xl-10" >
    <div class="card-header cursor-pointer">
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">
                {{ $title ?? null }}
            </h3>
        </div>

       {{ $buttons ?? null }}
    </div>
    <div class="card-body p-9">
       {{ $slot }}
    </div>
</div>
