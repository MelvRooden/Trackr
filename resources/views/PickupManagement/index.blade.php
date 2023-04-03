@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="d-flex align-items-center">
            <h3>{{__('messages.nav.pickupManagement')}}</h3>
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
                    <!-- pickup !-->
                    <th>{{__('attributes.label.pickupTime')}}</th>
                    <th>{{__('attributes.label.pickup')}}-{{__('attributes.loc.address')}}</th>
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
                        <!-- pickup !-->
                        <td>{{ $label->pickup_datetime }}</td>
                        <td>
                            {{ $label->pickup_address }}, {{ $label->pickup_city }}
                            <br>
                            {{ $label->pickup_postcode }}
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

            <div class="d-flex justify-content-center">
                {{ $labels->links() }}
            </div>
        </div>
    </section>
@endsection

@include('labelManagement.modals.csv_upload_modal')
