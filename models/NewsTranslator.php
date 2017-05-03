<?php 
class NewsTranslator {
	
	const NEWS_CONTRIBUTORS = "newsContributors";
	const NEWS_CREATE_PROJECT = "newsCreateProject";
	const NEWS_CREATE_NEED = "newsCreateNeed";
	const NEWS_CREATE_EVENT = "newsCreateEvent";
	const NEWS_CREATE_ORGANIZATION = "newsCreateOrganization";
	const NEWS_CREATE_TASK = "newsCreateTask";
	const NEWS_JOIN_ORGANIZATION = "newsMemberJoinOrganization";
	/**
		*get news well formated 
		*	@param string author become an object, 
		*	@param object object (if type=="activityStream") become object with informations, 
		*	@param object target, 
		*	@param object media (if type=="gallery_images") become of object with document,
	**/
	public static function convertParamsForNews($params,$readOne=false){
		if(@$params["object"]){
			$docImg="";
			if(@$params["object"]["type"]==Event::COLLECTION){
				$object=Event::getSimpleEventById((string)$params["object"]["id"]);
				$params["icon"] = "fa-calendar";
			} 
			else if (@$params["object"]["type"]==Organization::COLLECTION){
				$object=Organization::getSimpleOrganizationById((string)$params["object"]["id"]);
				$params["icon"] = "fa-group";
			} 
			else if (@$params["object"]["type"]==Project::COLLECTION){
				$object=Project::getSimpleProjectById((string)$params["object"]["id"]);
				$params["icon"]="fa-lightbulb-o";
			}
			else if (@$params["object"]["type"]==Need::COLLECTION){
				$object=Need::getSimpleNeedById((string)$params["object"]["id"]);
				$params["icon"]="fa-cubes";
			}
			else if (@$params["object"]["type"]==News::COLLECTION){
				$object=News::getById((string)$params["object"]["id"]);
				$params["icon"]="fa-newspaper-o";
			}
			else if (@$params["object"]["type"]==Classified::COLLECTION){
				$object=Classified::getById((string)$params["object"]["id"]);
				$params["icon"]="fa-newspaper-o";
			}

			if(!empty($object)){
				$thisType = $params["object"]["type"];
				$params["object"] = array_merge($params["object"], $object);
				$params["object"]["type"] = $thisType;

				if(@$params["object"]["type"]!=Need::COLLECTION)
					$params["imageBackground"] = @$object["profilImageUrl"];

				$params["name"] = @$object["name"] ? $object["name"] : @$object["title"];
				
				//if(@$params["object"]["type"]==ActivityStream::COLLECTION)
				//$params["text"] = preg_replace('/<[^>]*>/', '', @$object["text"]);

				//if (empty($params["text"]))
				//	$params["text"] =(isset($object["description"]) ? preg_replace('/<[^>]*>/', '',$object["description"]) : "");
				
				if(@$params["object"]["type"]==Event::COLLECTION || $params["object"]["type"]==Need::COLLECTION){
					$params["startDate"]=@$object["startDate"];
					$params["endDate"]=@$object["endDate"];
					$params["startDateSec"]=@$object["startDateSec"];
					$params["endDateSec"]=@$object["endDateSec"];
					
				}

				if(@$params["object"]["type"]==News::COLLECTION){
					//$params["text"] = $params["object"][""]
					//var_dump($params["object"]); exit;
					$params["object"] = array_merge($params["object"], $object);
					
				}

				if(@$object["address"])
					$params["scope"]["address"]=$object["address"];


			}else{
				$params=array("created"=>$params["created"]);
				return $params;
			}
		}
		if(@$params["target"]["type"]){
			if ($params["target"]["type"] == Organization::COLLECTION){
				$params["target"]=Organization::getSimpleOrganizationById($params["target"]["id"]);
				$params["target"]["type"]=Organization::COLLECTION;
			}
			else if ($params["target"]["type"]== Project::COLLECTION){
				$params["target"] = Project::getSimpleProjectById($params["target"]["id"]);
				$params["target"]["type"]=Project::COLLECTION;

			}
			else if($params["target"]["type"]==Person::COLLECTION){
				$params["target"] =Person::getSimpleUserById($params["target"]["id"]);
				$params["target"]["type"]=Person::COLLECTION;
			}
			else if ($params["target"]["type"]==Event::COLLECTION){
				$params["target"] = Event::getSimpleEventById($params["target"]["id"]);
				$params["target"]["type"]=Event::COLLECTION;
			}
				
		}
		// if(@$params["type"]=="news"){
		// 	if(@$params["text"]){
		// 		$params["text"]=preg_replace('/<[^>]*>/', '',(isset($params["text"]) ? $params["text"] : ""));
		// 	}
			// if($params["scope"]["type"]=="public" && !@$params["scope"]["cities"][0]["addressLocality"] && @$params["scope"]["cities"][0]["postalCode"]){
			// 	$address=SIG::getAdressSchemaLikeByCodeInsee($params["scope"]["cities"][0]["codeInsee"],$params["scope"]["cities"][0]["postalCode"]);
			// 	if(empty($address)){
			// 		$params=array("created"=>$params["created"]);
			// 		return $params;
			// 	}
			// 	$params["scope"]["cities"][0]["addressLocality"]=$address["addressLocality"];
			// }
		//}
		if(@$params["media"] && !is_string(@$params["media"]) && $params["media"]["type"]=="gallery_images"){
			$images=array();
			$limit=5;
			$i=0;
			foreach($params["media"]["images"] as $data){
				if($i<$limit){
					if(@$data && !empty($data)){
						$image=Document::getById($data);
						if(@$image){
							array_push($images,$image);
						}else{
							$countImages=intval($params["media"]["countImages"]);
							$countImages--;
							$params["media"]["countImages"]=$countImages;
						}
					}else{
						$countImages=intval($params["media"]["countImages"]);
						$countImages--;
						$params["media"]["countImages"]=$countImages;
					}
				} else {
					exit;
				}
			}
			$params["media"]["images"]=$images;
		}

		if(!isset($params["author"]["id"])){ 
			//var_dump($params["author"]); //exit;
			if(@$params["targetIsAuthor"]==true){
  			$author =  Element::getByTypeAndId($params["target"]["type"], $params["target"]["id"]);
  			$params["authorName"] = @$author["name"];
  			$params["authorId"] = @$params["target"]["id"];
  			$params["authorType"] = @$params["target"]["type"];
			}else{
  			$author =  Person::getSimpleUserById($params["author"]);
	  		}
	  	}else{
	  		$author = $params["author"];
	  	}
	  	//var_dump($params["author"]); //exit;
  		if (!empty($author)) $params["author"] = $author;
	  	else return array("created"=>$params["created"]);
		
		if(isset($params["sharedBy"])){
			$sharedBy = array();
			foreach($params["sharedBy"] as $key => $id){
				$share =  Person::getSimpleUserById($id);
				if (!empty($share)) $sharedBy[] = $share;
			}
			$params["sharedBy"] = $sharedBy;
		  	
		}
		return $params;
	}
}
