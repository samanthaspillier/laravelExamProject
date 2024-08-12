<section id="user-management">
    <h3>User Management</h3>
    <div class="card">
       
        <div class="card-body">
            
            <!-- Search Form -->
            <form action="{{ route('admin.users.search') }}" method="GET">
                <div class="mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or email">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <!-- Dropdown to select a user to edit -->
            <div class="mb-3">
                <select id="userDropdown" class="form-select" onchange="window.location.href=this.value;">
                    <option value="">Select a user to edit...</option>
                    @foreach($allUsers as $user)
                        <option value="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Table for listing latest users -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->birthday }}</td>
                            <td>{{ $user->role ? 'Admin' : 'User' }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn btn-primary">Add New User</button>
        </div>
    </div>
</section>
