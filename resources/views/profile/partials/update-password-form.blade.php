<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            Modifica password
        </h2>

        <p class="mt-1 text-sm text-white">
            Assicurati che il tuo account usi una password lunga e casuale per rimanere al sicuro
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mb-2">
            <label class="text-white" for="current_password">Password attuale</label>
            <input class="mt-1 form-control" type="password" name="current_password" id="current_password"
                autocomplete="current-password">
            @error('current_password')
                <span class="invalid-feedback mt-2" role="alert">
                    <strong>{{ $errors->updatePassword->get('current_password') }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-2">
            <label class="text-white" for="password">Nuova password</label>
            <input class="mt-1 form-control" type="password" name="password" id="password" autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback mt-2" role="alert">
                    <strong>{{ $errors->updatePassword->get('password') }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-2">

            <label class="text-white" for="password_confirmation">Conferma password</label>
            <input class="mt-2 form-control" type="password" name="password_confirmation" id="password_confirmation"
                autocomplete="new-password">
            @error('password_confirmation')
                <span class="invalid-feedback mt-2" role="alert">
                    <strong>{{ $errors->updatePassword->get('password_confirmation') }}</strong>
                </span>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="secondary-button">Salva</button>

            @if (session('status') === 'password-updated')
                <script>
                    const show = true;
                    setTimeout(() => show = false, 2000)
                    const el = document.getElementById('status')
                    if (show) {
                        el.style.display = 'block';
                    }
                </script>
                <p id='status' class=" fs-5 text-muted">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
