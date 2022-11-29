<?php

namespace app\controllers;

use app\models\Img;
use app\models\UploadForm;
use yii\web\Controller;
use yii\web\UploadedFile;

class UploadController extends Controller
{
    public function actionIndex2()
    {
        $model = new UploadForm();

        if (\Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                // file is uploaded successfully
                return $this->redirect(['view']);
            }
        }

        return $this->render('index', ['model' => $model]);
    }


    public function actionIndex()
    {
        $modeluf = new UploadForm();

        if (\Yii::$app->request->isPost) {
            $modeluf->imageFiles = UploadedFile::getInstances($modeluf, 'imageFiles');

            if ($modeluf->validate()) {
                foreach ($modeluf->imageFiles as $file) {
                    debug($file);
                    $file_name = translit(strtolower($file->baseName)) . '.' . $file->extension;

                    $model = new Img();
                    $model->name = $file_name;
                    if (!$model->validate()){
                        $file_name = translit(strtolower($file->baseName)) . date("is") . '.' . $file->extension;
                        $model->name = $file_name;
                    }
                    $dir = 'upload/';
                    if(!is_dir($dir)){
                        mkdir($dir);
                    }
                    $file->saveAs($dir . $file_name);

                    debug($model->name);
                    $model->save();
                }
                return $this->redirect('view');
            }
        }

        return $this->render('index', ['modeluf' => $modeluf]);
    }


    public function actionView()
    {
        $sortable = $_GET['sort'] ?? 'nameup';
        switch ($sortable):
            case 'nameup':
                $sort = 'name ASC';
                $selected = 'nameup';
                break;
            case 'namedown':
                $sort = 'name DESC';
                $selected = 'namedown';
                break;
            case 'dateup':
                $sort = 'created_at ASC';
                $selected = 'dateup';
                break;
            case 'datedown':
                $sort = 'created_at DESC';
                $selected = 'datedown';
                break;
            default:
                $sort = 'name ASC';
                $selected = 'nameup';
        endswitch;

        $images = Img::find()
            ->orderBy($sort)
            ->all();
        return $this->render('view', compact('images', 'selected'));
    }

}