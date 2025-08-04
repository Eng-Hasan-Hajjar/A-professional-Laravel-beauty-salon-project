@extends('admin.layouts.app')

@section('content')
<div class="container text-right" dir="rtl">
    <h2>تعديل الإشعار</h2>
    <form action="{{ route('notifications.update', $notification) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="user_id" class="form-label text-right">المستخدم</label>
            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                <option value="">اختر مستخدم (اختياري)</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $notification->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="client_id" class="form-label text-right">العميل</label>
            <select name="client_id" class="form-control @error('client_id') is-invalid @enderror">
                <option value="">اختر عميل (اختياري)</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id', $notification->client_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
            @error('client_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="title" class="form-label text-right">العنوان</label>
            <input type="text" name="title" class="form-control text-right @error('title') is-invalid @enderror" value="{{ old('title', $notification->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="message" class="form-label text-right">الرسالة</label>
            <textarea name="message" class="form-control text-right @error('message') is-invalid @enderror" required>{{ old('message', $notification->message) }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="type" class="form-label text-right">النوع</label>
            <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                <option value="appointment" {{ old('type', $notification->type) == 'appointment' ? 'selected' : '' }}>موعد</option>
                <option value="offer" {{ old('type', $notification->type) == 'offer' ? 'selected' : '' }}>عرض</option>
                <option value="general" {{ old('type', $notification->type) == 'general' ? 'selected' : '' }}>عام</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label text-right">الحالة</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="pending" {{ old('status', $notification->status) == 'pending' ? 'selected' : '' }}>معلق</option>
                <option value="sent" {{ old('status', $notification->status) == 'sent' ? 'selected' : '' }}>مرسل</option>
                <option value="failed" {{ old('status', $notification->status) == 'failed' ? 'selected' : '' }}>فشل</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">تحديث</button>
    </form>
</div>
@endsection