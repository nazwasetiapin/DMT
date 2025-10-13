<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="no_wa" :value="__('WhatsApp')" />
            <x-text-input id="no_wa" name="no_wa" type="tel" class="mt-1 block w-full" :value="old('no_wa', $user->no_wa)" required autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('no_wa')" />


        @if (! $user->no_wa_verified)
            <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                     {{ __('Nomor WhatsApp Anda belum diverifikasi.') }}

            <button form="send-wa-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Klik di sini untuk mengirim ulang kode verifikasi WhatsApp.') }}
            </button>
        </p>

         @if (session('status') === 'wa-verification-sent')
            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __('Kode verifikasi baru telah dikirim ke nomor WhatsApp Anda.') }}
            </p>
         @endif
        </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
