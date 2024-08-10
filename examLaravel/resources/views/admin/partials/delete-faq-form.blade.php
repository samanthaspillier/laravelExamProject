<section class="mb-4">
    <!-- Button to Trigger Modal -->
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmPostDeletion">
        {{ __('Delete FAQ') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmPostDeletion" tabindex="-1" aria-labelledby="confirmPostDeletionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmPostDeletionLabel">
                        {{ __('Are you sure you want to delete this FAQ?') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        {{ __('Once it is deleted, all of its resources and data will be permanently deleted.') }}
                    </p>
                    <form method="GET" action="{{ route('deleteFaq', $faq->id) }}">
                        @csrf
                    

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
