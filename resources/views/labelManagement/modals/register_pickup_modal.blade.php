<div class="modal fade" id="pickup_create_modal" tabindex="-1" role="dialog" aria-labelledby="pickup_create_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('attributes.label.header.createPickup')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="pickupForm" action="/pickupManagement/pickups/set/" method="post">
                @csrf
                @method('post')
                <div class="modal-body">

                    <!-- time !-->
                    <div class="form-floating mb-3">
                        <input class="form-control @error('pickup_datetime', 'store') is-invalid @enderror" name="pickup_datetime" type="datetime-local" value="{{ old('pickup_datetime') }}" placeholder="{{__('attributes.label.pickupTime')}}" dusk="pickupTime" />
                        <label for="name">{{__('attributes.label.pickupTime')}}</label>
                        @error('pickup_datetime', 'store')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- address !-->
                    <div class="form-floating mb-3">
                        <input class="form-control @error('pickup_address', 'store') is-invalid @enderror" name="pickup_address" placeholder="{{__('attributes.loc.address')}} 1" dusk="address" />
                        <label for="address">{{__('attributes.loc.address')}} + {{__('attributes.loc.houseNumber')}}</label>
                        @error('pickup_address', 'store')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- city !-->
                    <div class="form-floating mb-3">
                        <input class="form-control @error('pickup_city', 'store') is-invalid @enderror" name="pickup_city" placeholder="{{__('attributes.loc.city')}}" dusk="city" />
                        <label for="city">{{__('attributes.loc.city')}}</label>
                        @error('pickup_city', 'store')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- postcode !-->
                    <div class="form-floating mb-3">
                        <input class="form-control @error('pickup_postcode', 'store') is-invalid @enderror" name="pickup_postcode" placeholder="{{__('attributes.loc.postcode')}}" dusk="postcode" />
                        <label for="postcode">{{__('attributes.loc.postcode')}}</label>
                        @error('pickup_postcode', 'store')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.buttons.cancel')}}</button>
                    <button type="submit" class="btn btn-success">{{__('messages.buttons.create')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
