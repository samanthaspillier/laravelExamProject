<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;

use App\Models\FAQ;
use App\Models\FaqCategory;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class FaqController extends Controller
{

    public function __construct()
    {
        // Apply the 'admin' middleware to all methods
        $this->middleware('admin')->except(['showFAQ']);
    }

    /**
     * Show the FAQ page.
     */

    public function showFAQ(): View
    {
       // Eager load the category relationship
        $faqs = FAQ::with('category')->get();

    
        return view('content.faq', compact('faqs'));
    }

       /**
      * FAQ related ADMIN methods
      */
      public function createFaq(): View
      {
        // Load distinct categories from the faq_categories table
        $categories = FaqCategory::orderBy('name', 'asc')->get();

         return view('admin.faqs.editFaq', [
            'faq' => new FAQ, 
            'categories' => $categories
    ]);
      }
  
      public function storeFaq(Request $request): RedirectResponse
      {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'required_without:new_category|string',
            'new_category' => 'nullable|string|max:255',
        ]);
    
        $categoryId = $request->input('category');
        
        if ($request->input('category') === 'new' && $request->input('new_category')) {
            // Create a new category if 'Other' is selected and a new category is provided
            $newCategory = FaqCategory::create([
                'name' => $request->input('new_category')
            ]);
            $categoryId = $newCategory->id;
        }
    
        FAQ::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'category_id' => $categoryId,
        ]);
    
        return redirect()->back()->with('success', 'FAQ created successfully');
      }


      public function editFaq($id): View
      {
        $faq = FAQ::findOrFail($id);
        $categories = FaqCategory::orderBy('name', 'asc')->get();
        
        return view('admin.faqs.editFaq', compact('faq', 'categories'));
      }
  
    public function updateFaq(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'required_without:new_category|string',
            'new_category' => 'nullable|string|max:255',
        ]);

        $faq = FAQ::findOrFail($id);

        // Determine the category ID
        if ($request->input('category') === 'new' && $request->input('new_category')) {
            // Create a new category if 'Other' is selected and a new category is provided
            $newCategory = FaqCategory::create([
                'name' => $request->input('new_category')
            ]);
            $categoryId = $newCategory->id;
        } else {
            // Use the selected category ID
            $categoryId = $request->input('category');
        }

        $faq->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'category_id' => $categoryId,
        ]);

        return redirect()->back()->with('success', 'FAQ updated successfully');
    }

  
      public function deleteFaq(Request $request, $id): RedirectResponse
      {
          // Find the post to delete
          $faq = FAQ::findOrFail($id);
  
          // Perform the deletion
          $faq->delete();
  
          // Redirect back with a success message
          return redirect()->route('admin.dashboard')->with('status', 'faq-deleted');
      }

    
}
