<div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('attributes.user.header.createUser')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('userManagement.store') }}" method="post">
                @csrf
                @method('post')
                <div class="modal-body">

                    <!-- name !-->
                    <div class="form-floating mb-3">
                        <input class="form-control @error('name', 'store') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{__('attributes.user.name')}}" dusk="name" />
                        <label for="name">{{__('attributes.user.name')}}</label>
                        @error('name', 'store')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- email !-->
                    <div class="form-floating mb-3">
                        <input class="form-control @error('email', 'store') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{__('attributes.user.email')}}" dusk="email" />
                        <label for="email">{{__('attributes.user.email')}}</label>
                        @error('email', 'store')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- password !-->
                    <div class="form-floating mb-3">
                        <input class="form-control @error('password', 'store') is-invalid @enderror" name="password" placeholder="{{__('attributes.user.password')}}" dusk="password" />
                        <label for="password">{{__('attributes.user.password')}}</label>
                        @error('password', 'store')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- address !-->
                    <div class="form-floating mb-3">
                        <input class="form-control @error('address', 'store') is-invalid @enderror" name="address" placeholder="{{__('attributes.loc.address')}} 1" dusk="address" />
                        <label for="address">{{__('attributes.loc.address')}} + {{__('attributes.loc.houseNumber')}}</label>
                        @error('address', 'store')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- city !-->
                    <div class="form-floating mb-3">
                        <input class="form-control @error('city', 'store') is-invalid @enderror" name="city" placeholder="{{__('attributes.loc.city')}}" dusk="city" />
                        <label for="city">{{__('attributes.loc.city')}}</label>
                        @error('city', 'store')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- postcode !-->
                    <div class="form-floating mb-3">
                        <input class="form-control @error('postcode', 'store') is-invalid @enderror" name="postcode" placeholder="{{__('attributes.loc.postcode')}}" dusk="postcode" />
                        <label for="postcode">{{__('attributes.loc.postcode')}}</label>
                        @error('postcode', 'store')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- role !-->
                    <div class="form-floating">
                        <select class="form-select" name="role_id">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == old('role') ? 'selected' : '' }}>{{__('attributes.role.' . $role->name)}}</option>
                            @endforeach
                        </select>
                        <label for="role">{{__('attributes.role.name')}}</label>
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
