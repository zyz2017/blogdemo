<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property integer $userid
 * @property string $email
 * @property string $url
 * @property integer $post_id
 * @property integer $remind 
 *
 * @property User $user
 * @property Post $post
 * @property Commentstatus $status0
 * @property User $user 
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id', 'content', 'status', 'userid', 'post_id'], 'required'],
	    [['content', 'status', 'userid', 'post_id'], 'required'],
            [['id', 'status', 'create_time', 'userid', 'post_id', 'remind'], 'integer'],
            [['content'], 'string'],
            [['email', 'url'], 'string', 'max' => 128],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Commentstatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
            'status' => '状态',
            'create_time' => '发布时间',
            'userid' => '用户',
            'email' => 'Email',
            'url' => 'Url',
            'post_id' => '文章',
	    'remind' => '是否提醒',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Commentstatus::className(), ['id' => 'status']);
    }

    public function getBeginning(){
	$tmpStr = strip_tags($this->content);
	$tmpLen = mb_strlen($tmpStr);
	return mb_substr($tmpStr,0,20,'utf-8').(($tmpLen>20)?'...':'');
	}

    /**
    * @return \yii\db\ActiveQuery
    */
   public function getUser()
   {
       return $this->hasOne(User::className(), ['id' => 'userid']);
   }

    public function approve()
    {
    	$this->status = 0; //设置评论状态为已审核
    	return $this->save()?true:false;
    }

    public static function getPengdingCommentCount(){
	return Comment::find()->where(['status'=>1])->count();
	}
    public function beforeSave($insert){
	if(parent::beforeSave($insert)){
		if($insert){
			$this->create_time=time();
		}
		return true;
	}else return false;
	}

    public static function findRecentComments($limit=10)
    {
    	return Comment::find()->where(['status'=>2])->orderBy('create_time DESC')
    	->limit($limit)->all();
    }   
}
