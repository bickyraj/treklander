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
@extends('layouts.front')
@section('content')
    <!-- Hero -->
    <section class="relative">
        <img src="{{ asset('assets/front/img/hero.jpg') }}" alt="" class="object-cover w-full h-96">
        <div class="absolute bottom-0 w-full bg-gradient-to-t from-primary-dark/60 to-primary-dark/0">
            <div class="container">
                <div class="py-10">
                    <h1 class="mb-4 text-4xl font-bold text-white font-display lg:text-7xl hero-title drop-shadow-lg">
                        <span>Contact Us</span>
                    </h1>
                    <div class="breadcrumb-wrapper">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb fs-sm wrap">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-5xl px-4 mx-auto">
            <div class="grid gap-10 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="mb-4 prose">
                        <p>Tell us more about your interest and we will respond your query within 12 hours !
                        </p>
                    </div>
                    <div class="mb-8">
                        <form id="captcha-form" action="{{ route('front.contact.store') }}" method="POST">
                            @csrf
                            <div class="mb-4 form-group">
                                <label for="name" class="text-sm">Name</label>
                                {{-- <div class="flex">
                                <div class="flex items-center justify-center px-2 bg-primary">
                                    <svg class="w-4 h-4 text-white">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#users" />
                                    </svg>
                                </div> --}}
                                <input type="text" name="name" required class="form-control" id="name" placeholder="Name">
                                {{-- </div> --}}
                            </div>
                            <div class="mb-4 form-group">
                                <label for="email" class="text-sm">E-mail</label>
                                {{-- <div class="flex">
                                <div class="flex items-center justify-center px-2 bg-primary">
                                    <svg class="w-4 h-4 text-white">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#mail" />
                                    </svg>
                                </div> --}}
                                <input type="email" name="email" required class="form-control" id="email" placeholder="Email">
                                {{-- </div> --}}
                            </div>
                            <div class="mb-4 form-group">
                                <label for="country" class="text-sm">Country</label>
                                {{-- <div class="flex">
                                <div class="flex items-center justify-center px-2 bg-primary">
                                    <svg class="w-4 h-4 text-white">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#flag" />
                                    </svg>
                                </div> --}}
                                <input name="" id="country" required name="country" class="form-control" list="countries" placeholder="Country">
                                {{-- </div> --}}
                            </div>
                            <div class="mb-4 form-group">
                                <label for="phone" class="text-sm">Phone Number</label>
                                {{-- <div class="flex">
                                <div class="flex items-center justify-center px-2 bg-primary">
                                    <svg class="w-4 h-4 text-white">
                                        <use xlink:href="{{ asset('assets/front/img/sprite.svg') }}#phone" />
                                    </svg>
                                </div> --}}
                                <input type="tel" name="phone" required class="block form-control" id="phone" placeholder="Phone No.">
                                {{-- </div> --}}
                            </div>
                            <div class="mb-4 form-group">
                                <label for="" class="text-sm">Message</label>
                                <textarea class="block form-control" required name="message" id="message" rows="5" placeholder="Message"></textarea>
                            </div>
                            <div class="mb-4 form-group">
                                <input type="hidden" id="recaptcha" name="g-recaptcha-response">
                                @include('front.elements.recaptcha')
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>

                    <datalist id="countries">
                        <option value="Afghanistan">
                        <option value="Albania">
                        <option value="Algeria">
                        <option value="American Samoa">
                        <option value="Andorra">
                        <option value="Angola">
                        <option value="Anguilla">
                        <option value="Antarctica">
                        <option value="Antigua and Barbuda">
                        <option value="Argentina">
                        <option value="Armenia">
                        <option value="Aruba">
                        <option value="Australia">
                        <option value="Austria">
                        <option value="Azerbaijan">
                        <option value="Bahamas">
                        <option value="Bahrain">
                        <option value="Bangladesh">
                        <option value="Barbados">
                        <option value="Belarus">
                        <option value="Belgium">
                        <option value="Belize">
                        <option value="Benin">
                        <option value="Bermuda">
                        <option value="Bhutan">
                        <option value="Bolivia">
                        <option value="Bosnia and Herzegovina">
                        <option value="Botswana">
                        <option value="Bouvet Island">
                        <option value="Brazil">
                        <option value="British Indian Ocean Territory">
                        <option value="Brunei Darussalam">
                        <option value="Bulgaria">
                        <option value="Burkina Faso">
                        <option value="Burundi">
                        <option value="Cambodia">
                        <option value="Cameroon">
                        <option value="Canada">
                        <option value="Cape Verde">
                        <option value="Cayman Islands">
                        <option value="Central African Republic">
                        <option value="Chad">
                        <option value="Chile">
                        <option value="China">
                        <option value="Christmas Island">
                        <option value="Cocos (Keeling) Islands">
                        <option value="Colombia">
                        <option value="Comoros">
                        <option value="Congo">
                        <option value="Congo, The Democratic Republic of The">
                        <option value="Cook Islands">
                        <option value="Costa Rica">
                        <option value="Cote D'ivoire">
                        <option value="Croatia">
                        <option value="Cuba">
                        <option value="Cyprus">
                        <option value="Czech Republic">
                        <option value="Denmark">
                        <option value="Djibouti">
                        <option value="Dominica">
                        <option value="Dominican Republic">
                        <option value="Ecuador">
                        <option value="Egypt">
                        <option value="El Salvador">
                        <option value="Equatorial Guinea">
                        <option value="Eritrea">
                        <option value="Estonia">
                        <option value="Ethiopia">
                        <option value="Falkland Islands (Malvinas)">
                        <option value="Faroe Islands">
                        <option value="Fiji">
                        <option value="Finland">
                        <option value="France">
                        <option value="French Guiana">
                        <option value="French Polynesia">
                        <option value="French Southern Territories">
                        <option value="Gabon">
                        <option value="Gambia">
                        <option value="Georgia">
                        <option value="Germany">
                        <option value="Ghana">
                        <option value="Gibraltar">
                        <option value="Greece">
                        <option value="Greenland">
                        <option value="Grenada">
                        <option value="Guadeloupe">
                        <option value="Guam">
                        <option value="Guatemala">
                        <option value="Guinea">
                        <option value="Guinea-bissau">
                        <option value="Guyana">
                        <option value="Haiti">
                        <option value="Heard Island and Mcdonald Islands">
                        <option value="Holy See (Vatican City State)">
                        <option value="Honduras">
                        <option value="Hong Kong">
                        <option value="Hungary">
                        <option value="Iceland">
                        <option value="India">
                        <option value="Indonesia">
                        <option value="Iran, Islamic Republic of">
                        <option value="Iraq">
                        <option value="Ireland">
                        <option value="Israel">
                        <option value="Italy">
                        <option value="Jamaica">
                        <option value="Japan">
                        <option value="Jordan">
                        <option value="Kazakhstan">
                        <option value="Kenya">
                        <option value="Kiribati">
                        <option value="Korea, Democratic People's Republic of">
                        <option value="Korea, Republic of">
                        <option value="Kuwait">
                        <option value="Kyrgyzstan">
                        <option value="Lao People's Democratic Republic">
                        <option value="Latvia">
                        <option value="Lebanon">
                        <option value="Lesotho">
                        <option value="Liberia">
                        <option value="Libyan Arab Jamahiriya">
                        <option value="Liechtenstein">
                        <option value="Lithuania">
                        <option value="Luxembourg">
                        <option value="Macao">
                        <option value="Macedonia, The Former Yugoslav Republic of">
                        <option value="Madagascar">
                        <option value="Malawi">
                        <option value="Malaysia">
                        <option value="Maldives">
                        <option value="Mali">
                        <option value="Malta">
                        <option value="Marshall Islands">
                        <option value="Martinique">
                        <option value="Mauritania">
                        <option value="Mauritius">
                        <option value="Mayotte">
                        <option value="Mexico">
                        <option value="Micronesia, Federated States of">
                        <option value="Moldova, Republic of">
                        <option value="Monaco">
                        <option value="Mongolia">
                        <option value="Montserrat">
                        <option value="Morocco">
                        <option value="Mozambique">
                        <option value="Myanmar">
                        <option value="Namibia">
                        <option value="Nauru">
                        <option value="Nepal">
                        <option value="Netherlands">
                        <option value="Netherlands Antilles">
                        <option value="New Caledonia">
                        <option value="New Zealand">
                        <option value="Nicaragua">
                        <option value="Niger">
                        <option value="Nigeria">
                        <option value="Niue">
                        <option value="Norfolk Island">
                        <option value="Northern Mariana Islands">
                        <option value="Norway">
                        <option value="Oman">
                        <option value="Pakistan">
                        <option value="Palau">
                        <option value="Palestinian Territory, Occupied">
                        <option value="Panama">
                        <option value="Papua New Guinea">
                        <option value="Paraguay">
                        <option value="Peru">
                        <option value="Philippines">
                        <option value="Pitcairn">
                        <option value="Poland">
                        <option value="Portugal">
                        <option value="Puerto Rico">
                        <option value="Qatar">
                        <option value="Reunion">
                        <option value="Romania">
                        <option value="Russian Federation">
                        <option value="Rwanda">
                        <option value="Saint Helena">
                        <option value="Saint Kitts and Nevis">
                        <option value="Saint Lucia">
                        <option value="Saint Pierre and Miquelon">
                        <option value="Saint Vincent and The Grenadines">
                        <option value="Samoa">
                        <option value="San Marino">
                        <option value="Sao Tome and Principe">
                        <option value="Saudi Arabia">
                        <option value="Senegal">
                        <option value="Serbia and Montenegro">
                        <option value="Seychelles">
                        <option value="Sierra Leone">
                        <option value="Singapore">
                        <option value="Slovakia">
                        <option value="Slovenia">
                        <option value="Solomon Islands">
                        <option value="Somalia">
                        <option value="South Africa">
                        <option value="South Georgia and The South Sandwich Islands">
                        <option value="Spain">
                        <option value="Sri Lanka">
                        <option value="Sudan">
                        <option value="Suriname">
                        <option value="Svalbard and Jan Mayen">
                        <option value="Swaziland">
                        <option value="Sweden">
                        <option value="Switzerland">
                        <option value="Syrian Arab Republic">
                        <option value="Taiwan, Province of China">
                        <option value="Tajikistan">
                        <option value="Tanzania, United Republic of">
                        <option value="Thailand">
                        <option value="Timor-leste">
                        <option value="Togo">
                        <option value="Tokelau">
                        <option value="Tonga">
                        <option value="Trinidad and Tobago">
                        <option value="Tunisia">
                        <option value="Turkey">
                        <option value="Turkmenistan">
                        <option value="Turks and Caicos Islands">
                        <option value="Tuvalu">
                        <option value="Uganda">
                        <option value="Ukraine">
                        <option value="United Arab Emirates">
                        <option value="United Kingdom">
                        <option value="United States">
                        <option value="United States Minor Outlying Islands">
                        <option value="Uruguay">
                        <option value="Uzbekistan">
                        <option value="Vanuatu">
                        <option value="Venezuela">
                        <option value="Viet Nam">
                        <option value="Virgin Islands, British">
                        <option value="Virgin Islands, U.S">
                        <option value="Wallis and Futuna">
                        <option value="Western Sahara">
                        <option value="Yemen">
                        <option value="Zambia">
                        <option value="Zimbabwe">
                    </datalist>
                </div>
                <aside>
                    @include('front.elements.experts-card')
                </aside>
            </div>
        </div>
    </section>

    {{-- <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3531.994738358237!2d85.30974421503373!3d27.717448731654816!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19f9bed7fab7%3A0x78efaefa26ee5d11!2s!5e0!3m2!1sen!2snp!4v1675749819092!5m2!1sen!2snp"
        width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            var session_success_message = '{{ $session_success_message ?? '' }}';
            var session_error_message = '{{ $session_error_message ?? '' }}';
            if (session_success_message) {
                toastr.success(session_success_message);
            }

            if (session_error_message) {
                toastr.error(session_error_message);
            }
        });
    </script>
@endpush
