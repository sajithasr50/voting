@extends('layouts.app-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

@section('content')
<div class="columns" style="margin-top:20px;">

    <div class="column">
        <h2 class="title">
            Candidate
        </h2>
        <a href="{{ route('candidate.create') }}" class="button is-primary is-small" style="float:right;text-decoration: none;">
            <span class="icon is-small">
                <i class="fa fa-upload" aria-hidden="true"></i>
            </span>
            <span>Add New Candidate</span>
        </a>

        <table class="table is-striped">
            <thead>
                <tr>
                    <th>Candidate name</th>
                    <th>Candidate icon</th>
                    <th>Uploaded at</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @forelse($uploadedFiles as $uploadedFile)
                <tr>
                    <td>
                        {{ $uploadedFile->name }}
                    </td>
                    <td>
                        <img src="{{ asset('uploads/'.$uploadedFile->filename) }}" class="img img-responsive" style="width: 50px;
    height: 50px;" />
                    </td>
                    <td>
                        {{ $uploadedFile->created_at }}
                    </td>
                    <td>
                        <a href="{{ url('candidate/delete/'.$uploadedFile->id) }}" data-value="{{$uploadedFile->id}}" target="_blank" class="deletecand button is-link is-small" style="background: maroon;text-decoration:none">
                            <span class="icon is-small">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </span>
                            <span>Delete</span>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>No data found</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection