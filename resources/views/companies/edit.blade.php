<div class="modal fade" id="UpdateCompanyModal{{ $company->id }}" tabindex="-1" aria-labelledby="UpdateCompanyModalLabel{{ $company->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="UpdateCompanyModalLabel{{ $company->id }}">Update Company</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Company Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" value="{{ $company->email }}" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*"> 
                        @if ($company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="Current Logo" class="img-thumbnail mt-2" style="max-width: 150px;">
                            <small class="form-text text-muted">Leave this blank to keep the current logo.</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Website<span class="text-danger">*</span></label>
                        <input type="url" class="form-control" id="website" name="website" value="{{ $company->website }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Company</button>
                </div>
            </form>
        </div>
    </div>
</div>
