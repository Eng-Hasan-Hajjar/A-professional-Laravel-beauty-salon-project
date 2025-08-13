@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" dir="rtl">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">الخدمات</h1>
                </div>
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                    <div class="col-sm-6 text-left">
                        <a href="{{ route('services.create') }}" class="btn btn-primary btn-sm">إضافة خدمة جديدة</a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-right">الصورة</th>
                                <th class="text-right">اسم الخدمة</th>
                                <th class="text-right">الفئة</th>
                                <th class="text-right">السعر</th>
                                <th class="text-right">المدة (بالدقائق)</th>
                                <th class="text-right">التوفر</th>
                                <th class="text-right">الجمهور المستهدف</th>
                                <th class="text-right">المتطلبات</th>
                                <th class="text-right">مميزة</th>
                                <th class="text-right">الحالة</th>
                                <th class="text-right">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td class="text-right align-middle">
                                        @if($service->image)
                                            <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="img-fluid rounded" style="max-width: 50px; height: auto;">
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                    <td class="text-right align-middle">{{ $service->name }}</td>
                                    <td class="text-right align-middle">{{ $service->category->name ?? '-' }}</td>
                                    <td class="text-right align-middle">{{ number_format($service->price, 2) }}</td>
                                    <td class="text-right align-middle">{{ $service->duration }}</td>
                                    <td class="text-right align-middle">
                                        {{ $service->availability == 'always' ? 'متوفر دائمًا' : ($service->availability == 'seasonal' ? 'موسمي' : 'حسب الطلب') }}
                                    </td>
                                    <td class="text-right align-middle">{{ $service->target_audience ?? '-' }}</td>
                                    <td class="text-right align-middle">{{ $service->requirements ?? '-' }}</td>
                                    <td class="text-right align-middle">{{ $service->featured ? 'نعم' : 'لا' }}</td>
                                    <td class="text-right align-middle">
                                        <span class="badge {{ $service->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $service->status == 'active' ? 'نشط' : 'غير نشط' }}
                                        </span>
                                    </td>
                                    <td class="text-right align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailsModal{{ $service->id }}">عرض التفاصيل</button>
                                            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                                                <a href="{{ route('services.edit', $service) }}" class="btn btn-warning">تعديل</a>
                                                <form action="{{ route('services.destroy', $service) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal for service details -->
                                <div class="modal fade" id="detailsModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{ $service->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">
                                                <h5 class="card-title mb-0" id="detailsModalLabel{{ $service->id }}">تفاصيل الخدمة: {{ $service->name }}</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="card-body" dir="rtl">
                                                <div class="row">
                                                    @if($service->image)
                                                        <div class="col-md-4 col-12 mb-3">
                                                            <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="img-fluid rounded shadow-sm" style="max-width: 100%; width: 300px; height: auto; display: block; margin: 0 auto;">
                                                        </div>
                                                    @else
                                                        <div class="col-md-4 col-12 mb-3 text-center">
                                                            <p class="text-muted">لا توجد صورة متاحة</p>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-8 col-12">
                                                        <p><strong>اسم الخدمة:</strong> {{ $service->name }}</p>
                                                        <p><strong>الفئة:</strong> {{ $service->category->name ?? '-' }}</p>
                                                        <p><strong>السعر:</strong> {{ number_format($service->price, 2) }}</p>
                                                        <p><strong>المدة (بالدقائق):</strong> {{ $service->duration }}</p>
                                                        <p><strong>التوفر:</strong> {{ $service->availability == 'always' ? 'متوفر دائمًا' : ($service->availability == 'seasonal' ? 'موسمي' : 'حسب الطلب') }}</p>
                                                        <p><strong>الجمهور المستهدف:</strong> {{ $service->target_audience ?? '-' }}</p>
                                                        <p><strong>المتطلبات:</strong> {{ $service->requirements ?? '-' }}</p>
                                                        <p><strong>مميزة:</strong> {{ $service->featured ? 'نعم' : 'لا' }}</p>
                                                        <p><strong>الحالة:</strong> 
                                                            <span class="badge {{ $service->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                                                {{ $service->status == 'active' ? 'نشط' : 'غير نشط' }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-left">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">إغلاق</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@section('styles')
<style>
    .content-wrapper {
        font-family: 'Cairo', sans-serif;
    }
    .table img {
        border-radius: 5px;
        object-fit: cover;
    }
    .modal .card {
        border: none;
        border-radius: 0.5rem;
        overflow: hidden;
    }
    .table td, .table th {
        vertical-align: middle;
    }
    .badge {
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
    }
    @media (max-width: 767.98px) {
        .table th, .table td {
            font-size: 0.8rem;
            padding: 0.5rem;
        }
        .modal-dialog {
            margin: 0.5rem;
        }
        .btn-group .btn {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        .modal .card-body img {
            max-width: 100% !important;
            width: 200px !important;
        }
    }
</style>
@endsection
@endsection