<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    //
    public function Contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'message' => 'required',
        ]);

        $contact = Contact::Create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);
        if ($contact) {
            $contact->save();
            return redirect()->back()->with('success', 'Message sent');
        } else {
            return redirect()->back()->with('error', 'Error While sending Message');
        }
    }

    public function UserMessage(){
        $messages=Contact::all();
        return View('admin.message',compact('messages'));
    }

    public function Destroy(Request $request,$id){
        $message=Contact::find($id);
        if($message){
            $message->delete();
            return redirect()->back()->with('success','Message Deleted');
        }
        else{
            return redirect()->back()->with('error','Error while message deleting........');
        }
    }
}
