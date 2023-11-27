<?php


class C_admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_admin', 'adm');
        $this->load->model('sdm/M_kepegawaian', 'sdm');
    }

    public function index()
    {
        $data['group'] = $this->adm->getGroupUser();
        $data['users'] = $this->adm->getListUser();
        render('management_user/v_management_user', $data, 'managementuser');
    }

    public function createUser()
    {
        $id = $this->adm->createUser();
        redirect('admin/C_admin');
    }

    public function deleteUser($id)
    {
        $this->adm->deleteUser($id);
        redirect('admin/C_admin');
    }

    public function viewEditUser($id)
    {
        $data['group'] = $this->adm->getGroupUser();
        $data['header'] = $this->adm->getUserById($id);
        $data['listPegawai'] = $this->sdm->getListPegawai();
        // dd($data);
        render('management_user/v_management_user_edit', $data, 'managementuser');
    }

    public function editUser($id)
    {
        $this->adm->editUser($id);
        redirect('admin/C_admin');
    }
}
