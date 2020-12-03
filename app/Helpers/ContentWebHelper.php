<?php
namespace App\Helpers;

use Validator;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ContentWebHelper {

	public static function store($index, $request){
		$message = [];
		if (isset($request->id)) {
			try {
				$id = Crypt::decrypt($request->id);
			} 
			catch (DecryptException $e) {
				return array(
					'response'=>false,
		         	'resault'=>'terjadi kesalahan dalam pengambilan data...!'
				);
			}
		}

		// banner
			if ($index == 'banner') {
				if (isset($request->id)) {
					$validator = Validator::make($request->all(), [
						'text_one' => 'nullable|max:175',
						'text_two' => 'nullable|max:175',
						'picture' => 'nullable|image|mimes:jpeg,bmp,png|max:6500',
					], $message);
				}
				else {
					$validator = Validator::make($request->all(), [
						'text_one' => 'nullable|max:175',
						'text_two' => 'nullable|max:175',
						'picture' => 'required|image|mimes:jpeg,bmp,png|max:6500',
					], $message);
				}
			}
		// banner
		// product
			else if ($index == 'product') {
				if (isset($request->id)) {
					$validator = Validator::make($request->all(), [
						'name' => 'required|max:175|unique:hpchs_product,name,'.$id,
						'picture' => 'nullable|image|mimes:jpeg,bmp,png|max:6500',
					], $message);
				}
				else {
					$validator = Validator::make($request->all(), [
						'name' => 'required|max:175|unique:hpchs_product',
						'picture' => 'required|image|mimes:jpeg,bmp,png|max:6500',
					], $message);
				}
			}
		// product
		// product_detail
			else if ($index == 'product_detail') {
				if (isset($request->id)) {
					$validator = Validator::make($request->all(), [
						'name' => 'required|max:175',
						'descript' => 'required',
						'product_id' => 'required',
						'picture' => 'nullable|image|mimes:jpeg,bmp,png|max:6500',
					], $message);
				}
				else {
					$validator = Validator::make($request->all(), [
						'name' => 'required|max:175',
						'descript' => 'required',
						'product_id' => 'required',
						'picture' => 'required|image|mimes:jpeg,bmp,png|max:6500',
					], $message);
				}
			}
		// product_detail
		// product
			else if ($index == 'project') {
				$validator = Validator::make($request->all(), [
					// 'name' => 'required|max:175|unique:hpchs_product',
					'picture' => 'required|image|mimes:jpeg,bmp,png|max:6500',
				], $message);
			}
		// product
			else{
				return array(
					'response'=>false,
		         	'resault'=>'terjadi kesalahan dalam pengambilan data...!2 '.$index
				);
			}

		if($validator->fails()){
			return array(
				'response'=>false,
	         	'resault'=>$validator->getMessageBag()->toArray()
			);
		}
		return array(
			'response'=>true
		);
	}
}