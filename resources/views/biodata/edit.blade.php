@extends('layout.app')

@section('title', 'Laracamp')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8">
                @include('components.alert')
                <div class="card">
                    <div class="card-header">Update Profile</div>
                    <div class="card-body">
                        <form action="{{ route('profile.update', $user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <div class="card">
                                    <div class="card-header">Avatar</div>
                                    
                                    <div class="card-body">
                                        @if($user->avatar)
                                            <img src="{{ Storage::url($user->avatar) }}" alt="" width="150" style="border-radius: 50%" class="mx-auto" id="prevFoto">
                                        @else
                                            <img src="{{ url('https://ui-avatars.com/api/?name=' . auth()->user()->name) }}"  width="150" style="border-radius: 50%" alt="nopict" id="prevFoto">
                                        @endif
                                    </div>

                                    <div class="card-footer">
                                        <input type="file" name="avatar" id="avatar" value="Upload Image" accept="image/*" onchange="preview(event)">
                                    </div>
                                </div>

                                <div class="card mt-2">
                                    <div class="card-header">Biodata</div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name ?? old('name') }}">
                                        </div>

                                        <div class="form-group mt-2">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email ?? old('email') }}">
                                        </div>

                                        <div class="form-group mt-2">
                                            <label for="occupation">Occupation</label>
                                            <input type="text" name="occupation" id="occupation" class="form-control @error('occupation') is-invalid @enderror" value="{{ $user->occupation ?? old('occupation') }}">
                                        </div>

                                        <div class="form-group mt-2">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone ?? old('phone') }}">
                                        </div>

                                        <div class="form-group mt-2">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" rows="5" class="form-control @error('address') is-invalid @enderror" style="resize: none">{{ $user->address ?? old('occupation') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="card-footer d-flex flex-row-reverse">
                                        <input type="submit" value="Update Profile" class="btn btn-primary btn-sm mx-2">
                                        <input type="reset" value="Cancel" class="btn btn-secondary btn-sm">
                                    </div>
                                </div>
                           </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Change Password</div>
                    <div class="card-body">
                        <form action="{{ route('profile.update.password') }}" method="POST">
                            @csrf
                            @method('put')
                            
                            <div class="form-group mb-3">
                                <label for="email">Name</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email ?? old('email') }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">New Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <input type="submit" value="Update Password" class="btn btn-success btn-sm">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <script>
       function preview(event)
       {
            document.getElementById('prevFoto').src = URL.createObjectURL(event.target.files[0])  
       }
    </script>
@endpush