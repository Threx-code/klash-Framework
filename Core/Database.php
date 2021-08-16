<?php
/**
 * @author Oluwatosin Amokeodo<oluwatosin.amokeodo@skopos.io>
 * @package klash
 * 
 */

namespace App\Core;


class Database
{

	public \PDO $pdo;

	public function __construct(array $config)
	{
		$dsn = $config['dsn'];
		$user = $config['user'];
		$password = $config['password'];
		$this->pdo = new \PDO($dsn, $user, $password);
		$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}


	public function applyMigration()
	{
		$this->createMigrationTable();
		$existingMigrations = $this->getAllMigrations();

		$applyMigrations = [];

		$files = scandir(Application::$ROOT_DIR."/migrations");

		$newMigrations = array_diff($files, $existingMigrations);

		$ignoreArray = ['.', '..'];

		foreach ($newMigrations as $migration) {
			if(in_array($migration, $ignoreArray)){
				continue;
			}

			$getClass = pathinfo($migration, PATHINFO_FILENAME);

			

			if(file_exists(Application::$ROOT_DIR."/migrations/".$migration)){
				require_once Application::$ROOT_DIR."/migrations/".$migration;
				$classInstance = new  $getClass();
			}

			$this->log("Currently migrating ". $migration);
			$classInstance->up();
			$this->log("Migration completed for ". $migration);

			$applyMigrations[] = $migration;
		}

		if(!empty($applyMigrations)){
			$this->saveMigrations($applyMigrations);
		}else{
			$this->log("All migrations applied");
		}
	}

	public function createMigrationTable()
	{
		$this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
			id INT AUTO_INCREMENT PRIMARY KEY,
			migration VARCHAR(255) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		) ENGINE=INNODB");
	}

	public function getAllMigrations()
	{
		$statement = $this->pdo->prepare("SELECT migration FROM migrations");
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_COLUMN);

	}

	public function saveMigrations(array $migrations)
	{
		$str = implode(",",  array_map(fn($m) =>"('$m')", $migrations));
		$statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
			$str");
		$statement->execute();
	}

	public function prepare($sql)
	{
		return $this->pdo->prepare($sql);

	}


	protected function log($message)
	{
		echo '['.date('Y-m-d H:i:s').'] - '.$message.PHP_EOL;
	}

}