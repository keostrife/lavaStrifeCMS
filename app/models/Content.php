<?php
	class Content extends Eloquent {

		protected $table = 'content';

		public static function get($uid, $page) {
			$lang = App::getLocale();

			// $result = Content::whereRaw('uid = ? and page = ? and language = ?', array($uid, $page, $langID));
			$result = Content::where('uid', $uid)->where('page', $page)->where('language', $lang);
			if($result->count() > 0) {
				$content = $result->get()[0];
				return $content->content;
			} else {
				self::make($uid, $page, "");
				return true;
			}
		}

		public static function set($uid, $page, $lang, $content="") {
			$result = Content::where('uid', $uid)->where('page', $page)->where('language', $lang);
			if($result->count() > 0) {
				$result = $result->get()[0];
				$result->content = $content;
				$result->save();
				return true;
			}
			return false;
			
		}

		public static function make($uid, $page, $content="") {
			$langs = DB::table('languages')->lists('code');
			
			for ($i = 0, $iLen = count($langs); $i<$iLen; $i++) {
				$lang = $langs[$i];
				DB::table('content')->insert(
				    array(
				    	'uid' => $uid, 
				    	'page' => $page,
				    	'language' => $lang,
				    	'content' => $content
				    )
				);
			}
			
		}

		public static function remove($uid, $page) {
			DB::table('content')->where('uid', $uid)->where('page', $page)->delete();
		}
	}

	
