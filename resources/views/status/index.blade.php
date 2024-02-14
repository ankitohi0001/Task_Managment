<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="User's tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Project's Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3"> Status's table</h6>
                            </div>
                        </div>
                        {{-- <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-1" href="{{route('project.create')}}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Create New
                                Project</a>
                        </div> --}}


                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">

                                    <thead>
                                    <tr>
                                        <th>Task title</th>
                                        <th>User Name</th>
                                        <th>Status</th>
                                        <th>Date&Time</th>
                                        {{-- <th>Estimate Time</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($statuss as $status)
                                        <tr>
                                            <td>{{ $status->tasks->title }}</td>
                                            <td> {{ $status->users->name }} </td>
                                            <td>{{ $status->status->name}}</td>
                                            <td>{{ $status->status->updated_at}}</td>
                                            {{-- <td>{{ hidden($project->estimate_time) }}</td> --}}
                                        </tr>
                                        {{-- <td>
                                            <a href="{{ route('project.edit' ,$project->id) }}" class="btn btn-primary">Edit Project</a>
                                            <!-- Add delete button if needed -->
                                        </td> --}}
                                    @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          

</x-layout>
