@extends('admin.layouts.app')

@section('content')
<div class="container" dir="rtl">
    <h2 class="text-right">التقييمات</h2>
    <a href="{{ route('reviews.create') }}" class="btn btn-primary float-right mb-3">إضافة تقييم جديد</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="text-right">العميل</th>
                <th class="text-right">الموعد</th>
                <th class="text-right">التقييم</th>
                <th class="text-right">التعليق</th>
                <th class="text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td class="text-right">{{ $review->client->name ?? '-' }}</td>
                    <td class="text-right">{{ $review->appointment->client->name ?? '-' }} ({{ \Carbon\Carbon::parse($review->appointment->start_time)->format('Y-m-d H:i') }})</td>
                    <td class="text-right">{{ $review->rating }} / 5</td>
                    <td class="text-right">{{ $review->comment ?? '-' }}</td>
                    <td class="text-right">
                        <a href="{{ route('reviews.edit', $review) }}" class="btn btn-warning ml-2">تعديل</a>
                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection