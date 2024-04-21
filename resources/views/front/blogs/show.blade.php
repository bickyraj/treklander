@extends('layouts.front_inner')

@section('meta_og_title'){!! $blog->seo->meta_title ?? '' !!}@stop
@section('meta_description'){!! $blog->seo->meta_description ?? '' !!}@stop
@section('meta_keywords'){!! $blog->seo->meta_keywords ?? '' !!}@stop
@section('meta_og_url'){!! $blog->seo->canonical_url ?? '' !!}@stop
@section('meta_og_description'){!! $blog->seo->meta_description ?? '' !!}@stop
@section('meta_og_image'){!! $blog->seo->socialImageUrl !== '' ? $blog->seo->socialImageUrl : $blog->imageUrl !!}@stop

@section('content')

    @include('front.elements.hero', [
        'title' => $blog->name,
        'image' => $blog->imageUrl,
        'breadcrumbs' => [
            'Home' => route('home'),
            'Blogs' => route('front.blogs.index'),
        ],
    ])

    @if ($contents)
        <section class="container grid gap-10 py-20 lg:grid-cols-3">
            <div class="">
                <div class="sticky px-4 py-8 top-32 bg-light">
                    <h2 class="mb-4 text-primary">Table of Contents</h2>
                    <div class="prose prose-a:no-underline prose-ul:list-none">
                        {!! $contents !!}
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2">
                <div class="mb-10 text-sm text-gray-600">
                    Published: {{ formatDate($blog->blog_date) }}
                </div>
                <div class="mb-10 prose prose-headings:text-primary">
                    {!! $body !!}
                </div>
                <div class="flex items-center gap-6 mb-8">
                    <img src="{{ $author->thumbImageUrl }}" alt="" class="flex-shrink-0 object-cover w-16 h-16 rounded-full bg-gray">
                    <div>
                        <div class="text-lg font-bold text-light-gray">{{ $author->name }}</div>
                        <div class="text-sm text-gray-600">
                            {!! truncate($author->description, 200) !!}
                        </div>
                    </div>
                </div>
                {{-- Share --}}
                <div class="mb-20">
                    <div class="mb-4 text-lg font-bold text-gray-600">Share this article</div>
                    <ul class="flex gap-4 text-gray-600">
                        <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="text-light-gray hover:text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->name) }}&amp;url={{ url()->current() }}" class="text-light-gray hover:text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                                    <path
                                        d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ url()->current() }}&amp;{{ urlencode($blog->name) }}" class="text-light-gray hover:text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                                    <path
                                        d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/?text={{ url()->current() }}" class="text-light-gray hover:text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>{{-- Share --}}

                {{-- Quick Enquiry --}}
                <div class="px-4 py-8 rounded-lg lg:px-10 bg-light border-primary">
                    <h2 class="mb-4 text-2xl font-display text-primary">Reach out to us</h2>
                    <div class="card-body">
                        <form id="enquiry-form" action="{{ route('front.contact.store') }}" method="POST">
                            @csrf
                            <input type="hidden" id="redirect-url" name="redirect_url">
                            <div class="mb-2 form-group">
                                <label class="sr-only" for="">Name</label>
                                <div class="flex items-center gap-2">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="mb-2 form-group">
                                <label class="sr-only" for="email">E-mail</label>
                                <div class="flex items-center gap-2">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="mb-2 form-group">
                                <label class="sr-only" for="country">Country</label>
                                <div class="flex items-center gap-2">
                                    <input name="country" id="" class="form-control" list="countries" placeholder="Country">
                                </div>
                            </div>
                            <div class="mb-2 form-group">
                                <label class="sr-only" for="phone">Phone Number</label>
                                <div class="flex items-center gap-2">
                                    <input type="tel" name="phone" class="form-control" placeholder="Phone No.">
                                </div>
                            </div>
                            <div class="mb-2 form-group">
                                <label class="sr-only" for="">Message</label>
                                <div class="flex items-center">
                                    <textarea name="message" class="form-control" placeholder="Message" required></textarea>
                                </div>
                            </div>
                            <div class="mb-2 form-group">
                                <div id="inquiry-g-recaptcha" data-sitekey="{{ config('constants.google_recaptcha') }}" data-callback="onSubmitEnquiry" data-size="invisible">
                                </div>
                                <input type="hidden" id="enquiry-recaptcha" name="enquiry-recaptcha">
                                <button type="submit" class="btn btn-sm btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>{{-- Quick Enquiry --}}

                @include('front.elements.scroll-to-top')

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
        </section>
    @else
        <div class="container py-20">
            <div class="mx-auto prose">
                {!! $blog->description !!}
            </div>
        </div>
    @endif

    <!-- similar blogs -->
    @if (isset($blog->similar_blogs) && !empty($blog->similar_blogs))
        <section class="py-10 mt-20 mb-5 bg-gray-100">
            <div class="container">
                <h2 class="relative pt-10 pb-10 pr-10 text-3xl font-bold text-gray-600 lg:text-4xl font-display">Similar Blogs</h2>
                <div class="absolute right-0 w-6 h-1 rounded top-1/2 bg-accent"></div>
                <div class="grid gap-2 lg:grid-cols-3 xl:gap-3">
                    @foreach ($blog->similar_blogs as $s_blog)
                        @include('front.elements.blog-card', ['blog' => $s_blog])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
