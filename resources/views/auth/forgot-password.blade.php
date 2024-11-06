@section('title', 'Forgot Password')

<x-guest-layout>
    <x-slot name="title">Forgot Password</x-slot>
    <x-slot name="description">Please enter your email address to reset your password.</x-slot>

    <div id="show_success_alert"></div>
    <div id="show_error_alert"></div>

    <form action="#" method="POST" class="custom_form" id="forgotPasswordForm">
        @csrf
        <div class="single_input">
            <x-input-label for="email" class="label_title" :value="__('Enter Email')" />
            <div class="include_icon">
                <x-text-input id="email" class="radius-5" type="email" name="email"
                    placeholder="Enter email address" />
                <div class="icon"><span class="material-symbols-outlined">mail</span></div>
            </div>
            <span class="text-danger text-sm error" id="email-error"></span>
        </div>

        <div class="btn_wrapper single_input d-flex gap-2">
            <x-submit-button class="cmn_btn w-100 radius-5" id="forgotPassword_btn">
                {{ __('Submit') }}
            </x-submit-button>
            <x-link-button route="login" class="cmn_btn outline_btn w-100 radius-5" :value="__('Cancel')" />
        </div>
    </form>

    @push('custom_js')
        <script>
            $(document).ready(function() {
                $('#forgotPasswordForm').on('submit', function(e) {
                    e.preventDefault();

                    $('.error').text('');
                    $('#show_success_alert').html('');
                    $('#show_error_alert').html('');
                    $('#forgotPassword_btn').prop('disabled', true);

                    $.ajax({
                        url: "{{ route('password.email') }}",
                        type: "POST",
                        data: $(this).serialize(),
                        beforeSend: function() {
                            $('#forgotPassword_btn').text('Please Wait...');
                        },
                        success: function(response) {
                            if (response.message) {
                                $('#show_success_alert').html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                ${response.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                            }
                        },
                        error: function(xhr, errors) {
                            $('#forgotPassword_btn').text('Submit');
                            $('#forgotPassword_btn').prop('disabled', false);

                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#' + key + '-error').text(value[0]);
                                });
                            } else if (xhr.status === 404) {
                                $('#show_error_alert').html(`
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        ${xhr.responseJSON.errors.email[0]}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                `);
                            }
                        },
                        complete: function() {
                            $('#forgotPassword_btn').text('Submit');
                        }
                    });
                });
            });
        </script>
    @endpush
</x-guest-layout>
