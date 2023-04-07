@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="d-flex align-items-center">
            <h3>{{__('attributes.review.leaveReview')}}</h3>
        </div>
        <hr/>
    </section>

    <section class="container">
        <form action="{{ route('review.index') }}">
            <!-- name !-->
            <div class="form-floating mb-3">
                <input class="form-control @error('name', 'store') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{__('attributes.user.name')}}" required />
                <label for="name">{{__('attributes.user.name')}}</label>
                @error('name', 'store')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- email !-->
            <div class="form-floating mb-3">
                <input class="form-control @error('email', 'store') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{__('attributes.user.email')}}" required />
                <label for="email">{{__('attributes.user.email')}}</label>
                @error('email', 'store')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- rating !-->
            <div class="form-floating mb-3">
                <select class="form-select" name="{{__('attributes.review.rating')}}" required>
                    <option value="0">1/5</option>
                    <option value="1">2/5</option>
                    <option value="2">3/5</option>
                    <option value="3">4/5</option>
                    <option value="4">5/5</option>
                </select>
                <label for="role">{{__('attributes.review.rating')}}</label>
            </div>

            <!-- review !-->
            <div class="form-floating mb-3">
                <input class="form-control @error('comment', 'store') is-invalid @enderror" name="comment" placeholder="{{__('attributes.review.comment')}}" />
                <label for="comment">{{__('attributes.review.comment')}}</label>
                @error('comment', 'store')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <button href="/" class="btn btn-success">{{__('attributes.review.leaveReview')}}</button>
            </div>
        </form>
    </section>

@endsection
