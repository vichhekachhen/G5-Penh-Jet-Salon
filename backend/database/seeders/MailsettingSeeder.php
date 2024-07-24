<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mailsetting;

class MailsettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mailsetting::create([
            'mail_transport'            =>'smtp',
            'mail_host'                 =>'smtp.gmail.com',
            'mail_port'                 =>'465',
            'mail_username'             =>'dggihhg@gmail.com',
            'mail_password'             =>'kkbu vjmd ppme gpnx',
            'mail_encryption'           =>'tls',
            'mail_from'                 => 'dggihhg@gmail.com',
        ]);
    }
}
