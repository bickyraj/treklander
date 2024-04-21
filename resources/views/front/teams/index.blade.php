<?php
if (session()->has('success_message')) {
    $session_success_message = session('success_message');
    session()->forget('success_message');
}

if (session()->has('error_message')) {
    $session_error_message = session('error_message');
    session()->forget('error_message');
}
?>
@extends('layouts.front_inner')
@push('styles')
    <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
@endpush
@section('content')
    {{--  Hero --}}
    <section class="relative">
        @include('front.elements.hero', [
            'title' => 'Our Team',
            'image' => asset('assets/front/img/hero.jpg'),
            'breadcrumbs' => [
                'Home' => route('home'),
            ],
        ])
    </section>

    <section class="py-20">
        <div class="container">
            <div class="grid gap-10 lg:grid-cols-3 xl:grid-cols-4" x-data="{ active: 'administration' }">
                <div class="lg:col-span-2 xl:col-span-3">
                    <div class="mb-20 prose">
                        <p>
                            "Embark on a Journey of Discovery with Our Team at {{ Setting::get('site_name') }} in Nepal"

                            Nestled amidst the towering Himalayan peaks and lush valleys, {{ Setting::get('site_name') }} is your gateway to the most awe-inspiring trekking adventures in Nepal. Our
                            dedicated
                            team of experienced guides, passionate nature enthusiasts, and local experts is here to make your trekking dreams a reality. Whether you're a seasoned trekker or a first-time
                            adventurer, our team is ready to lead you through breathtaking landscapes, ancient cultures, and unforgettable experiences. Discover the heart of the Himalayas with the trusted
                            companionship of {{ Setting::get('site_name') }}.
                        </p>
                    </div>

                    @if (!$administrations->isEmpty())
                        <button :class="{ 'btn': true, 'btn-accent': active === 'administration', 'btn-primary': active !== 'administration' }" x-on:click="active='administration'">Administration</button>
                    @endif
                    @if (!$representatives->isEmpty())
                        <button :class="{ 'btn': true, 'btn-accent': active === 'representatives', 'btn-primary': active !== 'representatives' }"
                            x-on:click="active='representatives'">Representatives</button>
                    @endif
                    @if (!$tour_guides->isEmpty())
                        <button :class="{ 'btn': true, 'btn-accent': active === 'tourguides', 'btn-primary': active !== 'tourguides' }" x-on:click="active='tourguides'">Tour Guides</button>
                    @endif


                    @if (!$administrations->isEmpty())
                        <div x-show="active==='administration'">
                            <div class="grid gap-2 pt-8 lg:gap-3">
                                @foreach ($administrations as $item)
                                    @include('front.elements.team_card')
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if (!$representatives->isEmpty())
                        <div x-show="active==='representatives'">
                            <div class="grid gap-2 pt-8 lg:gap-3">
                                @foreach ($representatives as $item)
                                    @include('front.elements.team_card')
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if (!$tour_guides->isEmpty())
                        <div x-show="active==='tourguides'">
                            <div class="grid gap-2 pt-8 lg:gap-3">
                                @foreach ($tour_guides as $item)
                                    @include('front.elements.team_card')
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
                <aside>
                    @include('front.elements.enquiry')
                </aside>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function() {
            var session_success_message = '{{ $session_success_message ?? '' }}';
            var session_error_message = '{{ $session_error_message ?? '' }}';
            if (session_success_message) {
                toastr.success(session_success_message);
            }

            if (session_error_message) {
                toastr.danger(session_error_message);
            }

            var enquiry_validator = $("#enquiry-form").validate({
                ignore: "",
                rules: {
                    'name': 'required',
                    'email': 'required',
                    'country': 'required',
                    'phone': 'required',
                    'message': 'required',
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest('.flex'));
                    // error.append(element.closest('.form-group'));
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    if (grecaptcha.getResponse(0)) {
                        var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Sending...');
                        setTimeout(() => {
                            form.submit();
                        }, 500);
                    } else {
                        grecaptcha.reset(enquiry_captcha);
                        grecaptcha.execute(enquiry_captcha);
                    }
                },
            });
        });

        function onSubmitEnquiry(token) {
            $("#enquiry-form").submit();
            return true;
        }

        let enquiry_captcha;
        var CaptchaCallback = function() {
            enquiry_captcha = grecaptcha.render('inquiry-g-recaptcha', {
                'sitekey': '{!! config('constants.recaptcha.sitekey') !!}'
            });
            // review_captcha = grecaptcha.render('review-g-recaptcha', {'sitekey' : '{!! config('constants.recaptcha.sitekey') !!}'});
        };
    </script>
@endpush
