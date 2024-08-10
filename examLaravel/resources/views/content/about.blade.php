@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')
@section('title', 'About ')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Read Me</div>

                <div class="card-body">
                    <p>...</p>
                </div>
                <div class="card-header">Sources</div>
                <div class="card-body">
                    <ul>
                        <li><a href="https://www.malawiantour.be/">Malawian Tour</a></li>
                        </ul>

                       
            </div>
        </div>
    </div>

    @endsection
