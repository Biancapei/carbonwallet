<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user')->latest()->paginate(10);
        return view('admin.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:70',
            'description' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string|max:160',
            'category' => 'nullable|string|in:carbon-accounting,hospitality,net-zero,regulations',
            'blog_status' => 'required|string|in:draft,published,deleted',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_alt' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255'
        ]);

        $data = $request->only(['title', 'description', 'excerpt', 'category', 'blog_status', 'content', 'is_published', 'image_alt', 'meta_title', 'meta_description', 'meta_keywords']);

        // Convert empty excerpt to null
        if (isset($data['excerpt']) && trim($data['excerpt']) === '') {
            $data['excerpt'] = null;
        }

        $data['user_id'] = auth()->id();

        // Use provided slug or auto-generate from title
        if ($request->filled('slug')) {
            $slug = Str::slug($request->slug);
        } else {
            $slug = Str::slug($request->title);
        }

        // Limit slug to 70 characters
        if (strlen($slug) > 70) {
            $slug = substr($slug, 0, 70);
            // Remove trailing hyphen if any
            $slug = rtrim($slug, '-');
        }

        // Ensure slug is unique
        $originalSlug = $slug;
        $counter = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slugSuffix = '-' . $counter;
            $maxLength = 70 - strlen($slugSuffix);
            $slug = substr($originalSlug, 0, $maxLength) . $slugSuffix;
            $counter++;
        }
        $data['slug'] = $slug;

        $data['is_published'] = ($data['blog_status'] ?? 'draft') === 'published';

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('blog-images', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        Blog::create($data);

        return redirect()->route('admin.index')->with('success', 'Blog post created successfully!');
    }

    public function edit($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            return view('admin.edit', compact('blog'));
        } catch (\Exception $e) {
            abort(404, 'Blog post not found');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'nullable|string|max:70',
                'description' => 'nullable|string|max:255',
                'excerpt' => 'nullable|string|max:160',
                'category' => 'nullable|string|in:carbon-accounting,hospitality,net-zero,regulations',
                'blog_status' => 'required|string|in:draft,published,deleted',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_alt' => 'nullable|string|max:255',
                'is_published' => 'boolean',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500',
                'meta_keywords' => 'nullable|string|max:255'
            ]);

            $data = $request->only(['title', 'description', 'excerpt', 'category', 'blog_status', 'content', 'is_published', 'image_alt', 'meta_title', 'meta_description', 'meta_keywords']);

            // Convert empty excerpt to null
            if (isset($data['excerpt']) && trim($data['excerpt']) === '') {
                $data['excerpt'] = null;
            }

            // Use provided slug or auto-generate from title
            if ($request->filled('slug')) {
                $slug = Str::slug($request->slug);
            } else {
                $slug = Str::slug($request->title);
            }

            // Limit slug to 70 characters
            if (strlen($slug) > 70) {
                $slug = substr($slug, 0, 70);
                // Remove trailing hyphen if any
                $slug = rtrim($slug, '-');
            }

            // Ensure slug is unique (excluding current blog)
            $originalSlug = $slug;
            $counter = 1;
            while (Blog::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slugSuffix = '-' . $counter;
                $maxLength = 70 - strlen($slugSuffix);
                $slug = substr($originalSlug, 0, $maxLength) . $slugSuffix;
                $counter++;
            }
            $data['slug'] = $slug;

            $data['is_published'] = ($data['blog_status'] ?? 'draft') === 'published';

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($blog->image) {
                    Storage::disk('public')->delete($blog->image);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('blog-images', $imageName, 'public');
                $data['image'] = $imagePath;
            }

            $blog->update($data);

            return redirect()->route('admin.index')->with('success', 'Blog post updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Blog update failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Update failed: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            // Delete image if exists
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            $blog->delete();

            return redirect()->route('admin.index')->with('success', 'Blog post deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Blog post not found or deletion failed.');
        }
    }

    public function uploadContentImage(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('blog-images', $imageName, 'public');

                // Get the public URL (same format as Blog model's image_url accessor)
                $imageUrl = app()->environment('production')
                    ? secure_asset('storage/' . $imagePath)
                    : asset('storage/' . $imagePath);

                return response()->json([
                    'success' => true,
                    'url' => $imageUrl,
                    'path' => $imagePath,
                    'alt' => pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No image file provided'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: ' . $e->getMessage()
            ], 500);
        }
    }
}
