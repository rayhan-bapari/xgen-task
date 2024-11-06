<x-app-layout>
    <div class="dashboard__inner__item dashboard__card bg__white padding-20 radius-10">
        <h4 class="dashboard__inner__item__header__title">
            All Cities
        </h4>
        <!-- Table Design One -->
        <div class="tableStyle_one mt-4">
            <div class="table_wrapper">
                <!-- Table -->
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Country Name</th>
                            <th>State Name</th>
                            <th>City Name</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $city->state->country->name }}</td>
                                <td>{{ $city->state->name }}</td>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->created_at->format('d M, Y') }}</td>
                                <td>
                                    <!-- DropDown -->
                                    <div class="dropdown custom__dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="las la-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('cities.edit', $city->id) }}">
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-city" href="#"
                                                    data-id="{{ $city->id }}">
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End-of Table one -->
    </div>

    @push('custom_js')
        <script>
            $(document).ready(function() {
                $('.delete-city').click(function() {
                    const cityId = $(this).data('id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/cities/${cityId}`,
                                type: 'DELETE',
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Deleted!',
                                            text: response.message,
                                            showConfirmButton: false,
                                            timer: 1500
                                        }).then(() => {
                                            location.reload();
                                        });
                                    }
                                },
                                error: function(response) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Error deleting city!',
                                        footer: response.responseJSON?.message ||
                                            'An error occurred'
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
