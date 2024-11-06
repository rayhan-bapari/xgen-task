@section('title', 'Signup')

<x-guest-layout>
    <x-slot name="title">Sign Up</x-slot>
    <x-slot name="description">Welcome! Please sign up to your account.</x-slot>

    <div id="show_success_alert"></div>

    <form action="#" method="POST" class="custom_form" id="signupForm">
        @csrf
        <div class="single_input">
            <x-input-label for="name" class="label_title" :value="__('Name')" />
            <div class="include_icon">
                <x-text-input id="name" class="radius-5" type="text" name="name"
                    placeholder="Enter your Full Name" />
                <div class="icon">
                    <span class="material-symbols-outlined">person</span>
                </div>
            </div>
            <span class="text-danger text-sm error" id="name-error"></span>
        </div>

        <div class="single_input">
            <x-input-label for="username" class="label_title" :value="__('Username')" />
            <div class="include_icon">
                <x-text-input id="username" class="radius-5" type="text" name="username"
                    placeholder="Enter your Username" />
                <div class="icon"><span class="material-symbols-outlined">person</span></div>
            </div>
            <span class="text-danger text-sm error" id="username-error"></span>
        </div>

        <div class="single_input">
            <x-input-label for="email" class="label_title" :value="__('Email')" />
            <div class="include_icon">
                <x-text-input id="email" class="radius-5" type="email" name="email"
                    placeholder="Enter your email address" />
                <div class="icon"><span class="material-symbols-outlined">mail</span></div>
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

        <div class="single_input">
            <x-input-label for="password_confirmation" class="label_title" :value="__('Confirm Password')" />
            <div class="include_icon">
                <x-text-input id="password_confirmation" class="radius-5" type="password" name="password_confirmation"
                    placeholder="Confirm your password" />
                <div class="icon"><span class="material-symbols-outlined">lock</span></div>
            </div>
            <span class="text-danger text-sm error" id="password_confirmation-error"></span>
        </div>

        <div class="btn_wrapper single_input">
            <x-submit-button class="cmn_btn w-100 radius-5" id="signup_btn">
                {{ __('Sign Up') }}
            </x-submit-button>
        </div>

        <div class="btn-wrapper mt-4">
            <p class="loginForm__wrapper__signup">
                <span>Already have an account? </span>
                <x-link-button route="login" class="loginForm__wrapper__signup__btn" :value="__('Sign In')" />
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
                $('#signupForm').on('submit', function(e) {
                    e.preventDefault();

                    $('.error').text('');
                    $('#signup_btn').prop('disabled', true);

                    $.ajax({
                        url: "{{ route('register') }}",
                        type: "POST",
                        data: $(this).serialize(),
                        beforeSend: function() {
                            $('#signup_btn').text('Please Wait...');
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
                            $('#signup_btn').text('Sign Up');
                            $('#signup_btn').prop('disabled', false);

                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#' + key + '-error').text(value[0]);
                                });
                            }
                        },
                        complete: function() {
                            $('#signup_btn').text('Sign Up');
                        }
                    });
                });
            });
        </script>
    @endpush
</x-guest-layout>
