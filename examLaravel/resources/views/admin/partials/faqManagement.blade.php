<section id="faq-management" class="mb-5">
    <h3>FAQ Management</h3>
    <div class="card">
        <div class="card-header">
            Manage FAQs
        </div>
        <div class="card-body">
            <p>Here you can create, edit, and delete FAQs.</p>
            <!-- Table for listing FAQs -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $faq)
                        <tr>
                            <td>{{ $faq->id }}</td>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->answer }}</td>
                            <td>
                                <a href="{{ route('editFaq', $faq->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('createFaq') }}" class="btn btn-primary btn-sm">Add a FAQ</a>
            </div>
    </div>
</section>