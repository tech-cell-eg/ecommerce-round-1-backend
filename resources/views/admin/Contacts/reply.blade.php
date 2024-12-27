@extends('layouts.dashboard')
@section('content')




<!-- parti  al -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Send Reply </h3>

        </div>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Reply to {{ $contact->name }}</h4>


    <form action="{{ route('admin.contacts.sendReply', $contact->id) }}" method="POST"  class="forms-sample">
        @csrf
        <div class="form-group">
            <label for="reply">Your Reply:</label>
            <textarea name="reply" id="reply" required class="form-control mb-3"></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary me-2">Send Reply</button>
        </div>
    </form>
    </div>
                </div>
            </div>


        </div>
    </div>

</div>


@endsection