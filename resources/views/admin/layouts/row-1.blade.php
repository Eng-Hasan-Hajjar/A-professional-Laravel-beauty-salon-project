
<div class="content">
    <div class="container-fluid">
        <!-- Info Boxes -->
        <div class="row">
            <!-- Total Clients -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-box">
                     <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content text-right">
                        <span class="info-box-text">إجمالي العملاء</span>
                        <span class="info-box-number">{{ number_format($totalClients) }}</span>
                    </div>
                </div>
            </div>

            <!-- Total Appointments -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-check"></i></span>
                    <div class="info-box-content text-right">
                        <span class="info-box-text">مواعيد هذا الشهر</span>
                        <span class="info-box-number">{{ number_format($totalAppointments) }}</span>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-bill-wave"></i></span>
                    <div class="info-box-content text-right">
                        <span class="info-box-text">إيرادات هذا الشهر</span>
                        <span class="info-box-number">{{ number_format($totalRevenue, 2) }} ₽</span>
                    </div>
                </div>
            </div>

            <!-- Active Employees -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-tie"></i></span>
                    <div class="info-box-content text-right">
                        <span class="info-box-text">الموظفون النشطون</span>
                        <span class="info-box-number">{{ number_format($activeEmployees) }}</span>
                    </div>
                </div>
            </div>

            <!-- Active Services -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-concierge-bell"></i></span>
                    <div class="info-box-content text-right">
                        <span class="info-box-text">الخدمات النشطة</span>
                        <span class="info-box-number">{{ number_format($activeServices) }}</span>
                    </div>
                </div>
            </div>

            <!-- Low Inventory Alerts -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-exclamation-triangle"></i></span>
                    <div class="info-box-content text-right">
                        <span class="info-box-text">تنبيهات المخزون المنخفض</span>
                        <span class="info-box-number">{{ number_format($lowInventoryCount) }}</span>
                    </div>
                </div>
            </div>

            <!-- Average Client Rating -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-star"></i></span>
                    <div class="info-box-content text-right">
                        <span class="info-box-text">متوسط تقييم العملاء</span>
                        <span class="info-box-number">{{ number_format($averageRating, 1) }} / 5</span>
                    </div>
                </div>
            </div>

            <!-- Active Offers -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-olive elevation-1"><i class="fas fa-tags"></i></span>
                    <div class="info-box-content text-right">
                        <span class="info-box-text">العروض النشطة</span>
                        <span class="info-box-number">{{ number_format($activeOffers) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Appointments -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-right">آخر المواعيد</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-right">العميل</th>
                                    <th class="text-right">الموظف</th>
                                    <th class="text-right">وقت البدء</th>
                                    <th class="text-right">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($recentAppointments as $appointment)
                                    <tr>
                                        <td class="text-right">{{ $appointment->client->name ?? '-' }}</td>
                                        <td class="text-right">{{ $appointment->employee->user->name ?? '-' }}</td>
                                        <td class="text-right">{{ \Carbon\Carbon::parse($appointment->start_time)->format('Y-m-d H:i') }}</td>
                                        <td class="text-right">
                                            @php
                                                $statusTranslations = [
                                                    'confirmed' => 'مؤكد',
                                                    'completed' => 'مكتمل',
                                                    'cancelled' => 'ملغى',
                                                    'pending' => 'معلق',
                                                ];
                                            @endphp
                                            {{ $statusTranslations[$appointment->status] ?? 'معلق' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
