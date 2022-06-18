@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="d-flex align-items-center">
            <h3>{{__('messages.nav.userManagement')}}</h3>
            <div class="d-flex align-items-center ms-auto me-0">
                <a class="btn btn-success modal-button" data-bs-toggle="modal" data-bs-target="#create_modal">
                    {{__('messages.buttons.addUser')}}
                </a>
            </div>
        </div>
        <hr/>
    </section>

    <section class="container">
        @include('layouts.alerts')
        <div class="row">
            <table class="table">
                <thead class="table-dark">
                <tr>
                    <th>{{__('attributes.user.name')}}</th>
                    <th>{{__('attributes.user.email')}}</th>
                    <th>{{__('attributes.loc.address')}}</th>
                    <th>{{__('attributes.loc.postcode')}}</th>
                    <th>{{__('attributes.role.name')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address}}, {{ $user->city }}</td>
                        <td>{{ $user->postcode }}</td>
                        <td>{{ $user->role->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection

@include('userManagement.modals.create_modal')
