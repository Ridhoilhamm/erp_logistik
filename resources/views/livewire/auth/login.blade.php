<div>
    <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-md w-full">
            <a href="javascript:void(0)">
                <img src="https://readymadeui.com/readymadeui.svg" alt="logo"
                    class="w-40 mb-8 mx-auto block dark:invert" />
            </a>

            <div class="p-8 rounded-2xl bg-white dark:bg-gray-800 shadow">
                <h2 class="text-slate-900 dark:text-white text-center text-3xl font-semibold">Sign in</h2>
                <form wire:submit="authenticate" class="mt-12 space-y-6">
                    <label class="text-slate-800 dark:text-slate-200 text-sm font-medium mb-2 block">
                        Username / Email
                    </label>
                    <div class="relative flex items-center">
                        <input wire:model="login" name="login" type="text" required
                            class="w-full text-slate-800 dark:text-white bg-white dark:bg-gray-700 text-sm border border-slate-300 dark:border-gray-600 px-4 py-3 rounded-md outline-blue-600"
                            placeholder="Enter username or email" autofocus />
                            @error('login')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                    </div>

                    <div>
                        <label
                            class="text-slate-800 dark:text-slate-200 text-sm font-medium mb-2 block">Password</label>
                        <div class="relative flex items-center">
                            <input wire:model="password" name="password" type="password" required
                                class="w-full text-slate-800 dark:text-white bg-white dark:bg-gray-700 text-sm border border-slate-300 dark:border-gray-600 px-4 py-3 rounded-md outline-blue-600"
                                placeholder="Enter password" />
                            {{-- <x-password value="password" /> --}}
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center">
                            <input wire:model="remember" id="remember-me" name="remember-me" type="checkbox"
                                class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-slate-300 dark:border-gray-600 rounded" />

                            <label for="remember-me" class="ml-3 block text-sm text-slate-800 dark:text-slate-200">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <div class="!mt-12">
                        <button type="submit"
                            class="w-full py-2 px-4 text-[15px] font-medium tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
