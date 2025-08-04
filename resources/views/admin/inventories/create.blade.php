@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>إضافة عنصر مخزون جديد</h2>
    <form action="{{ route('inventories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label text-right">اسم العنصر</label>
            <input type="text" name="name" class="form-control text-right @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label text-right">الوصف</label>
            <textarea name="description" class="form-control text-right @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label text-right">الكمية</label>
            <input type="number" name="quantity" class="form-control text-right @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" required>
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="unit_price" class="form-label text-right">سعر الوحدة</label>
            <input type="number" name="unit_price" step="0.01" class="form-control text-right @error('unit_price') is-invalid @enderror" value="{{ old('unit_price') }}" required>
            @error('unit_price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="minimum_stock" class="form-label text-right">الحد الأدنى للمخزون</label>
            <input type="number" name="minimum_stock" class="form-control text-right @error('minimum_stock') is-invalid @enderror" value="{{ old('minimum_stock') }}" required>
            @error('minimum_stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
    </form>
</div>
@endsection