@extends('layouts.app')

@section('title', 'Home')
@section('meta_title', 'Carbon AI | AI-Driven Carbon Accounting & ESG Validation')
@section('meta_description', 'Carbon AI helps organizations measure, reduce and verify carbon footprints with AI-driven carbon accounting and ESG validation for net zero')
@section('content')
<div>
    <div class="homepage-bg">
        <div class="green-ball">
            <img src="{{ asset('images/home/greenball.png') }}" style="max-width: 100%;">
        </div>
        <div class="container">
            <div class="row-centered">
                <div class="header">
                    <h1>AI for Net Zero</h1>
                    <h3>The audit-ready ESG and carbon accounting platform that validates Scope 1–3 data with AI precision.</h3>
                </div>
                <div class="header-btn">
                    <a href="{{ url('/waitlist') }}" class="start-for-free-btn">Start for Free</a> &nbsp;&nbsp;
                    <a href="{{ url('/waitlist') }}" class="request-demo-btn">Request a Demo</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Display Images - Desktop -->
    <div class="container-fluid display-section p-0 d-md-block d-none" style="background-image: url('{{ asset('images/home/faded-green.png') }}'); background-size: contain; background-position: center; background-repeat: no-repeat;">
        <div class="display-wrapper">
            <img src="{{ asset('images/home/display-top.png') }}" alt="Display Top" class="display-image">
            <img src="{{ asset('images/home/display-btm.png') }}" alt="Display Bottom" class="display-image">
        </div>
    </div>

    <!-- Display Images - Mobile -->
    <div class="container">
        <div class="display-wrapper d-block d-md-none px-3" style="margin-top: -15rem;">
            <img src="{{ asset('images/home/display-top.png') }}" alt="Display Top" class="display-image">
            <img src="{{ asset('images/home/display-btm.png') }}" alt="Display Bottom" class="display-image mt-4">
        </div>
    </div>


    <!-- Value Proposition -->
    <div class="value-proposition">
        <div class="container">
            <h3>Value Proposition</h3>
            <div class="row align-items-center value-proposition-content">
                <div class="col-12 col-md-6 text-center">
                    <img src="{{ asset('images/home/pic6.png') }}" class="img-fluid rounded shadow" style="z-index: 3; position: relative;">
                </div>

                <div class="col-12 col-md-6">
                    <div class="value-boxes">
                        <div class="value-box" onclick="toggleValueBox(this)">
                            <div class="value-header">
                                <h4 class="value-title">Validate</h4>
                                <button class="dropdown-arrow">↓</button>
                            </div>
                            <div class="value-divider"></div>
                            <p class="value-description">AI-powered and audit-ready ESG data validation for Scope 1-3 emissions.</p>
                        </div>

                        <div class="value-box" onclick="toggleValueBox(this)">
                            <div class="value-header">
                                <h4 class="value-title">Enrich</h4>
                                <button class="dropdown-arrow">↓</button>
                            </div>
                            <div class="value-divider"></div>
                            <p class="value-description">Enhance accuracy with localized emission factors and confidence scoring.</p>
                        </div>

                        <div class="value-box" onclick="toggleValueBox(this)">
                            <div class="value-header">
                                <h4 class="value-title">Connect</h4>
                                <button class="dropdown-arrow">↓</button>
                            </div>
                            <div class="value-divider"></div>
                            <p class="value-description">Integrate seamlessly with carbon accounting software, registries, and financial systems through API.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="/images/home/greenball-side.png" style="max-width: 100%; position: absolute; left: 0; top: 250%; transform: scaleX(-1);" class="greenball-side">
    </div>

    <!-- Case Tiles -->
    <div class="cards d-none d-md-block">
        <div class="container">
            <div class="row g-4 mt-4">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100" style="background-image: url('{{ asset('images/home/pic1.png') }}'); background-size: cover; background-position: center;">
                        <div class="card-body">
                            <h4>Hospitality & <br>Tourism</h4>
                            <div class="content-row">
                                <p>Guest-level sustainability data that converts into verified carbon savings.</p>
                                <a href=""><img src="/images/home/arrow.svg"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100" style="background-image: url('{{ asset('images/home/pic2.png') }}'); background-size: cover; background-position: center;">
                        <div class="card-body">
                            <h4 style="color: #1AB3C5">Finance & <br>Investments</h4>
                            <div class="content-row">
                                <p>Verified ESG data for green loans, bonds, and carbon-linked financing.</p>
                                <a href=""><img src="/images/home/arrow.svg"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100" style="background-image: url('{{ asset('images/home/pic3.png') }}'); background-size: cover; background-position: center;">
                        <div class="card-body">
                            <h4>Supply Chain & Manufacturing</h4>
                            <div class="content-row">
                                <p>AI validation for supplier Scope 1-3 disclosures and benchmarking.</p>
                                <a href=""><img src="/images/home/arrow.svg"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100" style="background-image: url('{{ asset('images/home/pic4.png') }}'); background-size: cover; background-position: center;">
                        <div class="card-body">
                            <h4 style="color: #1AB3C5">Corporate &<br> Integration</h4>
                            <div class="content-row">
                                <p>Plug Carbon AI into your ESG, POS, or ERP systems seamlessly.</p>
                                <a href=""><img src="/images/home/arrow.svg"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="/images/home/greenball-side.png" class="greenball-side-right">
    </div>

    <!-- Cards - Mobile Version -->
    <div class="cards-mobile d-block d-md-none px-3">
        <div class="container">
            <div class="row">
                <div class="col-6 my-4">
                    <div class="card-mobile h-100" style="background-image: url('{{ asset('images/home/pic1.png') }}'); background-size: cover; background-position: center;">
                        <div class="card-body-mobile">
                            <h4>Hospitality &amp; <br>Tourism</h4>
                            <div class="content-row-mobile">
                                <p>Guest-level sustainability data that converts into verified carbon savings.</p>
                                <a href=""><img src="{{ asset('images/home/arrow.svg') }}"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 my-4">
                    <div class="card-mobile h-100" style="background-image: url('{{ asset('images/home/pic2.png') }}'); background-size: cover; background-position: center;">
                        <div class="card-body-mobile">
                            <h4 style="color: #1AB3C5">Finance &amp; <br>Investments</h4>
                            <div class="content-row-mobile">
                                <p>Verified ESG data for green loans, bonds, and carbon-linked financing.</p>
                                <a href=""><img src="{{ asset('images/home/arrow.svg') }}"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card-mobile h-100" style="background-image: url('{{ asset('images/home/pic3.png') }}'); background-size: cover; background-position: center;">
                        <div class="card-body-mobile">
                            <h4>Supply Chain &amp; Manufacturing</h4>
                            <div class="content-row-mobile">
                                <p>AI validation for supplier Scope 1-3 disclosures and benchmarking.</p>
                                <a href=""><img src="{{ asset('images/home/arrow.svg') }}"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card-mobile h-100" style="background-image: url('{{ asset('images/home/pic4.png') }}'); background-size: cover; background-position: center;">
                        <div class="card-body-mobile">
                            <h4 style="color: #1AB3C5">Corporate &amp; Integration</h4>
                            <div class="content-row-mobile">
                                <p>Plug Carbon AI into your ESG, POS, or ERP systems seamlessly.</p>
                                <a href=""><img src="{{ asset('images/home/arrow.svg') }}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Differentiation -->
    <div class="differentiation">
        <div class="container differentiation-content">
            <div class="row">
                <div class="col-12 col-md-6" style="display: flex; flex-direction: column; justify-content: center;">
                    <h2 style="-webkit-text-fill-color: #fff;">Others measure.</h2>
                    <h2>We validate.</h2>
                    <div class="my-3">
                        <h3>Carbon AI isn’t just a reporting platform. It is an AI driven verification layer linking ESG and carbon accounting data to financial markets.</h3>
                    </div>
                    <div class="my-3"><a href="{{ url('/waitlist') }}" class="request-demo-btn m-0">Request a Demo</a></div>
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('images/home/pic5.png') }}" class="differentiation-img img-fluid rounded shadow" style="float: right;">
                </div>
            </div>
        </div>
    </div>

    <!-- Logos -->
    <div class="logos" style="background: #fff; position: relative;">
        <div class="logos-wrapper"">
            <div class="logos-slider" id="logosSlider">
                <img src="{{ asset('images/home/logo1.svg') }}" alt="Logo 1">
                <img src="{{ asset('images/home/logo2.svg') }}" alt="Logo 2">
                <img src="{{ asset('images/home/logo3.svg') }}" alt="Logo 3">
                <img src="{{ asset('images/home/logo4.svg') }}" alt="Logo 4">
                <img src="{{ asset('images/home/logo5.svg') }}" alt="Logo 5">
                <img src="{{ asset('images/home/logo6.svg') }}" alt="Logo 6">
                <img src="{{ asset('images/home/logo7.svg') }}" alt="Logo 7">
                <img src="{{ asset('images/home/logo8.svg') }}" alt="Logo 8">
            </div>
        </div>
    </div>
    <img src="/images/home/greenball-side.png" class="greenball-side-left-top">

    <!-- Insights - Desktop Version -->
    <div class="insights d-none d-md-block">
        <div class="container">
            <h3>Stay Ahead of the Curve</h3>
            <h5>Discover verified carbon data and decarbonization insights aligned with SBTi and global disclosure standards.</h5>

            <div class="row my-5">
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="insights-card">
                        <div class="insights-card-body">
                            <h4>Finance Emissions Guide</h4>
                            <div class="insights-content-row">
                                <a href="#" class="insights-link">Explore Insights</a>
                                <a href="#" class="insights-arrow">
                                    <i class="fa-solid fa-arrow-up"></i>
                                </a>
                            </div>
                            <img src="{{ asset('images/blog1.jpg') }}" alt="Finance Emission" class="insights-image">
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="insights-card">
                        <div class="insights-card-body">
                            <h4 class="insights-title-cyan">Supplier Data Exchange</h4>
                            <div class="insights-content-row">
                                <a href="#" class="insights-link">Explore Insights</a>
                                <a href="#" class="insights-arrow">
                                    <i class="fa-solid fa-arrow-up"></i>
                                </a>
                            </div>
                            <img src="{{ asset('images/blog2.jpg') }}" alt="Supplier Data Exchange" class="insights-image">
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="insights-card">
                        <div class="insights-card-body">
                            <h4>Scope 3 Decarbonization Insights (Asia & GBA)</h4>
                            <div class="insights-content-row">
                                <a href="#" class="insights-link">Explore Insights</a>
                                <a href="#" class="insights-arrow">
                                    <i class="fa-solid fa-arrow-up"></i>
                                </a>
                            </div>
                            <img src="{{ asset('images/blog3.jpg') }}" alt="Corporate Integration" class="insights-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Insights - Mobile Version -->
    <div class="insights-mobile d-block d-md-none">
        <div class="container">
            <h3>Stay Ahead of the Curve</h3>
            <h5 class="my-3">Discover verified carbon data and decarbonization insights aligned with SBTi and global disclosure standards.</h5>
            <div class="row mt-5">
                <div class="col-6">
                    <div class="insights-card-mobile">
                        <div class="insights-card-body-mobile">
                            <h4>Finance Emissions Guide</h4>
                            <div class="insights-content-row-mobile">
                                <a href="#" class="insights-link-mobile">Explore Insights</a>
                                <a href="#" class="insights-arrow-mobile">
                                    <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                </a>
                            </div>
                            <img src="{{ asset('images/blog1.jpg') }}" alt="Finance Emission" class="insights-image-mobile">
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="insights-card-mobile">
                        <div class="insights-card-body-mobile">
                            <h4 class="insights-title-cyan-mobile">Supplier Data Exchange</h4>
                            <div class="insights-content-row-mobile">
                                <a href="#" class="insights-link-mobile">Explore Insights</a>
                                <a href="#" class="insights-arrow-mobile">
                                    <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                </a>
                            </div>
                            <img src="{{ asset('images/blog2.jpg') }}" alt="Supplier Data Exchange" class="insights-image-mobile">
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="insights-card-mobile">
                        <div class="insights-card-body-mobile">
                            <h4>Scope 3 Decarbonization Insights (Asia & GBA)</h4>
                            <div class="insights-content-row-mobile">
                                <a href="#" class="insights-link-mobile">Explore Insights</a>
                                <a href="#" class="insights-arrow-mobile">
                                    <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                </a>
                            </div>
                            <img src="{{ asset('images/blog3.jpg') }}" alt="Corporate Integration" class="insights-image-mobile">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom - Desktop Version -->
    <div class="container bottom d-none d-md-block">
        <h2>Carbon data you can trust</h2>
        <div class="my-5">
            <a href="{{ url('/waitlist') }}" class="start-for-free-btn">Start for Free</a>
            <a href="{{ url('/waitlist') }}" class="request-demo-btn">Request a Demo</a>
        </div>
    </div>

    <!-- Bottom - Mobile Version -->
    <div class="container bottom-mobile d-flex d-md-none mb-5">
        <div class="bottom-card-mobile">
            <h2>Carbon data you can trust</h2>
            <div class="bottom-buttons mt-4" style="display: flex; flex-direction: column; align-items: center;">
                <a href="{{ url('/waitlist') }}" class="start-for-free-btn">Start for Free</a>
                <a href="{{ url('/waitlist') }}" class="request-demo-btn mt-3">Request a Demo</a>
            </div>
        </div>
    </div>
</div>
<script>

document.addEventListener("DOMContentLoaded", function () {
    // Accordion image change
    const accordionItems = document.querySelectorAll(".accordion-collapse");
    const image = document.getElementById("dropdown-image");

    accordionItems.forEach(item => {
        item.addEventListener("show.bs.collapse", function () {
            const newImg = item.getAttribute("data-img");
            if (newImg) {
                image.src = newImg;
            }
        });
    });

    // Logos
    const slider = document.getElementById("logosSlider");
    let speed = 1;
    let position = 0;

    function animate() {
        position -= speed;
        slider.style.transform = `translateX(${position}px)`;

        const firstLogo = slider.firstElementChild;
        const firstLogoWidth = firstLogo.offsetWidth + 80;

        if (Math.abs(position) >= firstLogoWidth) {
        slider.appendChild(firstLogo);
        position += firstLogoWidth;
        }

        requestAnimationFrame(animate);
    }
    animate();
});

function toggleValueBox(element) {
    // Remove active class from all value boxes
    document.querySelectorAll('.value-box').forEach(box => {
        box.classList.remove('active');
    });

    // Add active class to clicked box
    element.classList.add('active');
}

// Set first value box as active by default when page loads
document.addEventListener('DOMContentLoaded', function() {
    const firstValueBox = document.querySelector('.value-box');
    if (firstValueBox) {
        firstValueBox.classList.add('active');
    }
});
</script>
@endsection
