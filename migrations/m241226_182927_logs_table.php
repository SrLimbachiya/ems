<?php

use yii\db\Migration;

/**
 * Class m241226_182927_logs_table
 */
class m241226_182927_logs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableSchema = $this->db->schema->getTableSchema('logs');
        if (!$tableSchema) {
            echo "Table Doesn't Exist\nCreating 'logs' Table.\n";
            $this->createTable('logs', [
                'id' => $this->primaryKey()->unsigned(),
                'data_id' => $this->string(190)->comment('Primary key of the data that has been updated/added'),
                'log_type' => $this->string(100)->comment('Type of log create/update/delete'),
                'section_name' => $this->string(100)->comment('Section such as employee record, department, designation'),
                'values' => $this->text()->comment('Updated attributes'),
                'created_at' => $this->integer()->comment('Created At'),
                'updated_at' => $this->integer()->comment('Updated At'),
                'created_by' => $this->integer()->comment('Created By'),
                'updated_by' => $this->integer()->comment('Updated By'),
            ]);
        } else {
            echo "Table 'logs' Exists\nChecking For Columns\n";
            $existingColumns = array_map('strtolower', $tableSchema->columnNames);
            $columnsToAdd = [
                'id' => $this->primaryKey()->unsigned(),
                'data_id' => $this->string(190)->comment('Primary key of the data that has been updated/added'),
                'log_type' => $this->string(100)->comment('Type of log create/update/delete'),
                'section_name' => $this->string(100)->comment('Section such as employee record, department, designation'),
                'values' => $this->text()->comment('Updated attributes'),
                'created_at' => $this->integer()->comment('Created At'),
                'updated_at' => $this->integer()->comment('Updated At'),
                'created_by' => $this->integer()->comment('Created By'),
                'updated_by' => $this->integer()->comment('Updated By'),
            ];

            foreach ($columnsToAdd as $columnName => $columnDefinition) {
                if (!in_array(strtolower($columnName), $existingColumns)) {
                    $this->addColumn('logs', $columnName, $columnDefinition);
                }
            }

            $command = $this->db->createCommand("SHOW INDEX FROM logs");
            $existingIndexes = $command->queryAll();

            $indexes = array(
                0 =>
                    array(
                        'name' => 'PRIMARY',
                        'columns' =>
                            array(
                                0 => 'id',
                            ),
                        'isUnique' => true,
                    ),
                1 =>
                    array(
                        'name' => 'data_id_sec_type',
                        'columns' =>
                            array(
                                0 => 'data_id',
                                1 => 'section_name',
                                2 => 'log_type'
                            ),
                        'isUnique' => true,
                    ),
            );

            $existingIndexNames = array_column($existingIndexes, 'Key_name');

            foreach ($indexes as $index) {
                if (!in_array($index['name'], $existingIndexNames)) {
                    if ($index['isUnique']) {
                        $this->createIndex($index['name'], 'logs', $index['columns'], true);
                    } else {
                        $this->createIndex($index['name'], 'logs', $index['columns']);
                    }
                }
            }

        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241226_182927_logs_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241226_182927_logs_table cannot be reverted.\n";

        return false;
    }
    */
}
