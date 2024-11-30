<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m241129_151535_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string()->notNull(),
            'lastname' => $this->string(),
            'email' => $this->string(120)->notNull()->unique(),
            'password' => $this->string(20)->notNull(),
            'auth_key' => $this->string()->notNull(),
            'access_token' => $this->string()
        ]);

        $this->createIndex(
            'idx-users_email',
            'users',
            'email'
        );

        $this->createIndex(
            'idx-users_auth_key',
            'users',
            'auth_key'
        );

        $this->createIndex(
            'idx-users_access_token',
            'users',
            'access_token'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');

        $this->dropIndex(
            'idx-users_username',
            'users'
        );

        $this->dropIndex(
            'idx-users_auth_key',
            'users'
        );

        $this->dropIndex(
            'idx-users_access_token',
            'users'
        );
    }
}
