<form action="{{ route('kelola.user.update', $user->id) }}" method="post" id="form-update-user">
    @csrf
    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" name="name" class="form-control" placeholder="Masukkan Data!" value="{{ $user->name }}">
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Username</label>
        <input type="text" name="username" class="form-control" placeholder="Masukkan Data!"
            value="{{ $user->username }}">
        @error('username')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan Data!">
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Level</label>
        <select name="level" class="form-control">
            <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="superadmin" {{ $user->level == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
            <option value="owner" {{ $user->level == 'owner' ? 'selected' : '' }}>Owner</option>
        </select>
        @error('level')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</form>
