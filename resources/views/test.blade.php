@extends('layouts.app')
@include('components.consultation')
@section('content')

    @component('components.group.card')
        @slot('title',"vue test")

        <div class="row">
            <x-form.select   name="ADA" col="col-4" label="ADA"
                           :bind-with="$adas"/>
            <x-form.select required class="filter" name="CDA" col="col-4" label="CDA"
                           :bind-with="$cdas"/>
            <x-form.select required class="filter" name="nature" col="col-4" label="nature"
                           :bind-with="$natures"/>


            <div class="col-12 mt-5">
                <x-form.button id="getData"/>
            </div>

        </div>


        <div class="card-body border mt-5 fdsfds">

{{--            <div class="d-flex flex-stack">--}}

{{--                <div class="text-gray-700 fw-semibold fs-6 me-2">Avg. Client Rating</div>--}}



{{--                <div class="d-flex align-items-senter">--}}
{{--                    <i class="ki-outline ki-arrow-up-right fs-2 text-success me-2"></i>--}}


{{--                    <span class="text-gray-900 fw-bolder fs-6">7.8</span>--}}


{{--                    <span class="text-gray-500 fw-bold fs-6">/10</span>--}}
{{--                </div>--}}

{{--            </div>--}}



{{--            <div class="separator separator-dashed my-3"></div>--}}






        </div>
    @endcomponent





@endsection

@push('script')
    <script>
        let adaSelectEl = $('[name="ADA"]');
        let cdaSelectEl = $('[name="CDA"]');
        let natureSelectEl = $('[name="nature"]');
        //
        // const locationData = {
        //     country: "Morocco",
        //     lat: "35.619",
        //     localtime: "2024-03-04 01:13",
        //     localtime_epoch: 1709514780,
        //     lon: "-5.277",
        //     name: "Martil",
        //     region: "",
        //     timezone_id: "Africa/Casablanca",
        //     utc_offset: "1.0"
        // };
        //
        // for (const key in locationData) {
        //     if (Object.prototype.hasOwnProperty.call(locationData, key)) {
        //         const value = locationData[key];
        //         console.log(`${key}: ${value}`);
        //     }
        // }



        adaSelectEl.on('change' , function () {
            axios.post(route('test.api'), {
                'ada': adaSelectEl.val(),
            })
                .then(function ({data}) {
                    // console.log(data)
                    cdaSelectEl.find('option:not(:first-child)').remove();
                    for (const datum of data) {
                        cdaSelectEl.append(`<option value="${datum.id}"> ${datum.name} </option>`);
                    }
                })
                .catch(function (error) {
                    console.log(error.response.data.message)
                });
        });


        $('#getData').on('click' , function () {
            axios.post(route('weather.api'))
                .then(function ({data}) {
                    $('.fdsfds').empty()



                    for (const key in data.data.location) {
                        if (Object.prototype.hasOwnProperty.call(data.data.location, key)) {
                            const value = data.data.location[key];

                            $('.fdsfds').append(
                                `
                                <div class="d-flex flex-stack">
                                    <div class="text-gray-700 fw-semibold fs-6 me-2">${key}</div>
                                    <div class="d-flex align-items-senter">
                                        <span class="text-gray-900 fw-bolder fs-6">${value}</span>
                                    </div>
                               </div>
                               <div class="separator separator-dashed my-3"></div>
                            `
                            );
                        }
                    }
                    for (const key in data.data.current) {
                        if (Object.prototype.hasOwnProperty.call(data.data.current, key)) {
                            const value = data.data.current[key];

                            $('.fdsfds').append(
                                `
                                <div class="d-flex flex-stack">
                                    <div class="text-gray-700 fw-semibold fs-6 me-2">${key}</div>
                                    <div class="d-flex align-items-senter">
                                        <span class="text-gray-900 fw-bolder fs-6">
                                            <span class=" text-wrap">
${value}
</span>
                                        </span>
                                    </div>
                               </div>
                               <div class="separator separator-dashed my-3"></div>
                            `
                            );
                        }
                    }



                })
                .catch(function (error) {
                    console.log(error.response.data.message)
                });

        });

        // $('.filter').on('change' , function () {
        //     if(cdaSelectEl.val() && natureSelectEl.val()){
        //
        //     }
        // });

        console.log("api")
    </script>
@endpush

