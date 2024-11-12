@extends('AdminPanel.layouts.master')
@section('content')

<div class="text-center mb-2">
    <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
</div>
{{Form::open(['url'=>route('admin.faqs.store'), 'id'=>'createfaqForm', 'class'=>'row gy-1 pt-75','files'=>'true'])}}
<div class="col-12 col-md-12">
    <label class="form-label" for="question_ar">{{trans('common.question_ar')}}</label>
    {{Form::text('question_ar','',['id'=>'question_ar', 'class'=>'form-control'])}}
</div>
<div class="col-12 col-md-12">
    <label class="form-label" for="question_en">{{trans('common.question_en')}}</label>
    {{Form::text('question_en','',['id'=>'question_en', 'class'=>'form-control'])}}
</div>

<div class="col-12 col-md-12">
    <label class="form-label" for="answer_ar">{{trans('common.answer_ar')}}</label>
    {{Form::textarea('answer_ar','',['id'=>'answer_ar','name'=>'answer_ar', 'class'=>'form-control editor_ar ','rows'=>'4'])}}
</div>
<div class="col-12 col-md-12">
    <label class="form-label" for="answer_en">{{trans('common.answer_en')}}</label>
    {{Form::textarea('answer_en','',['id'=>'answer_en', 'class'=>'form-control editor_en '])}}
</div>

<div class="col-12 col-md-12">
    <label class="form-label" for="answer_video_link">{{trans('common.answer_video_link')}}</label>
    {{Form::text('answer_video_link','',['id'=>'answer_video_link', 'class'=>'form-control'])}}
</div>

<div class="col-md-12 text-start">
    <label class="form-label" for="photo">{{trans('common.answer_photo')}}</label>
    <div class="file-loading">
        <input class="files" name="answer_photo" type="file" accept="image/png, image/gif, image/jpeg ,image/gif">
    </div>
</div>



<div class="col-12 text-center mt-2 pt-50">
    <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
        {{trans('common.Cancel')}}
    </button>
</div>
{{Form::close()}}

{{-- <form method="Post" action="{{route('admin.faqs.store')}}" enctype="multipart/form-data">
    {{csrf_field()}}
     <label class="form-label" for="answer_ar">{{trans('common.answer__ar')}}</label>
     <textarea type="text" class="form-control editor_ar" id='answer_ar' name="answer_ar"></textarea>


</form> --}}

@stop

@section('scripts')
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
    class MyUploadAdapter {
        constructor( loader ) {
            // The file loader instance to use during the upload. It sounds scary but do not
            // worry — the loader will be passed into the adapter later on in this guide.
            this.loader = loader;
        }

        // Starts the upload process.
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }

        // Aborts the upload process.
        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }

        // Initializes the XMLHttpRequest object using the URL passed to the constructor.
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            // Note that your request may look different. It is up to you and your editor
            // integration to choose the right communication channel. This example uses
            // a POST request with JSON as a data structure but your configuration
            // could be different.
            xhr.open( 'POST', '{{ route('admin.images.store') }}', true );
            xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
            xhr.responseType = 'json';
        }

        // Initializes XMLHttpRequest listeners.
        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;

                // This example assumes the XHR server's "response" object will come with
                // an "error" which has its own "message" that can be passed to reject()
                // in the upload promise.
                //
                // Your integration may handle upload errors in a different way so make sure
                // it is done properly. The reject() function must be called when the upload fails.
                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }

                // If the upload is successful, resolve the upload promise with an object containing
                // at least the "default" URL, pointing to the image on the server.
                // This URL will be used to display the image in the content. Learn more in the
                // UploadAdapter#upload documentation.
                resolve( {
                    default: response.url
                } );
            } );

            // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
            // properties which are used e.g. to display the upload progress bar in the editor
            // user interface.
            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }

        // Prepares the data and sends the request.
        _sendRequest( file ) {
            // Prepare the form data.
            const data = new FormData();

            data.append( 'upload', file );

            // Important note: This is the right place to implement security mechanisms
            // like authentication and CSRF protection. For instance, you can use
            // XMLHttpRequest.setRequestHeader() to set the request headers containing
            // the CSRF token generated earlier by your application.

            // Send the request.
            this.xhr.send( data );
        }

        // ...
    }

    function SimpleUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            // Configure the URL to the upload script in your back-end here!
            return new MyUploadAdapter( loader );
        };
    }

    ClassicEditor
        .create( document.querySelector( '#task-textarea-en' ), {
            extraPlugins: [ SimpleUploadAdapterPlugin ],
        } )
        .then( editor => {
            // Simulate label behavior if textarea had a label
            if (editor.sourceElement.labels.length > 0) {
                editor.sourceElement.labels[0].addEventListener('click', e => editor.editing.view.focus());
            }
        } )
        .catch( error => {
            console.error( error );
        } );
</script>


<script>
    ClassicEditor
    .create( document.querySelector( '#task-textarea-ar' ) )
    .catch( error => {
    console.error( error );
    } );
</script> --}}

@endsection
