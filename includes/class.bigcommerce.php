<?php
/*
NAME: textusweb
 */

class BigCommerce {
	//BC Credentials
	private $apiEndpoint  = 'https://api.bigcommerce.com/stores/tbhimq8rr2/v3/';
	private $clientID     = 'ie5sk4zjcc1yfbxavte501l1wvk9cxl';
	private $clientSecret = 'c14d9ec50a1fed34c9cebd7e2039b244bfe1a7c16695785a0212729e20617fcd';
	private $accessToken  = '9tflnre38vb205rfd8z8k2i9erga3d';

	private $get = "GET";
	private $post = "POST";

	public function __construct (){
		echo "<br>bc initialized!";
	}

/*	public function addImage($productID){
		$json = {
			  "is_thumbnail": true,
			  "sort_order": 1,
			  "description": "Yellow Large Bath Towel",
			  "image_url": "{{image_url}}"
			}
		$url = "/catalog/products/".$productID."/images";
		$response $this->curlme($url, $this->post);
	}*/

	public function getProducts(){
		$productEndpoint = "catalog/products";
		$products = $this->curlme($productEndpoint, $this->get);
		print_r($products);

		//parse response
		/*response  Request Runner on developer.bigcommerce.com/api-docs/getting-started
		GET /catalog/products
		{
		  "data": [
		    {
		      "availability": "available",
		      "availability_description": "",
		      "base_variant_id": 77,
		      "bin_picking_number": "",
		      "brand_id": 38,
		      "calculated_price": 4.99,
		      "categories": [
		        28
		      ],
		      "condition": "New",
		      "cost_price": 0,
		      "custom_url": {
		        "is_customized": false,
		        "url": "/disney-aladdin-352-funko-pop/"
		      },
		      "date_created": "2020-10-24T17:04:32+00:00",
		      "date_modified": "2020-10-24T17:07:05+00:00",
		      "depth": 0,
		      "description": "<p><span>Disney&rsquo;s Aladdin #352 funko pop.</span></p>",
		      "fixed_cost_shipping_price": 0,
		      "gift_wrapping_options_list": [],
		      "gift_wrapping_options_type": "any",
		      "gtin": "",
		      "height": 0,
		      "id": 112,
		      "inventory_level": 0,
		      "inventory_tracking": "none",
		      "inventory_warning_level": 0,
		      "is_condition_shown": true,
		      "is_featured": false,
		      "is_free_shipping": false,
		      "is_preorder_only": false,
		      "is_price_hidden": false,
		      "is_visible": true,
		      "layout_file": "product.html",
		      "map_price": 0,
		      "meta_description": "",
		      "meta_keywords": [],
		      "mpn": "",
		      "name": "Disney Aladdin 352 Funko Pop",
		      "open_graph_description": "",
		      "open_graph_title": "",
		      "open_graph_type": "product",
		      "open_graph_use_image": true,
		      "open_graph_use_meta_description": true,
		      "open_graph_use_product_name": true,
		      "option_set_display": "right",
		      "option_set_id": null,
		      "order_quantity_maximum": 0,
		      "order_quantity_minimum": 0,
		      "page_title": "Disney Aladdin 352 Funko Pop",
		      "preorder_message": "",
		      "preorder_release_date": null,
		      "price": 4.99,
		      "price_hidden_label": "",
		      "product_tax_code": "",
		      "related_products": [
		        -1
		      ],
		      "retail_price": 0,
		      "reviews_count": 0,
		      "reviews_rating_sum": 0,
		      "sale_price": 0,
		      "search_keywords": "Disney, Aladdin, Funko",
		      "sku": "FP-100000",
		      "sort_order": 0,
		      "tax_class_id": 0,
		      "total_sold": 0,
		      "type": "physical",
		      "upc": "",
		      "view_count": 0,
		      "warranty": "",
		      "weight": 3,
		      "width": 0
		    },
		    {
		      "availability": "available",
		      "availability_description": "",
		      "base_variant_id": 78,
		      "bin_picking_number": "",
		      "brand_id": 39,
		      "calculated_price": 5,
		      "categories": [
		        24
		      ],
		      "condition": "New",
		      "cost_price": 0,
		      "custom_url": {
		        "is_customized": false,
		        "url": "/guardians-of-the-galaxy-vol-2-riders-in-the-sky/"
		      },
		      "date_created": "2020-10-24T17:12:04+00:00",
		      "date_modified": "2020-10-24T17:12:04+00:00",
		      "depth": 0,
		      "description": "<p><span>Collects All-New Guardians of the Galaxy #3, 5, 7, 9, 11-12. </span></p>\n<p><span>Catch up with your favorite Guardians as they share the galactic spotlight! Gamora - the most dangerous person in the galaxy - is hiding something. What is her secret quest? Star-Lord sails the galaxy's radio waves, keeping up with the one piece of home he could never leave behind! Discover the reason behind Drax the former Destroyer's vow of peace! Learn what happened to Groot that caused him to revert to a tiny shrub - and why Rocket thinks it's all his fault! Plus: Meet the members of the resurgent Nova Corps as they come into desperate conflict with the shadowy Fraternity of Raptors! And as the Guardians return to Earth in the aftermath of SECRET EMPIRE, who will join them as their newest member?</span></p>",
		      "fixed_cost_shipping_price": 0,
		      "gift_wrapping_options_list": [],
		      "gift_wrapping_options_type": "any",
		      "gtin": "",
		      "height": 0,
		      "id": 113,
		      "inventory_level": 0,
		      "inventory_tracking": "none",
		      "inventory_warning_level": 0,
		      "is_condition_shown": false,
		      "is_featured": false,
		      "is_free_shipping": false,
		      "is_preorder_only": false,
		      "is_price_hidden": false,
		      "is_visible": true,
		      "layout_file": "product.html",
		      "map_price": 0,
		      "meta_description": "",
		      "meta_keywords": [],
		      "mpn": "",
		      "name": "Guardians of the Galaxy - Vol 2 Riders in the Sky",
		      "open_graph_description": "",
		      "open_graph_title": "",
		      "open_graph_type": "product",
		      "open_graph_use_image": true,
		      "open_graph_use_meta_description": true,
		      "open_graph_use_product_name": true,
		      "option_set_display": "right",
		      "option_set_id": null,
		      "order_quantity_maximum": 0,
		      "order_quantity_minimum": 0,
		      "page_title": "Guardians of the Galaxy - Vol 2 Riders in the Sky",
		      "preorder_message": "",
		      "preorder_release_date": null,
		      "price": 5,
		      "price_hidden_label": "",
		      "product_tax_code": "",
		      "related_products": [
		        -1
		      ],
		      "retail_price": 0,
		      "reviews_count": 0,
		      "reviews_rating_sum": 0,
		      "sale_price": 0,
		      "search_keywords": "Marvel, Guardians of the Galaxy",
		      "sku": "GG-Riders",
		      "sort_order": 0,
		      "tax_class_id": 0,
		      "total_sold": 0,
		      "type": "physical",
		      "upc": "",
		      "view_count": 0,
		      "warranty": "",
		      "weight": 1,
		      "width": 0
		    }
		  ],
		  "meta": {
		    "pagination": {
		      "count": 2,
		      "current_page": 1,
		      "links": {
		        "current": "?page=1&limit=50"
		      },
		      "per_page": 50,
		      "too_many": false,
		      "total": 2,
		      "total_pages": 1
		    }
		  }
		}


		 */
	}

	public function createProduct($data=[]){
		$data = array(
			"name"=>"BigCommerce Coffee Mug",
			"price"=>"10.00",
			"categories"=>[27],
			"weight"=>4,
			"type"=>"physical"
			/*,
			"images"=>[
			    {
			      "image_url": "http://textusconsulting.com/assets/img/logo1.png"
			    }]*/
		);
		$json = json_encode($data);
		$url = "catalog/products";
		$response = $this->curlme($url, $this->post, $json);
		echo "<br> response:".$response;
	}//createProduct


	public function createBrand($data[]){

	/*

		POST https://api.bigcommerce.com/stores/{{store_hash}}/v3/catalog/brands
		Accept: application/json
		Content-Type: application/json
		X-Auth-Token: {{ACCESS_TOKEN}}

		{
		  "name": "BigCommerce",
		  "page_title": "BigCommerce",
		  "meta_keywords": [
		    "ecommerce",
		    "best in class",
		    "grow your business"
		  ],
		  "image_url": "{{image_url}}"
		}
		 */
	}


	public function createCategory ($data=[]){
	/*  sample from api-docs
	POST https://api.bigcommerce.com/stores/{store_hash}/v3/catalog/categories

	Accept: application/json
	Content-Type: application/json
	X-Auth-Token: {{ACCESS_TOKEN}}

	{
	  "parent_id": 18,
	  "name": "Shoes",
	  "description": "Shoes Available for purchase",
	  "sort_order": 1,
	  "page_title": "Shoes",
	  "is_visible": true
	}	
	 */
	}

	private function curlme($url, $method, $json=null){
		$curl = curl_init();
		if ($method=='GET'){

			curl_setopt_array($curl, array(
			  CURLOPT_URL => $this->apiEndpoint.$url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "x-auth-token: ".$this->accessToken
			  ),
			));

		} else if ($method=='POST'){

			curl_setopt_array($curl, array(
			  CURLOPT_URL => $this->apiEndpoint.$url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => $json,
			  CURLOPT_HTTPHEADER => array(
			    "accept: application/json",
			    "content-type: application/json",
			    "x-auth-token: ".$this->accessToken
			  ),
			));
		}

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}		
	}//curlme

}

?>