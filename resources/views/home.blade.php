@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} <br>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/list_orders') }}" class="text-lg-right dark:text-gray-400 underline">List WooCommerce Orders</a>
                            <form method="GET" action="/export"><div class="ml-4 form-group row mb-0">
                                @csrf
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Export') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
