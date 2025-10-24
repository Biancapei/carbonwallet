@extends('layouts.app')

@section('title', 'Blogs')

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
                    <h3 style="line-height: 40px;">Turning sustainability intelligence into action.</h3>
                    <h3 style="line-height: 40px;">Explore insights on carbon accounting software, ESG reporting, decarbonization, climate technology, and the path to Net Zero.</h3>
                </div>
            </div>
        </div>
    </div>

    <img src="/images/home/greenball-side.png" style="max-width: 100%; position: absolute; right: 0; top: 80%;">

    <!-- Blog Tabs Section -->
    <div class="blog-tabs-section">
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
                                <div class="author">
                                    <div class="blog-author">Alex Thompson</div>
                                    <div class="blog-date">Dec 15, 2024</div>
                                </div>
                                <h3 class="blog-title">Understanding Scope 1, 2, and 3 Emissions</h3>
                                <p class="blog-excerpt">A comprehensive guide to carbon footprint measurement and reporting standards.</p>
                                <div class="blog-meta">
                                    <span class="blog-date">Dec 15, 2024</span>
                                    <span class="blog-read-time">5 min read</span>
                                </div>
                            </div>
                        </div>

                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blog2.jpg') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="author">
                                    <div class="blog-author">Lisa Wang</div>
                                    <div class="blog-date">Dec 5, 2024</div>
                                </div>
                                <h3 class="blog-title">Carbon Footprint Calculation Methods</h3>
                                <p class="blog-excerpt">Different approaches to calculating your organization's carbon footprint.</p>
                                <div class="blog-meta">
                                    <span class="blog-date">Dec 5, 2024</span>
                                    <span class="blog-read-time">8 min read</span>
                                </div>
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
                                <div class="author">
                                    <div class="blog-author">James Wilson</div>
                                    <div class="blog-date">Dec 12, 2024</div>
                                </div>
                                <h3 class="blog-title">ESG Reporting Best Practices for 2025</h3>
                                <p class="blog-excerpt">Learn how to create compelling ESG reports that drive stakeholder engagement.</p>
                                <div class="blog-meta">
                                    <span class="blog-date">Dec 12, 2024</span>
                                    <span class="blog-read-time">7 min read</span>
                                </div>
                            </div>
                        </div>

                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blog3.jpg') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="author">
                                    <div class="blog-author">Maria Garcia</div>
                                    <div class="blog-date">Dec 3, 2024</div>
                                </div>
                                <h3 class="blog-title">ESG Data Collection Strategies</h3>
                                <p class="blog-excerpt">Effective methods for gathering and validating ESG data across your organization.</p>
                                <div class="blog-meta">
                                    <span class="blog-date">Dec 3, 2024</span>
                                    <span class="blog-read-time">6 min read</span>
                                </div>
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
                                <div class="author">
                                    <div class="blog-author">Robert Brown</div>
                                    <div class="blog-date">Nov 25, 2024</div>
                                </div>
                                <h3 class="blog-title">Net Zero Roadmap for Enterprises</h3>
                                <p class="blog-excerpt">Step-by-step guide to developing a comprehensive net zero strategy.</p>
                                <div class="blog-meta">
                                    <span class="blog-date">Nov 25, 2024</span>
                                    <span class="blog-read-time">10 min read</span>
                                </div>
                            </div>
                        </div>

                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blog3.jpg') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="author">
                                    <div class="blog-author">Jennifer Lee</div>
                                    <div class="blog-date">Nov 22, 2024</div>
                                </div>
                                <h3 class="blog-title">Carbon Offsetting Strategies</h3>
                                <p class="blog-excerpt">Understanding when and how to use carbon offsets in your net zero journey.</p>
                                <div class="blog-meta">
                                    <span class="blog-date">Nov 22, 2024</span>
                                    <span class="blog-read-time">7 min read</span>
                                </div>
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
                                <div class="author">
                                    <div class="blog-author">Thomas Anderson</div>
                                    <div class="blog-date">Nov 15, 2024</div>
                                </div>
                                <h3 class="blog-title">Industry Trends in Carbon Management</h3>
                                <p class="blog-excerpt">Latest trends and developments in the carbon management industry.</p>
                                <div class="blog-meta">
                                    <span class="blog-date">Nov 15, 2024</span>
                                    <span class="blog-read-time">5 min read</span>
                                </div>
                            </div>
                        </div>

                        <div class="blog-card">
                            <div class="blog-card-image">
                                <img src="{{ asset('images/blog3.jpg') }}" alt="Blog Post">
                            </div>
                            <div class="blog-card-content">
                                <div class="author">
                                    <div class="blog-author">Amanda Taylor</div>
                                    <div class="blog-date">Nov 12, 2024</div>
                                </div>
                                <h3 class="blog-title">Future of Climate Technology</h3>
                                <p class="blog-excerpt">Predictions and insights into the future of climate technology solutions.</p>
                                <div class="blog-meta">
                                    <span class="blog-date">Nov 12, 2024</span>
                                    <span class="blog-read-time">7 min read</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscribe -->
    <div class="container subscribe px-5">
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
    </div>
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
</script>
@endsection
