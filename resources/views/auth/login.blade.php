<x-guest-layout>
    <!-- حالة الجلسة -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" dir="rtl">
        @csrf

        <!-- البريد الإلكتروني -->
        <div>
            <x-input-label for="email" :value="__('البريد الإلكتروني')" />
            <x-text-input id="email" class="block mt-1 w-full text-right" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- كلمة المرور -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('كلمة المرور')" />
            <x-text-input id="password" class="block mt-1 w-full text-right"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-start mt-3" style="margin: 20px ; text-align: center;float:left" dir="auto">
            <x-primary-button class="me-3" style="margin: 5px">
                <a href="{{ route('indexproperty') }}">الموقع</a>
            </x-primary-button>
            <x-primary-button class="me-3"  style="margin: 5px" >
                <a href="{{ route('register') }}">تسجيل</a>
            </x-primary-button>
            <x-primary-button class="me-3"  style="margin: 5px"  >
                {{ __('تسجيل الدخول') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>