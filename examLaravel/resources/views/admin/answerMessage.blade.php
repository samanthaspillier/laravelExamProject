@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

@section('title', 'Answer Message')

@section('content')
<div id="answer-message" class="mb-5">

    <div class="card">
        <div class="card-header">
            Message received on {{ $message->created_at -> diffForHumans() }}
        </div>
        <div class="card-body">
            <!-- Display the message details -->
            <div class="mb-4">
                <!-- Container for "From" and "Subject" each on their own line but in a row -->
                <div class="row">
                    <div >
                        <p><strong>From:</strong> {{ $message->email }}</p>
                    </div>
                    <div>
                        <p><strong>Subject:</strong> {{ $message->subject }}</p>
                    </div>
                    <!-- Message field -->
                    <div class="">
                        <label class="form-label fw-bold">Message:</label>
                        <p class="form-control-plaintext">{{ $message->message }}</p>
                    </div>
                </div>

                
            </div>


            <!-- Form for answering the message -->
            <form method="POST" action="{{ route('submitAnswer', $message->id) }}">
                @csrf

                <div class="mb-3">
                    <label for="answer" class="form-label fw-bold">Your Answer</label>
                    <textarea id="answer" name="answer" rows="4" class="form-control" required></textarea>
                </div>



                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Send Answer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
