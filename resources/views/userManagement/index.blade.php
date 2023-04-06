@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="d-flex align-items-center">
            <h3>{{__('messages.nav.userManagement')}}</h3>
            <div class="d-flex align-items-center ms-auto me-0">
            <input class="form-control" id="fullText_input" name="search_param" value="" placeholder="{{__('messages.searchText')}}" dusk="fullText_input" />
                    <select id="role_input" class="form-select" name="role_input" dusk="role_input">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" >{{__('attributes.role.' . $role->name)}}</option>
                        @endforeach
                    </select>
                    <form id="searchForm" action="/userManagement/" method="get">
                        @method('get')
                        <button onclick="setRoute()" type="submit" class="mt-3 btn btn-success">{{__('messages.buttons.search')}}</button>
                    </form>
            </div>
            @can('create', App\Models\User::class)
                <button class="btn btn-success modal-button" data-bs-toggle="modal" data-bs-target="#create_modal">
                    {{__('messages.buttons.addUser')}}
                </button>
            @endcan
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

            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
    </section>

    <script>
        function setRoute() {
            let fullText = document.getElementById('fullText_input').value;
            let role = document.getElementById('role_input').value;
            document.getElementById('searchForm').action = `/userManagement/${role}/${fullText}`;
        }
    </script>

    @can('create', App\Models\User::class)
        @include('userManagement.modals.create_modal')
    @endcan
@endsection


