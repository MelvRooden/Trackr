<div class="modal fade" id="csv_upload_modal" tabindex="-1" role="dialog" aria-labelledby="csv_upload_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('attributes.label.header.uploadCSV')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('labelManagement.storeCSVFile') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="modal-body">

                    <!-- csv !-->
                    <div class="form-floating mb-3">
                        <input class="form-control @error('csvFile', 'store') is-invalid @enderror" name="csvFile" type="file"
                               placeholder="{{__('attributes.label.csvUploadInput')}}" required />
                        <label for="csvFile">{{__('attributes.label.csvUploadInput')}}</label>
                        @error('csvFile', 'store')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.buttons.cancel')}}</button>
                        <button type="submit" class="btn btn-success">{{__('messages.buttons.create')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
