<?php

namespace App\Http\Controllers\AdminPortal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

use App\Models\User;
use App\Models\Product;

use Auth;
use Validator;
use DB;
use Image;
use File;
use Rule;

use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use Carbon\Carbon;

use ContentWeb;


class ContentWebController extends Controller
{
    public function index($index, request $request){

		$message = [
            'flag.in'        => 'Invalid filter',
            'author.email'        => 'Invalid filter',
        ];
        $validator = Validator::make($request->all(), [
            'flag'   => 'nullable|in:Publis,Unpublis',
            'author'   => 'nullable|email',
        ], $message);
		
		$Model = "App\Models\\".studly_case($index);
        $authorList = $Model::select('user_id')->get();

        $categoryList = null;
        if ($index == 'product_detail') {
        	$categoryList = Product::get();
        }


        if ($validator->fails()) {
            return redirect()->route('adpor.ccw.index', ['index' => $index])
				->with('berhasil', 'Terjadi Keselahan Filter');
        }

        if ($request->author != null) {
    		$getFilterAuthor = User::where('email',$request->author)->first();
    		if(!$getFilterAuthor){
    			return redirect()->route('admin.content.index', ['index'=>$index])
					->with('berhasil', 'Terjadi Keselahan Filter');
    		}
    	}

        return view('admin-portal.content-web.index', compact(
        	'categoryList',
        	'index',
        	'authorList',
        	'getFilterAuthor',
        	'request'
        ));
	}

	public function datatables($index, request $request){
		$Model = "App\Models\\".studly_case($index);

        $get = $Model::orderBy('created_at','desc');
        // filter index
	        if ($request->flag != null and isset($request->flag)) {
		        if ($request->flag == 'Publis') {
		    		$get->where('flag', 'Y');
		    	}
		    	else if ($request->flag == 'Unpublis') {
		    		$get->where('flag', 'N');
		    	}
		    }

	        if ($request->author != null and isset($request->author)) {
	    		$getFilterAuthor = User::where('email',$request->author)->first();
	    		if(!$getFilterAuthor){
	    			return redirect()->route('admin.content.index', ['index'=>$index])
						->with('berhasil', 'Terjadi Keselahan Filter');
	    		}
	    		else{
		    		$get->where('user_id', $getFilterAuthor->id);
		    	}
	    	}

	    	if ($index == 'product_detail') {
		    	if ($request->product != null and isset($request->product)) {
		    		$getFilterProduct = Product::where('name',$request->product)->first();
		    		if(!$getFilterProduct){
		    			return redirect()->route('admin.content.index', ['index'=>$index])
							->with('berhasil', 'Terjadi Keselahan Filter');
		    		}
		    		else{
			    		$get->where('product_id', $getFilterProduct->id);
			    	}
		    	}
	    	}
        // filter index

	    $get = $get->get();
	    
	    return $Datatables = Datatables::of($get)
	    	->editColumn('user_id', function ($get){
				return $get->getUser->name."<br>".$get->getUser->email;
			})
	    	->editColumn('title', function ($get) use($index, $request){
	    		$html = '';
	    		if ($get->name) {
		    		$html = $get->name;
	    		}
	    		if ($get->picture) {
					$html .= "<br><a href='".asset('public/asset/picture/'.str_replace('_', '-', $index).'/'.$get->picture)."' target='_blank'><img class='picture' src='".asset('public/asset/picture/'.str_replace('_', '-', $index).'/'.$get->picture)."'></a>";
	    		}
				return $html;	
			})
			->editColumn('content', function ($get){
				$html = "<div class='content'>";
				
				if ($get->product_id) {
					$html .= '<p>'.$get->getHeader->name.'</p>';
				}

				if ($get->descript) {
					$html .= $get->descript;
				}
				if ($get->text_one) {
					$html .= '<p>text_one : <br>'.$get->text_one.'</p>';
				}
				if ($get->text_two) {
					$html .= '<p>text_two : <br>'.$get->text_two.'</p>';
				}
				return $html .= "</div>";
			})
			->addColumn('aksi', function ($get) use($index, $request){
				$html = '';
				if ($index == 'product') {
					$html .= '<a href="'.route('adpor.ccw.index', ['index' => $index.'_detail', 'product' => $get->name]).'" class="btn btn-xs btn-success"><i class="fa fa-folder-open-o"></i> Buka Detail</a>';
					$html .= '<br>';
				}

				$html .= '<a data-toggle="modal" data-target=".modal-form-add" href="#" data-href="'.route('adpor.ccw.openform', ['index' => $index, 'id' => encrypt($get->id)]).'" class="open btn btn-xs btn-success"><i class="fa fa-folder-open-o"></i> Buka</a>';
				$html .= '<br>';
				if ($get->flag == 'Y') {
					$html .= '<a data-toggle="modal" data-target=".modal-aksi" href="#" data-href="'.route('adpor.ccw.aksi', ['index' => $index, 'id' => encrypt($get->id), 'aksi' => 'flag' ]).'" class="publis btn btn-xs btn-success"><i class="fa fa-thumbs-up"></i> Publish</a>';
				}
				else{
					$html .= '<a data-toggle="modal" data-target=".modal-aksi" href="#" data-href="'.route('adpor.ccw.aksi', ['index' => $index, 'id' => encrypt($get->id), 'aksi' => 'flag' ]).'" class="unpublis btn btn-xs btn-danger"><i class="fa fa-thumbs-down"></i> Non-Publish</a>';
				}
				$html .= '<br>';
				$html .= '<a data-toggle="modal" data-target=".modal-aksi" href="#" data-href="'.route('adpor.ccw.aksi', ['index' => $index, 'id' => encrypt($get->id), 'aksi' => 'hapus']).'" class="hapus btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>';

				return $html;
			})
			->escapeColumns(['*'])
			->make();
	}

	public function openform($index, request $request){
		$data = null;

		if (isset($request->id)) {
			try {
			$id = Crypt::decrypt($request->id);
			} 
			catch (DecryptException $e) {
				return response()->json([
					'msg'=>title_case(str_replace('_', ' ', $index)).' | terjadi kesalahan dalam pengambilan data'
		        ]);
			}
			$Model = "App\Models\\".studly_case($index);
			$data = $Model::find($id);

			if (!$data) {
				return response()->json([
					'msg'=>title_case(str_replace('_', ' ', $index)).' | terjadi kesalahan dalam pengambilan data'
		        ]);
			}
		}
		
		if ($index == 'product_detail') {
			$productGrub = Product::get();
			$view = view('admin-portal.content-web.form.'.$index, compact('index','data', 'productGrub'))->render();
		}
		else{
			$view = view('admin-portal.content-web.form.'.$index, compact('index','data'))->render();
		}

        return response()->json(['html'=>$view]);
	}

	public function openformstore($index, request $request){

		$cek = ContentWeb::store($index, $request);

		if($cek['response'] == false){
			return response()->json([
				'response'=>false,
	         	'resault'=>$cek['resault'],
	         	'msg'=>$cek['resault']
			]);
		}

		$hasil = DB::transaction(function() use($index, $request){
			$Model = "App\Models\\".studly_case($index);

			if ($request->id) {
				try {
					$id = Crypt::decrypt($request->id);
				} 
				catch (DecryptException $e) {
					return response()->json([
						'response'=>false,
						'msg'=>'terjadi kesalahan dalam pengambilan data...!'
			        ]);
				}
				$save = $Model::find($id);
			}
			else{
				$save = new $Model;
			}

			$columns=$save->getTableColumns(); // memanggil semua column/field pada table

			if ($request->name and in_array('name', $columns)) {
				$save->name = $request->name;
				if (in_array('slug', $columns)) {
					$save->slug = str_slug($request->name);
				}
			}

			if ($request->product_id and in_array('product_id', $columns)) {
				$save->product_id = $request->product_id;
			}

			if ($request->descript and in_array('descript', $columns)) {
				$save->descript = $request->descript;
			}

			if ($request->text_one and in_array('text_one', $columns)) {
				$save->text_one = $request->text_one;
			}

			if ($request->text_two and in_array('text_two', $columns)) {
				$save->text_two = $request->text_two;
			}

			if($request->file('picture') and in_array('picture', $columns)){
				
				$directory = 'asset/picture/'.str_replace('_', '-', $index);
				if ($save->picture != null) {
					File::delete($directory.'/'.$save->picture);
				}
				$salt = str_random(4);
				$image = $request->file('picture');
				$img_url = date('ymd-His').'-'.$salt. '.' . $image->getClientOriginalExtension();
				$upload1 = Image::make($image);
				$upload1->save($directory.'/'.$img_url);
				$save->picture = $img_url;
			}

			if (in_array('user_id', $columns)) {
				$save->user_id = Auth::user()->id;
			}
			$save->save();

			return $save;
		});

		return response()->json([
			'response'=>true,
         	'msg'=>'Data '.$hasil->title.' Telah Tersimpan...!'
		]);
	}

	public function aksi($index, request $request){
		$Model = "App\Models\\".studly_case($index);

		try {
			$id = Crypt::decrypt($request->id);
		} 
		catch (DecryptException $e) {
			return response()->json([
				'msg'=>title_case(str_replace('_', ' ', $index)).' | terjadi kesalahan dalam pengambilan data'
	        ]);
		}

		$find = $Model::find($id);

		if (!$find) {
			return response()->json([
				'msg'=>title_case(str_replace('_', ' ', $index)).' | terjadi kesalahan dalam pengambilan data'
	        ]);
		}

		$columns=$find->getTableColumns(); // memanggil semua column/field pada table

		if ($request->aksi == 'flag') {
			if ($find->flag == 'N') {
				$find->flag = 'Y';
				$notif = $find->title.' telah di publikasikan';
				$hasil = 'publis';
			}
			else if ($find->flag == 'Y') {
				$find->flag = 'N';
				$notif = $find->title.' telah tidak di publikasikan';
				$hasil = 'unpublis';
			}
			$find->save();
		}
		else if ($request->aksi == 'hapus') {
			$notif = $find->title.' telah di hapus';
			$hasil = 'hapus';
			DB::transaction(function() use($find, $index, $request, $columns){
				if (in_array('picture', $columns)) {
					if (in_array('picture', $columns)) {
						$on = 'picture';
					}
					$directory = 'asset/'.$on.'/'.str_replace('_', '-', $index);
					File::delete($directory.'/'.$find->$on);
				}
				
				if ($index == 'product') {
					$ModelSd = "App\Models\\".studly_case($index).'Detail';
					$cek = $index.'_id';
					$get = $ModelSd::where($cek, $find->id)->get();

					foreach ($get as $key) {
						$directory = 'asset/picture/'.str_replace('_', '-', $index);
						File::delete($directory.'/'.$key->picture);
						$key->delete();
					}
				}

				$find->delete();
			});
		}

		return response()->json([
			'hasil'=>$hasil,
			'msg'=>title_case(str_replace('_', ' ', $index)).' | '.$notif
        ]);
	}
}