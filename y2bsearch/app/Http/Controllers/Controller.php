<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Elasticsearch\ClientBuilder;

class Controller extends BaseController
{
	use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	public function show(){

		$hosts = $hosts = [
					'y2search_elk:9200',         // IP + Port
					];
					$client = ClientBuilder::create()->setHosts($hosts)->build();
					$params = [
					'index' => 'videos_en',
					'type' => 'videosSubtitles',
					'body' => [
						'query' => [ 
							'match' => ['subtitles' => 'create'] 
							],
						'highlight' => [
							'pre_tags'=>['<b>'], 
							'post_tags'=>['</b>'],
							'fields' => [
									"subtitles" => [
									"fragment_size" => 30,
									"number_of_fragments" => 3
									]
								] 
							]
						]
					];
					// dd(json_encode($params['body']));
					$response = $client->search($params);
					$data['videos'] = $response['hits']['hits'];
					// dd($data['videos'][0]['highlight']['subtitles'][0]);

					return view('welcome', $data);

				}
			}
