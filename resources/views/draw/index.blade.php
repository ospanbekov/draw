@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">Prize draw</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p>Click the button and get a random prize</p>
                        <p>Types of prizes: money, bonus points, physical object</p>
                        <a href="#" class="btn btn-primary btn-lg">START</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
