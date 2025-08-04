@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>تعديل ربط المخزون بالخدمة</h2>
    <form action="{{ route('service-inventories.update', $serviceInventory) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="service_id" class="form-label text-right">الخدمة</label>
            <select name="service_id" class="form-control @error('service_id') is-invalid @enderror" required>
                <option value="">اختر خدمة</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id', $serviceInventory->service_id) == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                @endforeach
            </select>
            @error('service_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="inventory_id" class="form-label text-right">عنصر المخزون</label>
            <select name="inventory_id" class="form-control @error('inventory_id') is-invalid @enderror" required>
                <option value="">اختر عنصر مخزون</option>
                @foreach($inventories as $inventory)
                    <option value="{{ $inventory->id }}" {{ old('inventory_id', $serviceInventory->inventory_id) == $inventory->id ? 'selected' : '' }}>{{ $inventory->name }}</option>
                @endforeach
            </select>
            @error('inventory_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="quantity_used" class="form-label text-right">الكمية المستخدمة</label>
            <input type="number" name="quantity_used" step="0.01" class="form-control text-right @error('quantity_used') is-invalid @enderror" value="{{ old('quantity_used', $serviceInventory->quantity_used) }}" required>
            @error('quantity_used')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">تحديث</button>
    </form>
</div>
@endsection