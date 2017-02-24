<?php

/* @author Bouboule (CDA) && ??
Activity Streams are made to keep track of activity inside any environment 
- ActivityStream aims to register all modification on open-editing entity 
- It builds also array of notification which is register in activityStream Collection with a param type array @notify 
- It builds news too

 */
 
class ActivityStream {

	const COLLECTION = "activityStream";
	/**
   *
   * @return [json Map] list
   */
	public static function addEntry($param)
	{
		if($param["type"]==self::COLLECTION){
			$news=$param;
			$news["target"]["type"]=$param["target"]["objectType"];
			unset($news["target"]["objectType"]);
		    PHDB::insert(News::COLLECTION, $news);
		}
	    $param["timestamp"] = new MongoDate(time());
	    PHDB::insert(self::COLLECTION, $param);
	}
	public static function getWhere($params) {
	  	 return PHDB::find( self::COLLECTION,$params,null,null);
	}
	public static function getNotifications($param,$sort=array("timestamp"=>-1))
	{
	    return PHDB::findAndSort(self::COLLECTION, $param,$sort);
	}
	public static function getActivtyForObjectId($param,$sort=array("timestamp"=>-1))
	{
	    return PHDB::findAndSort(self::COLLECTION, $param,$sort,5);
	}
	/*
	* Get activities on entity which is in openEdition
	* @param type string $id defines id of modified entity
	* @param type string $type defines type of modified entity
	*/	
	public static function activityHistory($id,$type){
		$where = array("target.id"=>$id, 
					"target.objectType"=>$type, 
					"type"=>ActStr::TYPE_ACTIVITY_HISTORY);
		$sort = array("date"=>-1);
		return PHDB::findAndSort( self::COLLECTION,$where,$sort,null);
	}
	/*
	* SaveActivityHistory aims to insert in collecion ActivityStream 
	* Each modification, add, each activity done on an entity
	* @param type string $verb defines action realized
	* @param type string $targetId is the id of the entity where action is done
	* @param type string $targetType is the type of the entity where action is done
	* @param type string $activityName is to precise which label is modified (ex name, image, etc)
	*	=> [optional] ex: creation of the event
	* @param type string $activityValue is to precise the value of the activity
	*	=> [optional] ex: creation of the event
	*/
	public static function saveActivityHistory($verb, $targetId, $targetType, $activityName=null, $activityValue=null){
		$buildArray = array(
			"type" => ActStr::TYPE_ACTIVITY_HISTORY,
			"verb" => $verb,
			"target" => array("id" => $targetId,
							"type"=> $targetType),
			"author" => array("id"=>Yii::app()->session["userId"],
							"name"=>Yii::app()->session["user"]["name"])
		);

		if($activityName != null)
			$buildArray["label"] = $activityName;
		if($activityValue != null)
			$buildArray["value"] = $activityValue;
		if($activityName=="geo" || $activityName=="geoPosition")
			$buildArray["value"] = "geoposition";

		$params=self::buildEntry($buildArray);
		self::addEntry($params);
		return true;
	}

	public static function removeNotifications($id)
	{
	    $notif = PHDB::findOne(self::COLLECTION, array("_id"=> new MongoId($id) ) );
	    $res = array( "result"=>false,"msg"=>"Something went wrong : Activty Stream Not Found","id"=>$id );
	    if( isset($notif) && isset( $notif["notify"] ) && isset( $notif["notify"]["id"]) )
	    {
		    if( count($notif["notify"]["id"]) > 1 )
		    	//remove userid from array
		    	unset($notif["notify"]);
		    else
		    	unset($notif["notify"]);
			try{
			    unset($notif["_id"]);
			    PHDB::update( self::COLLECTION,
			                  array("_id"  => new MongoId($id) ), 
			                  array('$unset' => array("notify"=>true) ) );

			    $res = array( "result"=>true,"msg"=>"Removed succesfully" );
		    }
		    catch (Exception $e) {  
		          $res = array( "result"=>false,"msg"=>"Something went wrong :".$e->getMessage() );
		    } 
		}

		return Rest::json($res);
	}

	/**
	 * Remove all notification of a user
	 * @param type $userId the userId
	 * @return array of result (result => boolean, msg => String)
	 */
	public static function removeNotificationsByUser($userId) {
		try{
		    
		    $userNotifcations = PHDB::find( self::COLLECTION,array("notify.id"  => $userId ));
		    
		    foreach ($userNotifcations as $key => $value) 
		    {
		    	if(count($value["notify"]["id"]) == 1 )
		    		PHDB::update( self::COLLECTION,
				                  array("_id"  => $value["_id"] ), 
				                  array('$unset' => array("notify"=>true) ) );
		    	else
		    		PHDB::update( self::COLLECTION,
			                  	  array("_id"  => $value["_id"] ), 
			                  	  array('$pull' => array( "notify.id" => $userId )));
		    	
		    }
		    /*PHDB::updateWithOptions( self::COLLECTION,
					    			array("notify.id"  => Yii::app()->session["userId"] ),
					    			array('$pull' => array( "notify.id" => Yii::app()->session["userId"] )),
					    			array("multi"=>1));*/
			
		    $res = array( "result"=>true,"msg"=>"Removed succesfully" );
	    }
	    catch (Exception $e) {  
	        $res = array( "result"=>false,"msg"=>"Something went wrong :".$e->getMessage() );
	    } 
	

		return $res;
	}

	public static function addNotification($params)
	{
	    $notify =  array(
	        "objectType" => "persons",
	        "id" => $params["persons"],
	        "displayName" => $params["label"],
	        "icon" => $params["icon"],
	        "url" => $params["url"]
	    );
	    return $notify;
	}
	public static function removeObject($objectId,$type,$targetId=null,$targetType=null,$verb=null){
		$where=array("object.id"=>$objectId,"object.objectType"=> $type);
		if(@$targetId && $targetId!=null){
			$where["target.id"]=$targetId;
		}
		if(@$targetType && $targetType!=null){
			$where["target.objectType"]=$targetType;
		}
		if(@$verb && $verb != null){
			$where["verb"]=$verb;
		}
		$res = PHDB::remove(self::COLLECTION, $where);
		return $res;
	}
	public static function buildEntry($params)
    {
    	$action = array(
            "type" => $params["type"],
            "verb" => $params["verb"],
            "author" => Yii::app()->session["userId"],
            "date" => new MongoDate(time()),
            "created" => new MongoDate(time())
        );

        if( isset( $params["object"] )){
            $action["object"] = array( 
                "objectType" => $params["object"]['type'],
                "id" => $params["object"]['id'],
                //"displayName" => "titi"
            );
        }

        if( isset( $params["target"] )){
            $action["target"] = array( 
                "objectType" => $params["target"]['type'],
                "id" => $params["target"]['id']
            );
        }

        if( isset( $params["ip"] ))
        	$action["author"]["ip"] = $params["ip"];

        	
		if($params["type"]==ActivityStream::COLLECTION){
			$action["scope"]["type"]="public";
	        if( isset( $params["address"] )){
	        	$insee = $params["address"]["codeInsee"];
	        	$cp = $params["address"]["postalCode"];
	        } 
	        if( isset( $params["geo"] ))
				$geo = $params["geo"];
			if(!@$insee && !@$cp){

		        $author=Person::getSimpleUserById(Yii::app()->session["userId"]);
		        
		        if(@$author["address"] && @$author["address"]["codeInsee"]){
			        $insee=$author["address"]["codeInsee"];
		        	$cp=$author["address"]["postalCode"];
		        	if(!@$geo)
		        		$geo = $author["geo"];
	        	} else {
		        	$action["scope"]["type"]="restricted";
	        	}
			}
			$action["scope"]["cities"][] = array(
				"codeInsee" => ((@$insee) ? $insee : ""), 
				"postalCode" => ((@$cp) ? $cp : ""),
				"geo"=> ((@$geo) ? $geo : "")
			);
			//$action["scope"]["cities"][] = array("codeInsee" => $insee, "postalCode" => $cp,"geo"=> $geo);

		}
		
        if( isset( $params["label"] ))
        	$action["object"]["displayName"] = $params["label"];
            
		if( isset( $params["value"] )){
			$action["object"]["displayValue"] = ((isset( $params["label"] ) && $params["label"] = "address")?$params["value"]:preg_replace('/<[^>]*>/', '',$params["value"]));

        	//$action["object"]["displayValue"] = preg_replace('/<[^>]*>/', '',$params["value"]);
        }
		if( isset( $params["author"] ))
        	$action["author"] = $params["author"];

		if (isset ($params["tags"]))
			$action["tags"] = $params["tags"];
      return $action;
    }

}