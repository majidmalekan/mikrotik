<footer class="bg-gray-100 text-center py-6 text-sm text-gray-700 border-t mt-10">
    @if( auth()->user()->role==\App\Enums\UserRoleEnum::User()->value)
        <div class="max-w-4xl mx-auto space-y-2">
            <div class="text-gray-600">
                در صورت وجود مشکل یا نیاز به پشتیبانی از طریق شبکه‌های اجتماعی زیر با ما در تماس باشید:
            </div>

            <div class="flex justify-center gap-4 text-lg mt-2">
                <!-- Telegram -->
                <a href="https://t.me/YourSupportUsername" target="_blank" class="text-blue-500 hover:text-blue-700 transition">
                    <i class="fab fa-telegram-plane"></i>
                </a>

                <!-- Bale -->
                <a href="https://ble.ir/YourBaleUsername" target="_blank" class="text-blue-400 hover:text-blue-600 transition">
                    <i class="fas fa-comment-dots"></i> {{-- چون Bale آیکون اختصاصی نداره، یکی شبیه‌ش رو استفاده می‌کنیم --}}
                </a>

                <!-- Email -->
                <a href="mailto:Info@pomas.ir" class="text-red-500 hover:text-red-700 transition">
                    <i class="fas fa-envelope"></i>
                </a>

                <!-- Phone -->
                <a href="tel:09370414609" class="text-green-600 hover:text-green-800 transition">
                    <i class="fas fa-phone-alt"></i>
                </a>
            </div>

            <p class="text-xs text-gray-500 mt-2">شماره پشتیبانی: ۰۹۳۷۰۴۱۴۶۰۹ | ایمیل: Info@pomas.ir</p>
        </div>
    @endif
    <div class="mt-3 flex flex-col">
        <p>© {{ jdate()->getYear() }} ناحیه نوآوری شریف</p>
        <p>تمامی حقوق محفوظ است.</p>
    </div>

</footer>

