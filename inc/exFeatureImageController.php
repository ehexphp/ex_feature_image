<?php
/**
 * Created by PhpStorm.
 * User: samtax
 * Date: 01/12/2018
 * Time: 3:03 PM
 */







class exFeatureImageController extends Controller1{

    static function initController(){
        $model_id = $_REQUEST['model_id'];
        $model_name = $_REQUEST['model_name'];
        /** @var Model1 $model */
        $model = $model_name::withId($model_id);

        // call action method
        if($model) static::removeImageColumn($model);
    }


    /**
     * @param $model Model1
     * @return bool|string
     */
    static function removeImageColumn($model){
        // action
        //$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
        //$save_option = $_REQUEST['save_option'];
        return !!($model->update(['feature_image_url'=>'']));
    }
}