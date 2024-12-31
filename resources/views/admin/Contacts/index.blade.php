@extends('layouts.dashboard')
@section('content')

<div class="container-scroller">

    <div class="container-fluid page-body-wrapper">

        <!-- partial -->
        <div class="content-wrapper">

            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card mt-5">
                    <div class="card">
                        <div class="card-body">
                            <!-- Display flash message -->
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            <h4 class="card-title">All Blogs</h4>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Name </th>
                                            <th>Email</th>
                                            <th>Text</th>
                                            <th> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $contact)

                                        <tr>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email}}</td>
                                            <td>{{ $contact->text }}</td>
                                            <td>
                                            <th><a href="{{ route('admin.contacts.reply', $contact->id) }}" class="btn btn-primary btn-sm">Reply</a></th>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection