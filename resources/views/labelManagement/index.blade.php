@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="d-flex align-items-center">
            <h3>{{__('messages.nav.labelManagement')}}</h3>

            <div class="d-flex align-items-center ms-auto me-0">
                <input class="form-control" id="fullText_input" name="search_param" value="" placeholder="{{__('messages.searchText')}}" dusk="fullText_input" />
                <select id="package_status_input" class="form-select" name="package_status_input" dusk="package_status">
                    @foreach($package_statuses as $package_status)
                        <option value="{{ $package_status->id }}" >{{__('attributes.packageStatus.' . $package_status->name)}}</option>
                    @endforeach
                </select>
                <form id="searchForm" action="/labelManagement/" method="get">
                    @method('get')
                    <button onclick="setRoute()" type="submit" class="mt-3 btn btn-success">{{__('messages.buttons.search')}}</button>
                </form>
            </div>

            @can('create', App\Models\Label::class)
                <div class="d-flex align-items-center ms-auto me-0">
                    <a class="btn btn-success modal-button" data-bs-toggle="modal" data-bs-target="#create_modal">
                        {{__('messages.buttons.uploadCSV')}}
                    </a>
                </div>
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
                    <th>Id</th>
                    <th>{{__('attributes.label.barcode_id')}}</th>
                    <th>{{__('attributes.label.package_status')}}</th>
                    <th>{{__('attributes.label.carrier_user_id')}}</th>
                    <!-- sender !-->
                    <th>{{__('attributes.label.sender')}}-{{__('attributes.loc.address')}}</th>
                    <!-- receiver !-->
                    <th>{{__('attributes.label.receiver')}}-{{__('attributes.loc.address')}}</th>
                    <th>
                        @can('create', App\Models\Label::class)
                            @if ($labels->count() > 0)
                                <form action="{{ route('labelManagement.labelPdfBulk') }}" method="get">
                                    @method('get')
                                    <button type="submit" class="btn btn-success">{{__('messages.buttons.createLabelPdfBulk')}}</button>
                                </form>
                            @endif
                        @endcan
                    </th>
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
                        <td>
                            <form action="{{route('labelManagement.labelPdf', [$label->id])}}" enctype="multipart/form-data" method="get">
                                @method('get')
                                <button class="btn btn-primary">{{__('messages.buttons.createLabelPdf')}}</button>
                            </form>
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

    <script>
        function setRoute() {
            let fullText = document.getElementById('fullText_input').value;
            let packageStatus = document.getElementById('package_status_input').value;
            document.getElementById('searchForm').action = `/labelManagement/${packageStatus}/${fullText}`;
        }
    </script>
@endsection

@include('labelManagement.modals.csv_upload_modal')
