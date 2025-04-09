@extends('Layouts.app')
@section('content')
    <main class="flex-1 p-6 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl  mb-6 text-customBlue">گزارش مصرف کاربران</h2>
            <a href="{{ route('network-logs.export-csv') }}">
                <button
                    class="p-6 mt-5 bg-customBlue text-white py-2 rounded transition duration-200">
                    📥 دانلود CSV
                </button>
            </a>
            <div class="overflow-x-auto mt-5">
                <table class="min-w-full bg-white rounded-lg shadow-md">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-center">ردیف</th>
                        <th class="py-3 px-6 text-center">IP</th>
                        <th class="py-3 px-6 text-center">MAC</th>
                        <th class="py-3 px-6 text-center">دانلود (MB)</th>
                        <th class="py-3 px-6 text-center">آپلود (MB)</th>
                        <th class="py-3 px-6 text-center">تاریخ ثبت</th>
                        <th class="py-3 px-6 text-center">تاریخ پایان</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @php $counter = 1; @endphp
                    @foreach ( $logs as $log)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-center whitespace-nowrap">{{ $counter }}</td>
                            <td class="py-3 px-6 text-center">{{ $log?->ip_address!=null?$log?->ip_address: "وارد نشده" }}</td>
                            <td class="py-3 px-6 text-center">{{ $log?->mac_address!=null?$log?->mac_address: "وارد نشده" }}</td>
                            <td class="py-3 px-6 text-center">{{ round($log?->download_bytes / 1024 / 1024, 2) }}</td>
                            <td class="py-3 px-6 text-center">{{ round($log?->upload_bytes / 1024 / 1024, 2) }}</td>
                            <td class="py-3 px-6 text-center">{{  $log?->created_at }}</td>
                            <td class="py-3 px-6 text-center">{{  $log?->finished_at }}</td>
                        </tr>
                        @php $counter++; @endphp
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-6 flex items-center justify-center gap-3">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
