@if ($message != null)
        <div class="alert alert-{{$type ?? warning}} alert-dismissible fade show" role="alert">
            <strong>Message : </strong>{{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif