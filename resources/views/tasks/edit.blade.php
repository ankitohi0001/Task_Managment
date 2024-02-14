<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-task"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Edit Task'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('');">
                {{-- <span class="mask  bg-gradient-primary  opacity-6"></span> --}}
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset('assets') }}/img/bruce-mars.jpg" alt="profile_image"
                                 class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Task Information</h6>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if (session('status'))
                            <div class="row">
                                <div class="alert alert-success alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('status') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                            data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if (Session::has('demo'))
                            <div class="row">
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('demo') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                            data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form method='POST' action='{{ route('tasks.update' , $task->id) }}'>
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Title:</label>
                                    <input type="text" name="title" class="form-control border border-2 p-2" value='{{ old('title', $task->title) }}'>
                                    @error('title')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Description</label>
                                    <input type="text" name="description" class="form-control border border-2 p-2" value='{{ old('description', $task->description) }}'>
                                    @error('description')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="priority">Priority:</label>
                                    <select name="priority" class="form-control">
                                        <option value="High" {{ old('priority', $task->priority) === 'High' ? 'selected' : '' }}>High</option>
                                        <option value="Medium" {{ old('priority', $task->priority) === 'Medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="Low" {{ old('priority', $task->priority) === 'Low' ? 'selected' : '' }}>Low</option>
                                    </select>
                                    @error('priority')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="Project">Project:</label>
                                    <select name="Project" class="form-control">
                                        <option value="SBO" {{ old('SBO', $task->SBO) === 'SBO' ? 'selected' : '' }}>SBO</option>
                                        <option value="RSD" {{ old('priority', $task->priority) === 'RSD' ? 'selected' : '' }}>RSD</option>
                                        <option value="Sport-Match" {{ old('priority', $task->priority) === 'Sport-Match' ? 'selected' : '' }}>Sport-Match</option>
                                    </select>
                                    @error('Project')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Due Date:</label>
                                    <input type="date" name="due_date" class="form-control border border-2 p-2" value='{{ old('due_date', $task->due_date) }}'>
                                    @error('due_date')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Assigned To:</label>
                                    <select name="user_id" class="form-control">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} - {{ $user->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                            <a href="{{route('tasks.index')}}">
                                <button type="submit" class="btn btn-primary">Back</button>
                            </a>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        {{-- <x-footers.auth></x-footers.auth> --}}
    </div>
    <x-plugins></x-plugins>

</x-layout>



