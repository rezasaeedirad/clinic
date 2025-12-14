<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>داشبورد بیمار — کلینیک آنلاین</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.bunny.net/css?family=vazirmatn:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard-patient.css') }}">
</head>
<body>

<!-- HEADER -->
<header class="main-header shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand fw-bold logo" href="#">کلینیک آنلاین</a>
        <div class="collapse navbar-collapse">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-link nav-link">خروج</button>
            </form>
        </div>
    </nav>
</header>

<main class="container my-4">
<div class="row g-4">

<!-- LEFT -->
<div class="col-lg-4">
<div class="card shadow-sm mb-3">
<div class="card-body">

<h5 class="mb-3">پروفایل شما</h5>

<div class="fw-bold">
    {{ auth()->user()->patient->full_name ?? 'بیمار' }}
</div>

<hr>

<h6>نوبت‌های شما</h6>
<div class="list-group">
    @forelse(auth()->user()->patient->appointments ?? [] as $appointment)
        <div class="list-group-item">
            <div class="fw-bold mb-1">نام پزشک: {{ $appointment->doctor->full_name }}</div>
            <div class="text-muted">تاریخ: {{ $appointment->appointment_date ?? '—' }}</div>
            <div class="text-muted">زمان: {{ $appointment->start_time ?? '—' }}</div>
            <div class="text-muted">وضعیت: 
                <span class="badge 
                    @if($appointment->status == 'confirmed') bg-success 
                    @elseif($appointment->status == 'cancelled') bg-danger 
                    @elseif($appointment->status == 'pending') bg-warning 
                    @else bg-secondary @endif">
                    {{ ucfirst($appointment->status) }}
                </span>
            </div> <!-- نمایش وضعیت نوبت -->
        </div>
    @empty
        <div class="list-group-item text-center">
            نوبتی ثبت نشده است
        </div>
    @endforelse
</div>

</div>
</div>
</div>

<!-- RIGHT -->
<div class="col-lg-8">
<div class="card shadow-sm">
<div class="card-header bg-primary text-white">
    جستجوی پزشکان
</div>
<div class="card-body">

<form id="searchForm" class="row g-2 mb-3">
    <div class="col-md-4">
        <input name="name" class="form-control" placeholder="نام پزشک">
    </div>
    <div class="col-md-4">
        <input name="specialty" class="form-control" placeholder="تخصص">
    </div>
    <div class="col-md-4">
        <input name="address" class="form-control" placeholder="آدرس">
    </div>
    <div class="col-12">
        <button class="btn btn-primary">جستجو</button>
    </div>
</form>

<div class="row g-3" id="doctorResults"></div>

</div>
</div>
</div>

</div>
</main>

<!-- MODAL رزرو -->
<div class="modal fade" id="scheduleModal">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title">انتخاب زمان</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div id="scheduleList" class="list-group"></div>
</div>

</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$('#searchForm').submit(function(e){
    e.preventDefault();

    $.get("{{ route('patient.search.doctors') }}", $(this).serialize(), function(doctors){

        let html = '';
        doctors.forEach(doc => {
            html += `
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6>${doc.user.name}</h6>
                        <p class="text-muted">${doc.specialty ?? ''}</p>
                        <div class="d-flex gap-2">
                            <!-- دکمه نمایش مشخصات پزشک -->
                            <button class="btn btn-info btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#doctorModal${doc.id}">
                                نمایش مشخصات پزشک
                            </button>

                            <!-- دکمه رزرو نوبت -->
                            <button class="btn btn-success btn-sm"
                                    onclick="loadSchedules(${doc.id})">
                                رزرو نوبت
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- مودال مشخصات پزشک -->
            <div class="modal fade" id="doctorModal${doc.id}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">مشخصات ${doc.user.name}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>نام کامل:</strong> ${doc.user.name}</p>
                            <p><strong>تخصص:</strong> ${doc.specialty ?? '—'}</p>
                            <p><strong>بیو:</strong> ${doc.bio ?? '—'}</p>
                            <p><strong>شماره تماس:</strong> ${doc.phone ?? '—'}</p>
                            <p><strong>آدرس کلینیک:</strong> ${doc.address ?? '—'}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                        </div>
                    </div>
                </div>
            </div>
            `;
        });

        $('#doctorResults').html(html);
    });
});

function loadSchedules(doctorId)
{
    $.get(`/patient/doctor/${doctorId}/schedules`, function(schedules){

        let html = '';
        schedules.forEach(s => {
            html += `
            <div class="list-group-item d-flex justify-content-between">
                <span>${s.date} — ${s.start_time}</span>
                <form method="POST" action="/patient/appointments/book/${s.id}">
                @csrf
                <button class="btn btn-success btn-sm">رزرو</button>
                </form>
            </div>`;
        });

        $('#scheduleList').html(html);
        new bootstrap.Modal(document.getElementById('scheduleModal')).show();
    });
}
</script>

</body>
</html>
