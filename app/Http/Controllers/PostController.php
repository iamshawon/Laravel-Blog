<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PostController extends Controller
{
    public function writePost(){
        $category=DB::table('categories')->get();
        return view('post/writepost', compact('category'));
    }

    public function StorePost(Request $request){
        $validatedData = $request->validate([
            'title' => 'required||max:200',
            'details' => 'required|min:3',
            'image' => 'required|mimes:jpeg,jpg,png,PNG |max:10000',
        ]);

        $data=array();
        $data['title'] = $request->title;
        $data['category_id'] = $request->category_id;
        $data['details'] = $request->details;
        $image = $request->file('image');
        if($image){
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name. '.' .$ext;
            $upload_path='frontend/image/';
            $image_url=$upload_path . $image_full_name;
            $success=$image->move($upload_path,$image_full_name);

            $data['image'] = $image_url;
            DB::table('posts')->insert($data);
            $notification=array(
                'message'=> 'Successfully Post Inserted',
                'alert-type'=> 'success'
            );
            return Redirect()->back()->with($notification); 
        }

        else{
            DB::table('posts')->insert($data);
            $notification=array(
                'message'=> 'Successfully Post Inserted',
                'alert-type'=> 'success'
            );
            return Redirect()->back()->with($notification); 

        }


    }

    public function AllPost(){
        // One one join is here
        $post=DB::table('posts')
                ->join('categories', 'posts.category_id', 'categories.id')
                ->select('posts.*', 'categories.name')
                ->get();
                // return response()->json($post);

        return view('post/allpost', compact('post'));
    }

    public function ViewPost($id){
        $post=DB::table('posts')
                ->join('categories', 'posts.category_id', 'categories.id')
                ->select('posts.*', 'categories.name')
                ->where('posts.id',$id)
                ->first();
                // return response()->json($post);
    return view('post/viewpost', compact('post'));        
    }

    public function DeletePost($id){
        $post=DB::table('posts')->where('id', $id)->first();
        $image=$post->image;

        $delete=DB::table('posts')->where('id',$id)->delete();
        if($delete){
            unlink($image);
            $notification=array(
                'message'=> 'Successfully Post Deleted!',
                'alert-type'=> 'success'
            );
            return Redirect()->back()->with($notification); 
        }
        else{
            $notification=array(
                'message'=> 'Something Wrong!',
                'alert-type'=> 'error'
            );
            return Redirect()->back()->with($notification); 
        }

    }

    public function EditPost($id){
        $category=DB::table('categories')->get();
        $post=DB::table('posts')->where('id', $id)->first();

        return view('post/editpost', compact('category', 'post'));
    }

    public function UpdatePost(Request $request, $id){
        $validatedData = $request->validate([
            'title' => 'required||max:200',
            'details' => 'required|min:3',
            'image' => 'mimes:jpeg,jpg,png,PNG |max:10000',
        ]);

        $data=array();
        $data['title'] = $request->title;
        $data['category_id'] = $request->category_id;
        $data['details'] = $request->details;
        $image = $request->file('image');
        if($image){
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name. '.' .$ext;
            $upload_path='frontend/image/';
            $image_url=$upload_path . $image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image'] = $image_url;
            unlink($request->old_photo);
            DB::table('posts')->where('id', $id)->update($data);
            $notification=array(
                'message'=> 'Successfully Post Updated!',
                'alert-type'=> 'success'
            );
            return Redirect()->route('all.post')->with($notification); 
        }

        else{
            $data['image'] = $request->old_photo;
            DB::table('posts')->where('id', $id)->update($data);
            $notification=array(
                'message'=> 'Successfully Post Updateed!',
                'alert-type'=> 'success'
            );
            return Redirect()->route('all.post')->with($notification); 

        }

    }

}
