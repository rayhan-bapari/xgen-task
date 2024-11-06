@section('title', 'Reset Password')

<x-guest-layout>
    <x-slot name="title">Reset Password</x-slot>
    <x-slot name="description">Please enter your new password to reset your account.</x-slot>

    <div id="show_success_alert"></div>
    <div id="show_error_alert"></div>

    <form id="resetPasswordForm" method="POST" class="custom_form">
        @csrf

        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <div class="single_input">
            <x-input-label for="email" class="label_title" :value="__('Email')" />
            <div class="include_icon">
                <x-text-input id="email" class="radius-5" type="email" name="email"
                    placeholder="Enter your email address" value="{{ request()->email }}" readonly />
                <div class="icon"><span class="material-symbols-outlined">mail</span></div>
            </div>
            <span class="text-danger" id="email-error"></span>
        </div>

        <div class="single_input">
            <x-input-label for="password" class="label_title" :value="__('Password')" />
            <div class="include_icon">
                <x-text-input id="password" class="radius-5" type="password" name="password"
                    placeholder="Enter your password" />
                <div class="icon"><span class="material-symbols-outlined">lock</span></div>
            </div>
            <span class="text-danger" id="password-error"></span>
        </div>

        <div class="single_input">
            <x-input-label for="password_confirmation" class="label_title" :value="__('Confirm Password')" />
            <div class="include_icon">
                <x-text-input id="password_confirmation" class="radius-5" type="password" name="password_confirmation"
                    placeholder="Confirm your password" />
                <div class="icon"><span class="material-symbols-outlined">lock</span></div>
            </div>
            <span class="text-danger" id="password_confirmation-error"></span>
        </div>

        <div class="btn_wrapper single_input d-flex gap-2">
            <button type="submit" id="resetPassword_btn" class="cmn_btn w-100 radius-5">{{ __('Submit') }}</button>
        </div>
    </form>

    @push('custom_js')
        <script>
            $(document).ready(function() {
                $('#resetPasswordForm').on('submit', function(e) {
                    e.preventDefault();

                    $('.text-danger').text('');
                    $('#show_success_alert').html('');
                    $('#show_error_alert').html('');
                    $('#resetPassword_btn').prop('disabled', true).text('Please Wait...');

                    $.ajax({
                        url: "{{ route('password.store') }}",
                        type: "POST",
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.message) {
                                $('#show_success_alert').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    ${response.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `);
                            }
                            setTimeout(function() {
                                window.location.href = "{{ route('login') }}";
                            }, 2000);
                        },
                        error: function(xhr) {
                            $('#resetPassword_btn').prop('disabled', false).text('Submit');

                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#' + key + '-error').text(value[0]);
                                });
                            } else {
                                $('#show_error_alert').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    An unexpected error occurred. Please try again.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `);
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
</x-guest-layout>
