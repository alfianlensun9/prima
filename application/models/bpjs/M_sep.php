<?php
class M_sep extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function allSEP()
    {
        return $this->db->select('*')
            ->from('db_bpjs.trx_sep_uat as a')
            ->where('a.date_deleted IS NULL')
            ->get()->result();
    }

    public function allPengajuanSEP()
    {
        return $this->db->select('*')
            ->from('db_bpjs.trx_pengajuan_sep as a')
            ->where('a.date_deleted IS NULL')
            ->get()->result();
    }

    public function createSEPUAT($data_insert)
    {
        $this->db->insert('db_bpjs.trx_sep_uat', $data_insert);
    }

    public function deleteSEPUAT($no_sep)
    {
        $dataupdate = [
            'date_deleted' => date('Y-m-d H:i:s'),
        ];

        $this->db->where('no_sep', $no_sep)
            ->update('db_bpjs.trx_sep_uat', $dataupdate);
    }

    public function createPengajuanSEP($data_insert)
    {
        $this->db->insert('db_bpjs.trx_pengajuan_sep', $data_insert);
    }

    public function updatePengajuanSEP($id)
    {
        $dataupdate = [
            'flag_approval' => 1,
        ];

        $this->db->where('id', $id)
            ->update('db_bpjs.trx_pengajuan_sep', $dataupdate);
    }
}
