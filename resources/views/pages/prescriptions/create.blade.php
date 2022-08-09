@extends('layouts.ui.web',['activePage'=>'showcase'])
@section('content')
<div class="card card-custom">
	<!-- <div class="card-header flex-wrap border-0 pt-6 pb-0"> -->
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
        <form class="form" method="post" action="{{route('prescriptions.uploadImages')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Note:</label>
                    <textarea class="form-control form-control-solid" name="note" id="" cols="20" rows="5" required></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Delivery Address:</label>
                    <input type="text" name="address" class="form-control" placeholder="Enter name" required/>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Delivery Time Slot(start):</label>
                    <input type="time" name="start_time" id="start_time" class="form-control" placeholder="Enter name" required/>
                </div>
                <div id="endtime" class="col-lg-6">
                    <label>Delivery Time Slot(end):</label>
                    <input type="time" name="end_time" id="end_time" class="form-control" placeholder="Enter name" required/>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Images</label>
                    <div>

                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="image[]" accept=".png, .jpg, .jpeg" required multiple/>
                        <label class="custom-file-label" for="customFile">Choose Images</label>
                    </div>
                </div>
            </div>

            <br><br>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
            </form>
        </div>
</div>
@endsection
@section('css')
<style>
    #customFile .custom-file-control:lang(en)::after {
  content: "Select file...";
}

#customFile .custom-file-control:lang(en)::before {
  content: "Click me";
}
</style>
@endsection
@section('js')
<script src="{{ asset('ui/web/js/pages/crud/forms/widgets/tagify.js') }}"></script>
<script src="{{ asset('ui/web/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
@endsection