@extends('Layouts.app')
@section('content')
<main class="flex-1 p-6 bg-white">
    <h2 class="text-2xl  mb-6 text-customBlue">ویرایش سوال</h2>
    <div class="shadow-md rounded px-8 pt-6 pb-8 w-full">
        @if ( $errors->any())
            <div class="fixed top-5 right-5 space-y-2">
                @foreach ( $errors->all() as $error)
                    <div class="bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-center">
                        <span class="mr-2">⚠️</span>
                        <span>{{ $error }}</span>
                        <button onclick="this.parentElement.remove()" class="ml-auto text-white font-bold">✖</button>
                    </div>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('update-faq', $faq?->id) }}">
            @csrf
            <!-- Name Field -->
            <div class="flex w-full">
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="question">سوال</label>
                    <input type="text" name="question" id="question" value="{{ old('question', $faq->question) }}"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                           >
                </div>
            </div>
            <div class="flex w-full">
                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="answer">جواب</label>
                    <textarea type="text" name="answer" id="answer" rows="10"
                              class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                              >
                        {{ old('answer', $faq->answer) }}
                    </textarea>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="flex items-center mt-4">
                <button
                    class="p-6 mt-5 bg-customBlue text-white py-2 rounded transition duration-200"
                    type="submit">
                    اعمال تغییرات
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#answer'), {
                language: 'fa'
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
