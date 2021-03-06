<?php

namespace sterkado\crontab\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m200329_060852_create_cron_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cron_task}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'schedule' => $this->string(),
            'route' => $this->string(),
            'params' => $this->text(),
            'is_enabled' => $this->tinyInteger()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cron_task}}');
    }
}
