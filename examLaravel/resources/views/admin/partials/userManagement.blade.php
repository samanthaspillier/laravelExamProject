<style>
    .btnRed {
        background-color: #C8102E;
        color: white !important;
    }
    .btnGreen{
        background-color: #007A33;
        color: white !important;
    }
    
</style>

<section id="user-management">
    <h3>User Management</h3>
    <div class="card">
       
        <div class="card-body">
            
            <!-- Search Form -->
            <form action="{{ route('admin.users.search') }}" method="GET">
                <div class="mb-2">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or email">
                </div>
                <button type="submit" class="btn btnGreen mb-3">Search</button>
            </form>

            <!-- Search Results -->
            @if(isset($searchResults) && !$searchResults->isEmpty())
                <div class="card mb-4">
                    <div class="card-header">
                        Search Results
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($searchResults as $user)
                            <li class="list-group-item">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="link-primary">{{ $user->name }} - {{ $user->email }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btnRed btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('newUser') }}" class="btn btnRed btn-sm">Add a new user</a>
            </div>
    </div>
</section>
