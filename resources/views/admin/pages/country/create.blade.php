<x-app-layout>
    <div class="row g-4">
        <div class="col-12">
            <div class="dashboard__card bg__white padding-20 radius-10">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__header__title">
                        Add Country
                    </h4>
                </div>
                <div class="dashboard__card__inner mt-4">
                    <div id="success_message"></div>
                    <div class="form__input">
                        <form action="#" method="POST" class="custom_form" id="create_form">
                            @csrf
                            <div class="form__input__single">
                                <x-input-label for="name" class="form__input__single__label" :value="__('Country Name')" />
                                <x-text-input id="name" class="radius-5" type="text" name="name"
                                    placeholder="Enter Country Name" />
                                <x-error-message id="name-error" />
                            </div>

                            <div class="form__input__single">
                                <x-submit-button class="cmn_btn btn_small radius-5" id="create_btn">
                                    Add
                                </x-submit-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('custom_js')
        <script>
            $(document).ready(function() {
                $('#create_form').on('submit', function(e) {
                    e.preventDefault();

                    $('.error').text('');
                    $('#success_message').text('');
                    $('#create_btn').prop('disabled', true);
                    $.ajax({
                        url: "{{ route('countries.store') }}",
                        type: "POST",
                        data: $(this).serialize(),
                        beforeSend: function() {
                            $('#create_btn').text('Please Wait...');
                        },
                        success: function(response) {
                            if (response.message) {
                                $('#success_message').html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                ${response.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                            }
                            setTimeout(function() {
                                window.location.href = "{{ route('countries.index') }}";
                            }, 2000);
                        },
                        error: function(xhr) {
                            $('#create_btn').text('Add');
                            $('#create_btn').prop('disabled', false);

                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#' + key + '-error').text(value[0]);
                                });
                            }
                        },
                        complete: function() {
                            $('#create_btn').text('Add');
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
