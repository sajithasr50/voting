

@extends('layouts.app-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

@section('content')
<div class="columns" style="margin-top:20px;">

            <div class="column">
                <h2 class="title">
                    Voted for {{$getAll[0]['name']}}
                </h2>
                <table class="table is-striped">
                    <thead>
                    <tr>
                        <th>Users</th>
                        <th>Voting Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($getAll as $getAll)
                        <tr>
                        <td>
                            {{$getAll['username']}}
                            </td>
                            <td>
                            {{$getAll['created_at']}}
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
