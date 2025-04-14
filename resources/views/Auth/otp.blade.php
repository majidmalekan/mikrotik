<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه رمز موقت</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white flex  justify-center min-h-screen font-IRANSans ">
<div class="text-center">
    @if ($errors->any())
        <div class="fixed top-5 right-5 space-y-2">
            @foreach ($errors->all() as $error)
                <div class="bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-center">
                    <span class="mr-2">⚠️</span>
                    <span>{{ $error }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-white font-bold">✖</button>
                </div>
            @endforeach
        </div>
    @endif
    <div class="mt-5">
        <img src="{{ asset('Image/logo.jpg') }}" alt="Logo" class="mx-auto" style="height: 200px">
    </div>
    <div class="bg-white shadow-custom rounded-lg p-8 max-w-sm mx-auto mt-10 w-3/4 lg:w-full md:w-full">
        <h2 class="text-gray-800 text-lg font-semibold">ناحیه نوآوری شریف</h2>
        <p class="text-gray-700 mt-4">برای دسترسی به اینترنت کد تایید خود را وارد کنید</p>


        <form id="md-form"
              class="mt-10"
              autocomplete="off"
              method="post"
              action="{{ route('otp') }}">
            @csrf
            <label for="otp" class="flex text-gray-500">
                کد تایید
            </label>
            <input type="text"
                   pattern="\d+"
                   name="otp"
                   class="w-full p-3 border border-gray-300 rounded mb-4 text-right focus:outline-none focus:ring-2 focus:ring-blue-500">
            <label for="phone">
                <input type="text"
                       hidden
                       name="phone"
                       value="{{ request()->get('phone') }}"
                       class="w-full p-3 border border-gray-300 rounded mb-4 text-right focus:outline-none focus:ring-2 focus:ring-blue-500">
            </label>

{{--            <div class="mx-auto flex flex-col">--}}
                <!-- Submit Button -->
                <button
                    id="submitBtn"
                    class="p-6 mt-5 bg-customBlue text-white py-2 rounded transition duration-200"
                    type="submit">
                    تایید
                </button>
                <button
                    type="button"
                    id="resendBtn"
                    disabled
                    class="mt-3 text-sm text-white bg-gray-400 hover:bg-gray-500 px-4 py-2 rounded transition">
                    {{ floor(($expireIn ?? 90) / 60) }}:{{ str_pad(($expireIn ?? 90) % 60, 2, '0', STR_PAD_LEFT) }}
                </button>
{{--            </div>--}}


        </form>
    </div>
</div>
<script>
    let resendBtn = document.getElementById('resendBtn');
    let submitBtn = document.getElementById('submitBtn');
    let seconds = {{ env('OTP_EXPIRES_IN') ?? 90 }};
    const phone = '{{ request()->get('phone') }}';

    function updateTimer() {
        if (seconds > 0) {
            resendBtn.disabled = true;
            resendBtn.classList.remove('bg-blue-600');
            resendBtn.classList.add('bg-gray-400');
            resendBtn.textContent = `ارسال مجدد کد در ${Math.floor(seconds / 60)}:${String(seconds % 60).padStart(2, '0')}`;

            submitBtn.disabled = false;
            submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
            submitBtn.classList.add('bg-customBlue');

            seconds--;
            setTimeout(updateTimer, 1000);
        } else {
            resendBtn.disabled = false;
            resendBtn.textContent = 'ارسال مجدد کد تایید';
            resendBtn.classList.remove('bg-gray-400');
            resendBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');

            submitBtn.disabled = true;
            submitBtn.classList.remove('bg-customBlue');
            submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
        }
    }

    resendBtn.addEventListener('click', function () {
        resendBtn.disabled = true;
        resendBtn.textContent = 'در حال ارسال...';

        fetch('{{ route('otp.resend') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ phone })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    seconds = data.expireIn || 90;
                    updateTimer();
                } else {
                    resendBtn.textContent = 'خطا در ارسال مجدد';
                }
            })
            .catch(() => {
                resendBtn.textContent = 'خطا در ارسال';
            });
    });

    updateTimer();
</script>



</body>

</html>
