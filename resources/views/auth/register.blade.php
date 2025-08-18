<x-guest-layout>
   <h1 style="text-align: center"> إنشاء حساب   </h1>
   
   <br>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" dir="rtl">
        @csrf

        <!-- الاسم -->
        <div>
            <x-input-label for="name" :value="__('الاسم')" />
            <x-text-input id="name" class="block mt-1 w-full text-right" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- البريد الإلكتروني -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('البريد الإلكتروني')" />
            <x-text-input id="email" class="block mt-1 w-full text-right" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- كلمة المرور -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('كلمة المرور')" />
            <x-text-input id="password" class="block mt-1 w-full text-right"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- تأكيد كلمة المرور -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full text-right"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- الصورة الشخصية -->
        <div class="mb-3" hidden>
            <label for="profile_image" class="form-label">الصورة الشخصية (اختياري)</label>
            <input type="file" class="form-control text-right" name="profile_image" accept="image/*">
        </div>

        <!-- إيصال الدفع -->
        <div class="mb-3" hidden>
            <label for="payment_receipt" class="form-label">إيصال الدفع (اختياري)</label>
            <input type="file" class="form-control text-right" name="payment_receipt" accept="image/*">
        </div>

        <div class="flex items-center justify-start mt-4"style="margin: 20px ; text-align: center;float:left" dir="auto">
            <x-primary-button class="me-3" style="margin: 10px">
                <a href="{{ route('indexproperty') }}">الموقع</a>
            </x-primary-button>

            <x-primary-button class="me-4">
                {{ __('تسجيل') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>