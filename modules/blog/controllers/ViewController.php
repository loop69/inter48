<?php

namespace app\modules\blog\controllers;

use Yii;
use app\modules\blog\models\Post;
use yii\data\ActiveDataProvider;
use app\modules\blog\models\PostSearch;
use app\modules\blog\models\Category;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PostController implements the CRUD actions for Post model.
 */
class ViewController extends Controller
{
    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()		
{
//    $cat = new Category();
//    $model = $cat->find()->select(['id','name'])->orderBy('id')->asArray()->all();

//    foreach ($model as $item) {
//       $post_title['id'] = $item->id;
//        $post_title['name'] = $item->name;
//   }



    $dataProvider = new ActiveDataProvider([
           'query' => Post::find()->where(['status'=>1])->with('category')->orderBy('created_at DESC'),
           'pagination' => [
                    'pageSize' => 10,
           ],
        ]);
        $data = new ActiveDataProvider([
            'query' => Category::find()->select(['id','name'])->orderBy('id ASC'),

        ]);
       $this->view->title = 'News List';
       return $this->render('index', ['listDataProvider' => $dataProvider, 'post_title' => $data]);



 //   $post = new Post();
 //   $model = $post->find()->where(['status'=>1])->all();
//        $searchModel = new PostSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

   // return $this->render('index', [
        // 'searchModel' => $searchModel,
     //   'model' => $model,
   // ]);
}
    public  function actionBycategory($category_id)
    {
		$cat = new Category();
		$model = $cat->findOne($category_id);
	    $category_title = $model->name;

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where(['status'=>1,'category_id'=>$category_id])->with('category')->orderBy('created_at DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        $data = new ActiveDataProvider([
            'query' => Category::find()->select(['id','name'])->orderBy('id ASC'),

        ]);
        return $this->render('categoryindex', ['listDataProvider' => $dataProvider, 'post_title' => $data, 'category_title'=> $category_title]);
    }


    public function actionShow($id)
    {
        $post = new Post();
        $model = $post->findOne(['id'=>$id, 'status'=>1]);
        $category = new Category();
        $cat_title = $category->findOne($model->category_id);

//        $searchModel = new PostSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('show', [
            // 'searchModel' => $searchModel,
            'model' => $model, 'cat_title'=>$cat_title,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'category' => Category::find()->all()
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        // $post = $this->findModel($id);
        $model = $this->findModel($id);

        if (Yii::$app->user->can('updatePost', ['post' => $model])) {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'category' => Category::find()->all()

                ]);
            }
        }else{echo 'ddd';}
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->user->can('deletePost', ['post' => $model])) {

            $model->delete();

            return $this->redirect(['index']);
        }
        else{
            echo 'deny';
        }
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}