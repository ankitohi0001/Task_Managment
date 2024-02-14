<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="User's tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Users Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3"> User's table</h6>
                            </div>
                        </div>
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-1" href="{{route('users.create')}}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Create New
                                User</a>
                        </div>


                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">

                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        {{-- <th>Password</th> --}}
                                        <th>User_type</th>
                                        <th>Action</th>




                                    </tr>
                                    <tr>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            @if ($errors->has('email'))
                                                <p class="text-danger">{{ $errors->first('email') }}</p>
                                            @endif

                                            <td hidden>{{$user->password}}</td>
                                            <td>{{$user->user_type}}</td>
                                            <td>
                                                <a href="{{ route('tasks.index', ['user_id' => $user->id]) }}" class="btn btn-primary">View Tasks</a>
                                            </td>


                                            @endforeach

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-plugins></x-plugins>

</x-layout>
