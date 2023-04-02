<style>
    .page-break-after {
        page-break-after: always;
    }

    .my-0 {
        margin-top: 0;
        margin-bottom: 0;
    }
</style>

<div class="labelsContainer">
    @foreach($labels as $label)

        <div @class(['px-5 label', 'page-break-after' => !$loop->last])>
            <h2 style="text-align:center">{{$label->carrier->name}}</h2>
            <hr>

            <h3>{{__('attributes.label.receiver')}}</h3>
            <p>{{$label->receiver_address}}</p>
            <p>{{$label->receiver_city}}</p>
            <p>{{$label->receiver_postcode}}</p>
            <hr>

            <h3>{{__('attributes.label.sender')}}</h3>
            <p>{{$label->sender_address}}</p>
            <p>{{$label->sender_city}}</p>
            <p>{{$label->sender_postcode}}</p>
            <hr>
            <br>
            <br>

            <div>
                <div>{!! \Milon\Barcode\DNS1D::getBarcodeHTML($label->barcode_id, 'C128', 2, 100) !!}</div>
                <h6 class="my-0" style="text-align:center">{{$label->barcode_id}}</h6>
            </div>
        </div>
    @endforeach
</div>
