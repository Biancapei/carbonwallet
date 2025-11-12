@extends('layouts.app')

@section('title', 'Blogs')
@section('meta_title', 'Carbon AI Insights | ESG, Net Zero & Climate Tech')
@section('meta_description', 'Read expert insights on ESG software, carbon accounting, and climate tech. See how Carbon AI drives the net-zero transition with verified sustainability data.')

@php
    use Illuminate\Support\Str;

    $activeTab = 'all';
    if(request()->has('carbon-accounting-page')) {
        $activeTab = 'carbon-accounting';
    } elseif(request()->has('hospitality-page')) {
        $activeTab = 'hospitality';
    } elseif(request()->has('net-zero-page')) {
        $activeTab = 'net-zero';
    } elseif(request()->has('regulations-page')) {
        $activeTab = 'regulations';
    }
@endphp

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

    <div id="blogs-wrapper">
        @include('partials.blogs-wrapper', compact('blogs', 'carbonAccountingBlogs', 'hospitalityBlogs', 'netZeroBlogs', 'regulationsBlogs', 'activeTab'))
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
</div>

<script>
function showTab(tabId) {
    const panels = document.querySelectorAll('.tab-panel');
    panels.forEach(panel => {
        panel.classList.remove('active');
    });

    const buttons = document.querySelectorAll('.tab-btn');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    const selectedPanel = document.getElementById(tabId);
    if (selectedPanel) {
        selectedPanel.classList.add('active');
    }

    const clickedButton = event.target;
    clickedButton.classList.add('active');
}

function showTabMobile(tabId) {
    const panels = document.querySelectorAll('.tab-panel');
    panels.forEach(panel => {
        panel.classList.remove('active');
    });

    const buttons = document.querySelectorAll('.tab-btn');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    const selectedPanel = document.getElementById(tabId + '-mobile');
    if (selectedPanel) {
        selectedPanel.classList.add('active');
    }

    const clickedButton = event.target;
    clickedButton.classList.add('active');
}

function attachPaginationHandlers() {
    document.querySelectorAll('[data-pagination] a.blog-pagination-link').forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const url = this.getAttribute('href');

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                const currentWrapper = document.getElementById('blogs-wrapper');
                if (!currentWrapper) {
                    window.location.href = url;
                    return;
                }

                currentWrapper.innerHTML = data.html;
                history.pushState({}, '', url);

                attachPaginationHandlers();

                const section = document.getElementById('blogs-section');
                if (section) {
                    section.scrollIntoView({ behavior: 'auto', block: 'start' });
                }
            })
            .catch(function (error) {
                console.error('Pagination load failed:', error);
                window.location.href = url;
            });
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    attachPaginationHandlers();
});
</script>
@endsection
