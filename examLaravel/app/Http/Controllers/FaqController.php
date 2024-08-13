<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Faq;



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
        $faqs = FAQ::orderBy('category')->get();
        return view('content.faq', compact('faqs'));
    }

       /**
      * FAQ related ADMIN methods
      */
      public function createFaq(): View
      {
          return view('admin.editFaq', ['faq' => new FAQ]);
      }
  
      public function storeFaq(Request $request): RedirectResponse
      {
          $request->validate([
              'question' => 'required|string|max:255',
              'answer' => 'required|string',
          ]);
  
          FAQ::create([
              'question' => $request->input('question'),
              'answer' => $request->input('answer'),
          ]);
  
          return redirect()->back()->with('success', 'FAQ created successfully');
      }
      public function editFaq($id): View
      {
          $faq = FAQ::findOrFail($id);
  
           // Load distinct categories from the faqs table
           $categories = FAQ::select('category')->distinct()->orderBy('category', 'asc')->get();
  
          return view('admin.editFaq', compact('faq', 'categories'));
      }
  
      public function updateFaq(Request $request, $id): RedirectResponse
      {
            $request->validate([
                'question' => 'required|string|max:255',
                'answer' => 'required|string',
                'category' => 'required|string',
                'new_category' => 'nullable|string|max:255',
            ]);
        
            $faq = FAQ::findOrFail($id);
        
            $category = $request->input('category') === 'new' ? $request->input('new_category') : $request->input('category');
        
        
            $faq->update([
                'question' => $request->input('question'),
                'answer' => $request->input('answer'),
                'category' =>  $category,       
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
