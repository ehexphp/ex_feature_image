# EasyTax exFeatureImage (v1.0)

#### Required
> Nothing


#### Use 
> Add exFeatureImage Plugin Folder to your project or shared plugin folder.
> This Will Allows you to use exFeatureImage in your EasyTax Project.

```php 
    // Parameter
    exFeatureImage::imageUploadBox($model = null, $imageFieldName = 'feature_image_url', $label_title = 'Feature Image Upload',  $image_style = 'height:150px;width:150px;', $labelName = 'Feature image')
    
    // Use Example
    echo exFeatureImage::imageUploadBox($model, 'feature_image_url', 'Feature Image Upload') 
```


#### Save Image
> Saving image is not handle automatically, Therefore, you can save image in ```Blog@processSave()``` like this.
```php
    static function processSave($id = null){
        // Upload Feature Image
        if(isset($_FILES['image']) && isset($_FILES['image']['tmp_path'])){
            $link = ImgurFileManager::instance()->upload($_FILES['image']['tmp_path'])->link();
            if($link) $result->update(['feature_image_url'=>$link]);
            else Session1::setStatus('Image Uploading Failed', 'Failed to Upload Feature Image to Server, Please try again');
        }
    }
```

## 
## 
## 
## 
## THE END
## 
## 
## 
## 





#### Sample Code
> View Code, Put in your blog Edit
```php
     <div class="form-group">
        <label><i class="fa fa-image" aria-hidden="true"></i> Feature Image Upload</label>
        <div style="border:1px solid #e7e7e7;text-align:center">
            {!! HtmlWidget1::imageUploadBox('image',  $model->id > 1? $model->feature_image_url: null, 'height:150px;width:100%', 'Feature image') !!}
            @if(!empty($model->feature_image_url))
                <script>
                    function removeImage() {
                        Popup1.confirmAjax('Remove Feature Image', 'Are you Sure you want to remove <?= $model->feature_image_url ?>', "{!! Form1::callApi("Blog::removeFeatureImage($model->id)?token=".token()) !!}", function(response){
                            if(response){
                                Popup1.alert('Picture Removed!', 'Picture Removed Successfully', 'success');
                                document.getElementById("{{ $model->feature_image_url }}").src = "{!! HtmlAsset1::getImageThumb() !!}";
                            }else{
                                Popup1.alert('Action Failed', 'Failed to Removed Picture!', 'error');
                            }
                        })
                    }
                </script>
                <button type="button" class="btn btn-danger" onclick="removeImage()"><i class="fa fa-trash" aria-hidden="true"></i> Remove Image</button>
            @endif
        </div>
    </div>
```

> Controller Code
```php
    class Blog extend Model1{
        public $name = '';
        public $slug = '';
        public $body = null;
        public $feature_image_url = '';
        ...
        static function removeFeatureImage($blog_id){ 
            return !!(Blog::withId($blog_id)->update(['feature_image_url'=>''])); 
        }
        ...
    }
```
