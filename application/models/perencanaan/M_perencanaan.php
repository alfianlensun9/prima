<?php
class M_perencanaan extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function checkPerencanaan($thn){
        return $this->db->select('id_trx_perencanaan')
                            ->from('trx_perencanaan')
                            ->where('flag_active', 1)
                            ->where('tahun', $thn)
                            ->limit(1)
                            ->get()->row_array();
    }

    public function getPerencanaan(){
        return $this->db->select("id_trx_perencanaan,tahun,confirm_status")
                        ->from("trx_perencanaan")
                        ->where('flag_active', 1)
                        ->order_by('tahun', 'desc')
                        ->get()->result_array();
    }

    public function getPerencanaanDiKonfirmasi(){
        return $this->db->select("id_trx_perencanaan,tahun,confirm_status")
                        ->from("trx_perencanaan")
                        ->where('flag_active', 1)
                        ->where('confirm_status', 1)
                        ->order_by('tahun', 'desc')
                        ->get()->result_array();
    }

    public function getPerencanaanById($id){
        return $this->db->select("id_trx_perencanaan,tahun, confirm_status")
                        ->from("trx_perencanaan")
                        ->where('id_trx_perencanaan', $id)
                        ->get()->row_array();
    }

    public function getPerencanaanDetail($id_trx_perencanaan){
        return $this->db->select('*')
                        ->from('trx_perencanaan_detail as a')
                        ->join('mst_nomenklatur_alat_kesehatan as b', 'a.id_mst_alkes = b.id', 'left')
                        ->join('mst_kategori as c', 'a.id_mst_kategori = c.id_mst_kategori')
                        ->where('a.id_trx_perencanaan', $id_trx_perencanaan)
                        ->get()->result_array();
    }

    public function getPerencanaanDetailById($id_trx_perencanaan_detail){
        return $this->db->select('*')
                        ->from('trx_perencanaan_detail as a')
                        ->join('mst_nomenklatur_alat_kesehatan as b', 'a.id_mst_alkes = b.id', 'left')
                        ->join('mst_kategori as c', 'a.id_mst_kategori = c.id_mst_kategori')
                        ->where('a.id_trx_perencanaan_detail', $id_trx_perencanaan_detail)
                        ->get()->row_array();
    }

    public function createPerencanaan(){
        $this->db->insert('trx_perencanaan',[
            'tahun' => $this->input->post('tahun')
        ]);
        return $this->db->insert_id();
    }

    public function deletePerencanaan($tahun){
        $this->db->where('tahun', $tahun)
                    ->update('trx_perencanaan',[
            'flag_active' => 0
        ]);
        return $this->db->affected_rows();
    }

    public function deletePerencanaanDetail($id){
        $this->db->where('id_trx_perencanaan_detail', $id)
                    ->update('trx_perencanaan_detail',[
            'flag_active' => 0
        ]);
        return $this->db->affected_rows();
    }

    public function createPerencanaanDetail($id = 0){
        $datapost= $this->input->post();
        $this->db->insert('trx_perencanaan_detail', [
            'id_trx_perencanaan' => $id,
            'nm_barang_non_eplanning' => $datapost['nm_mst_barang_non_eplaning'],
            'id_mst_alkes' => isset($datapost['mst_alkes']) ? $datapost['mst_alkes'] : 0,
            'id_mst_kategori' => $datapost['mst_kategori'],
            'kuantitas' => $datapost['kuantitas'],
            'harga' => str_replace('.','',$datapost['harga']),
            'justifikasi' => $datapost['justifikasi'],
            'umur_aset' => $datapost['umur_aset'],
            'mudah_rusak' => $datapost['mudah_rusak'],
            'eplanning' => $datapost['eplanning'],
            'file_data_pendukung' => $datapost['filename']
        ]);

        return $this->db->insert_id();
    }

    public function konfirmasiPerencanaan($id){
        $this->db->where('id_trx_perencanaan', $id)
                    ->update('trx_perencanaan', [
                        'confirm_status' => 1
                    ]);
    }

    public function confirmValid($iddetail){
        $this->db->where('id_trx_perencanaan_detail', $iddetail)
                    ->update('trx_perencanaan_detail', [
                        'validate_priority' => $this->input->post('prioritas'),
                        'validate_status' => 1,
                        'validate_komentar' => $this->input->post('komentar'),
                        'validate_id_mst_indikator' => $this->input->post('indikator')
                    ]);

        return $this->db->affected_rows();
    }

    public function confirmPending($iddetail){
        $this->db->where('id_trx_perencanaan_detail', $iddetail)
                    ->update('trx_perencanaan_detail', [
                        'detail_alasan_pending' => $this->input->post('detail_alasan_pending'),
                        'id_mst_alasan_pending' => $this->input->post('id_mst_alasan_pending'),
                        'validate_status' => 2,
                    ]);

        return $this->db->affected_rows();
    }

    public function createPanduan($datafile){
        // dd($datafile);
        $this->db->insert('trx_panduan', [
            'nm_trx_panduan' => $this->input->post('nama_panduan'),
            'filename' => $datafile['file_name']
        ]);
    }

    public function getPanduan(){
        return $this->db->where('flag_active', 1)
                        ->get('trx_panduan')->result_array(); 
    }
}