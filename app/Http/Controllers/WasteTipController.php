<?php

namespace App\Http\Controllers;
use App\Models\WasteTip;  // Assurez-vous que cette ligne est présente
use App\Models\AdviceType;  // Assurez-vous que cette ligne est présente

use Illuminate\Http\Request;

class WasteTipController extends Controller
{

   public function index()
{
    $adviceTypes = AdviceType::all();
    $wasteTips = WasteTip::with('adviceType')->get();

    return view('admin.WasteTips', compact('adviceTypes', 'wasteTips'));
}

   public function store(Request $request)
   {
       $request->validate([
           'title' => 'required|string|max:255',
           'content' => 'required|string',
           'advice_type_id' => 'required|exists:advice_types,id',
           'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
       ]);
   
       $imagePath = null;
       if ($request->hasFile('image')) {
           $imagePath = $request->file('image')->store('images/waste_tips', 'public');
       }
   
       WasteTip::create([
           'title' => $request->title,
           'content' => $request->content,
           'advice_type_id' => $request->advice_type_id,
           'author' => auth()->user()->id,
           'Creation_date' => now(),
           'image' => $imagePath, 
       ]);
   
       return redirect()->route('admin.WasteTips')->with('success', 'Waste Tip added successfully!');
   }
   public function update(Request $request, $id)
   {
       $request->validate([
           'title' => 'required|string|max:255',
           'content' => 'required|string|max:1000',
           'advice_type_id' => 'required|exists:advice_types,id',
           'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
       ]);
        $wasteTip = WasteTip::findOrFail($id);
        $wasteTip->title = $request->input('title');
        $wasteTip->content = $request->input('content');
        $wasteTip->advice_type_id = $request->input('advice_type_id');
          if ($request->hasFile('image')) {
           if ($wasteTip->image) {
               \Storage::disk('public')->delete($wasteTip->image);
           }
              $imagePath = $request->file('image')->store('waste_tips', 'public');
           $wasteTip->image = $imagePath;
       }
          $wasteTip->save();
          return redirect()->route('admin.WasteTips')->with('success', 'Waste Tip updated successfully!');
   }
   

    public function show($id)
    {
       
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wasteTip = WasteTip::findOrFail($id);
        $wasteTip->delete();
        return redirect()->route('admin.WasteTips')->with('success', 'Waste Tip deleted successfully!');
    }
}
