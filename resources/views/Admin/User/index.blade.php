@extends('Layouts.app')
@section('content')
<main class="flex-1 p-6 bg-white">
    <div class="container mx-auto px-4">

        <h2 class="text-2xl font-bold mb-4 text-gray-800 text-center">لیست کاربران</h2>
        <a href="{{ route('add-user') }}">
            <button
                class="p-6 mt-5 bg-customBlue text-white py-2 rounded transition duration-200">
                اضافه کردن کاربر
            </button>
        </a>
        <div class="overflow-x-auto mt-5">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">ردیف</th>
                    <th class="py-3 px-6 text-center">نام</th>
                    <th class="py-3 px-6 text-center">نام کاربری</th>
                    <th class="py-3 px-6 text-center">شماره تماس</th>
                    <th class="py-3 px-6 text-center">نوع کاربر</th>
                    <th class="py-3 px-6 text-center">حجم مصرف شده</th>
                    <th class="py-3 px-6 text-center">حجم مجاز مصرفی</th>
                    <th class="py-3 px-6 text-center">عملیات</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                @php $counter = 1; @endphp
                @foreach ( $users as $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-center whitespace-nowrap">{{ $counter }}</td>
                        <td class="py-3 px-6 text-center">{{ $user?->name!=null?$user?->name:"وارد نشده" }}</td>
                        <td class="py-3 px-6 text-center">{{ $user?->username!=null?$user?->username:"وارد نشده" }}</td>
                        <td class="py-3 px-6 text-center">{{ $user?->phone }}</td>
                        <td class="py-3 px-6 text-center">{{ $user->is_admin?"کاربر مدیر": ($user?->is_vip?"کاربر ویژه":"کاربر عادی") }}</td>
                        <td class="py-3 px-6 text-center">{{  $user?->traffic." مگابایت" }}</td>
                        <td class="py-3 px-6 text-center">{{ ($user->is_vip?"بی نهایت":$user?->traffic_limit." گیگابایت") }}</td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{ route('edit-user', $user?->id) }}">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">ویرایش
                                </button>
                            </a>
                            <button
                                onclick="showModal('block', {{ $user->id }}, '{{ $user->status == 'active' ? 'مسدودسازی' : 'فعالسازی' }}')"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                                {{ $user->status == 'active' ? 'مسدودسازی' : 'فعالسازی' }}
                            </button>
                            <button onclick="showModal('delete', {{ $user->id }}, 'حذف')"
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 ml-2">حذف
                            </button>
                        </td>
                    </tr>
                    @php $counter++; @endphp
                @endforeach
                </tbody>
            </table>
            <div class="mt-6 flex items-center justify-center gap-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</main>
<!-- Modal -->
<div id="confirmation-modal" data-modal
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-lg font-bold mb-4 text-gray-800 text-center">تایید عملیات</h2>
        <p class="text-gray-600 text-center mb-6" id="modal-message">آیا مطمئن هستید که می‌خواهید این عملیات را انجام
            دهید؟</p>
        <div class="flex justify-center">
            <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 mx-2">
                انصراف
            </button>
            <a id="confirm-action" href="#">
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 mx-2">تایید</button>
            </a>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        // Show the modal and update its content
        function showModal(action, userId, actionText) {
            const modal = document.getElementById('confirmation-modal');
            const modalMessage = document.getElementById('modal-message');
            const confirmAction = document.getElementById('confirm-action');

            // Update modal message
            modalMessage.textContent = `آیا مطمئن هستید که می‌خواهید ${actionText} این کاربر را انجام دهید؟`;

            // Update confirm button link
            if (action === 'delete') {
                confirmAction.href = `{{ route('delete-user', ':id') }}`.replace(':id', userId);
            } else if (action === 'block') {
                confirmAction.href = `{{ route('block-user', ':id') }}`.replace(':id', userId);
            }

            // Show the modal
            modal.style.display = 'flex';
        }

        // Close the modal
        function closeModal() {
            const modal = document.getElementById('confirmation-modal');
            modal.style.display = 'none';
        }
    </script>
@endpush

