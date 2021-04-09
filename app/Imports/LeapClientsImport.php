<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\LeapClient;

class LeapClientsImport implements ToModel, WithHeadingRow {

    public function model(array $row) {
        return new LeapClient([
            'matter_no' => $row['matter_no'],
            'client_name' => $row['client_name'],
            'staff_acting' => $row['staff_acting'],
            'trust_balance' => $row['trust_balance'],
            'wip_balance' => $row['wip_balance'],
            'debtor_balance' => $row['debtor_balance'],
            'cost_recovery' => $row['cost_recovery'],
            'net_position' => $row['net_position'],
        ]);
    }

}
