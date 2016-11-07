<?php 
class Element {



	public static function getControlerByCollection ($type) { 

		$ctrls = array(
	    	Organization::COLLECTION => Organization::CONTROLLER,
	    	Person::COLLECTION => Person::CONTROLLER,
	    	Event::COLLECTION => Event::CONTROLLER,
	    	Project::COLLECTION => Project::CONTROLLER,
			News::COLLECTION => News::COLLECTION,
	    	Need::COLLECTION => Need::CONTROLLER,
	    	City::COLLECTION => City::CONTROLLER,
	    	Survey::COLLECTION => Survey::CONTROLLER,
	    	ActionRoom::COLLECTION => ActionRoom::CONTROLLER,
	    	ActionRoom::COLLECTION_ACTIONS => ActionRoom::CONTROLLER,
	    );	    
    	return @$ctrls[$type];
    }


    public static function getCommonByCollection ($type) { 

		$commons = array(
	    	Organization::COLLECTION => "organisation",
	    	Event::COLLECTION => "event",
	    	/*Person::COLLECTION => Person::CONTROLLER,
	    	Project::COLLECTION => Project::CONTROLLER,
			News::COLLECTION => News::COLLECTION,
	    	Need::COLLECTION => Need::CONTROLLER,
	    	City::COLLECTION => City::CONTROLLER,
	    	Survey::COLLECTION => Survey::CONTROLLER,
	    	ActionRoom::COLLECTION => ActionRoom::CONTROLLER,
	    	ActionRoom::COLLECTION_ACTIONS => ActionRoom::CONTROLLER,*/
	    );	    
    	return @$commons[$type];
    }

    public static function getFaIcon ($type) { 

		$fas = array(
	    	Organization::COLLECTION 	=> "group",
	    	Person::COLLECTION 			=> "user",
	    	Event::COLLECTION 			=> "calendar",
	    	Project::COLLECTION 		=> "lightbulb-o",
			News::COLLECTION 			=> "rss",
	    	Need::COLLECTION 			=> "cubes",
	    	City::COLLECTION 			=> "university",
	    	ActionRoom::TYPE_ACTION		=> "cog",
	    	ActionRoom::TYPE_ENTRY		=> "archive",
	    	ActionRoom::TYPE_DISCUSS	=> "comment",
	    	ActionRoom::TYPE_VOTE		=> "archive",
	    	ActionRoom::TYPE_ACTIONS	=> "cogs",
	    );	
	    
	    if(isset($fas[$type])) return $fas[$type];
	    else return false;
    }
    public static function getColorIcon ($type) { 
    	$colors = array(
	    	Organization::COLLECTION 	=> "green",
	    	Person::COLLECTION 			=> "yellow",
	    	Event::COLLECTION 			=> "orange",
	    	Project::COLLECTION 		=> "purple",
	    );	
	    if(isset($colors[$type])) return $colors[$type];
	    else return false;
     }
    
    public static function getElementSpecsByType ($type) { 
    	$ctrler = self::getControlerByCollection ($type);
    	$prefix = "#".$ctrler;
		$fas = array(

	    	Person::COLLECTION 			=> array("icon"=>"user","color"=>"#FFC600","text-color"=>"yellow",
	    										 "hash"=> Person::CONTROLLER.".detail.id.",
	    										 "collection"=>Person::COLLECTION),
	    	Person::CONTROLLER 			=> array("icon"=>"user","color"=>"#FFC600","text-color"=>"yellow",
	    										 "hash"=> Person::CONTROLLER.".detail.id.",
	    										 "collection"=>Person::COLLECTION),

	    	Organization::COLLECTION 	=> array("icon"=>"group", "color"=>"#93C020","text-color"=>"green",
	    										 "hash"=> Organization::CONTROLLER.".detail.id."),
	    	Organization::CONTROLLER 	=> array("icon"=>"group", "color"=>"#93C020","text-color"=>"green",
	    										 "hash"=> Organization::CONTROLLER.".detail.id.",
	    										 "collection"=>Organization::COLLECTION),

	    	
	    	Event::COLLECTION 			=> array("icon"=>"calendar","color"=>"#FFA200","text-color"=>"orange",
	    										 "hash"=> Event::CONTROLLER.".detail.id."),
	    	Event::CONTROLLER 			=> array("icon"=>"calendar","color"=>"#FFA200","text-color"=>"orange",
	    										 "hash"=> Event::CONTROLLER.".detail.id.",
	    										 "collection"=>Event::COLLECTION),

	    	Project::COLLECTION 		=> array("icon"=>"lightbulb-o","color"=>"#8C5AA1","text-color"=>"purple",
	    										 "hash"=> Project::CONTROLLER.".detail.id."),
	    	Project::CONTROLLER 		=> array("icon"=>"lightbulb-o","color"=>"#8C5AA1","text-color"=>"purple",
	    										 "hash"=> Project::CONTROLLER.".detail.id.",
	    										 "collection"=>Project::COLLECTION),

			News::COLLECTION 			=> array("icon"=>"rss","hash"=> $prefix.""),

	    	City::COLLECTION 			=> array("icon"=>"university","color"=>"#E33551","text-color"=>"red",
	    										 "hash"=> $prefix.".detail.insee."),
	    	City::CONTROLLER 			=> array("icon"=>"university","color"=>"#E33551","text-color"=>"red",
	    										 "hash"=> $prefix.".detail.insee."),
	    	
	    	ActionRoom::TYPE_VOTE		=> array("icon"=>"archive","color"=>"#3C5665", "text-color"=>"azure",
	    		 								 "hash"=> "survey.entries.id.",
	    		 								 "collection"=>ActionRoom::COLLECTION),
	    	ActionRoom::TYPE_VOTE."s"	=> array("icon"=>"archive","color"=>"#3C5665", "text-color"=>"azure",
	    		 								 "hash"=> "survey.entries.id.",
	    		 								 "collection"=>ActionRoom::COLLECTION),
	    	ActionRoom::TYPE_ACTIONS	=> array("icon"=>"cogs","color"=>"#3C5665", "text-color"=>"lightblue2",
	    		 								 "hash"=> "rooms.actions.id.",
	    		 								 "collection"=>ActionRoom::COLLECTION),
	    	ActionRoom::TYPE_ACTIONS."s"=> array("icon"=>"cogs","color"=>"#3C5665", "text-color"=>"lightblue2",
	    		 								 "hash"=> "rooms.actions.id.",
	    		 								 "collection"=>ActionRoom::COLLECTION),
	    	ActionRoom::TYPE_ACTION		=> array("icon"=>"cog","color"=>"#3C5665", "text-color"=>"lightblue2",
	    		 								 "hash"=> "rooms.action.id.",
	    		 								 "collection"=>ActionRoom::COLLECTION_ACTIONS),
	    	ActionRoom::TYPE_ACTION."s"	=> array("icon"=>"cog","color"=>"#3C5665", "text-color"=>"lightblue2",
	    		 								 "hash"=> "rooms.action.id.",
	    		 								 "collection"=>ActionRoom::COLLECTION_ACTIONS),
	    	ActionRoom::TYPE_ENTRY		=> array("icon"=>"archive","color"=>"#3C5665", "text-color"=>"dark",
	    										 "hash"=> "survey.entry.id.",
	    										 "collection"=>Survey::COLLECTION ),
	    	ActionRoom::TYPE_ENTRY."s"	=> array("icon"=>"archive","color"=>"#3C5665", "text-color"=>"dark",
	    										 "hash"=> "survey.entry.id.",
	    										 "collection"=>Survey::COLLECTION ),
	    	ActionRoom::TYPE_DISCUSS	=> array("icon"=>"comment","color"=>"#3C5665", "text-color"=>"dark",
	    										 "hash"=> "comment.index.type.actionRooms.id.",
	    										 "collection"=>ActionRoom::COLLECTION),
	    	ActionRoom::TYPE_DISCUSS."s"=> array("icon"=>"comment","color"=>"#3C5665", "text-color"=>"dark",
	    										 "hash"=> "comment.index.type.actionRooms.id.",
	    										 "collection"=>ActionRoom::COLLECTION)
	    );	
	    //echo $type.Project::COLLECTION;
	    if( isset($fas[$type]) ) 
	    	return $fas[$type];
	    else 
	    	return false;
    }

    /**
     * Return a link depending on the type and the id of the element.
     * The HTML link could be kind of : <a href="" onclick="loadByHash(...)">name</a>
     * If loadByHashOnly is set : only the loadByHash will be returned
     * @param String $type The type of the entity
     * @param String $id The id of the entity
     * @param type|null $loadByHashOnly if true, will return only the loadbyhash not surounded by the html link
     * @return String the link on the loaByHash to display the detail of the element
     */
    public static function getLink( $type, $id, $hashOnly=null ) {	    
    	$link = ""; 
    	$specs = self::getElementSpecsByType ($type);
    	if( @$specs["collection"] )
    		$type = $specs["collection"];

    	if(@$type && @$id && $type != City::COLLECTION){
    		if (!$hashOnly)
    			$el = PHDB::findOne ( $type , array( "_id" => new MongoId($id) ),array("name") );
	    	
	    	$link = $specs["hash"].$id;
	    }
	    else if($type == City::COLLECTION){
	    	$el = City::getByUnikey($id);
	    	$link = $specs["hash"].$el['insee'].".postalCode.".$el['cp'];
	    }
	    
	    //if ( !$hashOnly && @$el ) 
	    $link = '<a href="#'.$link.'" class="lbh">'.htmlspecialchars(@$el['name']).'</a>';
	    
    	return $link;
    }

	public static function getByTypeAndId($type, $id){
		if($type == Person::COLLECTION)
			$element = Person::getById($id);
		else if($type == Organization::COLLECTION)
			$element = Organization::getById($id);		
		else if($type == Project::COLLECTION)
			$element = Project::getById($id);	
		else if($type == Event::COLLECTION)
			$element = Event::getById($id);	
		else if($type == City::COLLECTION)
			$element = City::getIdByInsee($id);
		else 
			$element = PHDB::findOne($type,array("_id"=>new MongoId($id)));
	  	
	  	return $element;
	}

    public static function getInfos( $type, $id, $loadByHashOnly=null ) {	    
    	$link = ""; 
    	$name = ""; 
    	if(@$type && @$id && $type != City::COLLECTION){
    		$el = PHDB::findOne ( $type , array( "_id" => new MongoId($id) ) );
	    	$ctrl = self::getControlerByCollection($type);
	    	if( @$el && @$ctrl )
	    		$link = "loadByHash('#".$ctrl.".detail.id.".$id."')";
	    }
	    else if($type == City::COLLECTION){
	    	$el = City::getByUnikey($id);
	    	$ctrl = self::getControlerByCollection($type);
	    	if( @$el && @$ctrl )
	    		$link = "loadByHash('#".$ctrl.".detail.insee.".$el['insee'].".cp.".$el['cp']."')";
	    }
	    
	    if (! $loadByHashOnly) {
	    	$link = "<a href='javascript:;' onclick=\"".$link."\">".$el['name']."</a>";
	    }
	    
    	return array( "link" => $link , 
    					"name" => $el['name'], 
    					"profilThumbImageUrl" => @$el['profilThumbImageUrl'], 
    					"type"=>$type,
    					"id"=> $id);
    }



    private static function getDataBinding($collection) {
		if($collection == Person::COLLECTION)
			return Person::getDataBinding();
		else if($collection == Organization::COLLECTION)
			return Organization::getDataBinding();
		else if($collection == Event::COLLECTION)
			return Event::getDataBinding();
		else if($collection == Project::COLLECTION)
			return Project::getDataBinding();
		else if($collection == Survey::COLLECTION)
			return Survey::getDataBinding();
		else
			return array();
	}

    private static function getCollectionFieldNameAndValidate($collection, $elementFieldName, $elementFieldValue, $elementId) {
		return DataValidator::getCollectionFieldNameAndValidate(self::getDataBinding($collection), $elementFieldName, $elementFieldValue, $elementId);
	}



    public static function updateField($collection, $id, $fieldName, $fieldValue) {

    	if (!Authorisation::canEditItemOrOpenEdition($id, $collection, Yii::app()->session['userId'])) {
			throw new CTKException(Yii::t("common","Can not update the element : you are not authorized to update that element !"));
		}
		if(is_string($fieldValue))
			$fieldValue = trim($fieldValue);

		$dataFieldName = self::getCollectionFieldNameAndValidate($collection, $fieldName, $fieldValue, $id);
		
		$verb = (empty($fieldValue) ? '$unset' : '$set');
		//$verb = '$set' ;
		//$set = array($fieldName => $fieldValue);

		//Specific case : 
		//Tags
		//var_dump($dataFieldName);
		if ($dataFieldName == "tags") {
			$fieldValue = Tags::filterAndSaveNewTags($fieldValue);
			$set = array($dataFieldName => $fieldValue);
		}
		else if ( ($dataFieldName == "telephone.mobile"|| $dataFieldName == "telephone.fixe" || $dataFieldName == "telephone.fax")){
			if($fieldValue ==null)
				$fieldValue = array();
			else
				$fieldValue = explode(",", $fieldValue);
			$set = array($dataFieldName => $fieldValue);
		}
		else if ($fieldName == "locality") {
			//address
			try{
				if(!empty($fieldValue)){
					$verb = '$set';
					$address = array(
				        "@type" => "PostalAddress",
				        "codeInsee" => $fieldValue["address"]["codeInsee"],
				        "addressCountry" => $fieldValue["address"]["addressCountry"],
				        "postalCode" => $fieldValue["address"]["postalCode"],
				        "addressLocality" => $fieldValue["address"]["addressLocality"],
				        "streetAddress" => ((@$fieldValue["address"]["streetAddress"])?trim(@$fieldValue["address"]["streetAddress"]):""),
				        "depName" => $fieldValue["address"]["depName"],
				        "regionName" => $fieldValue["address"]["regionName"],
				    	);
					//Check address is well formated

					$valid = DataValidator::addressValid($address);
					if ( $valid != "") throw new CTKException($valid);

					SIG::updateEntityGeoposition($collection, $id, $fieldValue["geo"]["latitude"], $fieldValue["geo"]["longitude"]);
					
					if($collection == Person::COLLECTION && Yii::app()->session['userId'] == $id){
						$user = Yii::app()->session["user"];
						$user["codeInsee"] = $address["codeInsee"];
						$user["postalCode"] = $address["postalCode"];
						$user["address"] = $address;
						Yii::app()->session["user"] = $user;
						Person::updateCookieCommunexion($id, $address);
					}
				}else{
					$verb = '$unset' ;
					SIG::updateEntityGeoposition($collection, $id, null, null);
					if($collection == Person::COLLECTION && Yii::app()->session['userId'] == $id){
						$user = Yii::app()->session["user"];
						unset($user["codeInsee"]);
						unset($user["postalCode"]);
						unset($user["address"]);
						Yii::app()->session["user"] = $user;
						Person::updateCookieCommunexion($id, null);
					}
					$address = null ;
				}
				$set = array("address" => $address);
				
			}catch (Exception $e) {  
				throw new CTKException("Error updating  : ".$e->getMessage());		
			}
		}else if ($fieldName == "addresses") {
			//address
			try{
				if(isset($fieldValue["addressesIndex"])){
					$elt = self::getElementById($id, $collection, null, array("addresses"));
					if(!empty($fieldValue["address"])){
						$verb = '$set';
						$address = array(
					        "@type" => "PostalAddress",
					        "codeInsee" => $fieldValue["address"]["codeInsee"],
					        "addressCountry" => $fieldValue["address"]["addressCountry"],
					        "postalCode" => $fieldValue["address"]["postalCode"],
					        "addressLocality" => $fieldValue["address"]["addressLocality"],
					        "streetAddress" => ((@$fieldValue["address"]["streetAddress"])?trim(@$fieldValue["address"]["streetAddress"]):""),
					        "depName" => $fieldValue["address"]["depName"],
					        "regionName" => $fieldValue["address"]["regionName"],
					    	);
						//Check address is well formated

						$valid = DataValidator::addressValid($address);
						if ( $valid != "") throw new CTKException($valid);

						
						if(empty($elt["addresses"]) || $fieldValue["addressesIndex"] >= count($elt["addresses"]) ){
							$geo = array("@type"=>"GeoCoordinates", "latitude" => $fieldValue["geo"]["latitude"], "longitude" => $fieldValue["geo"]["longitude"]);
							$geoPosition = array("type"=>"Point", "coordinates" => array(floatval($fieldValue["geo"]["longitude"]), floatval($fieldValue["geo"]["latitude"])));
							$locality = array(	"address" => $address,
												"geo" => $geo,
												"geoPosition" => $geoPosition);
							$addToSet = array("addresses" => $locality);
						}
						else{
							SIG::updateEntityGeoposition($collection, $id, $fieldValue["geo"]["latitude"], $fieldValue["geo"]["longitude"], $fieldValue["addressesIndex"]);
							$headSet = "addresses.".$fieldValue["addressesIndex"].".address" ;
						}

					}else{
						$verb = '$unset' ;
						//SIG::updateEntityGeoposition($collection, $id, null, null, $fieldValue["addressesIndex"]);
						$address = null ;
						if(count($elt["addresses"]) == 1){
							$headSet = "addresses";
						}else{
							$headSet = "addresses.".$fieldValue["addressesIndex"] ;
							$updatePull = true ;
						}
					}

					if(!empty($headSet))
						$set = array($headSet => $address);
				}else{
					throw new CTKException("Error updating  : addressesIndex ");	
				}
			}catch (Exception $e) {  
				throw new CTKException("Error updating  : ".$e->getMessage());		
			}
		}else if ($fieldName == "geo" || $fieldName == "geoPosition") {
			try{
				if(!empty($fieldValue["addressesIndex"])){
					$headSet = "addresses.".$fieldValue["addressesIndex"].".".$fieldName ;
					unset($fieldValue["addressesIndex"]);
				}
				else
					$headSet = $fieldName ;

				$verb = (!empty($fieldValue)?'$set':'$unset');
				$geo = (!empty($fieldValue)?$fieldValue:null);

				$valid = (($fieldName == "geo")?DataValidator::geoValid($geo):DataValidator::geoPositionValid($geo));
				if ( $valid != "") throw new CTKException($valid);

				
				$set = array($headSet => $geo);

			}catch (Exception $e) {  
				throw new CTKException("Error updating  : ".$e->getMessage());		
			}
		}
		/*else if ($fieldName == "address") {
			//address
			if(!empty($fieldValue["postalCode"]) && !empty($fieldValue["codeInsee"])) {
				$insee = $fieldValue["codeInsee"];
				$postalCode = $fieldValue["postalCode"];
				$cityName = $fieldValue["addressLocality"];
				$address = SIG::getAdressSchemaLikeByCodeInsee($insee, $postalCode,$cityName);
				$set = array("address" => $address);
				if (!empty($fieldValue["streetAddress"]))
					$set["address"]["streetAddress"] = $fieldValue["streetAddress"];
				if(empty($fieldValue["geo"])){
					$set["geo"] = SIG::getGeoPositionByInseeCode($insee, $postalCode,$cityName);
					//SIG::updateEntityGeoposition($collection,$id,$geo["latitude"],$geo["longitude"]);
					SIG::updateEntityGeoposition($collection,$id,$set["geo"]["latitude"],$set["geo"]["longitude"]);
				}
				if($collection == Person::COLLECTION){
					$user = Yii::app()->session["user"];
					$user["codeInsee"] = $insee;
					$user["postalCode"] = $postalCode;
					$user["address"] = $address;
					Yii::app()->session["user"] = $user;
				}
			} else 
				throw new CTKException("Error updating  : address is not well formated !");			
		}*/
		else if ($dataFieldName == "birthDate") 
		{
			date_default_timezone_set('UTC');
			$dt = DateTime::createFromFormat('Y-m-d H:i', $fieldValue);
			if (empty($dt)) {
				$dt = DateTime::createFromFormat('Y-m-d', $fieldValue);
			}
			$newMongoDate = new MongoDate($dt->getTimestamp());
			$set = array($dataFieldName => $newMongoDate);
		//Date format
		} else if ($dataFieldName == "startDate" || $dataFieldName == "endDate") {
			date_default_timezone_set('UTC');
			if( !is_string( $fieldValue ) && get_class( $fieldValue ) == "MongoDate"){
				$newMongoDate = $fieldValue;
			}else{
				$dt = DateTime::createFromFormat('Y-m-d H:i', $fieldValue);
				if (empty($dt)) {
					$dt = DateTime::createFromFormat('Y-m-d', $fieldValue);
				}
				$newMongoDate = new MongoDate($dt->getTimestamp());
			}
			$set = array($dataFieldName => $newMongoDate);	
		}
		else if ($dataFieldName == "seePreferences") {
			//var_dump($fieldValue);
			if($fieldValue == "false"){
				//$verb = "$unset";
				$verb = '$unset' ;
				$set = array($dataFieldName => "");
			}else{
				$set = array($dataFieldName => $fieldValue);
			}
		}
		else
			$set = array($dataFieldName => $fieldValue);

		if(Person::COLLECTION == $collection){
			if ( $fieldValue == "bgClass") {
				//save to session for all page reuse
				$user = Yii::app()->session["user"];
				$user["bg"] = $fieldValue;
				Yii::app()->session["user"] = $user;
			} else if ( $fieldName == "bgUrl") {
				//save to session for all page reuse
				$user = Yii::app()->session["user"];
				$user["bgUrl"] = $fieldValue;
				Yii::app()->session["user"] = $user;
			} 
		}else{
			$set["modified"] = new MongoDate(time());
			$set["updated"] = time();
		}
		
		//Manage dateEnd field for survey
		if ($collection == Survey::COLLECTION) {
			$canUpdate = Survey::canUpdateSurvey($id, $dataFieldName, $fieldValue);
			if ($canUpdate["result"]) {
				if ($dataFieldName == "dateEnd") {
					$set = array($dataFieldName => strtotime($fieldValue));
				}
			} else {
				throw new CTKException($canUpdate["msg"]);
			}
		}

		//update 
		if(!empty($addToSet)){
			$resAddToSet = PHDB::update( $collection, array("_id" => new MongoId($id)), 
	                          array('$addToSet' => $addToSet));
		}


		$resUpdate = PHDB::update( $collection, array("_id" => new MongoId($id)), 
		                          array($verb => $set));

		$res = array("result"=>false,"msg"=>"");

		if($resUpdate["ok"]==1){

			if(!empty($updatePull) && $updatePull == true){
				$resPull = PHDB::update( $collection, array("_id" => new MongoId($id)), 
		                          array('$pull' => array('addresses' => null)));
			}

			$fieldNames = array("badges", "geo", "geoPosition");
			if( $collection != Person::COLLECTION && !in_array($dataFieldName, $fieldNames)){
				// Add in activity to show each modification added to this entity
				ActivityStream::saveActivityHistory(ActStr::VERB_UPDATE, $id, $collection, $dataFieldName, $fieldValue);
			}
			$res = array("result"=>true,"msg"=>Yii::t(Element::getControlerByCollection($collection),"The ".Element::getControlerByCollection($collection)." has been updated"));
		}else{
			throw new CTKException("Can not update the element!");
		}
		

		return $res;
	}

	public static function getImgProfil($person, $imgName, $assetUrl){
    	$url = "";
    	$testUrl = "";
    	if (isset($person) && !empty($person)) {
	        if(!empty($person[$imgName])){
	          $url = Yii::app()->getRequest()->getBaseUrl(true).$person[$imgName];
	          $end = strpos($person[$imgName], "?");
	          if($end<0) $end = strlen($person[$imgName]);
	          $testUrl = substr($person[$imgName], 1, $end-1);
	        }
	        else{
	          $url = $assetUrl.'/images/thumbnail-default.jpg';
	          $testUrl = substr($url, 1);
	        }
	    }
	    return $url;
	    //echo $testUrl;
	    //error_log($testUrl);
	    //if(file_exists($testUrl)) return $url;
	    //else return $assetUrl.'/images/thumbnail-default.jpg';
    }
     
    public static function getAllLinks($links,$type, $id){
	    $contextMap = array();
		$contextMap["people"] = array();
		$contextMap["guests"] = array();
		$contextMap["attendees"] = array();
		$contextMap["organizations"] = array();
		$contextMap["projects"] = array();
		$contextMap["events"] = array();
		$contextMap["followers"] = array();


	    if($type == Organization::COLLECTION){
	    	$connectAs="members";
	    	$elt = Organization::getSimpleOrganizationById($id);
			$newOrga["type"]=Organization::COLLECTION;
			array_push($contextMap["organizations"], $elt);
	    }
	    else if($type == Project::COLLECTION){
	    	$connectAs="contributors";
	    	$elt = Project::getSimpleProjectById($id);
			array_push($contextMap["projects"], $elt);
	    }
		else if ($type == Event::COLLECTION){
			$connectAs="attendees";
			$elt = Event::getSimpleEventById($id);
			array_push($contextMap["events"], $elt);
		}
		else if ($type == Person::COLLECTION)
			$connectAs="knows";

	    
		if(!empty($links)){
			if(isset($links[$connectAs])){
				foreach ($links[$connectAs] as $key => $aMember) {
					if($type==Event::COLLECTION){
						$citoyen = Person::getSimpleUserById($key);
						if(!empty($citoyen)){
							if(@$aMember["invitorId"])  {
								array_push($contextMap["guests"], $citoyen);
							}
							else{
				                  if(@$e["isAdmin"]){
				                    if(@$e["isAdminPending"])
				                      $citoyen["isAdminPending"]=true;
				                    $citoyen["isAdmin"]=true;         
				                  }
								  array_push($contextMap["attendees"], $citoyen);
							}
              			}
					}else{
						if($aMember["type"]==Organization::COLLECTION){
							$newOrga = Organization::getSimpleOrganizationById($key);
							if(!empty($newOrga)){
								if ($aMember["type"] == Organization::COLLECTION && @$aMember["isAdmin"]){
									$newOrga["isAdmin"]=true;  				
								}
								$newOrga["type"]=Organization::COLLECTION;
								if (!@$newOrga["disabled"]) {
									array_push($contextMap["organizations"], $newOrga);
								}
							}
						} 
						else if($aMember["type"]==Person::COLLECTION){
							$newCitoyen = Person::getSimpleUserById($key);
							if (!empty($newCitoyen)) {
								if (@$aMember["type"] == Person::COLLECTION) {
									if(@$aMember["isAdmin"]){
										if(@$aMember["isAdminPending"])
											$newCitoyen["isAdminPending"]=true;  
											$newCitoyen["isAdmin"]=true;  	
									}			
									if(@$aMember["toBeValidated"]){
										$newCitoyen["toBeValidated"]=true;  
									}		
				  				
								}
								$newCitoyen["type"]=Person::COLLECTION;
								array_push($contextMap["people"], $newCitoyen);
							}
						}
					}
				}
			}
			// Link with events
			if(isset($links["events"])){
				foreach ($links["events"] as $keyEv => $valueEv) {
					 $event = Event::getSimpleEventById($keyEv);
					 if(!empty($event))
					 	array_push($contextMap["events"], $event);
				}
			}
	
			// Link with projects
			if(isset($links["projects"])){
				foreach ($links["projects"] as $keyProj => $valueProj) {
					 $project = Project::getSimpleProjectById($keyProj);
					 if (!empty($project))
	           		 array_push($contextMap["projects"], $project);
				}
			}

			if(isset($links["followers"])){
				foreach ($links["followers"] as $key => $value) {
					$newCitoyen = Person::getSimpleUserById($key);
					if (!empty($newCitoyen))
					array_push($contextMap["followers"], $newCitoyen);
				}
			}
			if(isset($links["memberOf"])){
				foreach ($links["memberOf"] as $key => $value) {
					$newOrga = Organization::getSimpleOrganizationById($key);
					if (!empty($newOrga))
					array_push($contextMap["organizations"], $newOrga);
				}
			}
			$follows = array("citoyens"=>array(),
  					"projects"=>array(),
  					"organizations"=>array(),
  					"count" => 0
  			);
  			if ($type == Person::COLLECTION){
	  			$contextMap["follows"] = array();
				$countFollows=0;
			    if (@$links["follows"]) {
			        foreach ( @$links["follows"] as $key => $member ) {
			          	if( $member['type'] == Person::COLLECTION ) {
				            $citoyen = Person::getSimpleUserById( $key );
				  	        if(!empty($citoyen)) {
				              array_push( $follows[Person::COLLECTION], $citoyen );
				            }
			        	}
						if( $member['type'] == Organization::COLLECTION ) {
							$organization = Organization::getSimpleOrganizationById($key);
							if(!empty($organization)) {
								array_push($follows[Organization::COLLECTION], $organization );
							}
						}
						if( $member['type'] == Project::COLLECTION ) {
						    $project = Project::getSimpleProjectById($key);
						    if(!empty($project)) {
								array_push( $follows[Project::COLLECTION], $project );
							}
						}
						$countFollows++;
		        	}
				}	
				$follows["count"]= $countFollows;
				$contextMap["follows"] = $follows;
			}
			
		}
		//error_log("get POI for id : ".$id." - type : ".$type);
		if(isset($id)){
			$pois = PHDB::find(Poi::COLLECTION,array("parentId"=>$id,"parentType"=>$type));
			if(!empty($pois)) {
				$allPois = array();
				if(!is_array($pois)) $pois = array($pois);
				foreach ($pois as $key => $value) {
					if(@$value["type"])
						$value["typeSig"] = Poi::COLLECTION.".".$value["type"];
					else
						$value["typeSig"] = Poi::COLLECTION;
					$allPois[] = $value;
				}
				$contextMap["pois"] = $allPois;
			}else{
				$contextMap["pois"] = array();
			}
		}
		return $contextMap;	
    }

    public static function getActive($type){

        $list = PHDB::findAndSort( $type ,array("updated"=>array('$exists'=>1)),array("updated"=>1), 4);
        
        return $list;
     }


    /**
	 * answers to show or not to show a field by it's name
	 * @param String $id : is the mongoId of the action room
	 * @param String $person : is the mongoId of the action room
	 * @return "" or the value to be shown
	 */
	public static function showField($fieldName,$element, $isLinked) {
	  	
	  	$res = null;

	  	$attConfName = $fieldName;
	  	if($fieldName == "address.streetAddress") 	$attConfName = "locality";
	  	if($fieldName == "telephone") 				$attConfName =  "phone";

	  	if( Yii::app()->session['userId'] == (string)$element["_id"]
	  		||  ( isset($element["preferences"]) && isset($element["preferences"]["publicFields"]) && in_array( $attConfName, $element["preferences"]["publicFields"]) )  
	  		|| ( $isLinked && isset($element["preferences"]) && isset($element["preferences"]["privateFields"]) && in_array( $attConfName, $element["preferences"]["privateFields"]))  )
	  	{
	  		$res = ArrayHelper::getValueByDotPath($element,$fieldName);
	  	
	  	}
	  	
	  	return $res;
     
	}
	/**
		* Put last timestamp on element label 
		* label ex: update, lastInvitation
	**/
	public static function updateTimeElementByLabel($elementType,$elementId, $label) {
		PHDB::update($elementType, 
			array("_id" => $elementId) , 
            array('$set' => array( $label =>time()))
		);
		return true;
	}

	public static function delete($elementType,$elementId,$userId) {
		
		if ($elementType != Poi::COLLECTION && $elementType != Poi::CONTROLLER) {
            return array( "result" => false, "msg" => "For now you can only delete Points of interest" );   
        }

		if ( !@$userId) {
            return array( "result" => false, "msg" => "You must be loggued to delete something" );
        }
        
        $el = self::getByTypeAndId($elementType, $elementId);
        //TODO : we could also allow admins
        if ( $userId != $el['creator']) {
            return array( "result" => false, "msg" => "You must be owner to delete something" );    
        }
        
		PHDB::remove($elementType, array("_id"=>new MongoId($elementId)));
		return array("result" => true, "msg" => "The element has been deleted succesfully");
	}

	public static function save($params){
        $id = null;
        $data = null;
        $collection = $params["collection"];
        if( !empty($params["id"]) ){
        	$id = $params["id"];
        }
        $key = $params["key"];
		$paramsLinkImport = ( empty($params["paramsLink"] ) ? null : $params["paramsLink"]);

		unset($params["paramsLink"]);
        unset($params['collection']);
        unset($params['key']);
        $params = self::prepData( $params );
        unset($params['id']);
        
        /*$microformat = PHDB::findOne(PHType::TYPE_MICROFORMATS, array( "key"=> $key));
        $validate = ( !isset($microformat )  || !isset($microformat["jsonSchema"])) ? false : true;
        //validation process based on microformat defeinition of the form
        */
        //validation process based on databind on each Elemnt Mode
        $valid = array("result"=>true);
        if( $collection == Event::COLLECTION ){
            $valid = Event::validateFirstAndFormat($params);
            if( $valid["result"] )
            	$params = $valid["params"];
        }
        
        if( $valid["result"] )
        	try {
        		$valid = DataValidator::validate( ucfirst($key), json_decode (json_encode ($params), true) );
        	} catch (CTKException $e) {
        		$valid = array("result"=>false, "msg" => $e->message);
        	}
        if( $valid["result"]) {
            if($id) {
                //update a single field
                //else update whole map
                //$changeMap = ( !$microformat && isset( $key )) ? array('$set' => array( $key => $params[ $key ] ) ) : array('$set' => $params );
                PHDB::update($collection,array("_id"=>new MongoId($id)), array('$set' => $params ));
                $res = array("result"=>true,
                             "msg"=>"Vos données ont été mise à jour.",
                             "reload"=>true,
                             "map"=>$params,
                             "id"=>$id);
            } else {
                $params["created"] = time();
                PHDB::insert($collection, $params );
                $res = array("result"=>true,
                             "msg"=>"Vos données ont bien été enregistré.",
                             "reload"=>true,
                             "map"=>$params,
                             "id"=>(string)$params["_id"]);  
                
                //TODO
                //self::afterSave();
                
                // ***********************************
                //post process for specific actions
                // ***********************************
                if( $collection == Organization::COLLECTION )
                	$res["afterSave"] = Organization::afterSave($params, Yii::app()->session["userId"]);
                else if( $collection == Event::COLLECTION )
                	$res["afterSave"] = Event::afterSave($params);
                else if( $collection == Project::COLLECTION )
                	$res["afterSave"] = Project::afterSave($params, @$params["parentId"] , @$params["parentType"] );

                if( false && @$params["parentType"] && @$params["parentId"] ){
                    //createdObjectAsParam($authorType, $authorId, $objectType, $objectId, $targetType, $targetId, $geo, $tags, $address, $verb="create")
                    //TODO
                    //Notification::createdObjectAsParam($authorType[Person::COLLECTION],$userId,$elementType, $elementType, $parentType[projet crée par une orga => orga est parent], $parentId, $params["geo"], (isset($params["tags"])) ? $params["tags"]:null ,$params["address"]);  
                }
            }
          //  if(@$url = ( @$params["parentType"] && @$params["parentId"] && in_array($collection, array("poi") && Yii::app()->theme != "notragora")) ? "#".self::getControlerByCollection($params["parentType"]).".detail.id.".$params["parentId"] : null )
	        //    $res["url"] = $url;
	        if(@$params["parentType"] && @$params["parentId"] && in_array($collection, array("poi"))){
		        if(Yii::app()->params["theme"] != "notragora")
		        	$url="#".self::getControlerByCollection($params["parentType"]).".detail.id.".$params["parentId"];
		        else
		        	$url="#poi.detail.id.".$res["id"];
	        } else{
		        $url=false;
	        }
             
			$res["url"]=$url;
        } else 
            $res = array( "result" => false, 
                          "msg" => Yii::t("common","Something went really bad : ".$valid['msg']) );

        return $res;
    }

    public static function prepData ($params) { 

        //empty fields aren't properly validated and must be removed
        foreach ($params as $k => $v) {
            if($v== "")
                unset($params[$k]);
        }
        $coordinates = @$params["geoPosition"]["coordinates"] ;
        if(@$coordinates && (is_string($coordinates[0]) || is_string($coordinates[1])))
			$params["geoPosition"]["coordinates"] = array(floatval($coordinates[0]), floatval($coordinates[1]));

     	/*if(!empty($params['startDate']) )
			$params['startDate'] = new MongoDate( strtotime( $params['startDate'] ));//$project['startDate'];
			
		if(!empty($params['endDate'])) 
			$params['endDate'] = new MongoDate( strtotime( $params['endDate'] ));//$project['endDate']
		*/
		if (!empty($params["tags"]))
			$params["tags"] = Tags::filterAndSaveNewTags($params["tags"]);
        
		$params["modified"] = new MongoDate(time());
		$params["updated"] = time();
		if( empty($params["id"]) ){
	        $params["creator"] = Yii::app()->session["userId"];
	        $params["created"] = time();
	    }

        return $params;
     }


    /**
	 * Retrieve a element by id from DB
	 * @param String $id of the event
	 * @return array with data id, name, type profilImageUrl
	 */
	public static function getElementById($id, $collection, $where=null, $fields=null){
		$where["_id"] = new MongoId($id) ;
		$element = PHDB::findOne($collection, $where ,$fields);
		return @$element;
	}


	public static function getElementSimpleById($id, $collection,$where=null, $fields=null){
		$fields = array("_id", "name");
		$element = self::getElementById($id, $collection, $where ,$fields) ;
		return @$element;
	}

	public static function followPerson($params, $gmail=null){
		
		$invitedUserId = "";

        if (empty(Yii::app()->session["userId"])) {
        	Rest::json(array("result" => false, "msg" => "The current user is not valid : please login."));
        	die();
        }
        
        //Case spécial : Vérifie si l'email existe et retourne l'id de l'utilisateur
        if (!empty($params["invitedUserEmail"]))
        	$invitedUserId = Person::getPersonIdByEmail($params["invitedUserEmail"]) ;

        //Case 1 : the person invited exists in the db
        if (!empty($params["connectUserId"]) || !empty($invitedUserId)) {
        	if (!empty($params["connectUserId"]))
        		$invitedUserId = $params["connectUserId"];

        	$child["childId"] = Yii::app()->session["userId"] ;
        	$child["childType"] = Person::COLLECTION;

        	$res = Link::follow($invitedUserId, Person::COLLECTION, $child);
            $actionType = ActStr::VERB_FOLLOW;
		//Case 2 : the person invited does not exist in the db
		} else if (empty($params["invitedUserId"])) {
			$newPerson = array("name" => $params["invitedUserName"], "email" => $params["invitedUserEmail"], "invitedBy" => Yii::app()->session["userId"]);
			
			//if(!empty($params["msgEmail"]))
				$res = Person::createAndInvite($newPerson, @$params["msgEmail"], $gmail);
			//else
				//$res = Person::createAndInvite($newPerson);

            $actionType = ActStr::VERB_INVITE;
            if ($res["result"]) {
            	$invitedUserId = $res["id"];
                $child["childId"] = Yii::app()->session["userId"];
    			$child["childType"] = Person::COLLECTION;
                $res = Link::follow($invitedUserId, Person::COLLECTION, $child);
            }
		}
		
        if (@$res["result"] == true) {
            $person = Person::getSimpleUserById($invitedUserId);
            $res = array("result" => true, "invitedUser" => $person);
        } else {
            $res = array("result" => false, "msg" => $res["msg"]);
        }

		return $res;
	}

	public static function followPersonByListMails($listMails, $msgEmail=null, $gmail=null){
		$result = array("result" => false);
		$params["msgEmail"] = (empty($msgEmail)?null:$msgEmail) ;
		foreach ($listMails as $key => $value) {
			$result["result"] = true ;
			if(!empty($value["mail"])){
				$params["invitedUserEmail"] = $value["mail"] ;

				if(empty($value["name"])){
					$split = explode("@", $value["mail"]);
					$params["invitedUserName"] = $split[0];
				}else
					$params["invitedUserName"] = $value["name"] ;
				$result["data"][] = Element::followPerson($params, $gmail);
			}
		}
		return $result;
	}



    
}