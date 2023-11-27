@extends('layouts.admin')
@section('title', 'User ' . $user->id)

@section('content')
    <div class="modal fade" tabindex="-1" id="lock-user-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lock this user?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="lock-user-btn">Lock</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>{{ $user->role }}: {{ $user->name }}</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.users.index') }}">Users</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $user->name }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->

        <!-- ========== tables-wrapper start ========== -->
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="mb-4">
                            @if ($user->is_locked === 0)
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#lock-user-modal">
                                    Lock user
                                </button>
                            @else
                                <button class="btn btn-secondary" id="unlock-user-btn">
                                    Unlock user
                                </button>
                            @endif
                        </div>

                        <div class="mb-2">
                            Name:
                            <strong>{{ $user->name }}</strong>
                        </div>
                        <div class="mb-2">
                            Email:
                            <strong>{{ $user->email  }}</strong>
                        </div>
                        <div class="mb-2">
                            Phone:
                            <strong>{{ $user->phone_number }}</strong>
                        </div>
                        <div class="mb-2">
                            Address:
                            <strong>{{ $user->address }}</strong>
                        </div>
                        <div class="mb-2">
                            Role:
                            <strong>{{ $user->role }}</strong>
                        </div>
                        <div class="mb-2">
                            Locked:
                            <strong>{{ $user->is_locked ? 'True' : 'False' }}</strong>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== tables-wrapper end ========== -->
    </div>
@endsection

@section('scripts')
    <script>
        const lockUserModal = new bootstrap.Modal('#lock-user-modal', {
            keyboard: false
        });
        const lockUserUrl = '{{ route("admin.users.lock", [$user->id]) }}';
        const userId = '{{ $user->id }}';

        $(function () {
            $("#lock-user-btn").click(function () {
                handleToggleLock();
            });

            $("#unlock-user-btn").click(function () {
                handleToggleLock();
            });
        });

        function handleToggleLock() {
            $.ajax({
                url: lockUserUrl, 
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: userId
                },
                type: "PATCH",
                success(result) {
                    toastr.success(result.message);
                    location.reload();
                },
                error(xhr, status, error) {
                    toastr.error(xhr.responseJSON.message);
                }
            });

            lockUserModal.hide();
        }
    </script>
@endsection
