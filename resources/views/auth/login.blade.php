@section('title', 'Signin')

<x-guest-layout>
    <x-slot name="title">Sign In</x-slot>
    <x-slot name="description">Welcome back! Please sign in to your account.</x-slot>

    <div id="show_success_alert"></div>

    <form action="#" method="POST" class="custom_form" id="loginForm">
        @csrf
        <div class="single_input">
            <x-input-label for="email" class="label_title" :value="__('Email or Username')" />
            <div class="include_icon">
                <x-text-input id="email" class="radius-5" type="text" name="email"
                    placeholder="email address or username" />
                <div class="icon"><span class="material-symbols-outlined">person</span></div>
            </div>
            <span class="text-danger text-sm error" id="email-error"></span>
        </div>
        <div class="single_input">
            <x-input-label for="password" class="label_title" :value="__('Password')" />
            <div class="include_icon">
                <x-text-input id="password" class="radius-5" type="password" name="password"
                    placeholder="Enter your password" />
                <div class="icon"><span class="material-symbols-outlined">lock</span></div>
            </div>
            <span class="text-danger text-sm error" id="password-error"></span>
        </div>
        <div class="loginForm__wrapper__remember single_input">
            <div class="dashboard_checkBox">
                <input class="dashboard_checkBox__input" id="remember" type="checkbox">
                <x-input-label for="remember" class="dashboard_checkBox__label" :value="__('Remember me')" />
            </div>
            <div class="forgotPassword">
                <x-link-button route="password.request" class="forgotPass" :value="__('Forgot Password?')" />
            </div>
        </div>
        <div class="btn_wrapper single_input">
            <x-submit-button class="cmn_btn w-100 radius-5" id="login_btn">
                {{ __('Sign In') }}
            </x-submit-button>
        </div>
        <div class="btn-wrapper mt-4">
            <p class="loginForm__wrapper__signup">
                <span>Don't have an account ? </span>
                <x-link-button route="register" class="loginForm__wrapper__signup__btn" :value="__('Sign Up')" />
            </p>
            <div class="loginForm__wrapper__another d-flex flex-column gap-2 mt-3">
                <a href="javascript:void(0)" class="loginForm__wrapper__another__btn radius-5 w-100">
                    <img src="{{ asset('assets/img/icon/googleIocn.svg') }}" alt="" class="icon">
                    Login With Google
                </a>
                <a href="javascript:void(0)" class="loginForm__wrapper__another__btn radius-5 w-100">
                    <img src="{{ asset('assets/img/icon/fbIcon.svg') }}" alt="" class="icon">
                    Login With Facebook
                </a>
            </div>
        </div>
    </form>

    @push('custom_js')
        <script>
            $(document).ready(function() {
                $('#loginForm').on('submit', function(e) {
                    e.preventDefault();

                    $('.error').text('');
                    $('#show_success_alert').html('');
                    $('#login_btn').prop('disabled', true);

                    $.ajax({
                        url: "{{ route('login') }}",
                        type: "POST",
                        data: $(this).serialize(),
                        beforeSend: function() {
                            $('#login_btn').text('Please Wait...');
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
                            setTimeout(function() {
                                window.location.href = "{{ route('dashboard') }}";
                            }, 2000);
                        },
                        error: function(xhr) {
                            $('#login_btn').text('Sign In');
                            $('#login_btn').prop('disabled', false);

                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#' + key + '-error').text(value[0]);
                                });
                            }
                        },
                        complete: function() {
                            $('#login_btn').text('Sign In');
                        }
                    });
                });
            });
        </script>
    @endpush
</x-guest-layout>
