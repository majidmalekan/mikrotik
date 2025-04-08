@extends('Layouts.app')
@section('content')
<main class="flex-1 p-6 bg-white">
    <div class="container mx-auto px-4">

        <h2 class="text-2xl font-bold mb-4 text-gray-800 text-center">لیست سوالات</h2>
        <a href="{{ route('create-faq') }}">
            <button
                class="p-6 mt-5 bg-customBlue text-white py-2 rounded transition duration-200">
                اضافه کردن سوال متداول
            </button>
        </a>
        <div class="overflow-x-auto mt-5">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">ردیف</th>
                    <th class="py-3 px-6 text-center">سوال</th>
                    <th class="py-3 px-6 text-center">جواب</th>
                    <th class="py-3 px-6 text-center">عملیات</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                @php $counter = 1; @endphp
                @foreach ( $faqs as $faq)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-center whitespace-nowrap">{{ $counter }}</td>
                        <td class="py-3 px-6 text-center">{{ $faq?->question != null ? $faq?->question: "وارد نشده" }}</td>
                        <td class="py-3 px-6 text-center">{{ $faq?->answer != null ? $faq?->answer: "وارد نشده" }}</td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{ route('edit-faq', $faq?->id) }}">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    ویرایش
                                </button>
                            </a>
                            <button onclick="showModal('delete', {{ $faq?->id }}, 'حذف')"
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 ml-2">
                                حذف
                            </button>
                        </td>
                    </tr>
                    @php $counter++; @endphp
                @endforeach
                </tbody>
            </table>
            <div class="mt-6 flex items-center justify-center gap-3">
                {{ $faqs->links() }}
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
        function showModal(action, faqId, actionText) {
            const modal = document.getElementById('confirmation-modal');
            const modalMessage = document.getElementById('modal-message');
            const confirmAction = document.getElementById('confirm-action');

            // Update modal message
            modalMessage.textContent = `آیا مطمئن هستید که می‌خواهید ${actionText} این سوال را انجام دهید؟`;

            // Update confirm button link
            if (action === 'delete') {
                confirmAction.href = `{{ route('delete-faq', ':id') }}`.replace(':id', faqId);
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
