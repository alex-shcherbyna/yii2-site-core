<?php

namespace ashch\sitecore\components;

use Yii;
use yii\base\InvalidCallException;
use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;

/**
 * CreatorEditorBehavior automatically fills the specified attributes with the current User.

 */
class CreatorEditorBehavior extends AttributeBehavior
{

    /**
     * @var string the attribute that will receive [user->identity->id] value
     * Set this property to false if you do not want to record the creator id [user->identity->id].
     */
    public $createdByAttribute = 'created_by';

    /**
     * @var string the attribute that will receive [user->identity->id] value.
     * Set this property to false if you do not want to record the editor id [user->identity->id].
     */
    public $updatedByAttribute = 'updated_by';

    /**
     * @inheritdoc
     *
     * In case, when the value is `null`, the result of the Yii::$app->user->identity->id
     * will be used as value.
     */
    public $value;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->createdByAttribute, $this->updatedByAttribute],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->updatedByAttribute,
            ];
        }
    }

    /**
     * @inheritdoc
     *
     * In case, when the [[value]] is `null`, the result of the Yii::$app->user->identity->id
     * will be used as value.
     */
    protected function getValue($event)
    {
        if ($this->value === null) {
            return Yii::$app->user->identity->id;
        }

        //return parent::getValue($event);
    }

    /**
     * Updates a Editor user attribute to the current user->id.
     */
    public function touch($attribute)
    {
        /* @var $owner BaseActiveRecord */
        $owner = $this->owner;
        if ($owner->getIsNewRecord()) {
            throw new InvalidCallException('Updating the Editor user is not possible on a new record.');
        }
        $owner->updateAttributes(array_fill_keys((array) $attribute, $this->getValue(null)));
    }

}
