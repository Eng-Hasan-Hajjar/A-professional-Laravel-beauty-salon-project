@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>تعديل ربط الخدمة بالموعد</h2>
    <form action="{{ route('appointment-services.update', $appointmentService) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="appointment_id" class="form-label text-right">الموعد</label>
            <select name="appointment_id" class="form-control @error('appointment_id') is-invalid @enderror" required>
                <option value="">اختر موعد</option>
                @foreach($appointments as $appointment)
                    <option value="{{ $appointment->id }}" {{ old('appointment_id', $appointmentService->appointment_id) == $appointment->id ? 'selected' : '' }}>{{ $appointment->client->name ?? '-' }} ({{ \Carbon\Carbon::parse($appointment->start_time)->format('Y-m-d H:i') }})</option>
                @endforeach
            </select>
            @error('appointment_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="service_id" class="form-label text-right">الخدمة</label>
            <select name="service_id" class="form-control @error('service_id') is-invalid @enderror" required>
                <option value="">اختر خدمة</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id', $appointmentService->service_id) == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                @endforeach
            </select>
            @error('service_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label text-right">السعر</label>
            <input type="number" name="price" step="0.01" class="form-control text-right @error('price') is-invalid @enderror" value="{{ old('price', $appointmentService->price) }}" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">تحديث</button>
    </form>
</div>
@endsection