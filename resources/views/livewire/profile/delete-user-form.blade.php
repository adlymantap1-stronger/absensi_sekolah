<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-red-600 dark:text-red-400">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Setelah akun dihapus, seluruh data terkait akan dihapus secara permanen. Sebelum menghapus akun, silakan unduh data yang ingin kamu simpan.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Hapus Akun</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6 dark:bg-gray-800">

            <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                Yakin ingin menghapus akun kamu?
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Setelah akun dihapus, seluruh data terkait akan dihapus secara permanen. Masukkan password untuk konfirmasi penghapusan akun.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Password" class="sr-only" />

                <x-text-input
                    wire:model="password"
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    placeholder="Password"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Hapus Akun
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>  
