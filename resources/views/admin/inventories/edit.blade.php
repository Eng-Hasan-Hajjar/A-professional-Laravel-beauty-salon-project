@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>تعديل عنصر المخزون</h2>
    <form action="{{ route('inventories.update', $inventory) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label text-right">اسم العنصر</label>
            <input type="text" name="name" class="form-control text-right @error('name') is-invalid @enderror" value="{{ old('name', $inventory->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label text-right">الوصف</label>
            <textarea name="description" class="form-control text-right @error('description') is-invalid @enderror">{{ old('description', $inventory->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label text-right">صورة العنصر</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png">
            @if ($inventory->image && File::exists(public_path($inventory->image)))
                <div class="mt-2">
                    <img src="{{ asset($inventory->image) }}" alt="{{ $inventory->name }}" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
            @endif
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label text-right">الكمية</label>
            <input type="number" name="quantity" class="form-control text-right @error('quantity') is-invalid @enderror" value="{{ old('quantity', $inventory->quantity) }}" required>
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="unit_price" class="form-label text-right">سعر الوحدة</label>
            <input type="number" name="unit_price" step="0.01" class="form-control text-right @error('unit_price') is-invalid @enderror" value="{{ old('unit_price', $inventory->unit_price) }}" required>
            @error('unit_price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="minimum_stock" class="form-label text-right">الحد الأدنى للمخزون</label>
            <input type="number" name="minimum_stock" class="form-control text-right @error('minimum_stock') is-invalid @enderror" value="{{ old('minimum_stock', $inventory->minimum_stock) }}" required>
            @error('minimum_stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">تحديث</button>
    </form>
</div>
@endsection