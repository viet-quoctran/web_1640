@extends('admin.master.master')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
        @if(Auth::user()->role_id == 3)
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Magazines
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Faculties</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($magazines as $magazine)
                        <tr>
                            <td>{{ $magazine->id }}</td>
                            <td>{{ $magazine->name }}</td>
                            <td>{{ $magazine->faculties->name }}</td>
                            <td>
                                <!-- Update Button -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateMagazinesModal{{ $magazine->id }}">
                                    Update
                                </button>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('delete.magazines', $magazine->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Update Faculties Modal -->
                        <div class="modal fade" id="updateMagazinesModal{{ $magazine->id }}" tabindex="-1" aria-labelledby="updateMagazinesModalLabel{{ $magazine->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateMagazinesModalLabel{{ $magazine->id }}">Update Magazines</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('update.magazines', $magazine->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name{{ $magazine->id }}" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name{{ $magazine->id }}" name="name" value="{{ $magazine->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="faculty_name" class="form-label">Faculties</label>
                                                <input type="hidden" name="faculties_magazines" value="{{ Auth::user()->faculties->id }}">
                                                <input type="text" class="form-control" id="faculty_name" value="{{ Auth::user()->faculties->name }}" readonly>
                                            </div>
                                        </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update Magazines</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    @endforeach
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMagazinesModal">
                        Add Magazines
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addMagazinesModal" tabindex="-1" aria-labelledby="addMagazinesModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addMagazinesModalLabel">Add New Magazines</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('store.magazines') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <!-- Form fields -->
                                    <div class="mb-3">  
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="faculty_name" class="form-label">Faculties</label>
                                        <input type="hidden" name="faculties_magazines" value="{{ Auth::user()->faculties->id }}">
                                        <input type="text" class="form-control" id="faculty_name" value="{{ Auth::user()->faculties->name }}" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Magazines</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Post
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Word</th>
                            <th>Image</th>
                            <th>Email Student</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contributions as $contribution)
                            <tr>
                                <td>
                                    @foreach ($contribution->words as $word)
                                        <a href="{{ asset('storage/' . $word->path) }}" download>Download Here</a><br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($contribution->images as $image)
                                        <a href="{{ asset('storage/' . $image->path) }}" download>Download Here</a><br>
                                    @endforeach
                                </td>
                                <td>{{ $contribution->user->email ?? 'N/A' }}</td>
                                <td>{{ $contribution->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @if(Auth::user()->role_id == 1)
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Faculties
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faculties as $facultie)
                        <tr>
                            <td>{{ $facultie->id }}</td>
                            <td>{{ $facultie->name }}</td>
                            <td>
                                <!-- Update Button -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateFacultiesModal{{ $facultie->id }}">
                                    Update
                                </button>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('delete.faculties', $facultie->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Update Faculties Modal -->
                        <div class="modal fade" id="updateFacultiesModal{{ $facultie->id }}" tabindex="-1" aria-labelledby="updateFacultiesModalLabel{{ $facultie->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateFacultiesModalLabel{{ $facultie->id }}">Update Faculties</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('update.faculties', $facultie->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name{{ $facultie->id }}" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name{{ $facultie->id }}" name="name" value="{{ $facultie->name }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update Faculties</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    @endforeach
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFacultiesModal">
                        Add Faculties
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addFacultiesModal" tabindex="-1" aria-labelledby="addFacultiesModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addFacultiesModalLabel">Add New Faculties</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('store.faculties') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <!-- Form fields -->
                                    <div class="mb-3">  
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Faculties</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Accounts
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Faculty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name ?? 'N/A' }}</td> <!-- Giả sử mỗi user đều thuộc về một Role -->
                            <td>{{ $user->faculties->name ?? 'N/A' }}</th>
                            <td>
                                <!-- Update Button -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateUserModal{{ $user->id }}">
                                    Update
                                </button>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('delete.user', $user->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Update User Modal -->
                        <div class="modal fade" id="updateUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="updateUserModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateUserModalLabel{{ $user->id }}">Update User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('update.user', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name{{ $user->id }}" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email{{ $user->id }}" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="role_id{{ $user->id }}" class="form-label">Role</label>
                                                <select class="form-select" id="role_id{{ $user->id }}" name="role_id" required>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}" @if($user->role_id == $role->id) selected @endif>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3" id="facultiesDiv{{ $user->id }}">
                                                <label for="faculties_id{{ $user->id }}" class="form-label">Faculties</label>
                                                <select class="form-select" id="faculties_id{{ $user->id }}" name="faculties_id" required>
                                                    @foreach($faculties as $facultie)
                                                        <option value="{{ $facultie->id }}">{{ $facultie->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update User</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    @endforeach
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        Add User
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('store.user') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <!-- Form fields -->
                                <div class="mb-3">  
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role_id_new" class="form-label">Role</label>
                                    <select class="form-select" id="role_id_new" name="role_id" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3" id="facultiesDivNew">
                                    <label for="faculties_new" class="form-label">Faculties</label>
                                    <select class="form-select" id="faculties_new" name="faculties" required>
                                        @foreach($faculties as $facultie)
                                            <option value="{{ $facultie->id }}">{{ $facultie->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
  
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</main>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Bundle with Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function toggleFacultiesDisplay(roleSelectId, facultiesDivId) {
            let roleSelect = document.getElementById(roleSelectId);
            let facultiesDiv = document.getElementById(facultiesDivId);
            let facultiesNew = document.getElementById(faculties_new);
            facultiesDiv.style.display = (roleSelect.value == '3' || roleSelect.value == '2' || roleSelect.value == '4') ? '' : 'none';
        }
        @foreach ($users as $user)
            toggleFacultiesDisplay('role_id{{ $user->id }}', 'facultiesDiv{{ $user->id }}');
            document.getElementById('role_id{{ $user->id }}').addEventListener('change', function() {
                toggleFacultiesDisplay('role_id{{ $user->id }}', 'facultiesDiv{{ $user->id }}');
            });
        @endforeach
        toggleFacultiesDisplay('role_id_new', 'facultiesDivNew');
        document.getElementById('role_id_new').addEventListener('change', function() {
            toggleFacultiesDisplay('role_id_new', 'facultiesDivNew');
        });
    });
</script>
    
@endsection