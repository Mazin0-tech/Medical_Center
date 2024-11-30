@extends('layouts.main')
@push('css')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="{{asset ('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset ('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset ('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

@endpush



@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">

            <a href="#" class="menu-logo">
                <img src="{{asset ('img\logo\logo2_footer.png')}}" class="img-fluid" alt="Logo">
            </a>

            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Doctor List</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->


<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                <!-- Profile Sidebar -->

                <!-- Profile Sidebar -->
                <div class="profile-sidebar">
                    <div class="widget-profile pro-widget-content">
                        <div class="profile-info-widget">
                            <a href="#" class="booking-doc-img">
                                <img src="{{ Auth::user()->image }}" alt="User Image">
                            </a>
                            <div class="profile-det-info">
                                <h3>Dr.{{ Auth::user()->name }} </h3>

                                <div class="patient-details">
                                    <h5 class="mb-0">{{Auth::user()->specialty}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-widget">
                        <nav class="dashboard-menu">
                            <ul>
                                <li>
                                    <a href="{{route('doctor')}}">
                                        <i class="fas fa-columns"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('appointments') }}">
                                        <i class="fas fa-calendar-check"></i>
                                        <span>Appointments</span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">

                                <li>
                                    <a class="dropdown-item" href="{{ route('settings') }}">
                                        <i class="fas fa-user-cog"></i>
                                        <span>Profile Settings</span>
                                    </a>
                                </li>
                                @if(Auth::check() && Auth::user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('all_patients') }}">
                                        <i class="fas fa-user"></i>
                                        <span>All Patients</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('all_doctors') }}">
                                        <i class="fas fa-user-md"></i>
                                        <span>All Doctors</span>
                                    </a>
                                </li>
                                @endif

                                </li>

                                <li>
                                    <form class="" action="{{route('logout')}}" method="POST">
                                        @csrf

                                        <button onclick="return confirm('Are you sure you want to logout?')"
                                            type='supmit' class="btn btn-danger w-100">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /Profile Sidebar -->

            </div>

            <div class="col-md-9 col-lg-10 col-xl-9">
                <h2 class="text-center ">All Doctors</h2>
                <div class="appointments">

                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->has('success') }}
                    </div>
                    @endif

                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 ">
                                    <div class="card">

                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>phone</th>
                                                        <th>specialty</th>
                                                        <th>Daily Appointments</th>
                                                        <th>Monthly Appointments</th>
                                                        <th>Role</th>
                                                        <th>Status</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td>
                                                            <img src="{{ $user->image }}" alt="User Image"
                                                                class="img-circle rounded-5 " style="width: 50px; ">
                                                        </td>
                                                        <td>
                                                            @if($user->role == 'doctor')
                                                            Dr. {{ $user->name }}
                                                            @else
                                                            {{ $user->name }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>{{ $user->specialty }}</td>
                                                        <td>{{ $user->daily_appointments }}</td>
                                                        <td>{{ $user->monthly_appointments }}</td>

                                                        <td>
                                                            <form action="{{ route('admin.updateRole', $user->id) }}"
                                                                method="POST" id="roleForm-{{ $user->id }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <select name="role" class="form-control"
                                                                    onchange="confirmRoleChange(this, '{{ $user->id }}')">
                                                                    <option value="patient" {{ $user->role == 'patient'
                                                                        ? 'selected' : '' }}>Patient</option>
                                                                    <option value="doctor" {{ $user->role == 'doctor' ?
                                                                        'selected' : '' }}>Doctor</option>
                                                                    <option value="admin" {{ $user->role == 'admin' ?
                                                                        'selected' : '' }}>Admin</option>
                                                                </select>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('admin.blockUser', $user->id) }}"
                                                                method="POST" id="statusForm-{{ $user->id }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <select name="status" class="form-control"
                                                                    onchange="confirmStatusChange(this, '{{ $user->id }}')">
                                                                    <option value="active" {{ $user->status === 'active'
                                                                        ? 'selected' : '' }}>Active</option>
                                                                    <option value="blocked" {{ $user->status ===
                                                                        'blocked' ? 'selected' : '' }}>Blocked</option>
                                                                </select>
                                                            </form>
                                                        </td>


                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>phone</th>
                                                        <th>specialty</th>
                                                        <th>Daily Appointments</th>
                                                        <th>Monthly Appointments</th>
                                                        <th>Role</th>
                                                        <th>Status</th>

                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->


                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->
            </div>


        </div>
    </div>
</div>

</div>

</div>
<!-- /Page Content -->


</div>
<!-- /Main Wrapper -->



@endsection

@push('js')

<!-- DataTables  & Plugins -->
<script src="{{asset ('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset ('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset ('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset ('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset ('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset ('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset ('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset ('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset ('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset ('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset ('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset ('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });

  function confirmRoleChange(selectElement, userId) {
    const selectedRole = selectElement.value;
    if (confirm(`Are you sure you want to change the role to ${selectedRole}?`)) {
        document.getElementById(`roleForm-${userId}`).submit();
    } else {
        // Reset the dropdown to the previous value
        selectElement.selectedIndex = [...selectElement.options].findIndex(option => option.defaultSelected);
    }
}

function confirmStatusChange(selectElement, userId) {
    const selectedStatus = selectElement.value;
    if (confirm(`Are you sure you want to change the status to ${selectedStatus}?`)) {
        document.getElementById(`statusForm-${userId}`).submit();
    } else {
        // Reset the dropdown to the previous value
        selectElement.selectedIndex = [...selectElement.options].findIndex(option => option.defaultSelected);
    }
}

</script>
@endpush