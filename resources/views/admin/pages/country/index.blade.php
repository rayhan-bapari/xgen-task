<x-app-layout>
    <div class="dashboard__inner__item dashboard__card bg__white padding-20 radius-10">
        <h4 class="dashboard__inner__item__header__title">
            All Countries
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
                            <th>Number of States</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countries as $country)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $country->name }}</td>
                                <td>{{ $country->states->count() }}</td>
                                <td>{{ $country->created_at->format('d M, Y') }}</td>
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
                                                <a class="dropdown-item"
                                                    href="{{ route('countries.edit', $country->id) }}">
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-country" href="#"
                                                    data-id="{{ $country->id }}">
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
                $('.delete-country').click(function() {
                    const countryId = $(this).data('id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This will delete the country and all associated states and cities. This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/countries/${countryId}`,
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
                                        text: 'Error deleting country!',
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
