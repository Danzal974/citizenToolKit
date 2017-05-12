<?php
/**
 * a notification has been read by a user
 * remove it's entry in the notify node on an activity Stream for the current user
 * @return [json] 
 */
class GetAction extends CAction
{
     public function run($type,$id) { 
        $res = array();
        if( Yii::app()->session["userId"] )
        {
          if($type != Person::COLLECTION){
            $params = array(
              '$and'=> 
                array(
                  array("notify.id.".Yii::app()->session["userId"] => array('$exists' => true),
                  "verb" => array('$ne' => ActStr::VERB_ASK)),
                  array('$or'=> array(
                    array("target.type"=>$type, "target.id" => $id),
                    array("target.parent.type"=>$type, "target.parent.id" => $id)
                    )
                  ) 
                ) 
              );
          }else
            $params = array("notify.id.".Yii::app()->session["userId"] => array('$exists' => true));
          $res = ActivityStream::getNotifications($params);
          if(!empty($res)){
            $timezone="";
             foreach($res as $key => $data){
                if(@$data["updated"]){
                  $res[$key]["timeAgo"]=Translate::pastTime(date(@$data["updated"]->sec), "timestamp", $timezone);
                  $res[$key]["sortDate"]=$data["updated"];
                }
                else if(@$data["created"]){
                  $res[$key]["timeAgo"]=Translate::pastTime(date(@$data["created"]->sec), "timestamp", $timezone);
                   $res[$key]["sortDate"]=$data["created"];
                }
             } 
            $res = Notification::sortNotifs($res, array('sortDate'=>SORT_DESC));
          }
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
            
        Rest::json($res,false);  
        Yii::app()->end();
    }
}