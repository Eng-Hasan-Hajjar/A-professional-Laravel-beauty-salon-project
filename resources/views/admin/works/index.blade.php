@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" dir="rtl">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الأعمال</h1>
                </div>
                <div class="col-sm-6">
                                    @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager'))

                    <div class="float-left">
                        <a href="{{ route('works.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> إضافة عمل جديد
                        </a>
                    </div>

                    @endif

                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline w-100">
                        <div class="card-header" dir="rtl" style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="card-title">قائمة الأعمال</h3>
                            <div class="card-tools">
                                <form action="{{ route('works.index') }}" method="GET" class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="search" class="form-control float-right" placeholder="بحث باسم العمل أو الموظف..." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show text-right" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show text-right" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <table class="table table-hover table-bordered table-striped text-right m-0">
                                <thead>
                                    <tr>
                                        <th style="width: 30%">اسم العمل</th>
                                        <th style="width: 20%">تاريخ البدء</th>
                                        <th style="width: 20%">تاريخ الانتهاء</th>
                                        <th style="width: 20%">الموظف</th>

                                                        @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager'))


                                        <th style="width: 10%">الإجراءات</th>

                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($works as $work)
                                        <tr>
                                            <td>{{ $work->title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($work->start_date)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($work->end_date)->format('d-m-Y') }}</td>
                                            <td>{{ $work->employee->user->name ?? 'غير متوفر' }}</td>
                                        
                                        
                                             @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager'))

                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('works.edit', $work) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i> تعديل
                                                    </a>
                                                    <form action="{{ route('works.destroy', $work) }}" method="POST" style="display:inline;" class="ml-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                            <i class="fas fa-trash"></i> حذف
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted p-4">
                                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                                لا توجد أعمال مسجلة
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix w-100">
                            <small class="text-muted">آخر تحديث: {{ now()->format('Y-m-d H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection