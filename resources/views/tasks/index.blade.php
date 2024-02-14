<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="User's tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tasks Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3"> Task's table</h6>
                            </div>
                        </div>
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-1" href="{{route('tasks.create')}}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Create New
                                Task</a>
                        </div>
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-1" href="{{route('statustasks.index')}}"><i class="fas fa-bars"></i>
                                &nbsp;&nbsp;See the Status</a>
                        </div>


                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">

                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Priority</th>
                                            <th>Project</th>
                                            <th>Due Date</th>
                                            <th>Assigned To</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tasks as $task)
                                            <tr>
                                                <td>{{ $task->id }}</td>
                                                <td>{{ $task->title }}</td>
                                                <td>{{ $task->description }}</td>
                                                <td>{{ $task->priority }}</td>
                                                <td>{{ $task->project }}</td>
                                                <td>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : 'Not set' }}</td>
                                                <td>{{ $task->assigned_to->email  }}</td>
                                                <td>{{ $task->status }}</td>
                                                <td>
                                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit Task</a>
                                                    <!-- Add delete button if needed -->
                                                </td>
                                                <td>
                                                <form method="post" action="{{ route('tasks.destroy', $task->id) }}" class="mt-3" >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">Delete Task</button>
                                                </form>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          

</x-layout>
