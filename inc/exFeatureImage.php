<?php
/**
 * Created by PhpStorm.
 * User: samtax
 * Date: 01/12/2018
 * Time: 3:03 PM
 */







class exFeatureImage{


    static function imageUploadBox($model = null, $imageFieldName = 'feature_image_url', $label_title = 'Feature Image Upload',  $image_style = 'height:150px;width:150px;', $labelName = 'Feature image'){
        ob_start();
            if(!$model) throw new Exception(Console1::println(static::class." Requires Model1 (with id column) Instance"));
            $existingDbImage = Model1FileLocator::selectAll_fromDb($model, false);
            $controller_url = Form1::callApi("exFeatureImageController::initController()?token=".token()."&model_name=".$model->getModelClassName()."&model_id=$model->id");
            $unique_id = String1::random(5);
            $existingImage = $model->id > 1? $model->{$imageFieldName}: null;
        ?>


        <div class="form-group">
            <label><i class="fa fa-image" aria-hidden="true"></i> <?= $label_title ?></label>
            <div style="border:1px solid #e7e7e7;text-align:center; <?= $image_style ?>">

                <?= HtmlWidget1::imageUploadBox('image',  $existingImage, $image_style, $labelName) ?>


                <?php if(!empty($existingImage)){ ?>
                    <script>
                        function removeImage_<?= $unique_id ?>() {
                            Popup1.confirmAjax('Remove Feature Image', 'Are you Sure you want to remove <?= $existingImage ?>', "<?= Form1::callApi("exFeatureImageController::removeFeatureImage($model->id)?token=".token()) ?>", function(response){
                                if(response){
                                    Popup1.alert('Picture Removed!', 'Picture Removed Successfully', 'success');
                                    document.getElementById("<?= $model->{$imageFieldName} ?>").src = "<?= HtmlAsset1::getImageThumb() ?>";
                                }else{
                                    Popup1.alert('Action Failed', 'Failed to Removed Picture!', 'error');
                                }
                            })
                        }
                    </script>
                    <div>
                        <?php if(Url1::urlToPath($existingImage)) { ?>
                            <button type="button" class="btn btn-link" onclick="removeImage_<?= $unique_id ?>()"><i class="fa fa-times-circle" aria-hidden="true"></i> Remove Image</button>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>




        <?php
        return ob_get_clean();
    }
}