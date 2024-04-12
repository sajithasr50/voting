@extends('layouts.app-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

@section('content')
<div class="container">
    <div class="columns">
        <div class="column">

            <h1 class="title">Add Candidate</h1>
            @if ($errors->any())
            <div class="notification is-danger is-light">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('candidate.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="name" required="required" autofocus>
                    <label for="floatingName">Candidate Name</label>
                    @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <label class="is-block mb-4">
                    <span class="is-block mb-2">Choose a file to upload</span>
                    <span class="file has-name is-fullwidth">
                        <label class="file-label">
                            <input type="file" name="file_upload" />
                        </label>
                    </span>
                </label>
                <div class="field is-grouped mt-3">
                    <div class="control">
                        <button type="submit" class="button is-info">Save</button>
                    </div>
                    <div class="control">
                        <a href="{{ route('candidate.index') }}" class="button is-light">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection