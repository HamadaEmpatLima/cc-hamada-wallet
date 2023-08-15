<div>
    @if ($showSuccessModal)
        <div id="toast-success"
            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 ml-auto"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 text-sm font-normal">Please wait, your request is being processed.</div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>

        <script>
            setTimeout(function() {
                location.reload();
            }, 4000);
        </script>
    @endif
    <x-form-section submit="submit">
        <x-slot name="title">
            Wallet Form
        </x-slot>

        <x-slot name="description">
            Request deposit or withdrawal.
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6">
                <x-label value="Wallet Information" />

                <div class="flex items-center mt-2">
                    <div class="ml-4 leading-tight">
                        <div class="text-gray-900 dark:text-white">{{ Auth::user()->name }}</div>
                        <div class="text-gray-700 dark:text-gray-300 text-sm">hamada.undetected@gmail.com</div>
                        <div class="text-gray-700 dark:text-gray-300 text-sm">123456789</div>
                        <div class="text-gray-700 dark:text-gray-300 text-sm">Rp {{ $balance }}</div>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                    Type</label>
                <select wire:model.defer="state.type" id="type"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2">
                    <option selected>Choose type</option>
                    <option value="in">Deposit</option>
                    <option value="out">Withdrawal</option>
                </select>
                <x-input-error for="state.type" class="mt-2" />

                <x-label for="amount" value="Amount" class="mt-2" />
                <x-input wire:model.defer="state.amount" id="amount" type="number" class="mt-1 block w-full"
                    autofocus />
                <x-input-error for="state.amount" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-button>
                Submit
            </x-button>
        </x-slot>
    </x-form-section>
</div>
