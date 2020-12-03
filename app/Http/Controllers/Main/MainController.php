<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Project;
use App\Models\Message;

use Validator;
use DB;
use Mail;

class MainController extends Controller
{
    public function beranda(){
        $banner = Banner::where('flag', 'Y')->limit(6)->orderBy('updated_at', 'desc')->get();
        $product = Product::where('flag', 'Y')->limit(6)->orderBy('name', 'asc')->get();
    	return view('Main.beranda.index',compact(
            'banner',
            'product'
        ));
    }

    public function aboutus(){
        $product = Product::where('flag', 'Y')->limit(6)->orderBy('name', 'asc')->get();
    	return view('Main.aboutus.index', compact('product'));
    }

    public function product(){
        $product = Product::where('flag', 'Y')->orderBy('name', 'asc')->paginate(6);
    	return view('Main.product.index', compact('product'));
    }

    public function productDetail($slug){
        $product = Product::where('flag', 'Y')->limit(6)->orderBy('name', 'asc')->get();
        $self = Product::where('slug', $slug)->where('flag', 'Y')->first();

        if (!$self) {
            return view('errors.404');
        }

    	return view('Main.product.detail', compact(
            'self',
            'product'
        ));
    }

    public function productCallData(request $request){
        $product = Product::where('flag', 'Y')->orderBy('name', 'asc')->paginate(6);
    	$view = view('Main._layout.product_list', compact('product'))->render();
		return response()->json(['html'=>$view]);
    }

    public function servis(){
        $project = Project::where('flag', 'Y')->orderBy('created_at', 'asc')->paginate(3);
    	return view('Main.servis.index', compact('project'));
    }

    public function projectList(){
        $project = Project::where('flag', 'Y')->orderBy('created_at', 'asc')->paginate(3);
        $view = '';
        foreach($project as $list){
            $view .= "<div class='bar'>";
            $view .= "    <div id='spacing'>";
            $view .= "        <a href='". asset("public/asset/picture/project/".$list->picture)."'>";
            $view .= "            <div id='show'>";
            $view .= "                <div id='img' style='background-image: url(".asset("public/asset/picture/project/".$list->picture).")';></div>";
            $view .= "            </div>";
            $view .= "        </a>";
            $view .= "    </div>  ";
            $view .= "</div>";
        }
        return response()->json(['html'=>$view]);
    }

    public function contact(request $request){
        $message = [];
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:175',
            'handphone' => 'nullable',
            'email' => 'required|email',
            'subject' => 'required|max:175',
            'message' => 'required|max:675',
            'g-recaptcha-response' => 'required',
        ], $message);

        if($validator->fails()){
            return response()->json([
                'response'=>false,
                'resault'=>$validator->getMessageBag()->toArray(),
                'msg'=>'Sorry, Some Thing Wrong...'
            ]);
        }

        $save = new Message;
        $save->name = $request->name;
        $save->phone = $request->handphone;
        $save->email = $request->email;
        $save->subject = $request->subject;
        $save->message = $request->message;
        $save->save();

        $data = array([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->handphone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        
        $cc = array();
        
        array_push($cc, "fourline66@gmail.com");
        array_push($cc, "dessurya02@gmail.com");
        array_push($cc, "candysupriady@gmail.com");

        Mail::send('mail.new-inbox', ['data' => $data], function($message) use ($data, $cc) {
            $message->from('robot@stainlesschs.co.id','Robot Administrator')
                ->to('stainlesschs@gmail.com', 'stainlesschs@gmail.com')
                ->cc($cc)
                ->subject('New Inbox');
        });

        return response()->json([
            'response'=>true,
            'msg'=>'Thanks For Contact Us... '.$request->name
        ]);
    }
}
