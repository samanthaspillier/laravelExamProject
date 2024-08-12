

<section id="faq-management" class="mb-5">
    <h3>FAQ Management</h3>
    <div class="card">
    
        <div class="card-body">
            <!-- Dropdown to select a faq to edit -->
            <div class="mb-3">
                <select id="faqDropdown" class="form-select" onchange="window.location.href=this.value;">
                    <option value="">Select a faq to edit...</option>
                    @foreach($faqs as $faq)
                        <option value="{{ route('editFaq', $faq->id) }}">{{ $faq->question }}</option>
                    @endforeach
                </select>
            </div>
            
            <a href="{{ route('createFaq') }}" class="btn btn-primary btn-sm">Add a FAQ</a>
            </div>
    </div>
</section>