@extends('admin.layout')

@section('content')
<div>
    <div class="admin-create-header">
        <h1>Create New Blog Post</h1>
        <a href="{{ route('admin.index') }}" class="back-to-posts-btn">
            <i class="fa-solid fa-arrow-left"></i> &nbsp;Back to Posts
        </a>
    </div>

    <div class="admin-form-container">
        <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data" class="admin-form">
            @csrf

            <!-- Slug -->
            <div class="admin-form-group">
                <label for="slug" class="admin-form-label">
                    Add Slug
                </label>
                <input type="text"
                       id="slug"
                       name="slug"
                       value="{{ old('slug') }}"
                       class="admin-form-input"
                       placeholder="Enter custom URL slug (e.g., my-blog-post)"
                       maxlength="70">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 5px;">
                    <p class="admin-form-help-text" style="margin: 0;">Custom URL for this blog post. Spaces will be converted to hyphens automatically. Leave empty to auto-generate from title.</p>
                    <span id="slug-char-count" style="font-size: 12px; color: #6b7280; margin-left: 10px;">0/70</span>
                </div>
                @error('slug')
                    <p class="admin-form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Title -->
            <div class="admin-form-group">
                <label for="blogTitle" class="admin-form-label">
                    Blog Title
                </label>
                <input type="text"
                       id="blogTitle"
                       name="title"
                       value="{{ old('title') }}"
                       class="admin-form-input"
                       placeholder="Enter blog post title"
                       maxlength="70"
                       required>
                <div style="display: flex; justify-content: flex-end; align-items: center; margin-top: 5px;">
                    <span id="title-char-count" style="font-size: 12px; color: #6b7280; margin-left: 10px;">{{ strlen(old('title', '')) }}/70</span>
                </div>
                @error('title')
                    <p class="admin-form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Add Excerpt -->
            <div class="admin-form-group">
                <label for="excerpt" class="admin-form-label">
                    Add Excerpt
                </label>
                <input type="text"
                       id="excerpt"
                       name="excerpt"
                       value="{{ old('excerpt') }}"
                       class="admin-form-input"
                       placeholder="Enter blog excerpt (will display on blog listing pages)"
                       maxlength="160">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 5px;">
                    <p class="admin-form-help-text" style="margin: 0;">Brief summary of the blog post. Leave empty to auto-generate from content.</p>
                    <span id="excerpt-char-count" style="font-size: 12px; color: #6b7280; margin-left: 10px;">0/160</span>
                </div>
                @error('excerpt')
                    <p class="admin-form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category and Status Row -->
            <div class="admin-form-row">
                <!-- Category -->
                <div>
                    <label for="category" class="admin-form-label">
                        Category
                    </label>
                    <div class="custom-dropdown">
                        <button type="button" class="custom-dropdown-toggle" id="categoryDropdownToggle" aria-expanded="false">
                            <span class="dropdown-text">
                                @php
                                    $categoryMap = [
                                        '' => 'Select a category (optional)',
                                        'carbon-accounting' => 'Carbon Accounting',
                                        'hospitality' => 'Hospitality & Tourism',
                                        'net-zero' => 'Net Zero & Strategy',
                                        'regulations' => 'Regulations & Disclosure'
                                    ];
                                    $oldCategory = old('category');
                                @endphp
                                {{ $categoryMap[$oldCategory ?? ''] ?? 'Select a category (optional)' }}
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <input type="hidden" id="category" name="category" value="{{ old('category') ?: '' }}">
                        <ul class="dropdown-menu" id="categoryDropdownMenu">
                            <li><a class="dropdown-item" href="#" data-value="">Select a category (optional)</a></li>
                            <li><a class="dropdown-item" href="#" data-value="carbon-accounting">Carbon Accounting</a></li>
                            <li><a class="dropdown-item" href="#" data-value="hospitality">Hospitality & Tourism</a></li>
                            <li><a class="dropdown-item" href="#" data-value="net-zero">Net Zero & Strategy</a></li>
                            <li><a class="dropdown-item" href="#" data-value="regulations">Regulations & Disclosure</a></li>
                        </ul>
                    </div>
                    @error('category')
                        <p class="admin-form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Blog Status -->
                <div>
                    <label for="blog_status" class="admin-form-label">
                        Blog Status *
                    </label>
                    <div class="custom-dropdown">
                        <button type="button" class="custom-dropdown-toggle" id="blogStatusDropdownToggle" aria-expanded="false">
                            <span class="dropdown-text">
                                @php
                                    $statusMap = [
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'deleted' => 'Deleted'
                                    ];
                                    $oldStatus = old('blog_status', 'draft');
                                @endphp
                                {{ $statusMap[$oldStatus] ?? 'Draft' }}
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <input type="hidden" id="blog_status" name="blog_status" value="{{ old('blog_status', 'draft') }}">
                        <ul class="dropdown-menu" id="blogStatusDropdownMenu">
                            <li><a class="dropdown-item" href="#" data-value="draft">Draft</a></li>
                            <li><a class="dropdown-item" href="#" data-value="published">Published</a></li>
                            <li><a class="dropdown-item" href="#" data-value="deleted">Deleted</a></li>
                        </ul>
                    </div>
                    @error('blog_status')
                        <p class="admin-form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Meta Title -->
            <div class="admin-form-group">
                <label for="meta_title" class="admin-form-label">
                    Meta Title
                </label>
                <input type="text"
                       id="meta_title"
                       name="meta_title"
                       value="{{ old('meta_title') }}"
                       class="admin-form-input"
                       placeholder="Enter meta title for SEO">
                @error('meta_title')
                    <p class="admin-form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Meta Description -->
            <div class="admin-form-group">
                <label for="meta_description" class="admin-form-label">
                    Meta Description
                </label>
                <textarea id="meta_description"
                          name="meta_description"
                          rows="3"
                          class="admin-form-textarea"
                          placeholder="Enter meta description for SEO">{{ old('meta_description') }}</textarea>
                @error('meta_description')
                    <p class="admin-form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Add Tags -->
            <div class="admin-form-group">
                <label for="add_tags_input" class="admin-form-label">
                    Add Tags
                </label>

                <!-- Tags Container -->
                <div id="keywords-tags-container" class="keywords-tags-container">
                    <!-- Tags will be displayed here -->
                </div>

                <!-- Hidden input to store keywords -->
                <input type="hidden" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}">

                <!-- Input for adding new keywords -->
                <input type="text"
                       id="add_tags_input"
                       class="admin-form-input"
                       placeholder="Type and press Enter to add tags">
                <!-- Counter -->
                <p id="keywords-counter" class="keywords-counter">15 keywords remaining</p>
                @error('meta_keywords')
                    <p class="admin-form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Banner Image -->
            <div class="admin-form-group">
                <label class="admin-form-label">
                    Banner Image
                </label>
                <p class="admin-form-help-text">
                    In JPEG or PNG format, Width (416px) Height (280px)
                </p>
                <div class="admin-file-upload-wrapper">
                    <input type="file"
                           id="image"
                           name="image"
                           accept="image/*"
                           class="admin-file-input"
                           onchange="updateFileName(this); previewImage(this)">
                    <button type="button" onclick="document.getElementById('image').click()" class="admin-file-browse-btn">
                        Browse...
                    </button>
                    <input type="text" id="featureImage" placeholder="No file chosen" readonly class="admin-file-name">
                </div>
                <div class="admin-form-group" style="margin-top: 15px;">
                    <label class="admin-form-label">
                        Image Alt Text
                    </label>
                    <input type="text"
                           name="image_alt"
                           id="image_alt"
                           class="admin-form-input"
                           placeholder="Enter alt text for the image"
                           value="{{ old('image_alt') }}">
                    @error('image_alt')
                        <p class="admin-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div id="image-preview" class="image-preview">
                    <img id="preview-img" src="" alt="Preview">
                    <br>
                    <button type="button" onclick="removeImage()">Remove Image</button>
                </div>
                @error('image')
                    <p class="admin-form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div class="admin-form-group">
                <label for="content" class="admin-form-label">
                    Content *
                </label>
                       <!-- Rich Text Editor -->
                       <div class="rich-text-editor">
                           <div class="editor-toolbar">
                               <!-- Paragraph/Block Format -->
                               <select id="blockFormat" class="editor-dropdown" onchange="formatText('formatBlock', this.value)">
                                   <option value="p">Paragraph</option>
                                   <option value="h1">Heading 1</option>
                                   <option value="h2">Heading 2</option>
                                   <option value="h3">Heading 3</option>
                                   <option value="h4">Heading 4</option>
                                   <option value="h5">Heading 5</option>
                                   <option value="h6">Heading 6</option>
                               </select>

                               <!-- Heading/Quote Format -->
                               <select id="headingFormat" class="editor-dropdown" onchange="formatText('formatBlock', this.value)">
                                   <option value="p">Normal</option>
                                   <option value="h2">Heading 2</option>
                                   <option value="h3">Heading 3</option>
                                   <option value="h4">Heading 4</option>
                                   <option value="h5">Heading 5</option>
                                   <option value="h6">Heading 6</option>
                                   <option value="blockquote">Quote</option>
                               </select>

                               <!-- Font Size -->
                               <select id="fontSize" class="editor-dropdown">
                                   <option value="1">8pt</option>
                                   <option value="2">10pt</option>
                                   <option value="3" selected>12pt</option>
                                   <option value="4">14pt</option>
                                   <option value="5">18pt</option>
                                   <option value="6">24pt</option>
                                   <option value="7">36pt</option>
                               </select>

                               <!-- Line Height -->
                               <select id="lineHeight" class="editor-dropdown" onchange="applyLineHeight(this.value)">
                                   <option value="1">1</option>
                                   <option value="1.25">1.25</option>
                                   <option value="1.5" selected>1.5</option>
                                   <option value="1.75">1.75</option>
                                   <option value="2">2</option>
                               </select>

                               <!-- Text Formatting -->
                               <button type="button" class="editor-btn" onclick="formatText('bold')" title="Bold">
                                   <i class="fas fa-bold"></i>
                               </button>
                               <button type="button" class="editor-btn" onclick="formatText('italic')" title="Italic">
                                   <i class="fas fa-italic"></i>
                               </button>
                               <button type="button" class="editor-btn" onclick="formatText('underline')" title="Underline">
                                   <i class="fas fa-underline"></i>
                               </button>

                               <!-- Text Color -->
                               <input type="color" id="textColor" class="color-picker" value="#000000" onchange="applyTextColor(this.value)" title="Text Color">

                               <!-- Background Color -->
                               <input type="color" id="bgColor" class="color-picker" value="#ffffff" onchange="applyBackgroundColor(this.value)" title="Background Color">

                               <!-- Alignment -->
                               <button type="button" class="editor-btn" onclick="formatText('justifyLeft')" title="Align Left">
                                   <i class="fas fa-align-left"></i>
                               </button>
                               <button type="button" class="editor-btn" onclick="formatText('justifyCenter')" title="Align Center">
                                   <i class="fas fa-align-center"></i>
                               </button>
                               <button type="button" class="editor-btn" onclick="formatText('justifyRight')" title="Align Right">
                                   <i class="fas fa-align-right"></i>
                               </button>

                               <!-- Numbered List -->
                               <button type="button" class="editor-btn" onclick="formatText('insertOrderedList')" title="Numbered List">
                                   <i class="fas fa-list-ol"></i>
                               </button>

                               <!-- Bullet List -->
                               <button type="button" class="editor-btn" onclick="formatText('insertUnorderedList')" title="Bullet List">
                                   <i class="fas fa-list-ul"></i>
                               </button>

                               <!-- Decrease Indent -->
                               <button type="button" class="editor-btn" onclick="formatText('outdent')" title="Decrease Indent">
                                   <i class="fas fa-outdent"></i>
                               </button>

                               <!-- Increase Indent -->
                               <button type="button" class="editor-btn" onclick="formatText('indent')" title="Increase Indent">
                                   <i class="fas fa-indent"></i>
                               </button>

                               <!-- Insert Image -->
                               <label class="editor-btn" title="Insert Image">
                                   <i class="fas fa-image"></i>
                                   <input type="file" accept="image/*" style="display: none;" onchange="uploadContentImage(this)">
                               </label>

                               <!-- Image Alignment (only active when image is selected) -->
                               <button type="button" class="editor-btn" onclick="alignImage('left')" title="Align Image Left" id="alignImageLeft" style="display: none;">
                                   <i class="fas fa-align-left"></i>
                               </button>
                               <button type="button" class="editor-btn" onclick="alignImage('center')" title="Align Image Center" id="alignImageCenter" style="display: none;">
                                   <i class="fas fa-align-center"></i>
                               </button>
                               <button type="button" class="editor-btn" onclick="alignImage('right')" title="Align Image Right" id="alignImageRight" style="display: none;">
                                   <i class="fas fa-align-right"></i>
                               </button>

                               <!-- Insert Link -->
                               <button type="button" class="editor-btn" onclick="insertLink()" title="Insert/Edit Link">
                                   <i class="fas fa-link"></i>
                               </button>
                           </div>

                           <div id="blogContent"
                                class="editor-content"
                                contenteditable="true"
                                data-placeholder="Write your blog post content here..."
                                oninput="updateContent()">{{ old('content') }}</div>

                           <!-- Hidden textarea for form submission -->
                           <textarea name="content" id="content-hidden" style="display: none;" required>{{ old('content') }}</textarea>
                       </div>

                @error('content')
                    <p class="admin-form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Published Status -->
            {{-- <div style="margin-bottom: 30px;">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="checkbox"
                           name="is_published"
                           value="1"
                           {{ old('is_published', true) ? 'checked' : '' }}
                           style="margin-right: 8px; accent-color: #dc2626;">
                    <span style="font-size: 14px; color: #374151;">Publish immediately</span>
                </label>
            </div> --}}

            <!-- Submit Button -->
            <div class="save-post-btn">
                <button type="submit">
                    Save Post
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Link Modal -->
<div id="linkModal" class="link-modal-overlay" style="display: none;">
    <div class="link-modal">
        <div class="link-modal-header">
            <h3 id="linkModalTitle">Insert Link</h3>
            <button type="button" class="link-modal-close" onclick="closeLinkModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="link-modal-body">
            <div class="link-modal-form-group">
                <label for="linkTextInput" class="link-modal-label">Link Text</label>
                <input type="text" id="linkTextInput" class="link-modal-input" placeholder="Enter link text">
            </div>
            <div class="link-modal-form-group">
                <label for="linkUrlInput" class="link-modal-label">URL</label>
                <input type="url" id="linkUrlInput" class="link-modal-input" placeholder="https://example.com">
            </div>
        </div>
        <div class="link-modal-footer">
            <button type="button" class="link-modal-btn link-modal-btn-cancel" onclick="closeLinkModal()">Cancel</button>
            <button type="button" class="link-modal-btn link-modal-btn-submit" onclick="confirmLinkInsert()">Insert Link</button>
        </div>
    </div>
</div>

<script>
// Auto-format slug input (format on blur, allow spaces while typing)
document.addEventListener('DOMContentLoaded', function() {
    const slugInput = document.getElementById('slug');
    const slugCharCount = document.getElementById('slug-char-count');
    const slugMaxLength = 70;

    // Title character counter
    const titleInput = document.getElementById('blogTitle');
    const titleCharCount = document.getElementById('title-char-count');
    const titleMaxLength = 70;

    // Excerpt character counter
    const excerptInput = document.getElementById('excerpt');
    const excerptCharCount = document.getElementById('excerpt-char-count');
    const excerptMaxLength = 160;

    // Title character counter
    if (titleInput && titleCharCount) {
        function updateTitleCharCount() {
            const length = titleInput.value.length;
            titleCharCount.textContent = length + '/' + titleMaxLength;
            // Change color if approaching limit
            if (length > titleMaxLength * 0.9) {
                titleCharCount.style.color = '#ef4444'; // red
            } else if (length > titleMaxLength * 0.75) {
                titleCharCount.style.color = '#f59e0b'; // orange
            } else {
                titleCharCount.style.color = '#6b7280'; // gray
            }
        }

        // Initialize character counter
        updateTitleCharCount();

        // Update character counter on input
        titleInput.addEventListener('input', function() {
            updateTitleCharCount();
        });
    }

    if (slugInput) {
        // Update character counter
        function updateSlugCharCount() {
            if (slugCharCount) {
                const length = slugInput.value.length;
                slugCharCount.textContent = length + '/' + slugMaxLength;
                // Change color if approaching limit
                if (length > slugMaxLength * 0.9) {
                    slugCharCount.style.color = '#ef4444'; // red
                } else if (length > slugMaxLength * 0.75) {
                    slugCharCount.style.color = '#f59e0b'; // orange
                } else {
                    slugCharCount.style.color = '#6b7280'; // gray
                }
            }
        }

        // Initialize character counter
        updateSlugCharCount();

        // Update character counter on input
        slugInput.addEventListener('input', function() {
            updateSlugCharCount();
        });

        // Format the slug when user leaves the field (on blur)
        slugInput.addEventListener('blur', function(e) {
            let value = e.target.value.trim();
            if (value) {
                // Convert to lowercase
                value = value.toLowerCase();
                // Replace spaces and special characters with hyphens
                value = value.replace(/[^a-z0-9-]/g, '-');
                // Replace multiple hyphens with single hyphen
                value = value.replace(/-+/g, '-');
                // Remove leading and trailing hyphens
                value = value.replace(/^-+|-+$/g, '');
                // Truncate to max length if needed
                if (value.length > slugMaxLength) {
                    value = value.substring(0, slugMaxLength);
                }
                e.target.value = value;
                updateSlugCharCount();
            }
        });
    }

    // Excerpt character counter
    if (excerptInput) {
        function updateExcerptCharCount() {
            if (excerptCharCount) {
                const length = excerptInput.value.length;
                excerptCharCount.textContent = length + '/' + excerptMaxLength;
                // Change color if approaching limit
                if (length > excerptMaxLength * 0.9) {
                    excerptCharCount.style.color = '#ef4444'; // red
                } else if (length > excerptMaxLength * 0.75) {
                    excerptCharCount.style.color = '#f59e0b'; // orange
                } else {
                    excerptCharCount.style.color = '#6b7280'; // gray
                }
            }
        }

        // Initialize character counter
        updateExcerptCharCount();

        // Update character counter on input
        excerptInput.addEventListener('input', function() {
            updateExcerptCharCount();
        });
    }
});

// Image preview functionality
function updateFileName(input) {
    const fileNameInput = document.getElementById('featuredImage');
    if (input.files && input.files[0]) {
        fileNameInput.value = input.files[0].name;
        fileNameInput.classList.add('has-file');
    } else {
        fileNameInput.value = 'No file chosen';
        fileNameInput.classList.remove('has-file');
    }
}

function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    const preview = document.getElementById('image-preview');
    const fileInput = document.getElementById('image');
    const fileNameInput = document.getElementById('featuredImage');

    preview.style.display = 'none';
    fileInput.value = '';
    fileNameInput.value = 'No file chosen';
    fileNameInput.classList.remove('has-file');
}

// Rich text editor functionality
function formatText(command, value = null) {
    const editor = document.getElementById('blogContent');
    editor.focus();

    if (command === 'fontSize' && value) {
        document.execCommand('fontSize', false, value);
        const fontElements = editor.querySelectorAll('font');
        const sizeMap = {
            '1': '8pt',
            '2': '10pt',
            '3': '12pt',
            '4': '14pt',
            '5': '18pt',
            '6': '24pt',
            '7': '36pt'
        };
        fontElements.forEach(el => {
            if (el.getAttribute('size')) {
                el.style.fontSize = sizeMap[el.getAttribute('size')] || '12pt';
                el.removeAttribute('size');
            }
        });
    } else if (command === 'fontName' && value) {
        if (value === 'System Font') {
            document.execCommand('removeFormat', false);
        } else {
            document.execCommand('fontName', false, value);
        }
    } else if (command === 'formatBlock' && value) {
        // Get the current text color before formatting (to preserve it)
        const editor = document.getElementById('blogContent');
        const selection = window.getSelection();
        let originalColor = null;

        if (selection.rangeCount > 0 && selection.toString().trim()) {
            const range = selection.getRangeAt(0);
            let container = range.commonAncestorContainer;
            if (container.nodeType === Node.TEXT_NODE) {
                container = container.parentElement;
            }
            // Get computed color to preserve it
            if (container && container !== editor) {
                const computedStyle = window.getComputedStyle(container);
                originalColor = computedStyle.color;
            }
        }

        // Apply formatBlock for headings (h2, h3, h4, h5, h6) and blockquote
        document.execCommand('formatBlock', false, value);

        // Clean up any inline styles that might interfere with CSS styling
        setTimeout(function() {
            const selection = window.getSelection();
            if (selection.rangeCount > 0) {
                const range = selection.getRangeAt(0);
                let element = range.commonAncestorContainer;

                // Get the actual element (not text node)
                if (element.nodeType === Node.TEXT_NODE) {
                    element = element.parentElement;
                }

                // Find the formatted element (h2, h3, h4, h5, h6, blockquote, p)
                while (element && element !== editor) {
                    if (element.tagName && element.tagName.toLowerCase().match(/^(h[1-6]|blockquote|p|div)$/)) {
                        break;
                    }
                    element = element.parentElement;
                }

                // If we found the element and it matches what we formatted, clean up styles
                if (element && element.tagName && element.tagName.toLowerCase() === value.toLowerCase()) {
                    // Remove inline styles that would override CSS
                    element.style.fontSize = '';
                    element.style.fontWeight = '';
                    element.style.margin = '';
                    element.style.padding = '';
                    // Preserve the original text color if we captured it
                    // Don't force any color - let it inherit or use the original
                    if (!element.style.color || element.style.color === 'rgb(22, 211, 202)' || element.style.color === '#16d3ca') {
                        element.style.color = '';
                    }

                    // Add classes to blockquote for styling
                    if (value.toLowerCase() === 'blockquote') {
                        element.classList.add('mdc-c-blockquote', 'mdc-c-blockquote--is-quotes');
                        // Ensure blockquote has a paragraph inside
                        if (!element.querySelector('p')) {
                            const p = document.createElement('p');
                            while (element.firstChild) {
                                p.appendChild(element.firstChild);
                            }
                            element.appendChild(p);
                        }
                    }
                }
            }
            updateContent();
        }, 50);
    } else if (command === 'foreColor' && value) {
        // For text color - direct approach
        document.execCommand('styleWithCSS', false, true);
        document.execCommand('foreColor', false, value);
    } else if (command === 'backColor' && value) {
        // For background color - direct approach
        document.execCommand('styleWithCSS', false, true);
        document.execCommand('backColor', false, value);
    } else if (command === 'insertUnorderedList') {
        document.execCommand('insertUnorderedList', false, null);
    } else if (command === 'insertOrderedList') {
        document.execCommand('insertOrderedList', false, null);
    } else if (command === 'indent') {
        document.execCommand('indent', false, null);
    } else if (command === 'outdent') {
        document.execCommand('outdent', false, null);
    } else {
        document.execCommand(command, false, value);
    }

    updateContent();
}

function applyLineHeight(value) {
    const editor = document.getElementById('blogContent');
    editor.focus();
    document.execCommand('styleWithCSS', false, true);
    document.execCommand('styleWithCSS', false, true);
    const selectedText = window.getSelection().toString();
    if (selectedText) {
        const selection = window.getSelection();
        if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            const span = document.createElement('span');
            span.style.lineHeight = value;
            try {
                range.surroundContents(span);
            } catch (e) {
                const contents = range.extractContents();
                span.appendChild(contents);
                range.insertNode(span);
            }
        }
    } else {
        document.execCommand('formatBlock', false, 'p');
        const paragraphs = editor.querySelectorAll('p');
        if (paragraphs.length > 0) {
            paragraphs[paragraphs.length - 1].style.lineHeight = value;
        }
    }
    updateContent();
}

function updateContent() {
    const editor = document.getElementById('blogContent');
    const hiddenTextarea = document.getElementById('content-hidden');

    // Remove outline properties from all images before saving
    const images = editor.querySelectorAll('img');
    images.forEach(function(img) {
        img.style.removeProperty('outline');
        img.style.removeProperty('outline-offset');
        img.style.removeProperty('outline-color');
        img.style.removeProperty('outline-style');
        img.style.removeProperty('outline-width');
    });

    // Update hidden textarea with HTML content
    hiddenTextarea.value = editor.innerHTML;

    // Add placeholder functionality
    if (editor.innerHTML.trim() === '' || editor.innerHTML.trim() === '<br>') {
        editor.innerHTML = '';
        editor.classList.add('placeholder');
    } else {
        editor.classList.remove('placeholder');
    }
}

// Simple text color function using manual HTML manipulation
function applyTextColor(color) {
    const editor = document.getElementById('blogContent');
    editor.focus();

    const selection = window.getSelection();

    if (selection.rangeCount > 0 && !selection.isCollapsed) {
        // Get all color spans in the editor
        const allColorSpans = editor.querySelectorAll('span[style*="color"], font[color]');
        const range = selection.getRangeAt(0);
        const selectedText = selection.toString();

        // Find color spans that intersect with the selection
        const spansToRemove = [];
        allColorSpans.forEach(function(span) {
            try {
                if (range.intersectsNode(span) || range.containsNode(span, true)) {
                    spansToRemove.push(span);
                }
            } catch (e) {
                // Invalid range, skip
            }
        });

        // Remove color property from intersecting spans
        spansToRemove.forEach(function(span) {
            if (span.style && span.style.color) {
                // Remove only the color property
                span.style.removeProperty('color');
                // If style is now empty, clean it up
                if (!span.style.cssText || !span.style.cssText.trim()) {
                    span.removeAttribute('style');
                }
            }
            if (span.tagName === 'FONT') {
                span.removeAttribute('color');
            }
        });

        // Convert font tags to spans before applying new color
        const fontTags = editor.querySelectorAll('font[color]');
        fontTags.forEach(function(font) {
            const span = document.createElement('span');
            if (font.getAttribute('color')) {
                span.style.color = font.getAttribute('color').startsWith('#')
                    ? font.getAttribute('color')
                    : '#' + font.getAttribute('color');
            }
            while (font.firstChild) {
                span.appendChild(font.firstChild);
            }
            font.parentNode.replaceChild(span, font);
        });
    }

    // Now apply the new color - this will work on the current selection
    document.execCommand('styleWithCSS', false, true);
    document.execCommand('foreColor', false, color);

    // Clean up any nested or duplicate color spans
    setTimeout(function() {
        cleanupColorSpans(editor);
        updateContent();
    }, 100);
}

// Helper function to clean up nested color spans
function cleanupColorSpans(editor) {
    // Find all spans with color styles
    const colorSpans = editor.querySelectorAll('span[style*="color"], font[color]');

    colorSpans.forEach(function(span) {
        // If this span contains only a single text node and parent has no color, we can keep it
        // Otherwise, unwrap nested color spans
        const parent = span.parentElement;

        // If parent is also a span/font with color, unwrap the inner one
        if (parent && (parent.tagName === 'SPAN' || parent.tagName === 'FONT')) {
            const parentColor = parent.style.color || (parent.getAttribute('color') ? '#' + parent.getAttribute('color') : '');
            const spanColor = span.style.color || (span.getAttribute('color') ? '#' + span.getAttribute('color') : '');

            // If colors match, remove the inner span
            if (parentColor && spanColor && parentColor === spanColor) {
                const parentSpan = document.createElement('span');
                while (span.firstChild) {
                    parentSpan.appendChild(span.firstChild);
                }
                span.parentNode.replaceChild(parentSpan, span);
                parentSpan.style.color = spanColor;
                return;
            }
        }

        // If span only has color and no other styles, keep it simple
        const styleStr = span.getAttribute('style') || '';
        if (styleStr && !styleStr.replace(/color\s*:\s*[^;]+;?/gi, '').trim()) {
            // Only color style, that's fine
            return;
        }
    });

    // Also handle font tags with color attribute
    const fontTags = editor.querySelectorAll('font[color]');
    fontTags.forEach(function(font) {
        const color = font.getAttribute('color');
        if (color) {
            const span = document.createElement('span');
            span.style.color = color.startsWith('#') ? color : '#' + color;
            while (font.firstChild) {
                span.appendChild(font.firstChild);
            }
            font.parentNode.replaceChild(span, font);
        }
    });
}

// Simple background color function
function applyBackgroundColor(color) {
    console.log('Applying background color:', color);
    const editor = document.getElementById('blogContent');
    editor.focus();

    // Check if there's a selection
    const selection = window.getSelection();
    console.log('Selection:', selection.toString());

    // Try different approaches
    try {
        document.execCommand('styleWithCSS', false, true);
        const result = document.execCommand('backColor', false, color);
        console.log('execCommand result:', result);
    } catch (e) {
        console.error('Error with styleWithCSS:', e);
        // Fallback approach
        const result = document.execCommand('backColor', false, color);
        console.log('Fallback execCommand result:', result);
    }

    updateContent();
}

// Upload content image
function uploadContentImage(input) {
    if (!input.files || !input.files[0]) {
        return;
    }

    const file = input.files[0];
    const maxSize = 2 * 1024 * 1024; // 2MB
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

    // Validate file type
    if (!allowedTypes.includes(file.type)) {
        alert('Please upload a valid image file (JPEG, PNG, JPG, GIF)');
        input.value = '';
        return;
    }

    // Validate file size
    if (file.size > maxSize) {
        alert('Image size should be less than 2MB');
        input.value = '';
        return;
    }

    // Create FormData
    const formData = new FormData();
    formData.append('image', file);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    // Show loading indicator
    const editor = document.getElementById('blogContent');
    editor.focus();

    // Upload image
    fetch('{{ route("admin.upload-content-image") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.url) {
            // Insert image into editor at cursor position
            const img = document.createElement('img');
            img.src = data.url;
            img.alt = data.alt || 'Content image';
            img.style.maxWidth = '100%';
            img.style.height = 'auto';
            img.style.display = 'block';
            img.style.margin = '1rem 0';
            img.style.cursor = 'pointer';
            img.style.outline = 'none';
            img.style.outlineOffset = '0';
            img.className = 'content-image content-image-center'; // Default to center

            // Make image clickable for alignment
            img.addEventListener('click', function(e) {
                e.stopPropagation();
                selectImage(this);
            });

            // Insert image at cursor position
            const selection = window.getSelection();
            if (selection.rangeCount > 0) {
                try {
                    const range = selection.getRangeAt(0);
                    range.deleteContents();
                    range.insertNode(img);
                    // Move cursor after image
                    range.setStartAfter(img);
                    range.collapse(true);
                    selection.removeAllRanges();
                    selection.addRange(range);
                } catch (e) {
                    // Fallback: append to editor
                    editor.appendChild(img);
                }
            } else {
                // No selection, append to end
                editor.appendChild(img);
                // Move cursor after image
                const range = document.createRange();
                range.setStartAfter(img);
                range.collapse(true);
                selection.removeAllRanges();
                selection.addRange(range);
            }

            // Select the newly inserted image
            selectImage(img);
            updateContent();
        } else {
            alert(data.message || 'Failed to upload image');
        }
    })
    .catch(error => {
        console.error('Error uploading image:', error);
        alert('Failed to upload image. Please try again.');
    })
    .finally(() => {
        // Reset input
        input.value = '';
    });
}

// Link modal state
let linkModalState = {
    range: null,
    selectedText: '',
    existingLink: null,
    selection: null
};

// Insert/Edit link
function insertLink() {
    const editor = document.getElementById('blogContent');
    editor.focus();

    const selection = window.getSelection();
    let range = null;
    let selectedText = '';
    let existingLink = null;

    // Get selection range
    if (selection.rangeCount > 0) {
        range = selection.getRangeAt(0);
        selectedText = selection.toString().trim();

        // Check if selection is already a link
        let container = range.commonAncestorContainer;
        if (container.nodeType === Node.TEXT_NODE) {
            container = container.parentElement;
        }

        // Find existing link
        let linkElement = container;
        while (linkElement && linkElement !== editor) {
            if (linkElement.tagName === 'A') {
                existingLink = linkElement;
                break;
            }
            linkElement = linkElement.parentElement;
        }
    }

    // Store state for modal
    linkModalState.range = range;
    linkModalState.selectedText = selectedText;
    linkModalState.existingLink = existingLink;
    linkModalState.selection = selection;

    // Get URL from existing link
    let url = '';
    if (existingLink) {
        url = existingLink.getAttribute('href') || '';
        selectedText = existingLink.textContent || selectedText;
    }

    // Show modal
    const modal = document.getElementById('linkModal');
    const linkTextInput = document.getElementById('linkTextInput');
    const linkUrlInput = document.getElementById('linkUrlInput');
    const modalTitle = document.getElementById('linkModalTitle');

    // Set modal title
    modalTitle.textContent = existingLink ? 'Edit Link' : 'Insert Link';

    // Populate inputs
    linkTextInput.value = selectedText || '';
    linkUrlInput.value = url || '';

    // Show modal
    modal.style.display = 'flex';
    linkUrlInput.focus();
    linkUrlInput.select();

    // Close modal on overlay click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeLinkModal();
        }
    });

    // Close modal on Escape key
    const handleEscape = function(e) {
        if (e.key === 'Escape') {
            closeLinkModal();
            document.removeEventListener('keydown', handleEscape);
        }
    };
    document.addEventListener('keydown', handleEscape);

    // Submit on Enter key in URL input
    linkUrlInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            confirmLinkInsert();
        }
    });
}

function closeLinkModal() {
    const modal = document.getElementById('linkModal');
    modal.style.display = 'none';

    // Clear inputs
    document.getElementById('linkTextInput').value = '';
    document.getElementById('linkUrlInput').value = '';

    // Clear state
    linkModalState = {
        range: null,
        selectedText: '',
        existingLink: null,
        selection: null
    };
}

function confirmLinkInsert() {
    const linkTextInput = document.getElementById('linkTextInput');
    const linkUrlInput = document.getElementById('linkUrlInput');
    const editor = document.getElementById('blogContent');

    const linkText = linkTextInput.value.trim();
    let userUrl = linkUrlInput.value.trim();

    if (!userUrl) {
        // If URL is empty and there's an existing link, remove it
        if (linkModalState.existingLink) {
            const parent = linkModalState.existingLink.parentElement;
            while (linkModalState.existingLink.firstChild) {
                parent.insertBefore(linkModalState.existingLink.firstChild, linkModalState.existingLink);
            }
            parent.removeChild(linkModalState.existingLink);
            updateContent();
        }
        closeLinkModal();
        return;
    }

    // Ensure URL has protocol
    let finalUrl = userUrl;
    if (!finalUrl.match(/^https?:\/\//i)) {
        finalUrl = 'https://' + finalUrl;
    }

    editor.focus();

    if (linkModalState.existingLink) {
        // Update existing link
        linkModalState.existingLink.setAttribute('href', finalUrl);
        linkModalState.existingLink.setAttribute('target', '_blank');
        linkModalState.existingLink.setAttribute('rel', 'noopener noreferrer');

        // Update link text if provided
        if (linkText) {
            linkModalState.existingLink.textContent = linkText;
        }
        updateContent();
    } else if (linkModalState.selectedText && linkModalState.range && !linkModalState.range.collapsed) {
        // Create new link from selected text
        try {
            const link = document.createElement('a');
            link.href = finalUrl;
            link.target = '_blank';
            link.rel = 'noopener noreferrer';
            link.textContent = linkText || linkModalState.selectedText;

            linkModalState.range.deleteContents();
            linkModalState.range.insertNode(link);

            const range = document.createRange();
            range.setStartAfter(link);
            range.collapse(true);
            linkModalState.selection.removeAllRanges();
            linkModalState.selection.addRange(range);
            updateContent();
        } catch (e) {
            // Fallback: use execCommand
            document.execCommand('createLink', false, finalUrl);
            setTimeout(function() {
                const links = editor.querySelectorAll('a');
                links.forEach(function(link) {
                    if (link.getAttribute('href') === finalUrl) {
                        link.setAttribute('target', '_blank');
                        link.setAttribute('rel', 'noopener noreferrer');
                        if (linkText) {
                            link.textContent = linkText;
                        }
                    }
                });
                updateContent();
            }, 10);
        }
    } else {
        // No selection - insert new link with text
        const textToInsert = linkText || 'Link';
        let insertRange = null;
        if (linkModalState.selection.rangeCount > 0) {
            insertRange = linkModalState.selection.getRangeAt(0);
        } else {
            insertRange = document.createRange();
            insertRange.selectNodeContents(editor);
            insertRange.collapse(false);
        }

        const textNode = document.createTextNode(textToInsert);
        insertRange.deleteContents();
        insertRange.insertNode(textNode);

        const newRange = document.createRange();
        newRange.selectNodeContents(textNode);
        linkModalState.selection.removeAllRanges();
        linkModalState.selection.addRange(newRange);

        document.execCommand('createLink', false, finalUrl);

        setTimeout(function() {
            const links = editor.querySelectorAll('a');
            links.forEach(function(link) {
                if (link.textContent.trim() === textToInsert) {
                    link.setAttribute('href', finalUrl);
                    link.setAttribute('target', '_blank');
                    link.setAttribute('rel', 'noopener noreferrer');
                }
            });
            updateContent();
        }, 10);
    }

    closeLinkModal();
}

// Image selection and alignment functions
let selectedImage = null;

function selectImage(img) {
    // Remove previous selection
    if (selectedImage) {
        selectedImage.style.removeProperty('outline');
        selectedImage.style.removeProperty('outline-offset');
        selectedImage.style.removeProperty('outline-color');
        selectedImage.style.removeProperty('outline-style');
        selectedImage.style.removeProperty('outline-width');
    }

    // Select new image (no outline) - ensure no outline is set
    selectedImage = img;
    img.style.removeProperty('outline');
    img.style.removeProperty('outline-offset');
    img.style.removeProperty('outline-color');
    img.style.removeProperty('outline-style');
    img.style.removeProperty('outline-width');

    // Show alignment buttons
    document.getElementById('alignImageLeft').style.display = 'inline-flex';
    document.getElementById('alignImageCenter').style.display = 'inline-flex';
    document.getElementById('alignImageRight').style.display = 'inline-flex';

    // Update active state based on current alignment
    updateAlignmentButtons();
}

function deselectImage() {
    if (selectedImage) {
        selectedImage.style.removeProperty('outline');
        selectedImage.style.removeProperty('outline-offset');
        selectedImage.style.removeProperty('outline-color');
        selectedImage.style.removeProperty('outline-style');
        selectedImage.style.removeProperty('outline-width');
        selectedImage = null;
    }

    // Hide alignment buttons
    document.getElementById('alignImageLeft').style.display = 'none';
    document.getElementById('alignImageCenter').style.display = 'none';
    document.getElementById('alignImageRight').style.display = 'none';
}

function alignImage(alignment) {
    if (!selectedImage) {
        // Try to find selected image from selection
        const selection = window.getSelection();
        if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            const node = range.commonAncestorContainer;
            let img = node.nodeType === Node.ELEMENT_NODE && node.tagName === 'IMG' ? node : node.parentElement;
            if (img && img.tagName === 'IMG') {
                selectImage(img);
            } else {
                return;
            }
        } else {
            return;
        }
    }

    // Remove existing alignment classes
    selectedImage.classList.remove('content-image-left', 'content-image-center', 'content-image-right');

    // Apply new alignment
    selectedImage.classList.add('content-image-' + alignment);

    // Update styles - images are block-level, no float to prevent text wrapping
    if (alignment === 'left') {
        selectedImage.style.margin = '1rem 0';
        selectedImage.style.marginRight = 'auto';
        selectedImage.style.marginLeft = '0';
        selectedImage.style.float = 'none';
        selectedImage.style.clear = 'both';
    } else if (alignment === 'center') {
        selectedImage.style.margin = '1rem auto';
        selectedImage.style.float = 'none';
        selectedImage.style.clear = 'both';
    } else if (alignment === 'right') {
        selectedImage.style.margin = '1rem 0';
        selectedImage.style.marginLeft = 'auto';
        selectedImage.style.marginRight = '0';
        selectedImage.style.float = 'none';
        selectedImage.style.clear = 'both';
    }

    updateAlignmentButtons();

    // Ensure outline is removed after alignment
    selectedImage.style.removeProperty('outline');
    selectedImage.style.removeProperty('outline-offset');
    selectedImage.style.removeProperty('outline-color');
    selectedImage.style.removeProperty('outline-style');
    selectedImage.style.removeProperty('outline-width');

    updateContent();
}

function updateAlignmentButtons() {
    if (!selectedImage) return;

    // Remove active state from all buttons
    document.getElementById('alignImageLeft').classList.remove('active');
    document.getElementById('alignImageCenter').classList.remove('active');
    document.getElementById('alignImageRight').classList.remove('active');

    // Add active state to current alignment
    if (selectedImage.classList.contains('content-image-left')) {
        document.getElementById('alignImageLeft').classList.add('active');
    } else if (selectedImage.classList.contains('content-image-right')) {
        document.getElementById('alignImageRight').classList.add('active');
    } else {
        // Default to center
        document.getElementById('alignImageCenter').classList.add('active');
    }
}

// Initialize rich text editor
document.addEventListener('DOMContentLoaded', function() {
    const editor = document.getElementById('blogContent');
    const hiddenTextarea = document.getElementById('content-hidden');
    const fontSizeSelect = document.getElementById('fontSize');

    // Make existing images clickable and add alignment classes if missing
    function initializeImages() {
        const images = editor.querySelectorAll('img');
        images.forEach(function(img) {
            // Remove any existing outline from inline styles
            img.style.removeProperty('outline');
            img.style.removeProperty('outline-offset');
            img.style.removeProperty('outline-color');
            img.style.removeProperty('outline-style');
            img.style.removeProperty('outline-width');

            // Add content-image class if missing
            if (!img.classList.contains('content-image')) {
                img.classList.add('content-image');
                // Check existing alignment
                if (img.style.float === 'left' || img.style.textAlign === 'left') {
                    img.classList.add('content-image-left');
                } else if (img.style.float === 'right' || img.style.textAlign === 'right') {
                    img.classList.add('content-image-right');
                } else {
                    img.classList.add('content-image-center');
                }
            }

            // Make clickable
            img.style.cursor = 'pointer';
            img.addEventListener('click', function(e) {
                e.stopPropagation();
                selectImage(this);
            });
        });
    }

    // Initialize images on load
    initializeImages();

    // Initialize blockquotes on load - add classes and ensure proper structure
    function initializeBlockquotes() {
        const blockquotes = editor.querySelectorAll('blockquote');
        blockquotes.forEach(function(blockquote) {
            // Add classes if not present
            if (!blockquote.classList.contains('mdc-c-blockquote')) {
                blockquote.classList.add('mdc-c-blockquote', 'mdc-c-blockquote--is-quotes');
            }
            // Ensure blockquote has a paragraph inside
            if (!blockquote.querySelector('p')) {
                const p = document.createElement('p');
                while (blockquote.firstChild) {
                    p.appendChild(blockquote.firstChild);
                }
                blockquote.appendChild(p);
            }
        });
    }

    // Initialize blockquotes on load
    initializeBlockquotes();

    // Re-initialize images when content changes
    const observer = new MutationObserver(function(mutations) {
        initializeImages();
        initializeBlockquotes();
    });
    observer.observe(editor, { childList: true, subtree: true });

    // Deselect image when clicking elsewhere
    editor.addEventListener('click', function(e) {
        if (e.target.tagName !== 'IMG') {
            deselectImage();
        }
    });

    if (fontSizeSelect) {
        fontSizeSelect.addEventListener('change', function () {
            formatText('fontSize', this.value);
        });

        fontSizeSelect.addEventListener('mousedown', function (event) {
            if (event.target.tagName === 'OPTION' && event.target.value === this.value) {
                event.preventDefault();
                formatText('fontSize', this.value);
            }
        });
    }

    // Set initial content if exists
    if (hiddenTextarea.value.trim()) {
        editor.innerHTML = hiddenTextarea.value;
        // Clean up outline properties from loaded content
        setTimeout(function() {
            initializeImages();
        }, 100);
    }

    // Handle placeholder
    editor.addEventListener('focus', function() {
        if (this.innerHTML.trim() === '' || this.innerHTML.trim() === '<br>') {
            this.innerHTML = '';
            this.classList.remove('placeholder');
        }
    });

    editor.addEventListener('blur', function() {
        if (this.innerHTML.trim() === '' || this.innerHTML.trim() === '<br>') {
            this.innerHTML = '';
            this.classList.add('placeholder');
        }
    });

    // Handle paste to clean up formatting
    editor.addEventListener('paste', function(e) {
        e.preventDefault();
        const text = (e.clipboardData || window.clipboardData).getData('text/plain');
        document.execCommand('insertText', false, text);
    });

    // Update button states based on current formatting
    editor.addEventListener('keyup', function() {
        updateButtonStates();
    });

    editor.addEventListener('mouseup', function() {
        updateButtonStates();
    });
});

function updateButtonStates() {
    const editor = document.getElementById('blogContent');

    // Update bold button state
    const boldBtn = document.querySelector('[onclick="formatText(\'bold\')"]');
    if (document.queryCommandState('bold')) {
        boldBtn.classList.add('active');
    } else {
        boldBtn.classList.remove('active');
    }

    // Update italic button state
    const italicBtn = document.querySelector('[onclick="formatText(\'italic\')"]');
    if (document.queryCommandState('italic')) {
        italicBtn.classList.add('active');
    } else {
        italicBtn.classList.remove('active');
    }

    // Update underline button state
    const underlineBtn = document.querySelector('[onclick="formatText(\'underline\')"]');
    if (document.queryCommandState('underline')) {
        underlineBtn.classList.add('active');
    } else {
        underlineBtn.classList.remove('active');
    }

    // Update unordered list button state
    const ulBtn = document.querySelector('[onclick="formatText(\'insertUnorderedList\')"]');
    if (document.queryCommandState('insertUnorderedList')) {
        ulBtn.classList.add('active');
    } else {
        ulBtn.classList.remove('active');
    }

    // Update ordered list button state
    const olBtn = document.querySelector('[onclick="formatText(\'insertOrderedList\')"]');
    if (document.queryCommandState('insertOrderedList')) {
        olBtn.classList.add('active');
    } else {
        olBtn.classList.remove('active');
    }
}

// Form submission - ensure content is updated
document.querySelector('form').addEventListener('submit', function(e) {
    updateContent();
    if (!document.getElementById('content-hidden').value.trim()) {
        e.preventDefault();
        alert('Please enter some content for your blog post.');
        document.getElementById('blogContent').focus();
    }
});

// Meta Keywords Tag Management
(function() {
    const keywordsInput = document.getElementById('add_tags_input');
    const keywordsContainer = document.getElementById('keywords-tags-container');
    const hiddenInput = document.getElementById('meta_keywords');
    let keywords = [];

    // Load existing keywords if any
    const existingKeywords = hiddenInput.value;
    if (existingKeywords) {
        keywords = existingKeywords.split(',').map(k => k.trim()).filter(k => k);
        renderTags();
        updateCounter();
    }

    // Add keyword on Enter
    keywordsInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const value = this.value.trim();
            if (value && !keywords.includes(value)) {
                if (keywords.length >= 15) {
                    alert('Maximum of 15 keywords allowed');
                    return;
                }
                keywords.push(value);
                this.value = '';
                renderTags();
                updateHiddenInput();
                updateCounter();
            }
        }
    });

    // Remove keyword
    function removeKeyword(keyword) {
        keywords = keywords.filter(k => k !== keyword);
        renderTags();
        updateHiddenInput();
        updateCounter();
    }

    // Render tags
    function renderTags() {
        keywordsContainer.innerHTML = '';
        keywords.forEach(keyword => {
            const tag = document.createElement('div');
            tag.className = 'keyword-tag';

            const text = document.createElement('span');
            text.className = 'keyword-tag-text';
            text.textContent = keyword;

            const removeBtn = document.createElement('span');
            removeBtn.className = 'keyword-tag-remove';
            removeBtn.innerHTML = '×';
            removeBtn.addEventListener('click', () => removeKeyword(keyword));

            tag.appendChild(text);
            tag.appendChild(removeBtn);
            keywordsContainer.appendChild(tag);
        });
    }

    // Update hidden input with comma-separated keywords
    function updateHiddenInput() {
        hiddenInput.value = keywords.join(',');
    }

    // Update counter display
    function updateCounter() {
        const counter = document.getElementById('keywords-counter');
        const remaining = 15 - keywords.length;
        counter.textContent = remaining + ' keywords remaining';
        counter.className = 'keywords-counter';
        if (remaining <= 0) {
            counter.classList.add('error');
            counter.textContent = 'Maximum reached (15 keywords)';
        } else if (remaining <= 3) {
            counter.classList.add('warning');
        }
    }

    // Initialize counter
    updateCounter();
})();

// Custom Dropdown Functionality
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.custom-dropdown-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const dropdown = this.closest('.custom-dropdown');
            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            const isOpen = dropdownMenu.classList.contains('show');

            // Close all
            document.querySelectorAll('.custom-dropdown .dropdown-menu').forEach(function(menu) {
                menu.classList.remove('show');
            });
            document.querySelectorAll('.custom-dropdown-toggle').forEach(function(t) {
                t.setAttribute('aria-expanded', 'false');
            });

            if (!isOpen) {
                dropdownMenu.classList.add('show');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // Item selection handlers
    document.querySelectorAll('.custom-dropdown .dropdown-item').forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            const dropdown = this.closest('.custom-dropdown');
            const toggle = dropdown.querySelector('.custom-dropdown-toggle');
            const hiddenInput = dropdown.querySelector('input[type="hidden"]');
            const dropdownText = toggle.querySelector('.dropdown-text');

            dropdownText.textContent = this.textContent;
            hiddenInput.value = this.dataset.value;

            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            dropdownMenu.classList.remove('show');
            toggle.setAttribute('aria-expanded', 'false');
        });
    });

    // Close on outside click
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.custom-dropdown')) {
            document.querySelectorAll('.custom-dropdown .dropdown-menu').forEach(function(menu) {
                menu.classList.remove('show');
            });
            document.querySelectorAll('.custom-dropdown-toggle').forEach(function(t) {
                t.setAttribute('aria-expanded', 'false');
            });
        }
    });
});
</script>
@endsection
