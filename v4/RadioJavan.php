<?php
/*
	Name             : RadioJavan API (PHP Class)
	Version          : V4
	Author           : Yasin Bahrami
	Documents        : https://docs.ineo-team.ir/radiojavan
	Panel            : https://t.me/APIManager_Bot?start=api-radiojavan
	GitHub           : https://github.com/iNeoTeam/RadioJavan-API/tree/main/v4
*/
class RadioJavan{
	const API = "https://api.ineo-team.ir/rj.php";
	private $accessKey;
	###################################################################################
	public function __construct($accessKey){
		$this->accessKey = $accessKey;
	}
	###################################################################################
	public function request($action, $params = []){
		$params['accessKey'] = $this->accessKey;
		$params['action']    = $action;
		$cURL = curl_init();
		curl_setopt_array($cURL, [
			CURLOPT_URL             => self::API,
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_POST            => true,
			CURLOPT_POSTFIELDS      => $params,
		]);
		$response = curl_exec($cURL);
		curl_close($cURL);
		return json_decode($response, true);
	}
	###################################################################################
	public function error($code, $message){
		return ['error' => true, 'code' => $code, 'message' => $message];
	}
	###################################################################################
	public function get_id($link){
		/*
			[*] link       : media link or share link (short link)
		*/
		$result = $this->request("getid", ['link' => $link]);
		if($result['status_code'] == 200){
			return $result['result'];
		}else{
			return $this->error($result['status_code'], $result['message']);
		}
	}
	###################################################################################
	public function media_info($media_type, $media_id){
		/*
			[*] media_type : music, video, podcast
			[*] id         : media id
		*/
		$result = $this->request("media", ['type' => $media_type, 'id' => $media_id]);
		if($result['status_code'] == 200){
			return $result['result'];
		}else{
			return $this->error($result['status_code'], $result['message']);
		}
	}
	###################################################################################
	public function album_info($track_id){
		/*
			[*] track_id : a track id from album
		*/
		$result = $this->request("media", ['type' => "album", 'id' => $track_id]);
		if($result['status_code'] == 200){
			return $result['result'];
		}else{
			return $this->error($result['status_code'], $result['message']);
		}
	}
	###################################################################################
	public function artist_media($media_type, $artist_name){
		/*
			[*] media_type  : music, video, podcast, album
			[*] artist_name : artist name, ex: pishro
		*/
		$result = $this->request("media", ['type' => $media_type, 'artist' => $artist_name]);
		if($result['status_code'] == 200){
			return $result['result'];
		}else{
			return $this->error($result['status_code'], $result['message']);
		}
	}
	###################################################################################
	public function podcast_artist($podcast_artist){
		/*
			[*] podcast_artist : podcast creator name, ex: khodcast 
		*/
		$result = $this->request("podcast", ['type' => "show", 'artist' => $podcast_artist]);
		if($result['status_code'] == 200){
			return $result['result'];
		}else{
			return $this->error($result['status_code'], $result['message']);
		}
	}
	###################################################################################
	public function search($query = "top"){
		/*
			[*] query       : song name, video name, podcast name, album name, playlist name or artist name
			[*] query = top : search for new posts and medias
		*/
		$result = $this->request("search", ['query' => $query]);
		if($result['status_code'] == 200){
			return $result['result'];
		}else{
			return $this->error($result['status_code'], $result['message']);
		}
	}
	###################################################################################
	public function artist_profile($artist_name){
		/*
			[*] artist_name : artist name, ex: pishro
		*/
		$result = $this->request("profile", ['artist' => $artist_name]);
		if($result['status_code'] == 200){
			return $result['result'];
		}else{
			return $this->error($result['status_code'], $result['message']);
		}
	}
	###################################################################################
	public function playlist_info($playlist_id){
		/*
			[*] playlist_id : playlist id, ex: 854b87855624
		*/
		$result = $this->request("playlist", ['id' => $playlist_id]);
		if($result['status_code'] == 200){
			return $result['result'];
		}else{
			return $this->error($result['status_code'], $result['message']);
		}
	}
	###################################################################################
	public function get_stories(){
		$result = $this->request("stories");
		if($result['status_code'] == 200){
			return $result['result'];
		}else{
			return $this->error($result['status_code'], $result['message']);
		}
	}
	###################################################################################
	public function storie_info($storie_hash){
		/*
			[*] storie_hash : get storie hash id from stories list, ex: 4xkzXbbQ
		*/
		$result = $this->request("storie", ['hash' => $storie_hash]);
		if($result['status_code'] == 200){
			return $result['result'];
		}else{
			return $this->error($result['status_code'], $result['message']);
		}
	}
	###################################################################################
	public function storie_uploader($username){
		/*
			[*] username : storie uploader username, ex: sba._.jd
		*/
		$result = $this->request("storie_user", ['username' => $username]);
		if($result['status_code'] == 200){
			return $result['result'];
		}else{
			return $this->error($result['status_code'], $result['message']);
		}
	}
	###################################################################################
	public function new_medias($type){
		/*
			[*] type : music, video, podcast, album, playlist
		*/
		$result = $this->request("new", ['type' => $type]);
		if($result['status_code'] == 200){
			return $result['result'];
		}else{
			return $this->error($result['status_code'], $result['message']);
		}
	}
	###################################################################################
}
