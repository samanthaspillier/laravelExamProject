<section id="contact-message-management" class="mb-5">
    <h3>Contact Message Management</h3>
    <div class="card">
        <div class="card-header">
            Manage Contact Messages
        </div>
        <div class="card-body">
            <!-- Table for listing unanswered messages -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Category</th> <!-- Added column for Category -->
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unansweredMessages as $message)
                        <tr>
                            <td>{{ $message->subject }}</td>
                            <td>{{ $message->category }}</td>
                            <td>{{ \Str::limit($message->message, 50) }}</td>
                            <td>
                                <a href="{{ route('answerMessage', $message->id) }}" class="btn btn-primary btn-sm">Answer</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
