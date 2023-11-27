<?php
class M_master extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->sdm = $this->load->database('sdm', TRUE);
    }


    public function getMasterKategoriAlkes()
    {
        return $this->db->where('flag_active', 1)
            ->get('mst_kategori')->result_array();
    }

    public function getMstIndikator()
    {
        return $this->db->where('flag_active', 1)
            ->get('mst_indikator')->result_array();
    }

    public function getMstAlasanPending()
    {
        return $this->db->where('flag_active', 1)
            ->get('mst_alasan_pending')->result_array();
    }

    public function searchAlkes()
    {
        // dd($this->input->post());
        return $this->db->select('id, nama_alat_kesehatan')
            ->from('mst_nomenklatur_alat_kesehatan')
            ->like('nama_alat_kesehatan', $this->input->post('query'))
            ->get()->result_array();
    }

    public function createMasterUnit($unit)
    {
        $this->sdm->insert('mst_unit', $unit);
        return $this->sdm->insert_id();
    }

    public function getListUnit()
    {
        $this->sdm->select('*')
            ->from("mst_unit")
            ->where("deletedAt", null);
        return $this->sdm->get()->result_object();
    }

    public function getListJenisPegawai()
    {
        $this->sdm->select('*')
            ->from("mst_jenis_pegawai")
            ->where("deletedAt", null);
        return $this->sdm->get()->result_object();
    }

    public function getListKategoriPegawai()
    {
        $this->sdm->select('*')
            ->from("mst_kategori")
            ->where("deletedAt", null);
        return $this->sdm->get()->result_object();
    }

    public function getListGolonganPegawai()
    {
        $this->sdm->select('*')
            ->from("mst_golongan")
            ->where("deletedAt", null);
        return $this->sdm->get()->result_object();
    }
}
