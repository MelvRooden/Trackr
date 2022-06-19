<div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('attributes.user.header.createUser')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form" action="/labelManagement/barCodeSearch" method="get">
                @method('get')
                <div class="modal-body">

                    <!-- barcode_id !-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="barcode_id" name="barcode_id" value="{{ old('barcode_id') }}" placeholder="{{__('attributes.label.barcode_id')}}" dusk="barcode_id" />
                        <label for="barcode_id">{{__('attributes.label.barcode_id')}}</label>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.buttons.cancel')}}</button>
                        <button onclick="setRoute()" type="submit" class="btn btn-success">{{__('messages.buttons.searchBar')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function setRoute() {
        let barcode = document.getElementById('barcode_id').value;
        document.getElementById('form').action = `/labelManagement/barCodeSearch/${barcode}`;
    }
</script>
