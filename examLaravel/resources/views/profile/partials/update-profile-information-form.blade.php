<section>
    <header>
        <h2 class="h4">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-muted">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4" enctype="multipart/form-data">
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

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="text-muted">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" class="btn btn-link p-0">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="text-success">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
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
                    <input id="avatar" name="avatar" type="file" class="form-control" style="max-width: 400px;" >
                    @error('avatar')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                @if ($isAdmin)
                <div class="mb-3">
                    <label class="form-label fw-bold">Admin Role</label>
                    <button type="button" class="btn btn-info">Admin: {{ $isAdmin ? 'True' : 'False' }}</button>
                </div>
                @endif

               
              
            </div>

            <!-- Right Column -->
            <div class="col-md-4 d-flex justify-content-center align-items-start">
                @if ($user->avatar)
                    <div class="mb-3 d-flex justify-content-center align-items-start" >
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar" class="img-fluid rounded h-75">
                    </div>
                @endif
            </div>
        </div>
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

        <div class="d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="text-success mb-0">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
