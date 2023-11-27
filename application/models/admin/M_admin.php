<?php
class M_admin extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getGroupUser()
    {
        return $this->db->where('flag_active', 1)
            ->get('auth_group')->result_array();
    }

    public function getListUser()
    {
        return $this->db->select('*')
            ->from('auth_users as a')
            ->join('auth_group as b', 'a.id_auth_group = b.id_auth_group')
            ->where('a.flag_active', 1)
            ->get()->result_array();
    }

    public function createUser()
    {
        $datapost = $this->input->post();
        $generatePassword = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $this->db->insert('auth_users', [
            'id_auth_group' => $datapost['id_mst_group'],
            'fullname' => $datapost['fullname'],
            'username' => $datapost['no_telp'],
            'no_handphone' => $datapost['no_telp'],
            'password' => $generatePassword,
            'id_telegram' => $datapost['id_telegram'],
        ]);
    }

    public function deleteUser($id)
    {
        $this->db->where('id_auth_users', $id)
            ->update('auth_users', [
                'flag_active' => 0
            ]);
    }

    public function editUser($id)
    {
        $datapost = $this->input->post();
        $dataupdate = [
            'id_auth_group' => $datapost['id_mst_group'],
            'id_trx_kepegawaian' => $datapost['id_trx_kepegawaian'],
            'fullname' => $datapost['fullname'],
            'username' => $datapost['no_telp'],
            'no_handphone' => $datapost['no_telp'],
            'id_telegram' => $datapost['id_telegram'],
        ];
        if ($this->input->post('password')) {
            $generatePassword = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $dataupdate['password'] = $generatePassword;
        }

        // dd($dataupdate);    
        $this->db->where('id_auth_users', $id)
            ->update('auth_users', $dataupdate);
    }

    public function getUserById($id)
    {
        return $this->db->select('*')
            ->from('auth_users as a')
            ->join('auth_group as b', 'a.id_auth_group = b.id_auth_group')
            ->where('a.id_auth_users', $id)
            ->limit(1)
            ->get()->row_array();
    }
}
