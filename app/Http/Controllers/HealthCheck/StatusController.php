<?php

namespace App\Http\Controllers\HealthCheck;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke()
    {
        $status = $this->getApplicationStatus();
        return response()->json($status, 200);
    }

    protected function getApplicationStatus()
    {
        $status = [
            'status' => 'active',
            'environment' => app()->environment(),
            'database' => $this->checkDatabaseStatus(),
        ];

        return $status;
    }

    protected function checkDatabaseStatus()
    {
        try {
            $pdo = \DB::connection()->getPdo();
            $start = microtime(true);
            $pdo->getAttribute(\PDO::ATTR_SERVER_INFO);
            $pingTime = (microtime(true) - $start) * 1000; // Em milissegundos
            $tables = $this->getDatabaseTables();

            return [
                'status' => 'connected',
                'ping_time_ms' => $pingTime,
                'tables' => $tables,
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'error_message' => $e->getMessage(),
            ];
        }
    }

    protected function getDatabaseTables()
{
    try {
        $tables = \DB::select("
            SELECT table_name
            FROM information_schema.tables
            WHERE table_schema = 'public'
        ");
        
        $tableList = [];
        foreach ($tables as $table) {
            $tableName = $table->table_name;
            $tableList[] = $tableName;
        }

        return $tableList;
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
}

}
