@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>تعديل جدول الموظف</h2>
    <form action="{{ route('employee-schedules.update', $employeeSchedule) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="employee_id" class="form-label text-right">الموظف</label>
            <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
                <option value="">اختر موظف</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('employee_id', $employeeSchedule->employee_id) == $employee->id ? 'selected' : '' }}>{{ $employee->user->name ?? '-' }}</option>
                @endforeach
            </select>
            @error('employee_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="day_of_week" class="form-label text-right">اليوم</label>
            <select name="day_of_week" class="form-control @error('day_of_week') is-invalid @enderror" required>
                <option value="">اختر يوم</option>
                <option value="Monday" {{ old('day_of_week', $employeeSchedule->day_of_week) == 'Monday' ? 'selected' : '' }}>الإثنين</option>
                <option value="Tuesday" {{ old('day_of_week', $employeeSchedule->day_of_week) == 'Tuesday' ? 'selected' : '' }}>الثلاثاء</option>
                <option value="Wednesday" {{ old('day_of_week', $employeeSchedule->day_of_week) == 'Wednesday' ? 'selected' : '' }}>الأربعاء</option>
                <option value="Thursday" {{ old('day_of_week', $employeeSchedule->day_of_week) == 'Thursday' ? 'selected' : '' }}>الخميس</option>
                <option value="Friday" {{ old('day_of_week', $employeeSchedule->day_of_week) == 'Friday' ? 'selected' : '' }}>الجمعة</option>
                <option value="Saturday" {{ old('day_of_week', $employeeSchedule->day_of_week) == 'Saturday' ? 'selected' : '' }}>السبت</option>
                <option value="Sunday" {{ old('day_of_week', $employeeSchedule->day_of_week) == 'Sunday' ? 'selected' : '' }}>الأحد</option>
            </select>
            @error('day_of_week')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label text-right">وقت البدء</label>
            <input type="time" name="start_time" class="form-control text-right @error('start_time') is-invalid @enderror" value="{{ old('start_time', \Carbon\Carbon::parse($employeeSchedule->start_time)->format('H:i')) }}" required>
            @error('start_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="end_time" class="form-label text-right">وقت الانتهاء</label>
            <input type="time" name="end_time" class="form-control text-right @error('end_time') is-invalid @enderror" value="{{ old('end_time', \Carbon\Carbon::parse($employeeSchedule->end_time)->format('H:i')) }}" required>
            @error('end_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label text-right">الحالة</label>
           <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>متاح</option>
                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>غير متاح</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">تحديث</button>
    </form>
</div>
@endsection