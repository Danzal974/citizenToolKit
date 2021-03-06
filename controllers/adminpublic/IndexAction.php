<?php

class IndexAction extends CAction
{
    public function run($key)
    {
    	$controller=$this->getController();
        $page = "../error/error";
        if(Role::isSourceAdmin(Role::getRolesUserId(Yii::app()->session["userId"]))){
            if(Person::getSourceAdmin(Yii::app()->session["userId"])){
                $params["entitiesSourceAdmin"] = Import::getAllEntitiesByKey($key);
                $page = "index";
            }
        }

        if(!empty($params["entitiesSourceAdmin"])){
            foreach ($params["entitiesSourceAdmin"] as $typeEntities => $entities) {
                foreach ($entities as $key => $entity) {
                    if(Person::CONTROLLER == $typeEntities){
                        $element = Person::getPublicData((String)$entity['id']);
                        $element["typeSig"] = "people";
                    }
                    else if(Organization::CONTROLLER == $typeEntities){
                        $element = Organization::getPublicData((String)$entity['id']);
                         $element["typeSig"] = "organizations";
                    }
                    else if(Event::CONTROLLER == $typeEntities){
                        $element = Event::getPublicData((String)$entity['id']);
                        $element["typeSig"] = "events";
                    }
                    else if(Project::CONTROLLER == $typeEntities){
                        $element = Project::getPublicData((String)$entity['id']);
                        $element["typeSig"] = "projects";
                    }  
                    $params["contextMap"][]=$element;
                }
            } 
        }
            
        
        if(Yii::app()->request->isAjaxRequest)
                echo $controller->renderPartial("index",$params,true);
            else 
                $controller->render("index",$params);
         
        
    }
}