<?php

namespace BackupTool\Service\DB\SQL;

use BackupTool\Model\DbCredentials;
use BackupTool\Service\DB\IDbService;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use \PDO;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;

class SqlDbService implements IDbService {
    private $connection;

    function __construct(string $type, DbCredentials $credentials){

        $config = new Configuration();
        $params =[
            'driver'    => $type,
            'dbname'    => $credentials->getDb(),
            'host'      => $credentials->getHost(),
            'user'      => $credentials->getUsername(),
            'password'  => $credentials->getPassword(),
            'port'      => $credentials->getPort()
        ];

        $this->connection = DriverManager::getConnection($params, $config);
    }


    public function isConnectionValid(): bool {
      return $this->connection->ping();
    }

    public function backup(OutputInterface $output, $resource):void {
        // Initialize Connection
        $this->connection->connect();
        $this->connection->setFetchMode(PDO::FETCH_NUM);
        $tables = $this->connection->fetchAll('SHOW TABLES');

        // Adding Visual appealing of progression
        $progress = new ProgressBar($output, count($tables));

        // Go through each table
        foreach ($tables as $table) {
            // Progress Bar advance
            $progress->advance();

            $tableMetadata = $this->getTableMetadata($table[0]);

            $this->writeTableQuery($tableMetadata, $resource);

            // Generate Header Insert Query
            $headerInsertQuery = $this->generateInsertQueryHeader(
                $tableMetadata['name'],
                $tableMetadata['columns']['count'],
                $tableMetadata['columns']['list']
            );

            // Add Table Values
            $statement = $this->connection->executeQuery('SELECT * FROM '.$table[0]);

            while (($result = $statement->fetch(PDO::FETCH_NUM)) !== false ){
               $query = "(";
                for($i = 0; $i < $tableMetadata['columns']['count']; $i++) {
                    $query .= sprintf("'%s'",addslashes($result[$i]));
                    $query .= ($i === $tableMetadata['columns']['count']-1)? ");":",";
                }

                fwrite($resource, $headerInsertQuery.$query.PHP_EOL);
            }
        }

        // Finish Progress Bar Effect
        $progress->finish();
        $output->writeln(PHP_EOL);
    }

    public function upload($resource):void {

    }

    private function getTableMetadata(string $tableName):array {
        // Get Table Creation Information
        $tableCreationInfo = $this->connection->fetchArray("SHOW CREATE TABLE " . $tableName)[1];

        return [
            'name'          => $tableName,
            'creationInfo'  => $tableCreationInfo . ";".PHP_EOL,
            'deleteInfo'    => "DROP TABLE IF EXISTS `$tableName`;" .PHP_EOL,
            'columns'       => $this->getTableColumnMetadata($tableName)
        ];
    }

    private function getTableColumnMetadata(string $tableName):array {
        // Get Column Names
        $columnList = $this->connection->fetchAll("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'");
        // Get Column Count
        $columnCount = count($columnList);
        return [
            'list' => $columnList,
            'count' => $columnCount
        ];
    }

    private function writeTableQuery(array $metadata, $resource):void{
        // Write Comment on which Table is being backed up
        fwrite($resource, sprintf("/* Backing up table: %s */;".PHP_EOL,$metadata['name']));

        // Write on File: Drop Table if exist
        fwrite($resource, $metadata['deleteInfo']);

        // Write on File: Create Table
        fwrite($resource, $metadata['creationInfo']);
    }
    private function generateInsertQueryHeader(string $tableName, int $columnCount, array $columnList):string{
        // Create Initial Insert Syntax
        $headerQuery = "INSERT INTO `$tableName` (";

        for($i = 0; $i < $columnCount; $i++) {
            $headerQuery .= sprintf("`%s`", $columnList[$i][0]);
            $headerQuery .= ($i === $columnCount-1)? ")":",";
        }

        $headerQuery .= " VALUES ";

        return $headerQuery;
    }
}