<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>داشبورد پزشک — کلینیک آنلاین</title>

    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- فونت فارسی -->
    <link href="https://fonts.bunny.net/css?family=vazirmatn:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/doctor-dashboard-simple.css') }}">
</head>
<body>

<header class="main-header shadow-sm mb-4">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand fw-bold logo" href="{{ url('/home') }}">کلینیک آنلاین</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a href="{{ route('doctor.profile.edit') }}" class="nav-link">ویرایش پروفایل</a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link p-0 m-0 align-baseline">
                            خروج
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main class="container">

    <!-- پیام موفقیت/خطا -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- بخش ۱: نوبت‌ها -->
<h3 class="mb-4">نوبت‌های من</h3>

<div class="list-group mb-5">

    @forelse($appointments as $appt)
        <div class="list-group-item d-flex justify-content-between align-items-center">

            {{-- اطلاعات نوبت --}}
            <div>
                <div class="fw-bold">
                    بیمار: {{ $appt->patient->full_name ?? '—' }}
                </div>

                <div class="small text-muted">
                    {{ $appt->appointment_date ?? '—' }}
                    —
                    {{ $appt->start_time ?? '—' }}
                </div>

                <div class="mt-1">
                    @switch($appt->status)
                        @case('booked')
                            <span class="badge bg-warning">رزرو شده</span>
                            @break
                        @case('confirmed')
                            <span class="badge bg-success">تأیید شده</span>
                            @break
                        @case('cancelled')
                            <span class="badge bg-danger">لغو شده</span>
                            @break
                        @case('pending') <!-- اضافه کردن وضعیت pending -->
                            <span class="badge bg-secondary">در انتظار</span>
                            @break
                        @default
                            <span class="badge bg-secondary">نامشخص</span>
                    @endswitch
                </div>
            </div>

            {{-- دکمه‌ها --}}
            <div class="d-flex gap-2">

                <!-- دکمه نمایش سابقه پزشکی -->
                <button
                    type="button"
                    class="btn btn-info btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#medicalHistoryModal{{ $appt->id }}"
                >
                    سابقه پزشکی
                </button>

                <!-- دکمه‌های تایید و لغو نوبت -->
                @if($appt->status === 'pending' || $appt->status === 'booked') <!-- نمایش برای pending و booked -->
                    <form method="POST" action="{{ route('doctor.appointments.confirm', $appt->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">
                            تأیید نوبت
                        </button>
                    </form>

                    <form method="POST" action="{{ route('doctor.appointments.cancel', $appt->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">
                            لغو نوبت
                        </button>
                    </form>
                @endif

            </div>
        </div>

        <!-- مودال سابقه پزشکی -->
        <div
            class="modal fade"
            id="medicalHistoryModal{{ $appt->id }}"
            tabindex="-1"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">سابقه پزشکی بیمار</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p><strong>نام بیمار:</strong> {{ $appt->patient->full_name }}</p>
                        <p><strong>شماره تماس:</strong> {{ $appt->patient->phone_number }}</p>

                        <hr>

                        @if($appt->patient->has_medical_history)
                            <div class="alert alert-info">
                                {{ $appt->patient->medical_history_text }}
                            </div>
                        @else
                            <div class="alert alert-secondary text-center">
                                این بیمار سابقه پزشکی ثبت نکرده است
                            </div>
                        @endif

                        {{-- دکمه‌های تایید و لغو نوبت داخل مودال --}}
                        @if($appt->status === 'pending' || $appt->status === 'booked') <!-- نمایش برای pending و booked -->
                            <div class="d-flex gap-2 mt-3">
                                <form method="POST" action="{{ route('doctor.appointments.confirm', $appt->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        تأیید نوبت
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('doctor.appointments.cancel', $appt->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        لغو نوبت
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                            بستن
                        </button>
                    </div>

                </div>
            </div>
        </div>

    @empty
        <div class="list-group-item text-center">
            هیچ نوبتی برای نمایش وجود ندارد.
        </div>
    @endforelse

</div>

<!-- بخش ۲: افزودن زمان آزاد -->
<div class="card mb-4">
    <div class="card-header">افزودن زمان آزاد</div>
    <div class="card-body">
        <form method="POST" action="{{ route('doctor.schedule.add') }}" class="row g-3">
            @csrf

            <div class="col-md-4">
                <label for="date" class="form-label">تاریخ</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label for="start_time" class="form-label">زمان شروع نوبت</label>
                <input type="time" id="start_time" name="start_time" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label for="end_time" class="form-label">زمان پایان نوبت</label>
                <input type="time" id="end_time" name="end_time" class="form-control">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success">افزودن</button>
            </div>
        </form>
    </div>
</div>

<!-- بخش ۳: جدول زمان‌بندی -->
<div class="card mb-5">
    <div class="card-header">زمان‌های ثبت شده</div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>تاریخ</th>
                    <th>زمان</th>
                    <th>وضعیت</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $slot)
                    <tr>
                        <td>{{ $slot->date }}</td>
                        <td>{{ $slot->start_time }} - {{ $slot->end_time ?? '—' }}</td>
                        <td>
                            @if($slot->status == 'available')
                                <span class="badge bg-secondary">آزاد</span>
                            @elseif($slot->status == 'booked')
                                <span class="badge bg-warning">رزرو شده</span>
                            @elseif($slot->status == 'confirmed')
                                <span class="badge bg-success">تأیید شده</span>
                            @elseif($slot->status == 'cancelled')
                                <span class="badge bg-danger">لغو شده</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">زمانی ثبت نشده است.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</main>

<footer class="main-footer mt-4 text-center">
    <p>© 2025 کلینیک آنلاین — تمامی حقوق محفوظ است.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
