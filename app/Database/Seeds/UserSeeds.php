<?php namespace App\Database\Seeds;
  
class UserSeeds extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'id_user'        => '2ed21e32e',
                'username'  => 'admin',
                'password'  =>  '$2y$10$StiNb1BUR78Y3./BqN1fse0B.AaHW8byt4hqcboawZx3VnbYF10tq',
                'privilage' => 'admin',
            ],
        ];
        $this->db->table('user')->insertBatch($data);
    }
} 