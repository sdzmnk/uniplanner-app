<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Видалити акаунт') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Після видалення вашого акаунта всі його ресурси та дані будуть безповоротно видалені. Перед видаленням акаунта, будь ласка, завантажте всі дані або інформацію, яку ви хочете зберегти.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Видалити акаунт') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Ви впевнені, що хочете видалити свій акаунт?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Після видалення вашого акаунта всі його ресурси та дані будуть безповоротно видалені. Будь ласка, введіть свій пароль, щоб підтвердити, що ви хочете безповоротно видалити акаунт.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Пароль') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Пароль') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Скасувати') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Видалити акаунт') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
