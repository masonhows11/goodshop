@extends('front.profile.master_profile')
@section('page_title')
    {{ __('messages.addresses') }}
@endsection
@section('left_profile_content')

    <div class="profile-card"><!-- start address box -->
        <p class="font-13">آدرس ها </p>
        <div class="row">
            @if( $errors->any())
                <div class="d-flex justify-content-start">
                    <div class="my-2 py-1">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            @forelse ( $addresses as $address)
                <div class="col-md-6 address-list mt-3">
                    <div class="card p-2">
                        <p class="font-13"> نام و نام خانوادگی : {{ $address->recipient_first_name . ' ' . $address->recipient_last_name }}</p>
                        <p class="font-13"> استان : {{ $address->province->name ? $address->province->name : ' - ' }}</p>
                        <p class="font-13"> شهر : {{ $address->city->name ? $address->city->name : ' - ' }}</p>
                        <p class="font-13"> آدرس : {{ $address->address_description }}</p>
                        <p class="font-13"> کد پستی : {{  $address->postal_code }}</p>
                        <p class="font-13"> شماره پلاک : {{  $address->plate_number }}</p>
                        <p class="font-13"> شماره تماس : {{ $address->mobile != null ? $address->mobile : $address->user->mobile }}</p>
                    </div>
                    <div class="card mt-3">
                        <div class="p-2">
                            <form action="{{ route('profile.address.delete', $address) }}" method="get"  class="address-form d-inline">
                                @csrf
                                <button type="submit" class="delete-item border-0 bg-white"><i class="fa fa-trash  font-13 delete-item" id="delete-item"></i></button>
                            </form>
                            <a href="#"  data-bs-toggle="modal" data-bs-target="#change-address-modal-{{ $address->id }} "><i class="fa fa-edit font-13"></i></a>
                        </div>
                    </div>
                </div>
                <!-- start change address modal -->
                <div class="modal fade" id="change-address-modal-{{ $address->id }}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-light">
                                <h6 class="text-muted modal-title">{{ __('messages.edit_address') }}</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('profile.address.update') }}" method="post" id="edit-address-modal-{{ $address->id }}">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="address" value="{{ $address->id }}">
                                        <div class="col my-3">
                                            <label class="form-label ms-2 font-13 light-font"> {{ __('messages.recipient_first_name') }}: </label>
                                            <input type="text" name="recipient_first_name" id="recipient_first_name" class="form-control form-control-lg" value="{{ $address->recipient_first_name  }}">
                                        </div>
                                        <div class="col my-3">
                                            <label class="form-label ms-2 font-13 light-font"> {{ __('messages.recipient_last_name') }}: </label>
                                            <input type="text" name="recipient_last_name" id="recipient_last_name" class="form-control form-control-lg" value="{{ $address->recipient_last_name  }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label ms-2 font-13 light-font">{{ __('messages.province') }}: </label>
                                            <select class="form-select form-select-lg font-13"
                                                    name="province_id"
                                                    id="province-edit-address-{{ $address->id }}">
                                                @foreach( $provinces as $province)
                                                    <option class="font-13" {{ $address->province_id == $province->id ? 'selected' : '' }} value="{{ $province->id }}">{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-label ms-2 font-13 light-font">{{ __('messages.city') }}: </label>
                                            <select class="form-select form-select-lg font-13" name="city_id" id="city-edit-address-{{ $address->id }}">
                                                <option value="{{ $address->city_id }}" class="font-13">{{ $address->city->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label ms-2 font-13 light-font"> {{ __('messages.plate_number') }}: </label>
                                            <input type="text" name="plate_number" id="plate_number" class="form-control form-control-lg" value=" {{ $address->plate_number }}">
                                        </div>
                                        <div class="col my-3">
                                            <label class="form-label ms-2 font-13 light-font"> {{ __('messages.post_code') }}: </label>
                                            <input type="text" name="postal_code" id="postal_code" class="form-control form-control-lg" value="{{ $address->postal_code }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            <label for="mobile" class="form-label ms-2 font-13 light-font">{{ __('messages.mobile') }}: </label>
                                            <input type="text" name="mobile" id="mobile" class="form-control form-control-lg" value="{{ $address->mobile }}">
                                        </div>
                                    </div>
                                    <div class="my-3">
                                        <textarea class="form-control" name="address_description" id="address_description" rows="5">{{ $address->address_description }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <input type="submit" class="send-btn" value="{{ __('messages.edit_model') }}">
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end change address modal -->
            @empty
                <div class="col-md-6">
                    <div class="card p-2">
                       <p class="text-center mb-5 mt-5">{{ __('messages.addresses_not_found') }}</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- start new address modal -->
        <div class="row">
            <div class="col mt-5">
                <div class="card text-center address-box">
                    <a href="#"  data-bs-toggle="modal" data-bs-target="#new-address-modal">
                        <i class="fas fa-map-marker-alt text-muted"></i>
                        <p class="font-13 text-muted">افزودن آدرس جدید</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="new-address-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h6 class="text-muted modal-title">{{ __('messages.add_new_address') }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.address.store') }}" method="post" id="create-address-modal">
                            @csrf
                            <div class="row">
                                <div class="col my-3">
                                    <label class="form-label ms-2 font-13 light-font">  {{ __('messages.recipient_first_name') }}: </label>
                                    <input type="text" name="recipient_first_name" id="recipient_first_name" class="form-control form-control-lg" placeholder="نام">
                                </div>
                                <div class="col my-3">
                                    <label class="form-label ms-2 font-13 light-font"> {{ __('messages.recipient_last_name') }}: </label>
                                    <input type="text" name="recipient_last_name" id="recipient_last_name" class="form-control form-control-lg" placeholder="نام خانوادگی">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="province-select" class="form-label ms-2 font-13 light-font">{{ __('messages.province') }}: </label>
                                    <select class="form-select form-select-lg font-13" name="province_id" id="province-select">
                                        <option selected>{{ __('messages.choose') }}</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}" class="font-13">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="city-new-address" class="form-label ms-2 font-13 light-font">{{ __('messages.city') }}: </label>
                                    <select class="form-select form-select-lg font-13" name="city_id" id="city-new-address">
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col my-3">
                                    <label class="form-label ms-2 font-13 light-font">{{ __('messages.plate_number') }}: </label>
                                    <input type="text" name="plate_number" id="plate_number" class="form-control form-control-lg" placeholder="شماره پلاک">
                                </div>
                                <div class="col my-3">
                                    <label class="form-label ms-2 font-13 light-font"> {{ __('messages.post_code') }}: </label>
                                    <input type="text" name="postal_code" id="postal_code" class="form-control form-control-lg" placeholder="کد پستی">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col my-3">
                                    <label for="mobile" class="form-label ms-2 font-13 light-font">{{ __('messages.mobile') }}: </label>
                                    <input type="text" name="mobile" id="mobile" class="form-control form-control-lg" placeholder="موبایل">
                                </div>
                            </div>
                            <div class="row">
                                <div class="my-3">
                                    <textarea class="form-control" name="address_description" id="address_description" rows="5" placeholder=" آدرس"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <input type="submit" class="send-btn" value="ثبت آدرس">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-top-0"></div>
                </div>
            </div>
        </div>
        <!-- end new address modal -->

    </div>


@endsection
@push('front_custom_scripts')
    <script>

        $(document).ready(function () {

            // for create address get cities from province
            $('#province-select').change(function () {
                let id = $('#province-select option:selected').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('get.cities') }}',
                    method: 'GET',
                    data: {id: id}
                }).done(function (data) {

                    if (data.status === 200) {
                        let cities = data.data;
                        $('#city-new-address').empty();
                        cities.map((city) => {
                            $('#city-new-address').append($('<option/>').val(city.id).text(city.name))
                        })
                    } else if (data.status === 404) {
                        $('#city-new-address').empty();
                        console.log(data['data']);
                    }
                }).fail(function (data) {
                    console.log(data['data']);
                });
            });

            // for edit address get cities from province
            var addresses = {!! auth()->user()->addresses !!}
            addresses.map(function (address) {
                let id = address.id;
                var target = `#province-edit-address-${id}`;
                var selected = `${target} option:selected`;
                $(target).change(function () {
                    let id = $(selected).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('get.cities') }}',
                        method: 'GET',
                        data: {id: id}
                    }).done(function (data) {
                        if (data.status === 200) {
                            let cities = data.data;
                            $(`#city-edit-address-${address.id}`).empty();
                            cities.map((city) => {
                                $(`#city-edit-address-${address.id}`).append($('<option/>').val(city.id).text(city.name))
                            })
                        } else if (data.status === 404) {
                            $(`#city-edit-address-${address.id}`).empty();
                            console.log(data['data']);
                        }
                    }).fail(function (data) {
                        console.log(data['data']);
                    });
                });
            });

            // for change background color div " delivery type " selected
            $('#address-radio-select input:radio').change(function() {
                $('.row.address-selected').removeClass('address-selected');
                $(this).closest('.address-select').addClass('address-selected');
            });

            $('#delivery-radio-select input:radio').change(function() {
                $('label.delivery-selected').removeClass('delivery-selected');
                $(this).closest('.delivery-select').next('label').addClass('delivery-selected');
            });

        })

    </script>
@endpush
