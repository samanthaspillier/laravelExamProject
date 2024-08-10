<section>
    <header class="mb-4">
        <h2 class="h4">{{ __('Profile Information') }}</h2>
        <p class="text-muted">{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <form method="post" action="{{ route('profile.update', $user->id) }}" class="mt-4" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="row">
            <!-- Left Column -->
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">{{ __('Name') }}</label>
                    <input id="name" name="name" type="text" class="form-control" style="max-width: 400px;" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @if($errors->has('name'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">{{ __('Email') }}</label>
                    <input id="email" name="email" type="email" class="form-control" style="max-width: 400px;" value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @if($errors->has('email'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="birthday" class="form-label fw-bold">{{ __('Birthday') }}</label>
                    <input id="birthday" name="birthday" type="date" class="form-control" style="max-width: 400px;" value="{{ old('birthday', $user->birthday) }}" autocomplete="birthday">
                    @if($errors->has('birthday'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('birthday') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="avatar" class="form-label fw-bold">{{ __('Change Avatar') }}</label>
                    <input id="avatar" name="avatar" type="file" class="form-control" style="max-width: 400px;">
                    @error('avatar')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                @if (auth()->user()->isAdmin())
                <div class="mb-3">
                    <label class="form-label fw-bold">Role</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="adminRole" value="admin" {{ $user->isAdmin() ? 'checked' : '' }}>
                        <label class="form-check-label" for="adminRole">
                            Admin
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="userRole" value="user" {{ !$user->isAdmin() ? 'checked' : '' }}>
                        <label class="form-check-label" for="userRole">
                            General User
                        </label>
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label for="bio" class="form-label fw-bold">{{ __('About You') }}</label>
                    <span class="text-muted">Provide a brief description about yourself.</span>
                    <textarea id="bio" name="bio" rows="4" class="form-control">{{ old('bio', $user->bio) }}</textarea>
                    @if($errors->has('bio'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('bio') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-4 d-flex justify-content-center align-items-start">
                @if ($user->avatar)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar" class="img-fluid rounded" style="max-height: 300px;">
                    </div>
                @endif
            </div>
        </div>

        <div class="d-flex align-items-center gap-2 mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            @if (session('status') === 'profile-updated')
                <p class="text-success mb-0">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
