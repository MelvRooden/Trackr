@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="d-flex align-items-center">
            <h3>{{__('messages.nav.labelByBar')}}</h3>
            <div class="d-flex align-items-center ms-auto me-0">
                <button class="btn btn-success modal-button" data-bs-toggle="modal" data-bs-target="#create_modal">
                    {{__('messages.buttons.searchBar')}}
                </button>
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
                    <th>Id</th>
                    <th>{{__('attributes.label.barcode_id')}}</th>
                    <th>{{__('attributes.label.package_status')}}</th>
                    <th>{{__('attributes.label.carrier_user_id')}}</th>
                    <!-- sender !-->
                    <th>{{__('attributes.label.sender')}}-{{__('attributes.loc.address')}}</th>
                    <!-- receiver !-->
                    <th>{{__('attributes.label.receiver')}}-{{__('attributes.loc.address')}}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($labels as $label)
                        <tr>
                            <td>{{ $label->id }}</td>
                            <td>{{ $label->barcode_id }}</td>
                            <td>{{__('attributes.packageStatus.' . $label->packageStatus->name)}}</td>
                            <td>{{ $label->carrier->name }}</td>
                            <!-- sender !-->
                            <td>
                                {{ $label->sender_address }}, {{ $label->sender_city }}
                                <br>
                                {{ $label->sender_postcode }}
                            </td>
                            <!-- receiver !-->
                            <td>
                                {{ $label->receiver_address }}, {{ $label->receiver_city }}
                                <br>
                                {{ $label->receiver_postcode }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection

@include('labelManagement.modals.show_by_bar_modal')
