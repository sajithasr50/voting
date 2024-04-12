

@extends('layouts.app-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

@section('content')
<div class="columns" style="margin-top:20px;">

            <div class="column">
                <h2 class="title">
                    Voting details
                </h2>
                <table class="table is-striped">
                    <thead>
                    <tr>
                        <th>Candidate</th>
                        <th>Voting count</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $count=0;
                        @endphp
                    @forelse($getAll as $getAll)
                    <?php $count++; ?>

                        <tr <?=($count==1?"class='green'":"");?>>
                        <td>
                        <img src="{{ asset('uploads/'.$getAll['candidateimage']) }}" class="img img-responsive" style="width: 50px;height: 50px;"/>
&nbsp;{{ $getAll['candidatename'] }}
                            </td>
                            <td>
                            {{$getAll['votingcount']}}
                            </td>
                            <td>
                            <a href="{{ url('vote/userdetails/'.$getAll['candidateid']) }}" style="text-decoration: none;">view more</a>
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
