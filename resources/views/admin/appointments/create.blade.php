@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>إضافة موعد جديد</h2>
    <form action="{{ route('appointments.store') }}" method="POST">
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
            <label for="employee_id" class="form-label text-right">الموظف</label>
            <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
                <option value="">اختر موظف</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->user->name ?? '-' }}</option>
                @endforeach
            </select>
            @error('employee_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label text-right">وقت البدء</label>
            <input type="datetime-local" name="start_time" class="form-control text-right @error('start_time') is-invalid @enderror" value="{{ old('start_time') }}" required>
            @error('start_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="end_time" class="form-label text-right">وقت الانتهاء</label>
            <input type="datetime-local" name="end_time" class="form-control text-right @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}" required>
            @error('end_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="services" class="form-label text-right">الخدمات</label>
            <select name="services[]" class="form-control @error('services') is-invalid @enderror" multiple required>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ in_array($service->id, old('services', [])) ? 'selected' : '' }}>{{ $service->name }}</option>
                @endforeach
            </select>
            @error('services')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label text-right">الحالة</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>معلق</option>
                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>ملغى</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label text-right">ملاحظات</label>
            <textarea name="notes" class="form-control text-right @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
            @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
    </form>
</div>
@endsection