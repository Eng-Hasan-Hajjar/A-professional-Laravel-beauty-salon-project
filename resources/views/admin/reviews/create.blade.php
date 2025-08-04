@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>إضافة تقييم جديد</h2>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="client_id" class="form-label text-right">العميل</label>
            <select name="client_id" class="form-control @error('client_id') is-invalid @enderror" required>
                <option value="">اختر عميل</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
            @error('client_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="appointment_id" class="form-label text-right">الموعد</label>
            <select name="appointment_id" class="form-control @error('appointment_id') is-invalid @enderror" required>
                <option value="">اختر موعد</option>
                @foreach($appointments as $appointment)
                    <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>{{ $appointment->client->name ?? '-' }} ({{ \Carbon\Carbon::parse($appointment->start_time)->format('Y-m-d H:i') }})</option>
                @endforeach
            </select>
            @error('appointment_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label text-right">التقييم (1-5)</label>
            <input type="number" name="rating" min="1" max="5" class="form-control text-right @error('rating') is-invalid @enderror" value="{{ old('rating') }}" required>
            @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label text-right">التعليق</label>
            <textarea name="comment" class="form-control text-right @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
            @error('comment')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
    </form>
</div>
@endsection