<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <!--職員のroleではない人がログインしようとした時に表示させるエラー（AuthenticatedSessionControllerに記載あり）-->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <!--<div>-->
        <!--    <x-input-label for="email" :value="__('Email')" />-->
        <!--    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />-->
        <!--    <x-input-error :messages="$errors->get('email')" class="mt-2" />-->
        <!--</div>-->
        
         <!--ID -->
        <div>
            <x-input-label for="custom_id" :value="__('ID')" />
            <x-text-input id="custom_id" class="block mt-1 w-full" type="text" name="custom_id" :value="old('custom_id')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('custom_id')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        
        
       

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<!--@if (Route::has('login'))-->
<!--    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">-->
<!--        @auth-->
<!--          <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>-->
<!--        @else-->
<!--            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ログイン</a>-->

<!--            @if (Route::has('register'))-->
<!--                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">新規登録</a>-->
<!--            @endif-->
<!--        @endauth-->
<!--    </div>-->
<!--@endif-->

@if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
       
            <!--<a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>-->
        
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ログイン</a>
            @if (Route::has('register'))
    <a href="{{ url('/register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">新規登録</a>
@endif

     </div>
@endif