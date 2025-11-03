@extends('layouts.app')

@section('title', 'About')
@section('meta_title', 'About Carbon AI | Climate Tech & ESG Data Innovation')
@section('meta_description', 'Discover Carbon AI’s mission to accelerate decarbonization with climate tech, AI-powered carbon accounting, and ESG software for transparent reporting.')

@section('content')
<div>
    <div class="homepage-bg">
        <div class="green-ball">
            <img src="{{ asset('images/home/greenball.png') }}" style="max-width: 100%;">
        </div>
        <div class="container">
            <div class="row-centered">
                <div class="header d-none d-md-block">
                    <h1>About Us</h1>
                </div>

                {{-- Mobile --}}
                <div class="header d-block d-md-none" style="margin-top: -10rem;">
                    <h1>About Us</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission -->
    <div class="mission">
        <div class="container">
            <h3>Mission</h3>
            <p class="my-5">
                Carbon AI empowers organizations to achieve net zero and advance decarbonization through audit-ready carbon accounting software aligned with ISSA 5000.
                <br><br>
                Our AI-driven ESG software in climate tech measures and verifies carbon footprints, validates carbon emissions data and enhances reporting accuracy for credible assurance.
            </p>
        </div>
    </div>

    <!-- Team -->
    <div class="team" style="margin-top: 10rem;">
        <div class="container">
            <h3>Team</h3>
            <div class="row align-items-center team-row">
                <div class="col-12 col-md-6 text-center">
                    <div class="team-card">
                        <img src="{{ asset('images/about/nickmah.jpeg') }}" class="team-image">
                        <div class="team-content">
                            <h4 class="team-name">Nick Mah</h4>
                            <p class="team-title">Founder & CEO</p>
                            <p class="team-description">With over a decade of experience driving growth at Oracle and Cisco, Nick advised Petronas on Malaysia's first solar subscription program and founded Change IT, one of Asia's fastest-growing B2B digital marketing agencies, before launching Carbon AI.</p>
                            <div class="team-linkedin">
                                <a href="https://www.linkedin.com/in/nickmahwk/" class="linkedin-btn" target="_blank">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="team-card">
                        <img src="{{ asset('images/about/image1.png') }}" class="team-image">
                        <div class="team-content">
                            <h4 class="team-name">Fiona Lee</h4>
                            <p class="team-title" style="color:#1AB3C5;">Co-Founder & COO</p>
                            <p class="team-description">Leads product development at Carbon AI, creating digital tools that simplify ESG reporting and deliver verified sustainability outcomes. Previously founded and successfully exited an edtech company that introduced coding and robotics programs to leading international schools across Asia.</p>
                            <div class="team-linkedin">
                                <a href="https://www.linkedin.com/in/fionaleeyy/" class="linkedin-btn" style="border: 1px solid #1AB3C5;" target="_blank">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="/images/home/greenball-side.png" style="max-width: 100%; position: absolute; right: 0; bottom: -250%;">
    </div>

    <!-- Investors-->
    <div class="">
        <div class="container investors"">
            <h3>Investors</h3>
            <div class="row investors-row align-items-stretch">
                <div class="col-12 col-md-4 d-flex">
                    <div class="inv-card flex-fill">
                        <div class="d-flex justify-content-center px-3">
                            <a href="https://startup.google.com/" target="_blank">
                                <img src="{{ asset('images/about/google.png') }}" style="max-width: 100%;">
                            </a>
                        </div>
                        <div class="inv-content">
                            <p class="inv-description mb-0">A global program that supports high potential startups with cloud credits, technical mentorship, and access to Google's ecosystem, enabling Carbon AI to scale its AI driven carbon validation and ESG assurance platform with confidence and efficiency.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 d-flex">
                    <div class="inv-card flex-fill">
                        <div class="d-flex justify-content-center">
                            <a href="https://cradle.com.my/" target="_blank">
                                <img src="{{ asset('images/about/cradle.svg') }}">
                            </a>
                        </div>
                        <div class="inv-content">
                            <p class="inv-description mb-0">Malaysia's national early-stage innovation fund supporting high-potential technology startups through commercialization funding, mentorship, and ecosystem partnerships.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 d-flex">
                    <div class="inv-card flex-fill">
                        <div class="d-flex justify-content-center px-3">
                            <a href="https://www.nvidia.com/en-us/startups/" target="_blank">
                                <img src="{{ asset('images/about/nvidia.png') }}" style="max-width: 100%;">
                            </a>
                        </div>
                        <div class="inv-content">
                            <p class="inv-description mb-0">A global accelerator that empowers AI-driven startups with cloud infrastructure, technical expertise, and go-to-market support to advance scalable, sustainable innovation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advisors-->
    <div class="advisor d-none d-md-block">
        <div class="container" style="padding-top: 5rem; padding-bottom: 10rem;">
            <h3>Advisors</h3>
            <div class="row" style="padding: 2rem 5rem 0rem;">
                <div class="col-12">
                    <div class="advisor-card">
                        <img src="{{ asset('images/about/drrenard.jpeg') }}" class="advisor-image px-4 py-4">
                        <div class="advisor-content">
                            <h4 class="advisor-name">Dr. Renard Siew</h4>
                            <p class="advisor-title">Climate Governance Advisor | Sustainability Leader</p>
                            <p class="advisor-description">A recognized sustainability and climate-governance expert with experience across infrastructure, finance, and carbon markets. Provides strategic guidance to align Carbon AI with ISSB, IFRS, CDP, and the Greenhouse Gas Protocol, ensuring the platform upholds global standards of credibility, compliance, and transparency.</p>
                            <div class="advisor-linkedin">
                                <a href="https://www.linkedin.com/in/dr-renard-siew-4515524/" class="linkedin-btn" target="_blank">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Version -->
    <div class="advisor d-block d-md-none">
        <div class="container" style="padding-bottom: 5rem;">
            <h3>Advisors</h3>
            <div class="row advisor-row"">
                <div class="col-12">
                    <div class="advisor-card-mobile">
                        <img src="{{ asset('images/about/drrenard.jpeg') }}" class="advisor-image-mobile">
                        <div class="advisor-content-mobile">
                            <h4 class="advisor-name-mobile">Dr. Renard Siew</h4>
                            <p class="advisor-title-mobile">Climate Governance Advisor | Sustainability Leader</p>
                            <p class="advisor-description-mobile">A recognized sustainability and climate-governance expert with experience across infrastructure, finance, and carbon markets. Provides strategic guidance to align Carbon AI with ISSB, IFRS, CDP, and the Greenhouse Gas Protocol, ensuring the platform upholds global standards of credibility, compliance, and transparency.</p>
                            <div class="advisor-linkedin-mobile">
                                <a href="#" class="linkedin-btn-mobile">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom - Desktop -->
    <div class="container bottom d-none d-md-block">
        <h2>We are building the trust layer for ESG software, setting a new standard for verified sustainability data.</h2>
        <p>Collaborate with us through pilots, partnerships, or integrations and be part of the movement to make audit-ready climate data the norm for every organization.</p>
        <div class="mt-5">
            <a href="{{ url('/waitlist') }}" class="start-for-free-btn">Start for Free</a>
            <a href="{{ url('/waitlist') }}" class="request-demo-btn">Request a Demo</a>
        </div>
    </div>

    <!-- Bottom - Mobile -->
    <div class="container bottom-mobile d-flex d-md-none mb-5">
        <div class="bottom-card-mobile">
            <h6>We are building the trust layer for ESG software, setting a new standard for verified sustainability data.</h6>
            <p>Collaborate with us through pilots, partnerships, or integrations and be part of the movement to make audit-ready climate data the norm for every organization.</p>
            <div class="bottom-buttons mt-4" style="display: flex; flex-direction: column; align-items: center;">
                <a href="{{ url('/waitlist') }}" class="start-for-free-btn">Start for Free</a>
                <a href="{{ url('/waitlist') }}" class="request-demo-btn mt-3">Request a Demo</a>
            </div>
        </div>
    </div>
</div>

<script>
</script>
@endsection
