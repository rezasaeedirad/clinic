@extends('layouts.app')

@section('title', 'ثبت نام')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4 shadow">
            <h3 class="text-center mb-4">ثبت نام</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">نام کامل</label>
                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">ایمیل</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">رمز عبور</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control" name="password" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">👁️</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">تکرار رمز عبور</label>
                    <div class="input-group">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation')">👁️</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">ثبت نام</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    if (input.type === 'password') input.type = 'text';
    else input.type = 'password';
}
</script>
@endpush
