@extends('layouts.app')

@section('title', 'Blogs')
@section('meta_title', 'Carbon AI Insights | ESG, Net Zero & Climate Tech')
@section('meta_description', 'Read expert insights on ESG software, carbon accounting, and climate tech. See how Carbon AI drives the net-zero transition with verified sustainability data.')

@section('content')
<div>
    <div class="blogs-bg">
        <div class="green-ball">
            <img src="{{ asset('images/home/greenball.png') }}" style="max-width: 100%;">
        </div>
        <div class="container">
            <div class="row-centered">
                <div class="header">
                    <h1>Blogs</h1>
                    <h3>Turning sustainability intelligence into action.</h3>
                    <h3>Explore insights on carbon accounting software, ESG reporting, decarbonization, climate technology, and the path to Net Zero.</h3>
                </div>
            </div>
        </div>
    </div>

    <img src="/images/home/greenball-side.png" style="max-width: 100%; position: absolute; right: 0; top: 80%;">

    <!-- Blog Tabs Section - Desktop -->
    <div class="blog-tabs-section d-none d-md-block">
        <div class="container p-0">
            <!-- Tab Navigation -->
            <div class="tab-navigation">
                <button class="tab-btn active" onclick="showTab('all')">All</button>
                <button class="tab-btn" onclick="showTab('carbon-accounting')">Carbon Accounting</button>
                <button class="tab-btn" onclick="showTab('hospitality')">Hospitality & Tourism</button>
                <button class="tab-btn" onclick="showTab('net-zero')">Net Zero & Strategy</button>
                <button class="tab-btn" onclick="showTab('regulations')">Regulations & Disclosure</button>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- All Blogs Tab -->
                <div id="all" class="tab-panel active">
                    <div class="blog-cards-grid p-0">
                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blogs/pic1.png') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="author mt-3">
                                    <div class="blog-author">Author name</div>
                                    <div class="blog-date">Date</div>
                                </div>
                                <h3 class="blog-title">Why audit ready ESG software is a competitive edge</h3>
                                <p class="blog-excerpt">Learn how trusted carbon accounting software strengthens assurance and financing while reducing carbon emissions on the path to net zero.</p>
                                <h6 class="blog-read-more">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>

                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blogs/pic2.png') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-content-wrapper">
                                    <div class="author mt-3">
                                        <div class="blog-author">Author name</div>
                                        <div class="blog-date">Date</div>
                                    </div>
                                    <h3 class="blog-title">AI anomaly detection for a more accurate carbon footprint</h3>
                                    <p class="blog-excerpt">See how data validation and localized factors improve precision and accelerate decarbonization across Scope 1, 2, and 3.</p>
                                </div>
                                <h6 class="blog-read-more">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>

                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blogs/pic3.png') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-content-wrapper">
                                    <div class="author mt-3">
                                        <div class="blog-author">Author name</div>
                                        <div class="blog-date">Date</div>
                                    </div>
                                    <h3 class="blog-title">Climate tech in hospitality</h3>
                                    <p class="blog-excerpt"> From guest activity data to verified reporting.
                                        How digital passports turn operations data into trusted carbon accounting software outputs and measurable decarbonization.</p>
                                </div>
                                <h6 class="blog-read-more">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>

                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blogs/pic4.png') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-content-wrapper">
                                    <div class="author mt-3">
                                        <div class="blog-author">Author name</div>
                                        <div class="blog-date">Date</div>
                                    </div>
                                    <h3 class="blog-title">Malaysia reporting updates for SMEs</h3>
                                    <p class="blog-excerpt">What to know now.
                                        Practical steps to improve ESG software readiness and manage carbon emissions while moving toward net zero.</p>
                                </div>
                                <h6 class="blog-read-more">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carbon Accounting Tab -->
                <div id="carbon-accounting" class="tab-panel">
                    <div class="blog-cards-grid">
                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blog1.jpg') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-content-wrapper">
                                    <div class="author mt-3">
                                        <div class="blog-author">Author name</div>
                                        <div class="blog-date">Date</div>
                                    </div>
                                    <h3 class="blog-title">Understanding Scope 1, 2, and 3 Emissions</h3>
                                    <p class="blog-excerpt">A comprehensive guide to carbon footprint measurement and reporting standards.</p>
                                </div>
                                <h6 class="blog-read-more">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>

                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blog2.jpg') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-content-wrapper">
                                    <div class="author mt-3">
                                        <div class="blog-author">Author name</div>
                                        <div class="blog-date">Date</div>
                                    </div>
                                    <h3 class="blog-title">Carbon Footprint Calculation Methods</h3>
                                    <p class="blog-excerpt">Different approaches to calculating your organization's carbon footprint.</p>
                                </div>
                                <h6 class="blog-read-more">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hospitality & Tourism Tab -->
                <div id="hospitality" class="tab-panel">
                    <div class="blog-cards-grid">
                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blog2.jpg') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-content-wrapper">
                                    <div class="author mt-3">
                                        <div class="blog-author">Author name</div>
                                        <div class="blog-date">Date</div>
                                    </div>
                                    <h3 class="blog-title">ESG Reporting Best Practices for 2025</h3>
                                    <p class="blog-excerpt">Learn how to create compelling ESG reports that drive stakeholder engagement.</p>
                                </div>
                                <h6 class="blog-read-more">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>

                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blog3.jpg') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-content-wrapper">
                                    <div class="author mt-3">
                                        <div class="blog-author">Author name</div>
                                        <div class="blog-date">Date</div>
                                    </div>
                                    <h3 class="blog-title">ESG Data Collection Strategies</h3>
                                    <p class="blog-excerpt">Effective methods for gathering and validating ESG data across your organization.</p>
                                </div>
                                <h6 class="blog-read-more">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Net Zero Tab -->
                <div id="net-zero" class="tab-panel">
                    <div class="blog-cards-grid">
                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blog2.jpg') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-content-wrapper">
                                    <div class="author mt-3">
                                        <div class="blog-author">Author name</div>
                                        <div class="blog-date">Date</div>
                                    </div>
                                    <h3 class="blog-title">Net Zero Roadmap for Enterprises</h3>
                                    <p class="blog-excerpt">Step-by-step guide to developing a comprehensive net zero strategy.</p>
                                </div>
                                <h6 class="blog-read-more">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>

                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blog3.jpg') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-content-wrapper">
                                    <div class="author mt-3">
                                        <div class="blog-author">Author name</div>
                                        <div class="blog-date">Date</div>
                                    </div>
                                    <h3 class="blog-title">Carbon Offsetting Strategies</h3>
                                    <p class="blog-excerpt">Understanding when and how to use carbon offsets in your net zero journey.</p>
                                </div>
                                <h6 class="blog-read-more">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Regulations Tab -->
                <div id="regulations" class="tab-panel">
                    <div class="blog-cards-grid">
                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blog2.jpg') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-content-wrapper">
                                    <div class="author mt-3">
                                        <div class="blog-author">Author name</div>
                                        <div class="blog-date">Date</div>
                                    </div>
                                    <h3 class="blog-title">Industry Trends in Carbon Management</h3>
                                    <p class="blog-excerpt">Latest trends and developments in the carbon management industry.</p>
                                </div>
                                <h6 class="blog-read-more">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>

                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blog3.jpg') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-content-wrapper">
                                    <div class="author mt-3">
                                        <div class="blog-author">Author name</div>
                                        <div class="blog-date">Date</div>
                                    </div>
                                    <h3 class="blog-title">IFRS S2 Climate Disclosure Guide</h3>
                                    <p class="blog-excerpt">Comprehensive guide to IFRS S2 climate disclosure requirements.</p>
                                </div>
                                <h6 class="blog-read-more">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Blog Cards - 2x2 Grid -->
    <div class="blog-tabs-section-mobile d-block d-md-none">
        <div class="container p-0">
            <!-- Tab Navigation -->
            <div class="tab-navigation">
                <button class="tab-btn active" onclick="showTabMobile('all')">All</button>
                <button class="tab-btn" onclick="showTabMobile('carbon-accounting')">Carbon Accounting</button>
                <button class="tab-btn" onclick="showTabMobile('hospitality')">Hospitality &amp; Tourism</button>
                <button class="tab-btn" onclick="showTabMobile('net-zero')">Net Zero &amp; Strategy</button>
                <button class="tab-btn" onclick="showTabMobile('regulations')">Regulations &amp; Disclosure</button>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- All Blogs Tab -->
                <div id="all-mobile" class="tab-panel active">
                    <div class="blog-cards-grid-mobile p-0">
                        <div class="blog-card-mobile">
                            <div class="blog-card-image-mobile">
                                <img src="{{ asset('images/blogs/pic1.png') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content-mobile">
                                <div class="author-mobile mt-3">
                                    <div class="blog-author-mobile">Author name</div>
                                    <div class="blog-date-mobile">Date</div>
                                </div>
                                <h3 class="blog-title-mobile">Why audit ready ESG software is a competitive edge</h3>
                                <p class="blog-excerpt-mobile">Learn how trusted carbon accounting software strengthens assurance and financing while reducing carbon emissions on the path to net zero.</p>
                                <h6 class="blog-read-more-mobile">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>

                        <div class="blog-card-mobile">
                            <div class="blog-card-image-mobile">
                                <img src="{{ asset('images/blogs/pic2.png') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content-mobile">
                                <div class="author-mobile mt-3">
                                    <div class="blog-author-mobile">Author name</div>
                                    <div class="blog-date-mobile">Date</div>
                                </div>
                                <h3 class="blog-title-mobile" style="color: #1AB3C5;">AI anomaly detection for a more accurate carbon footprint</h3>
                                <p class="blog-excerpt-mobile">See how data validation and localized factors improve precision and accelerate decarbonization across Scope 1, 2, and 3.</p>
                                <h6 class="blog-read-more-mobile">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>

                        <div class="blog-card-mobile">
                            <div class="blog-card-image-mobile">
                                <img src="{{ asset('images/blogs/pic3.png') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content-mobile">
                                <div class="author-mobile mt-3">
                                    <div class="blog-author-mobile">Author name</div>
                                    <div class="blog-date-mobile">Date</div>
                                </div>
                                <h3 class="blog-title-mobile">Climate tech in hospitality</h3>
                                <p class="blog-excerpt-mobile">From guest activity data to verified reporting. How digital passports turn operations data into trusted carbon accounting software outputs and measurable decarbonization.</p>
                                <h6 class="blog-read-more-mobile">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>

                        <div class="blog-card-mobile">
                            <div class="blog-card-image-mobile">
                                <img src="{{ asset('images/blogs/pic4.png') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content-mobile">
                                <div class="author-mobile mt-3">
                                    <div class="blog-author-mobile">Author name</div>
                                    <div class="blog-date-mobile">Date</div>
                                </div>
                                <h3 class="blog-title-mobile" style="color: #1AB3C5;">Malaysia reporting updates for SMEs</h3>
                                <p class="blog-excerpt-mobile">What to know now. Practical steps to improve ESG software readiness and manage carbon emissions while moving toward net zero.</p>
                                <h6 class="blog-read-more-mobile">Read More <img src="/images/home/arrow.svg"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom - Desktop Version -->
    <div class="container bottom d-none d-md-block">
        <h2>Join Our Waitlist</h2>
        <div class="my-5">
            <a href="{{ url('/waitlist') }}" class="start-for-free-btn">Start for Free</a>
            <a href="{{ url('/waitlist') }}" class="request-demo-btn">Request a Demo</a>
        </div>
    </div>

    <!-- Bottom - Mobile Version -->
    <div class="container bottom-mobile d-flex d-md-none mb-5">
        <div class="bottom-card-mobile">
            <h2>Join Our Waitlist</h2>
            <div class="bottom-buttons mt-4" style="display: flex; flex-direction: column; align-items: center;">
                <a href="{{ url('/waitlist') }}" class="start-for-free-btn">Start for Free</a>
                <a href="{{ url('/waitlist') }}" class="request-demo-btn mt-3">Request a Demo</a>
            </div>
        </div>
    </div>

    <!-- Subscribe - Desktop -->
    {{-- <div class="container subscribe px-5 d-none d-md-block">
        <h1>Subscribe</h1>
        <p class="my-4">Receive monthly insights on carbon accounting, ESG software, climate technology, and credible decarbonization strategies for enterprises and SMEs.</p>
        <div class="subscribe-form my-5">
            <div class="form-row">
                <div class="email-subscription">
                    <input type="email" placeholder="Enter your email" required>
                </div>
                <a href="#" class="subscribe-btn">Subscribe</a>
            </div>
            <div class="button-row">
                <a href="#" class="readmore-btn">Read More</a>
            </div>
        </div>
        <div class="" style="border-top: 1px solid #595959; padding-top: 3rem;">
            <p>Carbon AI publishes guidance and analysis on ESG software, carbon accounting, climate technology adoption, carbon footprint measurement, decarbonization planning, and verified pathways to Net Zero.</p>
        </div>
    </div> --}}

    <!-- Subscribe - Mobile -->
    {{-- <div class="container subscribe-mobile d-flex d-md-none my-5">
        <div class="subscribe-card-mobile">
            <h1>Subscribe</h1>
            <p>Receive monthly insights on carbon accounting, ESG software, climate technology, and credible decarbonization strategies for enterprises and SMEs.</p>
            <div class="subscribe-form-mobile mt-4" style="display: flex; flex-direction: column; align-items: stretch; gap: 1rem;">
                <input type="email" placeholder="Enter your email" class="email-input-mobile" required>
                <div style="display: flex; flex-direction: row; gap: 1rem; justify-content: center; align-items: center;">
                    <a href="#" class="subscribe-btn-mobile">Subscribe</a>
                    <a href="#" class="readmore-btn-mobile">Read More</a>
                </div>
            </div>
            <div class="subscribe-footer-mobile" style="border-top: 1px solid #595959; padding-top: 2rem; margin-top: 2rem;">
                <p>Carbon AI publishes guidance and analysis on ESG software, carbon accounting, climate technology adoption, carbon footprint measurement, decarbonization planning, and verified pathways to Net Zero.</p>
            </div>
        </div>
    </div> --}}
</div>

<script>
function showTab(tabId) {
    // Hide all tab panels
    const panels = document.querySelectorAll('.tab-panel');
    panels.forEach(panel => {
        panel.classList.remove('active');
    });

    // Remove active class from all tab buttons
    const buttons = document.querySelectorAll('.tab-btn');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    // Show the selected tab panel
    const selectedPanel = document.getElementById(tabId);
    if (selectedPanel) {
        selectedPanel.classList.add('active');
    }

    // Add active class to the clicked button
    const clickedButton = event.target;
    clickedButton.classList.add('active');
}

function showTabMobile(tabId) {
    // Hide all tab panels
    const panels = document.querySelectorAll('.tab-panel');
    panels.forEach(panel => {
        panel.classList.remove('active');
    });

    // Remove active class from all tab buttons
    const buttons = document.querySelectorAll('.tab-btn');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    // Show the selected tab panel
    const selectedPanel = document.getElementById(tabId + '-mobile');
    if (selectedPanel) {
        selectedPanel.classList.add('active');
    }

    // Add active class to the clicked button
    const clickedButton = event.target;
    clickedButton.classList.add('active');
}
</script>
@endsection
