<?php
/**
* retreive dynamically 
*/
class IncNbClickAction extends CAction
{
    public function run() {
    	$controller=$this->getController();
        
        $result = array();
        $query = array();
        if(isset($_POST["url"])){
            $url = $_POST["url"];
        	$query = array("url"=>$url);
            $siteurl = PHDB::findOne("siteurl", $query);

            if(isset($siteurl["_id"])){
                $id = $siteurl["_id"];
                $nbClick = $siteurl["nbClick"];
                $nbClick++;
                $set = array("nbClick"=>$nbClick);
                $resUpdate = PHDB::update( "siteurl", array("_id" => new MongoId($id)), 
                                          array('$set' => $set));

                $result = array("resUpdate"=>$resUpdate, "nbClick"=>$nbClick);
            }
        }

    	Rest::json($result);
        Yii::app()->end();
    }
}